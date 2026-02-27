<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SponsorHub | {{ $settings['hero_title'] ?? 'Official Portal' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" href="{{ url('https://assets.telkomsel.com/public/app-logo/2021-06/telkomsel-logo.png') }}"
        type="image/svg">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-white">

    <nav class="navbar navbar-expand-lg tsel-navbar fixed-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img src="{{ asset('images/logo-telkomsel.png') }}" alt="Telkomsel" height="32"
                    style="object-fit: contain; mix-blend-mode: multiply;">
                <span class="border-start border-secondary border-opacity-25 ps-2 ms-1 fw-bolder fs-4"
                    style="color: var(--tsel-dark-blue); letter-spacing: -0.5px;">
                    SponsorHub<span class="text-danger">.</span>
                </span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="btn btn-danger rounded-pill fw-bold px-4 shadow-sm">
                                    Go to Dashboard <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link fw-semibold"
                                    style="color: var(--tsel-dark-blue);">Log In</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}"
                                        class="btn btn-danger rounded-pill fw-bold px-4 shadow-sm">
                                        Submit Proposal
                                    </a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white py-4 border-top">
        <div class="container text-center text-muted fs-7 fw-semibold">
            &copy; {{ date('Y') }} PT Telekomunikasi Selular. All rights reserved. <br>
            <span class="text-black-50">This is a system prototype for demonstration purposes.</span>
        </div>
    </footer>

</body>

</html>
