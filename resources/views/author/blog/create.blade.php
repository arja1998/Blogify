@extends('admin.layouts.app')

@section('title', 'Create Blog')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="card-title">Create New Blog</h4>

        <form method="POST"
              action="{{ route('author.blogs.store') }}"
              enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror"
                       required>

                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                        required>
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tags --}}
            <div class="mb-3">
                <label class="form-label">Tags</label>
                <select name="tags[]"
                        class="form-select"
                        multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Content --}}
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content"
                          rows="6"
                          class="form-control @error('content') is-invalid @enderror"
                          required>{{ old('content') }}</textarea>

                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Featured Image --}}
            <div class="mb-3">
                <label class="form-label">Featured Image</label>
                <input type="file"
                       name="featured_image"
                       class="form-control @error('featured_image') is-invalid @enderror">

                @error('featured_image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-primary">
                Save as Draft
            </button>

        </form>
    </div>
</div>
@endsection
