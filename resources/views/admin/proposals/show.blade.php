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
                    class="btn btn-outline-secondary rounded-pill fw-semibold shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Pipeline
                </a>
                <div>
                    @if ($proposal->status === 'pending')
                        <span class="badge bg-warning text-dark px-4 py-2 fs-6 rounded-pill shadow-sm">Current Status:
                            Pending</span>
                    @elseif($proposal->status === 'under_review')
                        <span class="badge bg-info px-4 py-2 fs-6 rounded-pill shadow-sm">Current Status: Under
                            Review</span>
                    @elseif($proposal->status === 'approved')
                        <span class="badge bg-success px-4 py-2 fs-6 rounded-pill shadow-sm">Current Status: Approved</span>
                    @else
                        <span class="badge bg-danger px-4 py-2 fs-6 rounded-pill shadow-sm">Current Status: Rejected</span>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4 mb-4 border-top border-primary border-4">
                <div class="card-body p-4 d-flex justify-content-between align-items-center bg-light rounded-4">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Administrator Action</h5>
                        <div class="text-muted fs-7">Update the status of this proposal to trigger notifications to the
                            applicant.</div>
                    </div>
                    <form action="{{ route('admin.proposals.update-status', $proposal->id) }}" method="POST"
                        class="d-flex gap-2">
                        @csrf
                        @method('PATCH')

                        <button type="submit" name="status" value="under_review"
                            class="btn btn-info fw-bold rounded-pill text-white shadow-sm {{ $proposal->status === 'under_review' ? 'disabled' : '' }}">
                            <i class="bi bi-search me-1"></i> Under Review
                        </button>

                        <button type="submit" name="status" value="approved"
                            class="btn btn-success fw-bold rounded-pill shadow-sm {{ $proposal->status === 'approved' ? 'disabled' : '' }}">
                            <i class="bi bi-check-circle-fill me-1"></i> Approve
                        </button>

                        <button type="submit" name="status" value="rejected"
                            class="btn btn-danger fw-bold rounded-pill shadow-sm {{ $proposal->status === 'rejected' ? 'disabled' : '' }}">
                            <i class="bi bi-x-circle-fill me-1"></i> Reject
                        </button>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h3 class="fw-bolder text-dark mb-1">{{ $proposal->event_name }}</h3>
                            <p class="text-muted fs-5 mb-0"><i class="bi bi-building"></i> {{ $proposal->organizer }}</p>
                        </div>
                        <div class="text-end text-muted fs-7">
                            Submitted by:<br>
                            <strong class="text-dark">{{ $proposal->user->name }}</strong><br>
                            {{ $proposal->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div class="bg-light border rounded-3 p-3 mb-4">
                        <div class="fw-bold text-dark mb-2"><i class="bi bi-person-badge me-2 text-danger"></i> Primary
                            Contact</div>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <span class="text-muted fs-7 d-block">Name:</span>
                                <span class="fw-semibold">{{ $proposal->contact_name }}</span>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted fs-7 d-block">Email:</span>
                                <a href="mailto:{{ $proposal->contact_email }}"
                                    class="fw-semibold text-decoration-none">{{ $proposal->contact_email }}</a>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted fs-7 d-block">Phone:</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $proposal->contact_phone) }}"
                                    target="_blank" class="fw-semibold text-decoration-none text-success">
                                    <i class="bi bi-whatsapp"></i> {{ $proposal->contact_phone }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Category</div>
                            <div class="fw-semibold">{{ $proposal->event_category }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Scale</div>
                            <div class="fw-semibold">{{ $proposal->event_scale }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Event Date</div>
                            <div class="fw-semibold">{{ $proposal->event_date->format('d M Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Location</div>
                            <div class="fw-semibold">{{ $proposal->location }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted fs-7 fw-bold text-uppercase mb-1">Participants</div>
                            <div class="fw-semibold">{{ number_format($proposal->expected_participants) }} People</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-muted fs-7 fw-bold text-uppercase mb-2">Target Audience</div>
                        <p class="mb-0 bg-light p-3 rounded-3">{{ $proposal->target_audience }}</p>
                    </div>

                    <div class="mb-4">
                        <div class="text-muted fs-7 fw-bold text-uppercase mb-2">Executive Summary</div>
                        <p class="mb-0 bg-light p-3 rounded-3">{{ $proposal->description }}</p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-cash-coin text-danger me-2"></i> Request Details</h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <h6 class="fw-bold text-primary mb-3">{{ $proposal->request_type }}</h6>

                    @if ($proposal->request_type === 'Fresh Money Funding')
                        <div class="alert alert-success border-0 rounded-3 shadow-sm mb-0">
                            <i class="bi bi-check-circle-fill me-2"></i> This proposal requests financial sponsorship. See
                            the detailed packages below.
                        </div>
                    @else
                        <div>
                            <div class="text-muted fs-7 fw-bold text-uppercase mb-2">Support Description</div>
                            <p class="mb-0 bg-light p-3 rounded-3">{{ $proposal->support_description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            @if ($proposal->packages)
                <div class="card border-0 shadow-sm rounded-4 mb-4 border-start border-danger border-4">
                    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam text-danger me-2"></i> Sponsorship
                            Packages</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="row g-3">
                            @foreach ($proposal->packages as $package)
                                <div class="col-md-6">
                                    <div class="border rounded-3 p-3 h-100 bg-light">
                                        <h6 class="fw-bold text-danger mb-1">{{ $package['name'] }}</h6>
                                        <div class="text-muted fs-7 mb-2">
                                            {{ isset($package['price']) && $package['price'] ? 'Rp ' . number_format($package['price'], 0, ',', '.') : 'Custom Price' }}
                                            &bull; {{ $package['slots'] }}
                                        </div>
                                        <div class="fs-7 fw-semibold mt-2 mb-1">Benefits:</div>
                                        <p class="fs-7 mb-2">{{ $package['benefits'] }}</p>
                                        <div class="fs-7 fw-semibold mb-1">Exposure:</div>
                                        <p class="fs-7 mb-0">{{ $package['exposure'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-end mb-5">
                <a href="{{ Storage::url($proposal->proposal_file) }}" target="_blank"
                    class="btn btn-dark btn-lg px-5 rounded-pill fw-bold shadow-lg">
                    <i class="bi bi-file-earmark-pdf-fill me-2"></i> Download Full PDF
                </a>
            </div>

        </div>
    </div>
@endsection
