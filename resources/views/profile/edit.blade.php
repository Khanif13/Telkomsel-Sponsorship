@extends('layouts.dashboard')
@section('page_title', 'Account Settings')

@section('content')
    <div class="container-fluid pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4"
                        role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-person-circle text-danger me-2"></i> Basic
                                Information</h5>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Telkomsel
                                        Number</label>
                                    <input type="text" class="form-control bg-light text-muted"
                                        value="{{ $user->phone_number }}" readonly>
                                    <div class="form-text fs-7">This number is used for authentication and cannot be
                                        changed.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Full Name (PIC)</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-building text-danger me-2"></i> Institution /
                                Organizer Details</h5>
                            <p class="text-muted fs-7 mb-0 mt-1">This data will automatically autofill your form when
                                submitting a proposal.</p>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Organization / Company
                                        Name</label>
                                    <input type="text" name="organizer_name" class="form-control"
                                        value="{{ old('organizer_name', $user->organizer_name) }}"
                                        placeholder="e.g., Student Executive Board / Tech Corp">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Organizer
                                        Category</label>
                                    <select name="organizer_category" class="form-select">
                                        <option value="">Select Category...</option>
                                        <option value="University / Student"
                                            {{ $user->organizer_category == 'University / Student' ? 'selected' : '' }}>
                                            University / Student</option>
                                        <option value="School"
                                            {{ $user->organizer_category == 'School' ? 'selected' : '' }}>School</option>
                                        <option value="General Community / NGO"
                                            {{ $user->organizer_category == 'General Community / NGO' ? 'selected' : '' }}>
                                            General Community / NGO</option>
                                        <option value="Government Institution"
                                            {{ $user->organizer_category == 'Government Institution' ? 'selected' : '' }}>
                                            Government Institution</option>
                                        <option value="Private Company (Event Organizer)"
                                            {{ $user->organizer_category == 'Private Company (Event Organizer)' ? 'selected' : '' }}>
                                            Private Company (Event Organizer)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Position /
                                        Title</label>
                                    <input type="text" name="position" class="form-control"
                                        value="{{ old('position', $user->position) }}"
                                        placeholder="e.g., Head of Committee">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Official Email</label>
                                    <input type="email" name="contact_email" class="form-control"
                                        value="{{ old('contact_email', $user->contact_email) }}"
                                        placeholder="e.g., info@organization.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold text-muted fs-7 text-uppercase">Full Address</label>
                                    <textarea name="address" rows="3" class="form-control" placeholder="Enter the full address...">{{ old('address', $user->address) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-5">
                        <button type="submit" class="btn btn-danger btn-lg rounded-pill fw-bold px-5 shadow-sm">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
