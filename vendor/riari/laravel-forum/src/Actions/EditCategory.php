<?php

namespace TeamTeaTime\Forum\Actions;

use TeamTeaTime\Forum\Models\Category;

class EditCategory extends CreateCategory
{
    protected Category $category;

    public function __construct(Category $category, string $title, string $description, bool $acceptsThreads = true, bool $isPrivate = false)
    {
        parent::__construct($title, $description, $acceptsThreads, $isPrivate);
        $this->category = $category;
    }

    protected function transact()
    {
        $this->category->update([
            'title' => $this->title,
            'description' => $this->description,
            'accepts_threads' => $this->acceptsThreads,
            'is_private' => $this->isPrivate,
        ]);

        return $this->category;
    }
}
