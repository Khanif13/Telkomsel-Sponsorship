<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In - {{ config('app.name', 'SponsorHub') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card text-center">

            <a href="/" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-4">
                <img src="{{ asset('images/logo-telkomsel.png') }}" alt="Telkomsel" height="32"
                    style="object-fit: contain; mix-blend-mode: multiply;">
                <span class="border-start border-secondary border-opacity-25 ps-2 ms-1 fw-bolder fs-4"
                    style="color: var(--tsel-dark-blue); letter-spacing: -0.5px;">
                    SponsorHub<span class="text-danger">.</span>
                </span>
            </a>

            <h4 class="fw-bolder mb-1" style="color: var(--tsel-dark-blue);">Welcome Back</h4>
            <p class="text-muted fs-7 mb-4">Enter your Telkomsel number to sign in or register.</p>

            <form method="POST" action="{{ route('otp.generate') }}" class="text-start">
                @csrf

                <div class="mb-4">
                    <label for="phone_number" class="form-label fw-bold text-muted fs-7 text-uppercase">Telkomsel
                        Number</label>
                    <div class="position-relative d-flex align-items-center">
                        <i class="bi bi-phone position-absolute ms-3 text-muted"></i>
                        <input id="phone_number" type="text"
                            class="form-control auth-input ps-5 @error('phone_number') is-invalid @enderror"
                            name="phone_number" required autofocus placeholder="e.g., 081234567890">
                    </div>
                    @error('phone_number')
                        <span class="invalid-feedback d-block fs-7 mt-1"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-4 shadow-sm">
                    Send OTP Code
                </button>

                <div class="text-center fs-7 text-muted fw-medium">
                    <i class="bi bi-shield-lock-fill text-success me-1"></i> Secured transaction
                </div>
            </form>

        </div>
    </div>
</body>

</html>
