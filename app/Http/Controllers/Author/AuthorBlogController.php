<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthorBlogController extends Controller
{

    use AuthorizesRequests;
    /**
     * List author's blogs
     */
    public function index()
    {
        $blogs = Blog::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('author.blog.index', compact('blogs'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('author.blog.create', compact('categories', 'tags'));
    }

    /**
     * Store blog
     */
    public function store(Request $request)
    {
        $this->authorize('create', Blog::class);

        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'category_id'      => 'required|exists:categories,id',
            'tags'             => 'nullable|array',
            'tags.*'           => 'exists:tags,id',
            'featured_image'   => 'nullable|image|',
        ]);

        $slug = Str::slug($data['title']);

        // Ensure unique slug
        if (Blog::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

//     //     dd(
//     // $request->hasFile('featured_image'),
//     // $request->file('featured_image')
// );


        if ($request->hasFile('featured_image')) {
            $data['featured_image'] =
                $request->file('featured_image')->store('blogs', 'public');
        }

        $blog = Blog::create([
            'user_id'     => Auth::id(),
            'category_id' => $data['category_id'],
            'title'       => $data['title'],
            'slug'        => $slug,
            'content'     => $data['content'],
            'status'      => 'draft',
        ]);

        if (! empty($data['tags'])) {
            $blog->tags()->sync($data['tags']);
        }

        return redirect()
            ->route('author.blogs.index')
            ->with('success', 'Blog created as draft.');
    }

    /**
     * Edit blog
     */
    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);

        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('author.blog.edit', compact('blog', 'categories', 'tags'));
    }

    /**
     * Update blog
     */
    public function update(Request $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:tags,id',
        ]);

        $blog->update($data);

        if (isset($data['tags'])) {
            $blog->tags()->sync($data['tags']);
        }

        return redirect()
            ->route('author.blogs.index')
            ->with('success', 'Blog updated.');
    }

    /**
     * Publish blog
     */
    public function publish(Blog $blog)
    {
        $this->authorize('publish', $blog);

        $blog->update(['status' => 'published']);

        return back()->with('success', 'Blog published.');
    }

    /**
     * Delete blog
     */
    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        $blog->delete();

        return back()->with('success', 'Blog deleted.');
    }
}
