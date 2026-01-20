<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $blogs = Blog::with(['author', 'category'])
            ->where('status', 'published')

            // 🔍 Search
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('content', 'like', '%' . $request->search . '%');
                });
            })

            // 📂 Category filter
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })

            // 🏷️ Tag filter
            ->when($request->tag, function ($query) use ($request) {
                $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('tags.id', $request->tag);
                });
            })

            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('user.blog.index', [
            'blogs'      => $blogs,
            'categories' => Category::orderBy('name')->get(),
            'tags'       => Tag::orderBy('name')->get(),
        ]);
    }
}
