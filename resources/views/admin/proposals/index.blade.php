@extends('layouts.dashboard')

@section('page_title', 'Review All Submissions')

@section('content')
    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold text-dark mb-0">Proposal Yang Diajukan</h5>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form action="{{ url()->current() }}" method="GET" class="row g-3 align-items-center">

                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                placeholder="Search event or organizer..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <select name="status" class="form-select text-secondary">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under
                                Review</option>
                            <option value="need_revision" {{ request('status') === 'need_revision' ? 'selected' : '' }}>
                                Needs Revision</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved
                            </option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-danger fw-bold w-100 shadow-sm">
                            Filter
                        </button>
                        @if (request()->has('search') || request()->has('status'))
                            <a href="{{ url()->current() }}" class="btn btn-outline-secondary fw-bold shadow-sm"
                                title="Clear Filters">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>

                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fs-7 fw-semibold">Applicant & Event</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Request Type</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Submitted</th>
                            <th class="py-3 text-uppercase fs-7 fw-semibold">Status</th>
                            <th class="pe-4 py-3 text-uppercase fs-7 fw-semibold text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @forelse($proposals as $proposal)
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-bold text-dark">{{ $proposal->event_name }}</div>
                                    <div class="text-muted small">
                                        <i class="bi bi-person"></i> {{ $proposal->user->name }} &bull; <i
                                            class="bi bi-building"></i> {{ $proposal->organizer }}
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="fw-semibold">{{ $proposal->request_type }}</div>
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $proposal->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="py-3">
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
                                <td class="pe-4 py-3 text-end">
                                    <div class="btn-group shadow-sm rounded-pill">
                                        <a href="{{ route('admin.proposals.show', $proposal->id) }}"
                                            class="btn btn-sm btn-primary fw-bold px-4 rounded-start-pill">
                                            Review
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
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 mb-3 d-block text-black-50"></i>
                                    No proposals found in the system.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($proposals->hasPages())
                <div class="card-footer bg-white py-3 px-4 border-0">
                    {{ $proposals->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
