<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Telkomsel SponsorHub') }} - Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="d-flex dashboard-body">

    <aside class="sidebar p-4 d-flex flex-column flex-shrink-0 shadow-sm">
        <a href="/" class="text-decoration-none mb-5 px-2 d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo-telkomsel.png') }}" alt="Telkomsel" height="28"
                style="object-fit: contain; mix-blend-mode: multiply;">

            <span class="border-start border-secondary border-opacity-25 ps-2 ms-1 tsel-logo lh-1"
                style="font-size: 1.35rem;">
                SponsorHub<span class="text-danger">.</span>
            </span>
        </a>
        <ul class="nav flex-column mb-auto">

            <li class="nav-item">
                <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill me-2"></i> Overview
                </a>
            </li>

            @if (Auth::check() && Auth::user()->role === 'user')
                <li class="nav-item">
                    <a href="{{ route('proposals.create') }}"
                        class="nav-link {{ request()->routeIs('proposals.create') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-plus-fill me-2"></i> Submit Proposal
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('proposals.index') }}"
                        class="nav-link {{ request()->routeIs('proposals.index') ? 'active' : '' }}">
                        <i class="bi bi-folder-fill me-2"></i> My Submissions
                    </a>
                </li>
            @endif

            @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin'))
                <li class="nav-item mt-4 mb-2 px-3">
                    <span class="text-muted fs-7 fw-bold text-uppercase" style="letter-spacing: 0.5px;">Admin
                        Panel</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.proposals.index') }}"
                        class="nav-link {{ request()->routeIs('admin.proposals.*') ? 'active' : '' }}">
                        <i class="bi bi-inboxes-fill me-2"></i> Review Proposals
                    </a>
                </li>
            @endif

        </ul>

        <div class="mt-auto px-2 pt-4 border-top">
            <div class="text-muted fs-7 fw-semibold"><i class="bi bi-shield-check text-success"></i> Secured Enterprise
                Portal</div>
        </div>
    </aside>

    <div class="main-content d-flex flex-column">

        <header class="topbar py-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold" style="color: var(--tsel-dark-blue);">@yield('page_title', 'Dashboard')</h5>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <div class="text-white rounded-circle d-flex justify-content-center align-items-center me-2 fw-bold"
                        style="width: 38px; height: 38px; background-color: var(--tsel-dark-blue);">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <div class="d-flex flex-column text-start me-1">
                        <span class="fw-bold lh-1"
                            style="font-size: 0.9rem; color: var(--tsel-dark-blue);">{{ Auth::user()->name }}</span>
                        <span class="text-muted text-capitalize mt-1"
                            style="font-size: 0.75rem;">{{ Auth::user()->role }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger fw-semibold py-2">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <main class="p-4 flex-grow-1 overflow-auto">
            @yield('content')
        </main>

    </div>

</body>

</html>
