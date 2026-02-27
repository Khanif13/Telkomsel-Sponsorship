@extends('layouts.auth')
@section('title', 'Login')
@section('header_title', 'Welcome Back')
@section('header_subtitle', 'Sign in to securely manage your proposals.')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label fw-semibold fs-7 text-muted mb-1">Email / Username</label>
            <div class="position-relative">
                <i class="bi bi-person position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="login" type="text" class="form-control auth-input ps-5 @error('login') is-invalid @enderror"
                    name="login" value="{{ old('login') }}" required autofocus placeholder="Enter Email or Username">
            </div>
            @error('login')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label fw-semibold fs-7 text-muted mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="auth-link fs-7" href="{{ route('password.request') }}">Forgot Password?</a>
                @endif
            </div>
            <div class="position-relative d-flex align-items-center">
                <i class="bi bi-lock position-absolute ms-3 text-muted"></i>
                <input id="password" type="password"
                    class="form-control auth-input ps-5 pe-5 @error('password') is-invalid @enderror" name="password"
                    required placeholder="Enter your password">
                <button type="button" class="btn border-0 position-absolute end-0 me-2 toggle-password"
                    style="background: transparent;">
                    <i class="bi bi-eye text-muted"></i>
                </button>
            </div>
            @error('password')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mb-4 form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label fs-7 text-muted fw-medium" for="remember">Keep me signed in</label>
        </div>

        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-4 shadow-sm">Sign In</button>

        <div class="text-center fs-7 text-muted fw-medium">
            Don't have an account? <a href="{{ route('register') }}" class="auth-link">Create one here</a>
        </div>
    </form>
@endsection
