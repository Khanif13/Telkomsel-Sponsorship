@extends('layouts.dashboard')
@section('page_title', 'Review Proposal')
@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-lg-10">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.proposals.index') }}"
                    class="btn btn-outline-secondary rounded-pill fw-semibold shadow-sm"><i
                        class="bi bi-arrow-left me-1"></i> Back to Pipeline</a>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted fw-bold">Current Status:</span>
                    <x-status-badge :status="$proposal->status" class="fs-6" />
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4 mb-4 border-top border-primary border-4">
                <div class="card-body p-4 bg-light rounded-4">
                    <div class="mb-3">
                        <h5 class="fw-bold text-dark mb-1">Administrator Action</h5>
                        <div class="text-muted fs-7">Update the status of this proposal and provide feedback to the
                            applicant.</div>
                    </div>
                    <form action="{{ route('admin.proposals.update-status', $proposal->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted fs-7 text-uppercase">Feedback / Reason
                                (Optional)</label>
                            <textarea name="admin_note" class="form-control border-secondary-subtle rounded-3 shadow-sm" rows="3"
                                placeholder="Explain why this is rejected or requires changes...">{{ $proposal->admin_note }}</textarea>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" name="status" value="under_review"
                                class="btn btn-info fw-bold rounded-pill text-white shadow-sm {{ $proposal->status === 'under_review' ? 'disabled' : '' }}">
                                <i class="bi bi-search me-1"></i> Under Review
                            </button>
                            <button type="submit" name="status" value="need_revision"
                                class="btn btn-dark fw-bold rounded-pill shadow-sm {{ $proposal->status === 'need_revision' ? 'disabled' : '' }}">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Request Revision
                            </button>
                            <button type="submit" name="status" value="approved"
                                class="btn btn-success fw-bold rounded-pill shadow-sm {{ $proposal->status === 'approved' ? 'disabled' : '' }}">
                                <i class="bi bi-check-circle-fill me-1"></i> Approve
                            </button>
                            <button type="submit" name="status" value="rejected"
                                class="btn btn-danger fw-bold rounded-pill shadow-sm {{ $proposal->status === 'rejected' ? 'disabled' : '' }}">
                                <i class="bi bi-x-circle-fill me-1"></i> Reject
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <x-proposal-details :proposal="$proposal" :is-admin="true" />

            <div class="d-flex justify-content-end mb-5">
                <a href="{{ Storage::url($proposal->proposal_file) }}" target="_blank"
                    class="btn btn-dark btn-lg px-5 rounded-pill fw-bold shadow-lg"><i
                        class="bi bi-file-earmark-pdf-fill me-2"></i> Download Full PDF</a>
            </div>
        </div>
    </div>
@endsection
