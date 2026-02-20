@extends('layouts.dashboard')

@section('page_title', 'System Command Center')

@section('content')
    <div class="container-fluid">
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-primary border-5">
                    <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Total Applicants</div>
                    <div class="h2 fw-black text-dark mb-0">{{ $stats['total_users'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-info border-5">
                    <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Active Admins</div>
                    <div class="h2 fw-black text-dark mb-0">{{ $stats['total_admins'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-danger border-5">
                    <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Total Proposals</div>
                    <div class="h2 fw-black text-dark mb-0">{{ $stats['total_proposals'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-warning border-5">
                    <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Action Required</div>
                    <div class="h2 fw-black text-dark mb-0">{{ $stats['pending_reviews'] }}</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
                    <h5 class="fw-bold mb-4"><i class="bi bi-activity text-danger me-2"></i>Recent Sign-ups</h5>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="fs-7 text-uppercase text-muted ps-3">User</th>
                                    <th class="fs-7 text-uppercase text-muted">Role</th>
                                    <th class="fs-7 text-uppercase text-muted text-end pe-3">Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_users as $user)
                                    <tr>
                                        <td class="ps-3">
                                            <div class="fw-bold text-dark">{{ $user->name }}</div>
                                            <div class="small text-muted">{{ $user->email }}</div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge rounded-pill {{ $user->role == 'user' ? 'bg-light text-dark' : 'bg-primary' }}">
                                                {{ $user->role_label }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-3 text-muted">{{ $user->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 bg-dark text-white p-4 h-100">
                    <h5 class="fw-bold mb-3">Engine Status</h5>
                    <p class="text-white-50 small">Landing page is currently live and managed via database CMS.</p>
                    <hr class="border-secondary">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Active Content:</span>
                        <span class="fw-bold text-success">{{ $stats['active_cms'] }} Keys</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Status:</span>
                        <span class="badge bg-success rounded-pill px-3">Stable</span>
                    </div>
                    <a href="{{ route('superadmin.cms.index') }}"
                        class="btn btn-outline-light btn-sm rounded-pill mt-4 w-100 py-2">
                        Open CMS Manager <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
