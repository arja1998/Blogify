@extends('user.layouts.app')

@section('title', 'Register')
@section('header_title', 'Create Account')
@section('header_subtitle', 'Join our blogging community')

@section('content')
<div class="card shadow-sm border-0 mb-5">
    <div class="card-body p-4">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter your name"
                       required>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="Enter your email"
                       required>

                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
                    <div class="mb-3">
                <label class="form-label">Register As</label>
                <select name="role"
                        class="form-select @error('role') is-invalid @enderror"
                        required>
                    <option value="">Select role</option>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>
                        User
                    </option>
                    <option value="author" {{ old('role') === 'author' ? 'selected' : '' }}>
                        Author
                    </option>
                </select>

                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                    </div>


            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Create a password"
                       required>

                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label class="form-label">Confirm Password</label>
                <input type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Confirm password"
                       required>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-success w-100">
                Register
            </button>
        </form>

        <hr>

        <p class="text-center mb-0">
            Already have an account?
            <a href="{{ route('login') }}">Login here</a>
        </p>

    </div>
</div>
@endsection
