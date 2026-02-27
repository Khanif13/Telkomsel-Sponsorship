@extends('layouts.auth')
@section('title', 'Register')
@section('header_title', 'Create an Account')
@section('header_subtitle', 'Join the official Telkomsel Enterprise platform.')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold fs-7 text-muted mb-1">Full Name / Organization</label>
            <div class="position-relative">
                <i class="bi bi-person position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="name" type="text" class="form-control auth-input ps-5 @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                    placeholder="e.g. John Doe">
            </div>
            @error('name')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold fs-7 text-muted mb-1">Email Address</label>
            <div class="position-relative">
                <i class="bi bi-envelope position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="email" type="email"
                    class="form-control auth-input ps-5 @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" placeholder="name@company.com">
            </div>
            @error('email')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label fw-semibold fs-7 text-muted mb-1">Phone Number (Telkomsel)</label>
            <div class="position-relative">
                <i class="bi bi-phone position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                <input id="phone_number" type="text"
                    class="form-control auth-input ps-5 @error('phone_number') is-invalid @enderror" name="phone_number"
                    value="{{ old('phone_number') }}" required placeholder="Example: 081234567890">
            </div>
            @error('phone_number')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="password" class="form-label fw-semibold fs-7 text-muted mb-1">Password</label>
                <div class="position-relative">
                    <i class="bi bi-lock position-absolute ms-3 text-muted top-50 translate-middle-y"></i>
                    <input id="password" type="password"
                        class="form-control auth-input ps-5 pe-5 @error('password') is-invalid @enderror" name="password"
                        required placeholder="Min. 8 chars">
                    <button type="button"
                        class="btn border-0 position-absolute end-0 top-50 translate-middle-y me-2 toggle-password"
                        style="background: transparent; z-index: 10;">
                        <i class="bi bi-eye text-muted"></i>
                    </button>
                </div>
                @error('password')
                    <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="password-confirm" class="form-label fw-semibold fs-7 text-muted mb-1">Confirm Password</label>
                <div class="position-relative">
                    <i class="bi bi-lock-fill position-absolute ms-3 text-muted top-50 translate-middle-y"></i>
                    <input id="password-confirm" type="password" class="form-control auth-input ps-5 pe-5"
                        name="password_confirmation" required placeholder="Repeat password">
                    <button type="button"
                        class="btn border-0 position-absolute end-0 top-50 translate-middle-y me-2 toggle-password"
                        style="background: transparent; z-index: 10;">
                        <i class="bi bi-eye text-muted"></i>
                    </button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-4 shadow-sm">Create Account</button>
        <div class="text-center fs-7 text-muted fw-medium">
            Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign in instead</a>
        </div>
    </form>
@endsection
