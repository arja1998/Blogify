@extends('user.layouts.app')

@section('title', $blog->meta_title ?? $blog->title)
@section('header_title', $blog->title)
@section('header_subtitle', $blog->category->name)

@section('content')

{{-- Blog Content --}}
@if($blog->featured_image)
    <img src="{{ Storage::url($blog->featured_image) }}" class="img-fluid mb-4">

@endif

<div class="mb-5">
    {!! nl2br(e($blog->content)) !!}
</div>

<hr>

{{-- COMMENTS SECTION --}}
<h4 class="mb-4">Comments</h4>

@forelse(
    $blog->comments()
        ->whereNull('parent_id')
        ->where('status','approved')
        ->latest()
        ->get()
    as $comment)

    {{-- Parent Comment --}}
    <div class="mb-3">
        <strong>{{ $comment->user->name }}</strong>
        <small class="text-muted">
            • {{ $comment->created_at->diffForHumans() }}
        </small>

        <p class="mb-1">{{ $comment->comment }}</p>

        @auth
            <a href="javascript:void(0)"
               onclick="reply({{ $comment->id }})"
               class="text-sm">
                Reply
            </a>
        @endauth
    </div>

    {{-- Replies --}}
    @foreach($comment->replies as $reply)
        <div class="ms-4 mb-3">
            <strong>{{ $reply->user->name }}</strong>
            <small class="text-muted">
                • {{ $reply->created_at->diffForHumans() }}
            </small>
            <p class="mb-1">{{ $reply->comment }}</p>
        </div>
    @endforeach

    <hr>

@empty
    <p>No comments yet.</p>
@endforelse

{{-- ADD COMMENT FORM --}}
@auth
    <h5 class="mt-4">Add a Comment</h5>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('comment.store', $blog) }}">
        @csrf

        {{-- IMPORTANT: single hidden parent_id --}}
        <input type="hidden" name="parent_id" id="parent_id">

        <div class="mb-3">
            <textarea name="comment"
                      rows="3"
                      class="form-control @error('comment') is-invalid @enderror"
                      placeholder="Write your comment..."
                      required></textarea>

            @error('comment')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-primary">
            Submit Comment
        </button>
    </form>
@else
    <p class="mt-4">
        <a href="{{ route('login') }}">Login</a> to add a comment.
    </p>
@endauth

@endsection
<script>
function reply(commentId) {
    document.getElementById('parent_id').value = commentId;
    document.querySelector('textarea[name="comment"]').focus();
}
</script>

