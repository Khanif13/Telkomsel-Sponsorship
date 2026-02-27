@extends('layouts.auth')
@section('title', 'Verify Email')
@section('header_title', 'Verify Your Email')
@section('header_subtitle', 'Almost there! Please check your email to continue.')

@section('content')
    @if (session('resent'))
        <div class="alert alert-success fs-7 rounded-3 border-0 shadow-sm mb-4" role="alert">
            <i class="bi bi-envelope-check-fill me-1"></i> A fresh verification link has been sent to your email address.
        </div>
    @endif

    <div class="text-center mb-4 text-muted fs-7">
        Before proceeding, please check your email for a verification link.
        If you did not receive the email, you can request another one below.
    </div>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 shadow-sm">
            Resend Verification Email <i class="bi bi-send ms-1"></i>
        </button>
    </form>
@endsection
