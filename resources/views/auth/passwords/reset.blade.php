@extends('layouts.auth')
@section('title', 'Create New Password')
@section('header_title', 'New Password')
@section('header_subtitle', 'Secure your account with a new password.')

@section('content')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold fs-7 text-muted mb-1">Email Address</label>
            <div class="position-relative">
                <i class="bi bi-envelope position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="email" type="email"
                    class="form-control auth-input ps-5 @error('email') is-invalid @enderror" name="email"
                    value="{{ $email ?? old('email') }}" required autocomplete="email" readonly>
            </div>
            @error('email')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold fs-7 text-muted mb-1">New Password</label>
            <div class="position-relative">
                <i class="bi bi-lock position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="password" type="password"
                    class="form-control auth-input ps-5 @error('password') is-invalid @enderror" name="password" required
                    autocomplete="new-password" placeholder="Enter new password" autofocus>
            </div>
            @error('password')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password-confirm" class="form-label fw-semibold fs-7 text-muted mb-1">Confirm Password</label>
            <div class="position-relative">
                <i class="bi bi-lock-fill position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="password-confirm" type="password" class="form-control auth-input ps-5"
                    name="password_confirmation" required autocomplete="new-password" placeholder="Repeat new password">
            </div>
        </div>

        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 shadow-sm">
            Reset Password
        </button>
    </form>
@endsection
