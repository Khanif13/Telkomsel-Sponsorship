@extends('layouts.dashboard')

@section('page_title', 'Overview')

@section('content')
    <style>
        .tsel-pagination nav>div.d-sm-flex {
            align-items: center;
        }

        .tsel-pagination p.text-muted {
            margin-bottom: 0;
            font-weight: 500;
        }

        .tsel-pagination .page-item.active .page-link {
            background-color: var(--tsel-red);
            border-color: var(--tsel-red);
            color: white;
            border-radius: 6px;
        }

        .tsel-pagination .page-link {
            color: var(--tsel-dark-blue);
            border-radius: 6px;
            margin: 0 3px;
            font-weight: 600;
            border: 1px solid #eaeaea;
        }

        .tsel-pagination .page-link:hover {
            background-color: #fce8e9;
            color: var(--tsel-red);
            border-color: var(--tsel-red);
        }

        /* Removes the sharp default bootstrap edges */
        .tsel-pagination .page-item:first-child .page-link,
        .tsel-pagination .page-item:last-child .page-link {
            border-radius: 6px;
        }
    </style>
    <div class="container-fluid pb-5">

        <div class="mb-4 d-flex justify-content-between align-items-end">
            <div>
                <h3 class="fw-bolder mb-1" style="color: var(--tsel-dark-blue);">Selamat Datang Kembali,
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

        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-6 g-4 mb-5">

            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-3">
                        <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">
                            {{ Auth::user()->role !== 'user' ? 'Incoming' : 'Total' }}</p>
                        <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['total'] }}</h2>
                        <i
                            class="bi bi-file-earmark-text fs-4 text-secondary opacity-25 position-absolute top-0 end-0 m-3"></i>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-secondary" style="height: 4px; opacity: 0.2;">
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-3">
                        <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Pending</p>
                        <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['pending'] }}</h2>
                        <i class="bi bi-hourglass-split fs-4 text-warning opacity-50 position-absolute top-0 end-0 m-3"></i>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-warning" style="height: 4px;"></div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-3">
                        <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Reviewing</p>
                        <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['under_review'] }}</h2>
                        <i class="bi bi-search fs-4 text-info opacity-50 position-absolute top-0 end-0 m-3"></i>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-info" style="height: 4px;"></div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-3">
                        <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Revision</p>
                        <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['need_revision'] }}
                        </h2>
                        <i
                            class="bi bi-arrow-counterclockwise fs-4 text-dark opacity-50 position-absolute top-0 end-0 m-3"></i>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-dark" style="height: 4px;"></div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-3">
                        <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Approved</p>
                        <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['approved'] }}</h2>
                        <i
                            class="bi bi-check-circle-fill fs-4 text-success opacity-50 position-absolute top-0 end-0 m-3"></i>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-success" style="height: 4px;"></div>
                </div>
            </div>

            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-3">
                        <p class="text-muted fw-bold fs-7 mb-1 text-uppercase">Rejected</p>
                        <h2 class="fw-bolder mb-0" style="color: var(--tsel-dark-blue);">{{ $metrics['rejected'] }}</h2>
                        <i class="bi bi-x-circle-fill fs-4 text-danger opacity-50 position-absolute top-0 end-0 m-3"></i>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 4px;"></div>
                </div>
            </div>

        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div
                class="card-header bg-white p-4 border-bottom-0 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <h5 class="fw-bold text-dark mb-0">Recent Activity</h5>

                <form action="{{ route('home') }}" method="GET" class="d-flex gap-2 align-items-center m-0">

                    <select name="per_page" class="form-select form-select-sm shadow-sm bg-light"
                        onchange="this.form.submit()" style="width: 70px;">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="text-muted fs-7 me-2 fw-semibold">entries</span>

                    <select name="status" class="form-select form-select-sm shadow-sm bg-light"
                        onchange="this.form.submit()" style="width: auto;">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Reviewing
                        </option>
                        <option value="need_revision" {{ request('status') === 'need_revision' ? 'selected' : '' }}>
                            Revision</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>

                    <a href="{{ Auth::user()->role !== 'user' ? route('admin.proposals.index') : route('proposals.index') }}"
                        class="btn btn-sm btn-outline-dark rounded-pill fw-semibold ms-1 text-nowrap">
                        View All <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </form>
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
                                    @if (Auth::user()->role !== 'user')
                                        <div class="text-muted small"><i class="bi bi-person"></i>
                                            {{ $proposal->user->name }}</div>
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
                                    @elseif($proposal->status === 'need_revision')
                                        <span
                                            class="badge bg-dark text-white px-3 py-2 rounded-pill shadow-sm">Revision</span>
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
        @if ($recent_proposals->hasPages())
            <div class="card-footer bg-white p-4 border-top border-light tsel-pagination">
                {{ $recent_proposals->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    </div>
@endsection
