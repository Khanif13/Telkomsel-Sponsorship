@extends('layouts.auth')
@section('title', 'Confirm Password')
@section('header_title', 'Security Check')
@section('header_subtitle', 'Please confirm your password before continuing.')

@section('content')
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label for="password" class="form-label fw-semibold fs-7 text-muted mb-1">Password</label>
            <div class="position-relative d-flex align-items-center">
                <i class="bi bi-lock position-absolute ms-3 text-muted"></i>
                <input id="password" type="password"
                    class="form-control auth-input ps-5 pe-5 @error('password') is-invalid @enderror" name="password"
                    required autocomplete="current-password" placeholder="Enter your current password" autofocus>
                <button type="button" class="btn border-0 position-absolute end-0 me-2 toggle-password"
                    style="background: transparent;">
                    <i class="bi bi-eye text-muted"></i>
                </button>
            </div>
            @error('password')
                <span class="invalid-feedback d-block fs-7"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-3 shadow-sm">
            Confirm Password
        </button>

        @if (Route::has('password.request'))
            <div class="text-center">
                <a class="auth-link fs-7 text-decoration-none" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
        @endif
    </form>
@endsection
