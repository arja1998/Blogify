<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Notifications\CommentApprovedNotification;

class AdminCommentController extends Controller
{
    /**
     * List all comments
     */
    public function index()
    {
        $comments = Comment::with(['user', 'blog.author'])
            ->latest()
            ->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Approve comment
     */
    public function approve(Comment $comment)
    {
        $comment->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Comment approved.');
    }

    /**
     * Delete comment
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
