@extends('user.layouts.app')

@section('content')
<div class="alert alert-warning">
    <h5>Email Verification Required</h5>
    <p>
        Please verify your email address before continuing.
        Check your inbox.
    </p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="btn btn-primary">
            send Verification Email
        </button>
    </form>
</div>
@endsection
