@extends('user.layouts.app')

@section('title', 'Home')
@section('header_title', 'Latest Posts')
@section('header_subtitle', 'Read the newest articles')

@section('content')


    <form method="GET" action="{{ route('home') }}" class="mb-4">

    <div class="row g-2">

        {{-- Search --}}
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Search blogs...">
        </div>

        {{-- Category --}}
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(request('category') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tag --}}
        <div class="col-md-3">
            <select name="tag" class="form-select">
                <option value="">All Tags</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @selected(request('tag') == $tag->id)>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Submit --}}
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                Filter
            </button>
        </div>

    </div>
</form>



@forelse($blogs as $blog)
    <div class="post-preview">
        <a href="{{ route('blog.show', $blog->slug) }}">
            <h2 class="post-title">
                {{ $blog->title }}
            </h2>
        </a>

        <p class="post-meta">
            Posted by {{ $blog->author->name }}
            on {{ $blog->created_at->format('F d, Y') }}
        </p>
    </div>
    <hr>
@empty
    <p>No blogs found.</p>
@endforelse

<div class="mt-4">
    {{ $blogs->links() }}
</div>

@endsection
