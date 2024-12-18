<?php

namespace TeamTeaTime\Forum\Support\Access;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Collection;
use Kalnoy\Nestedset\Collection as NestedCollection;
use TeamTeaTime\Forum\Models\Category;
use TeamTeaTime\Forum\Models\Thread;

/**
 * CategoryAccess provides utilities for retrieving category data based on category privacy and user authorisation.
 */
class CategoryAccess
{
    const DEFAULT_SELECT = ['*'];
    const DEFAULT_WITH = ['newestThread', 'latestActiveThread', 'newestThread.lastPost', 'latestActiveThread.lastPost'];

    public static function getPrivateAncestor(?User $user, Category $category): ?Category
    {
        return $user && $user->can('editCategories')
            ? Category::defaultOrder()
                ->where('is_private', true)
                ->ancestorsOf($category->id)
                ->first()
            : null;
    }

    public static function getFilteredCategoryCollectionFor(User $user, array $threadIds): Collection
    {
        $query = Thread::whereIn('id', $threadIds);

        if ($user->can('viewTrashedThreads')) {
            $query = $query->withTrashed();
        }

        $categoryIds = $query->select('category_id')
            ->distinct()
            ->pluck('category_id')
            ->intersect(static::getFilteredIdsFor($user));

        return Category::whereIn('id', $categoryIds)->get();
    }

    public static function isAccessibleTo(?User $user, int $categoryId): bool
    {
        return static::getFilteredAncestorsFor($user, $categoryId, $select = ['id'], $with = [])->keys()->contains($categoryId);
    }

    public static function getFilteredIdsFor(?User $user): Collection
    {
        return static::getFilteredTreeFor($user, $select = ['id'], $with = [])->keys();
    }

    public static function getFilteredAncestorsFor(?User $user, int $categoryId, array $select = self::DEFAULT_SELECT, array $with = self::DEFAULT_WITH): NestedCollection
    {
        $categories = static::getQuery($select, $with)
            ->ancestorsAndSelf($categoryId)
            ->keyBy('id');

        return static::filter($categories, $user);
    }

    public static function getFilteredDescendantsFor(?User $user, int $categoryId, array $select = self::DEFAULT_SELECT, array $with = self::DEFAULT_WITH): NestedCollection
    {
        $categories = static::getQuery($select, $with)
            ->descendantsAndSelf($categoryId)
            ->keyBy('id');

        return static::filter($categories, $user);
    }

    public static function getFilteredTreeFor(?User $user, array $select = self::DEFAULT_SELECT, array $with = self::DEFAULT_WITH): NestedCollection
    {
        $categories = static::getQuery($select, $with)
            ->withDepth()
            ->get()
            ->keyBy('id');

        return static::filter($categories, $user);
    }

    public static function removeParentRelationships(Collection $categories): Collection
    {
        $categories->each(function ($category) {
            $category->setRelation('parent', null);
            if ($category->children) {
                $category->children = static::removeParentRelationships($category->children);
            }
        });

        return $categories;
    }

    private static function getQuery(array $select = self::DEFAULT_SELECT, array $with = self::DEFAULT_WITH): Builder
    {
        // 'is_private' and 'parent_id' fields are required for filtering
        return Category::select(array_merge($select, ['is_private', 'parent_id']))
            ->with($with)
            ->defaultOrder();
    }

    private static function filter(NestedCollection $categories, ?User $user, ?NestedCollection $rejected = null): NestedCollection
    {
        if ($rejected == null) {
            $rejected = $categories->reject(function ($category, $id) use ($user) {
                return !$category->is_private || (!is_null($user) && $user->can('view', $category));
            });
        }

        $categories = $categories->whereNotIn('id', $rejected->keys());
        $rejected = $categories->whereIn('parent_id', $rejected->keys());

        if ($rejected->count() > 0) {
            $categories = static::filter($categories, $user, $rejected);
        }

        return $categories;
    }
}
