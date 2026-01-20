<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Admin can do anything
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * View blog
     */
    public function view(User $user, Blog $blog): bool
    {
        return $blog->status === 'published'
            || $blog->user_id === $user->id;
    }

    /**
     * Create blog
     */
    public function create(User $user): bool
    {
        return $user->isAuthor();
    }

    /**
     * Update blog
     */
    public function update(User $user, Blog $blog): bool
    {
        return $blog->user_id === $user->id;
    }

    /**
     * Delete blog
     */
    public function delete(User $user, Blog $blog): bool
    {
        return $blog->user_id === $user->id;
    }

    /**
     * Publish blog
     */
    public function publish(User $user, Blog $blog): bool
    {
        return $blog->user_id === $user->id
            && $user->email_verified_at !== null;
    }
}
