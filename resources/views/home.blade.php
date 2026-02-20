@extends('layouts.dashboard')

@section('page_title', 'Overview')

@section('content')
    <div class="container-fluid pb-5">

        <div class="mb-4 d-flex justify-content-between align-items-end">
            <div>
                <h3 class="fw-bolder mb-1" style="color: var(--tsel-dark-blue);">Welcome back,
                    {{ explode(' ', Auth::user()->name)[0] }}! 👋</h3>
                <p class="text-muted fs-6 mb-0">
                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                        Welcome to the Admin Portal. Here is your complete overview of all incoming sponsorship requests.
                    @else
                        Track your sponsorship proposal progress and status here.
                    @endif
                </p>
            </div>

            @if (Auth::user()->role === 'user')
                <a href="{{ route('proposals.create') }}"
                    class="btn btn-danger rounded-pill fw-bold px-4 shadow-sm d-none d-md-block">
                    <i class="bi bi-plus-lg me-1"></i> Submit New
                </a>
            @endif
        </div>

        <div class="row g-4 mb-5">

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">
                                    {{ Auth::user()->role === 'admin' ? 'Total Incoming' : 'Total Submitted' }}
                                </p>
                                <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['total'] }}
                                </h2>
                            </div>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="bi bi-file-earmark-text fs-4 text-secondary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-secondary" style="height: 4px; opacity: 0.2;">
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">
                                    {{ Auth::user()->role === 'admin' ? 'Pending Review' : 'Awaiting Review' }}
                                </p>
                                <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['pending'] }}
                                </h2>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px; background-color: #fff3cd;">
                                <i class="bi bi-hourglass-split fs-4 text-warning"></i>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-warning" style="height: 4px;"></div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                                    <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Currently Reviewing</p>
                                    <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">
                                        {{ $metrics['under_review'] }}</h2>
                                @else
                                    <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Approved</p>
                                    <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">
                                        {{ $metrics['approved'] }}</h2>
                                @endif
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px; background-color: #d1e7dd;">
                                <i
                                    class="bi {{ Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin' ? 'bi-search text-info' : 'bi-check-circle-fill text-success' }} fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 {{ Auth::user()->role === 'admin' ? 'bg-info' : 'bg-success' }}"
                        style="height: 4px;"></div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                                    <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Total Approved</p>
                                    <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">
                                        {{ $metrics['approved'] }}</h2>
                                @else
                                    <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Rejected</p>
                                    <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">
                                        {{ $metrics['rejected'] }}</h2>
                                @endif
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px; background-color: #f8d7da;">
                                <i
                                    class="bi {{ Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin' ? 'bi-trophy-fill text-success' : 'bi-x-circle-fill text-danger' }} fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 {{ Auth::user()->role === 'admin' ? 'bg-success' : 'bg-danger' }}"
                        style="height: 4px;"></div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 border-bottom-0 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-dark mb-0">Recent Activity</h5>
                <a href="{{ Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin' ? route('admin.proposals.index') : route('proposals.index') }}"
                    class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fs-7 fw-semibold">Event Name</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Request Type</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Date</th>
                            <th class="pe-4 py-3 text-uppercase fs-7 fw-semibold text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($recent_proposals as $proposal)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-bold text-dark">{{ $proposal->event_name }}</div>
                                    @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                                        <div class="text-muted small"><i class="bi bi-person"></i>
                                            {{ $proposal->contact_name }}</div>
                                    @endif
                                </td>
                                <td class="py-3 fw-semibold text-muted">
                                    {{ $proposal->request_type }}
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $proposal->created_at->format('d M Y') }}
                                </td>
                                <td class="pe-4 py-3 text-end">
                                    @if ($proposal->status === 'pending')
                                        <span
                                            class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">Pending</span>
                                    @elseif($proposal->status === 'under_review')
                                        <span class="badge bg-info px-3 py-2 rounded-pill shadow-sm">Under Review</span>
                                    @elseif($proposal->status === 'approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Approved</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">Rejected</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-3 mb-2 d-block text-black-50"></i>
                                    No recent activity found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
