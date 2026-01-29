<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BlogLikeController extends Controller
{
    public function toggle(Blog $blog)
    {
        $user = Auth::user();

        $existing = BlogLike::where('blog_id', $blog->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existing) {
            // Unlike
            $existing->delete();
        } else {
            // Like
            BlogLike::create([
                'blog_id' => $blog->id,
                'user_id' => $user->id,
            ]);
        }

        return back();
    }
}
