<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - {{ config('app.name', 'SponsorHub') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-card text-center" style="max-width: 500px;">

            <a href="/" class="text-decoration-none d-inline-flex align-items-center gap-2 mb-4">
                <img src="{{ asset('images/logo-telkomsel.png') }}" alt="Telkomsel" height="32"
                    style="object-fit: contain; mix-blend-mode: multiply;">
                <span class="border-start border-secondary border-opacity-25 ps-2 ms-1 fw-bolder fs-4"
                    style="color: var(--tsel-dark-blue); letter-spacing: -0.5px;">
                    SponsorHub<span class="text-danger">.</span>
                </span>
            </a>

            <h4 class="fw-bolder mb-1" style="color: var(--tsel-dark-blue);">Create an Account</h4>
            <p class="text-muted fs-7 mb-4">Join the official Telkomsel Enterprise platform.</p>

            <form method="POST" action="{{ route('register') }}" class="text-start">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold fs-7 text-muted mb-1">Full Name /
                        Organization</label>
                    <div class="position-relative">
                        <i class="bi bi-person position-absolute top-50 translate-middle-y text-muted ms-3"></i>
                        <input id="name" type="text"
                            class="form-control auth-input ps-5 @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="e.g. John Doe">
                    </div>
                    @error('name')
                        <span class="invalid-feedback d-block fs-7"
                            role="alert"><strong>{{ $message }}</strong></span>
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
                        <span class="invalid-feedback d-block fs-7"
                            role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="password" class="form-label fw-semibold fs-7 text-muted mb-1">Password</label>
                        <div class="position-relative d-flex align-items-center">
                            <i class="bi bi-lock position-absolute ms-3 text-muted"></i>
                            <input id="password" type="password"
                                class="form-control auth-input ps-5 pe-5 @error('password') is-invalid @enderror"
                                name="password" required placeholder="Min. 8 chars">
                            <button type="button" class="btn border-0 position-absolute end-0 me-2 toggle-password"
                                style="background: transparent;">
                                <i class="bi bi-eye text-muted"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="password-confirm" class="form-label fw-semibold fs-7 text-muted mb-1">Confirm
                            Password</label>
                        <div class="position-relative d-flex align-items-center">
                            <i class="bi bi-lock-fill position-absolute ms-3 text-muted"></i>
                            <input id="password-confirm" type="password" class="form-control auth-input ps-5 pe-5"
                                name="password_confirmation" required placeholder="Repeat password">
                            <button type="button" class="btn border-0 position-absolute end-0 me-2 toggle-password"
                                style="background: transparent;">
                                <i class="bi bi-eye text-muted"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 mb-4 shadow-sm">
                    Create Account
                </button>

                <div class="text-center fs-7 text-muted fw-medium">
                    Already have an account? <a href="{{ route('login') }}" class="auth-link">Sign in instead</a>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
