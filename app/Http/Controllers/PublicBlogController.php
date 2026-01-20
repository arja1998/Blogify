<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class PublicBlogController extends Controller
{
    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $blog->increment('view_count');

        return view('user.blog.show', compact('blog'));
    }
}
