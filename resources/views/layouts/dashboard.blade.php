<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SponsorshipHub') }} - Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* --- UPDATED CSS FOR FIXED SIDEBAR --- */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            height: 100vh;
            /* Lock body height to screen size */
            overflow: hidden;
            /* Prevent the whole page from scrolling */
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            /* Sidebar takes full height */
            background-color: #001a41;
            overflow-y: auto;
            /* Allows sidebar to scroll internally if menu gets too long */
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            font-weight: 500;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #ec2028;
            color: #fff;
        }

        .main-content {
            flex: 1;
            min-width: 0;
            height: 100vh;
            /* Match screen height */
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            flex-shrink: 0;
            /* Prevents navbar from shrinking when content is long */
        }
    </style>
</head>

<body class="d-flex">

    <aside class="sidebar p-3 d-flex flex-column flex-shrink-0">
        <a href="/" class="text-white text-decoration-none fs-4 fw-bold mb-4 px-2 d-block">
            SponsorHub<span class="text-danger">.</span>
        </a>
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill me-2"></i> Overview
                </a>
            </li>
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
        </ul>
    </aside>

    <div class="main-content d-flex flex-column">

        <header class="topbar p-3 d-flex justify-content-between align-items-center shadow-sm">
            <h5 class="mb-0 fw-bold text-dark">@yield('page_title', 'Dashboard')</h5>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-2 fw-bold"
                        style="width: 35px; height: 35px;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <div class="d-flex flex-column text-start me-1">
                        <span class="fw-bold lh-1" style="font-size: 0.9rem;">{{ Auth::user()->name }}</span>
                        <span class="text-muted text-capitalize mt-1"
                            style="font-size: 0.75rem;">{{ Auth::user()->role }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger fw-semibold">
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
