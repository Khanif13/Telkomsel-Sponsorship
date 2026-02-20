@extends('layouts.dashboard')

@section('page_title', 'My Submissions')

@section('content')
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

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
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
                                    @elseif($proposal->status === 'approved')
                                        <span class="badge bg-success px-3 py-2 rounded-pill shadow-sm">Approved</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-2 rounded-pill shadow-sm">Rejected</span>
                                    @endif
                                </td>
                                <td class="pe-4 py-3 text-end">
                                    <a href="{{ route('proposals.show', $proposal->id) }}"
                                        class="btn btn-sm btn-primary rounded-pill fw-semibold me-1 shadow-sm">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ Storage::url($proposal->proposal_file) }}" target="_blank"
                                        class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold shadow-sm">
                                        <i class="bi bi-download"></i> PDF
                                    </a>
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
                <div class="card-footer bg-white py-3 px-4 border-0">
                    {{ $proposals->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
@endsection
