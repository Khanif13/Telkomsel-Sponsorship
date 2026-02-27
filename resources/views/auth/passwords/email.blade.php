@extends('layouts.auth')
@section('title', 'Reset Password')
@section('header_title', 'Reset Password')
@section('header_subtitle', "Enter your email and we'll send a recovery link.")

@section('content')
    @if (session('status'))
        <div class="alert alert-success fs-7 rounded-3 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold fs-7 text-muted mb-1">Email Address</label>
            <div class="position-relative">
                <i class="bi bi-envelope position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="email" type="email"
                    class="form-control auth-input ps-5 @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@company.com">
            </div>
            @error('email')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-3 shadow-sm">
            Send Reset Link
        </button>

        <div class="text-center">
            <a href="{{ route('login') }}" class="auth-link fs-7 text-muted text-decoration-none">
                <i class="bi bi-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </form>
@endsection
