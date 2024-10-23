<?php

namespace TeamTeaTime\Forum\Policies;

class ForumPolicy
{
    public function createCategories($user): bool
    {
        // return $user->role == 'Admin';
        return in_array($user->role, ['Moderator', 'Admin']);
    }

    public function moveCategories($user): bool
    {
        return in_array($user->role, ['Moderator', 'Admin']);
    }

    public function editCategories($user): bool
    {
        return in_array($user->role, ['Moderator', 'Admin']);
    }

    public function deleteCategories($user): bool
    {
        // return $user->role == 'Admin';
        return in_array($user->role, ['Moderator', 'Admin']);
    }

    public function markThreadsAsRead($user): bool
    {
        return true;
    }

    public function viewTrashedThreads($user): bool
    {
        return in_array($user->role, ['Moderator', 'Admin']);
    }

    public function viewTrashedPosts($user): bool
    {
        return in_array($user->role, ['Moderator', 'Admin']);
    }
}
