@extends('user.layouts.app')

@section('title', 'Login')
@section('header_title', 'Welcome Back')
@section('header_subtitle', 'Login to your account')

@section('content')
<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="Enter your email"
                       required autofocus>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Enter your password"
                       required>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember">
                    <label class="form-check-label">
                        Remember me
                    </label>
                </div>

                {{-- <a href="{{ route('password.request') }}" class="small">
                    Forgot password?
                </a> --}}
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>
        </form>

        <hr>

        <p class="text-center mb-0">
            Don’t have an account?
            <a href="{{ route('register') }}">Register here</a>
        </p>

    </div>
</div>
@endsection
