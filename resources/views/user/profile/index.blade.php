@extends('user.layouts.app')

@section('title', 'Profile')
@section('header_title', 'My Profile')
@section('header_subtitle', 'Manage your account')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('profile.update') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input name="name" value="{{ auth()->user()->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>New Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>

    <button class="btn btn-primary">Update Profile</button>
</form>
@endsection
