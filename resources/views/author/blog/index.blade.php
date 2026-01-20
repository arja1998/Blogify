@extends('admin.layouts.app')

@section('title', 'My Blogs')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>My Blogs</h4>
    <a href="{{ route('author.blogs.create') }}" class="btn btn-primary">
        Create Blog
    </a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($blogs as $blog)
        <tr>
            <td>{{ $blog->title }}</td>
            <td>{{ ucfirst($blog->status) }}</td>
            <td>
                <a href="{{ route('author.blogs.edit', $blog) }}"
                   class="btn btn-sm btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
