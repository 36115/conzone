<?php

namespace TeamTeaTime\Forum\Policies;

use TeamTeaTime\Forum\Models\Post;

class PostPolicy
{
    public function edit($user, Post $post): bool
    {
        return $user->getKey() === $post->author_id || in_array($user->role, ['Moderator', 'Admin']);
    }

    public function delete($user, Post $post): bool
    {
        return $user->getKey() === $post->author_id || in_array($user->role, ['Moderator', 'Admin']);
    }

    public function restore($user, Post $post): bool
    {
        return in_array($user->role, ['Moderator', 'Admin']);
    }
}
