<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification - {{ config('app.name', 'SponsorHub') }}</title>

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

            <h4 class="fw-bolder mb-1" style="color: var(--tsel-dark-blue);">Verify Your Code</h4>
            <p class="text-muted fs-7 mb-4">The code has been sent to <strong>{{ session('otp_phone') }}</strong></p>

            @if (session('simulated_otp'))
                <div class="alert alert-success rounded-4 border-0 shadow-sm mb-4">
                    <div class="text-success fw-bold fs-7 mb-1 text-uppercase">💬 Simulated SMS Received:</div>
                    <div class="fs-2 fw-bolder tracking-widest">{{ session('simulated_otp') }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('otp.authenticate') }}" class="text-start">
                @csrf
                <div class="mb-4 text-center">
                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Enter 6-Digit OTP</label>
                    <input type="text" name="otp"
                        class="form-control auth-input text-center fs-4 fw-bolder shadow-none mx-auto @error('otp') is-invalid @enderror"
                        style="letter-spacing: 5px; max-width: 250px;" placeholder="••••••" maxlength="6" required
                        autofocus autocomplete="off">
                    @error('otp')
                        <span class="invalid-feedback d-block fs-7 mt-2 fw-bold">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-3 shadow-sm">
                    Verify & Sign In
                </button>
            </form>

            <div class="mt-2">
                <a href="{{ route('otp.login') }}" class="auth-link fs-7"><i class="bi bi-pencil-square me-1"></i>
                    Change Number</a>
            </div>

        </div>
    </div>
</body>

</html>
