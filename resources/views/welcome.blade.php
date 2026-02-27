@extends('layouts.app')

@section('content')
    <section class="hero-section position-relative overflow-hidden" style="padding-top: 120px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 z-2">
                    <div class="d-inline-flex align-items-center gap-2 rounded-pill px-3 py-2 fw-bold mb-4 border border-danger border-opacity-25 fs-7"
                        style="background-color: #fce8e9; color: var(--tsel-red);">
                        <i class="bi bi-rocket-takeoff-fill"></i> Official Enterprise Portal
                    </div>

                    <h1 class="hero-title mb-4" style="line-height: 1.2;">
                        {!! $settings['hero_title'] ?? 'Empowering <br><span class="text-danger">Brilliant Ideas.</span>' !!}
                    </h1>

                    <p class="hero-subtitle mb-5 pe-lg-5">
                        {!! $settings['hero_subtitle'] ??
                            "Seamlessly submit, track, and manage your event sponsorship proposals with Telkomsel's fully digital pipeline." !!}
                    </p>

                    <div class="d-flex flex-column flex-sm-row gap-3">
                        @auth
                            <a href="{{ url('/home') }}" class="btn btn-danger btn-lg rounded-pill fw-bold px-5 shadow-sm">
                                Enter Dashboard <i class="bi bi-box-arrow-in-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-danger btn-lg rounded-pill fw-bold px-5 shadow-sm">
                                Start Your Journey
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg rounded-pill fw-bold px-5">
                                Track Status
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="col-lg-6 position-relative z-1 d-none d-lg-block">
                    <div class="position-relative mx-auto" style="width: 400px; height: 400px;">
                        <div class="position-absolute rounded-circle shadow-lg"
                            style="width: 320px; height: 320px; background: var(--tsel-dark-blue); top: 0; right: 0;">
                        </div>
                        <div class="position-absolute rounded-5 shadow-lg d-flex justify-content-center align-items-center"
                            style="width: 220px; height: 220px; background: var(--tsel-red); bottom: 0; left: 0; z-index: 2;">
                            <i class="bi bi-file-earmark-check text-white" style="font-size: 6rem;"></i>
                        </div>
                        <div class="position-absolute bg-white rounded-4 shadow-lg p-3 d-flex align-items-center gap-3"
                            style="bottom: 40px; right: -20px; z-index: 3;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 45px; height: 45px; background-color: #d1e7dd; color: #198754;">
                                <i class="bi bi-check-lg fs-4 fw-bold"></i>
                            </div>
                            <div>
                                <div class="fw-bolder fs-5 text-dark lh-1">100%</div>
                                <div class="text-muted fs-7 fw-semibold">Digital Process</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light border-top border-bottom">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bolder mb-4" style="color: var(--tsel-dark-blue);">About SponsorHub</h2>
                    <p class="text-muted fs-5 lh-lg mb-0">
                        {{ $settings['about_section'] ?? 'Telkomsel SponsorHub is an official enterprise portal designed to streamline the sponsorship application process.' }}
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 bg-white mb-4 border-start border-danger border-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-danger mb-2"><i class="bi bi-eye-fill me-2"></i> Vision</h5>
                            <p class="mb-0 text-muted">
                                {{ $settings['vision'] ?? 'To be the leading digital ecosystem enabler.' }}</p>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 bg-white border-start border-4"
                        style="border-left-color: var(--tsel-dark-blue) !important;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-2" style="color: var(--tsel-dark-blue);"><i
                                    class="bi bi-bullseye me-2"></i> Mission</h5>
                            <p class="mb-0 text-muted">
                                {{ $settings['mission'] ?? 'Empowering Indonesian society through digital innovation.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder" style="color: var(--tsel-dark-blue);">Why use SponsorHub?</h2>
                <p class="text-muted fs-5">A streamlined experience from submission to approval.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card rounded-4 p-4 h-100 text-center bg-light border">
                        <div class="icon-box mx-auto mb-4 text-danger fs-1">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">Fast & Efficient</h5>
                        <p class="text-muted mb-0">No more lost emails or physical documents. Submit your proposal
                            directly into our review pipeline instantly.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card rounded-4 p-4 h-100 text-center bg-light border">
                        <div class="icon-box mx-auto mb-4 text-danger fs-1">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">Transparent Tracking</h5>
                        <p class="text-muted mb-0">Track exactly where your proposal is in the review process through
                            your personal dashboard.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card rounded-4 p-4 h-100 text-center bg-light border">
                        <div class="icon-box mx-auto mb-4 text-danger fs-1">
                            <i class="bi bi-building"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-3">Enterprise Standard</h5>
                        <p class="text-muted mb-0">Built to handle complex partnership structures, fresh money funding,
                            and product support natively.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: var(--tsel-dark-blue);">
        <div class="container py-4">
            <div
                class="cta-section text-center text-md-start d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="mb-4 mb-md-0">
                    <h2 class="fw-bolder mb-2 text-white">Ready to collaborate?</h2>
                    <p class="fs-5 text-white-50 mb-0">Submit your event proposal today and let's create something amazing
                        together.</p>
                </div>
                <div>
                    <a href="{{ route('register') }}"
                        class="btn btn-light btn-lg rounded-pill fw-bold px-5 text-danger shadow">
                        Create Account
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
