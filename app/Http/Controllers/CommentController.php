<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\CommentApprovedNotification;
use App\Notifications\NewCommentNotification;
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

       $comment = Comment::create([
            'blog_id'   => $blog->id,
            'user_id'   => Auth::id(),
            'comment'   => $request->comment,
            'parent_id' => $request->parent_id,
            'status'    => 'pending',
        ]);


        // Notify blog author
      $blog->author->notify(new NewCommentNotification($comment));
      $admins = User::whereHas('roles', function ($q) {
      $q->where('name', 'admin');
      })->get();

      foreach ($admins as $admin) {
    $admin->notify(new NewCommentNotification($comment));
}


        return back()->with('success', 'Comment submitted for approval.');
    }

    
}
