<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class AdminBlogController extends Controller
{
    /**
     * List all blogs (including soft deleted)
     */
    public function index()
    {
        $blogs = Blog::with(['author', 'category'])
            ->withTrashed()
            ->latest()
            ->paginate(10);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Publish a blog
     */
    public function publish(Blog $blog)
    {
        $blog->update([
            'status' => 'published',
        ]);

        return back()->with('success', 'Blog published successfully.');
    }

    /**
     * Archive a blog
     */
    public function archive(Blog $blog)
    {
        $blog->update([
            'status' => 'archived',
        ]);

        return back()->with('success', 'Blog archived.');
    }

    /**
     * Soft delete a blog
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back()->with('success', 'Blog deleted.');
    }

    /**
     * Restore soft deleted blog
     */
    public function restore(int $id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        return back()->with('success', 'Blog restored.');
    }
}
