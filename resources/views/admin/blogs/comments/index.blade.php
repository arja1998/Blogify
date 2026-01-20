@extends('admin.layouts.app')

@section('title', 'Comment Moderation')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Comment Moderation</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Comment</th>
                        <th>Blog</th>
                        <th>Status</th>
                        <th width="25%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ Str::limit($comment->comment, 50) }}</td>
                        <td>
                            {{ $comment->blog->title }} <br>
                            <small class="text-muted">
                                by {{ $comment->blog->author->name }}
                            </small>
                        </td>
                        <td>
                            @if($comment->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-success">Approved</span>
                            @endif
                        </td>
                        <td>

                            {{-- Approve --}}
                            @if($comment->status === 'pending')
                                <form method="POST"
                                      action="{{ route('admin.comments.approve', $comment) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">
                                        Approve
                                    </button>
                                </form>
                            @endif

                            {{-- Delete --}}
                            <form method="POST"
                                  action="{{ route('admin.comments.destroy', $comment) }}"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $comments->links() }}

    </div>
</div>
@endsection
