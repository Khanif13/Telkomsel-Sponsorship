@extends('layouts.dashboard')

@section('page_title', 'My Submissions')

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

        .tsel-pagination .page-item:first-child .page-link,
        .tsel-pagination .page-item:last-child .page-link {
            border-radius: 6px;
        }
    </style>

    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark mb-0">Track Proposals</h5>
            <a href="{{ route('proposals.create') }}" class="btn btn-danger rounded-pill fw-semibold shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> New Submission
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">

            <div
                class="card-header bg-white p-4 border-bottom d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3">
                <h5 class="fw-bold text-dark mb-0 d-none d-xl-block">All Submissions</h5>

                <form action="{{ url()->current() }}" method="GET" class="d-flex flex-wrap gap-2 align-items-center m-0">

                    <select name="per_page" class="form-select form-select-sm shadow-sm bg-light"
                        onchange="this.form.submit()" style="width: 70px;">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10
                        </option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="text-muted fs-7 me-2 fw-semibold">entries</span>

                    <div class="input-group input-group-sm shadow-sm" style="width: 220px;">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0"
                            placeholder="Search event..." value="{{ request('search') }}">
                    </div>

                    <select name="status" class="form-select form-select-sm shadow-sm bg-light"
                        onchange="this.form.submit()" style="width: auto;">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under
                            Review</option>
                        <option value="need_revision" {{ request('status') === 'need_revision' ? 'selected' : '' }}>Needs
                            Revision</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>

                    <button type="submit" class="btn btn-sm btn-danger fw-bold shadow-sm px-3">Filter</button>
                    @if (request()->has('search') || request()->has('status') || (request()->has('per_page') && request('per_page') != 10))
                        <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary fw-bold shadow-sm"
                            title="Clear Filters">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                </form>
            </div>

            <div class="table-responsive" style="min-height: 320px; overflow-y: visible;">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fs-7 fw-semibold">Event Details</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Request Type</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Submission Date</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Status</th>
                            <th class="pe-4 py-3 text-uppercase fs-7 fw-semibold text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($proposals as $proposal)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-bold text-dark">{{ $proposal->event_name }}</div>
                                    <div class="text-muted small"><i class="bi bi-building"></i> {{ $proposal->organizer }}
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="fw-semibold">{{ $proposal->request_type }}</div>
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $proposal->created_at->format('d M Y') }}
                                </td>
                                <td class="py-3">
                                    @if ($proposal->status === 'pending')
                                        <span
                                            class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">Pending</span>
                                    @elseif($proposal->status === 'under_review')
                                        <span class="badge bg-info px-3 py-2 rounded-pill shadow-sm">Under Review</span>
                                    @elseif($proposal->status === 'need_revision')
                                        <span class="badge bg-dark text-white px-3 py-2 rounded-pill shadow-sm">Needs
                                            Revision</span>
                                    @elseif($proposal->status === 'approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Approved</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">Rejected</span>
                                    @endif
                                </td>
                                <td class="pe-4 py-3 text-end">
                                    <div class="btn-group shadow-sm rounded-pill">
                                        <a href="{{ route('proposals.show', $proposal->id) }}"
                                            class="btn btn-sm btn-primary fw-bold px-4 rounded-start-pill">
                                            View
                                        </a>
                                        <button type="button"
                                            class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split rounded-end-pill px-2"
                                            data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                                            <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <ul
                                            class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2 p-2 fs-7">
                                            <li>
                                                <a class="dropdown-item fw-semibold py-2 rounded-3 text-secondary"
                                                    href="{{ Storage::url($proposal->proposal_file) }}" target="_blank">
                                                    <i class="bi bi-file-earmark-pdf text-danger me-2 fs-6"></i> Download
                                                    PDF
                                                </a>
                                            </li>
                                            @if (in_array($proposal->status, ['pending', 'need_revision']))
                                                <li>
                                                    <hr class="dropdown-divider opacity-10 my-1">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item fw-semibold py-2 rounded-3 text-secondary"
                                                        href="{{ route('proposals.edit', $proposal->id) }}">
                                                        <i class="bi bi-pencil-square text-warning me-2 fs-6"></i> Edit
                                                        Details
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('proposals.destroy', $proposal->id) }}"
                                                        method="POST" class="m-0">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="dropdown-item fw-semibold py-2 rounded-3 text-danger"
                                                            onclick="return confirm('Withdraw this proposal? This cannot be undone.')">
                                                            <i class="bi bi-x-circle me-2 fs-6"></i> Withdraw Request
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 mb-3 d-block text-black-50"></i>
                                    No proposals submitted yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($proposals->hasPages())
                <div class="card-footer bg-white py-4 px-4 border-top border-light tsel-pagination">
                    {{ $proposals->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
