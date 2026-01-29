<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{

/**
     * Create comment
     */
    public function create(User $user): bool
    {
        // dd(auth()->User::roles->pluck('name'));

        return $user->is_active;
    }

    /**
     * Update own comment
     */
    public function update(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id;
    }

    /**
     * Delete own comment
     */
    public function delete(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->id;
    }

    
}
