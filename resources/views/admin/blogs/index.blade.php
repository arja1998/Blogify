@extends('admin.layouts.app')

@section('title', 'Blog Moderation')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Blog Moderation</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>View Counts</th>
                        <th>Status</th>
                        <th width="35%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->author->name }}</td>
                        <td>{{ $blog->category->name }}</td>
                        <td>{{$blog->view_count}}</td>
                        <td>
                            @if($blog->trashed())
                                <span class="badge bg-danger">Deleted</span>
                            @else
                                <span class="badge bg-info text-dark">
                                    {{ ucfirst($blog->status) }}
                                </span>
                            @endif
                        </td>
                        <td>

                            {{-- Publish --}}
                            @if($blog->status === 'draft' && ! $blog->trashed())
                                <form method="POST"
                                      action="{{ route('admin.blogs.publish', $blog) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">
                                        Publish
                                    </button>
                                </form>
                            @endif

                            {{-- Archive --}}
                            @if($blog->status === 'published')
                                <form method="POST"
                                      action="{{ route('admin.blogs.archive', $blog) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">
                                        Archive
                                    </button>
                                </form>
                            @endif

                            {{-- Delete --}}
                            @if(! $blog->trashed())
                                <form method="POST"
                                      action="{{ route('admin.blogs.destroy', $blog) }}"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            @endif

                            {{-- Restore --}}
                            @if($blog->trashed())
                                <form method="POST"
                                      action="{{ route('admin.blogs.restore', $blog->id) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">
                                        Restore
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $blogs->links() }}

    </div>
</div>
@endsection
