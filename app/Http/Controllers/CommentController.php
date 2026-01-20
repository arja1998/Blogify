<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CommentController extends Controller
{
    use AuthorizesRequests;
 
    /**
     * Store new comment (pending)
     */
    public function store(Request $request, Blog $blog)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'blog_id'   => $blog->id,
            'user_id'   => Auth::id(),
            'comment'   => $request->comment,
            'parent_id' => $request->parent_id,
            'status'    => 'pending',
        ]);

        return back()->with('success', 'Comment submitted for approval.');
    }
}
