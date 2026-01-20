@extends('admin.layouts.app')

@section('title', 'Edit Blog')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="card-title">Edit Blog</h4>

        <form method="POST"
              action="{{ route('author.blogs.update', $blog) }}">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $blog->title) }}"
                       class="form-control"
                       required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected($blog->category_id == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tags --}}
            <div class="mb-3">
                <label class="form-label">Tags</label>
                <select name="tags[]" class="form-select" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"
                            @selected($blog->tags->contains($tag->id))>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content"
                          rows="6"
                          class="form-control"
                          required>{{ $blog->content }}</textarea>
            </div>

            <button class="btn btn-success">
                Update Blog
            </button>

        </form>
    </div>
</div>
@endsection
