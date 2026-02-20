@extends('layouts.dashboard')

@section('page_title', 'Submit Sponsorship Proposal')

@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-lg-10">

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm rounded-3 mb-4">
                    <div class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i> Please correct the
                        following errors:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('proposals.store') }}" method="POST" enctype="multipart/form-data" id="proposalForm">
                @csrf

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar-event text-danger me-2"></i> 1. Event &
                            Contact Information</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Event Name *</label>
                                <input type="text" name="event_name" class="form-control" value="{{ old('event_name') }}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Organizer / Institution *</label>
                                <input type="text" name="organizer" class="form-control" value="{{ old('organizer') }}"
                                    required>
                            </div>

                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Contact Person Details</h6>
                            </div>
                            <div class="col-md-4 mt-0">
                                <label class="form-label fw-semibold fs-7 text-muted">Full Name *</label>
                                <input type="text" name="contact_name" class="form-control"
                                    value="{{ old('contact_name') }}" required>
                            </div>
                            <div class="col-md-4 mt-0">
                                <label class="form-label fw-semibold fs-7 text-muted">Email Address *</label>
                                <input type="email" name="contact_email" class="form-control"
                                    value="{{ old('contact_email') }}" required>
                            </div>
                            <div class="col-md-4 mt-0">
                                <label class="form-label fw-semibold fs-7 text-muted">Phone / WhatsApp *</label>
                                <input type="text" name="contact_phone" class="form-control"
                                    value="{{ old('contact_phone') }}" placeholder="e.g. +62812..." required>
                            </div>

                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Event Specifics</h6>
                            </div>
                            <div class="col-md-6 mt-0">
                                <label class="form-label fw-semibold">Event Category *</label>
                                <select name="event_category" class="form-select" required>
                                    <option value="" disabled selected>Select category...</option>
                                    <option value="Technology & IT"
                                        {{ old('event_category') == 'Technology & IT' ? 'selected' : '' }}>Technology & IT
                                    </option>
                                    <option value="Business & Startup"
                                        {{ old('event_category') == 'Business & Startup' ? 'selected' : '' }}>Business &
                                        Startup</option>
                                    <option value="Arts & Entertainment"
                                        {{ old('event_category') == 'Arts & Entertainment' ? 'selected' : '' }}>Arts &
                                        Entertainment</option>
                                    <option value="Sports & E-Sports"
                                        {{ old('event_category') == 'Sports & E-Sports' ? 'selected' : '' }}>Sports &
                                        E-Sports</option>
                                    <option value="Academic & Education"
                                        {{ old('event_category') == 'Academic & Education' ? 'selected' : '' }}>Academic &
                                        Education</option>
                                    <option value="Other" {{ old('event_category') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-0">
                                <label class="form-label fw-semibold">Event Scale *</label>
                                <select name="event_scale" class="form-select" required>
                                    <option value="" disabled selected>Select scale...</option>
                                    <option value="Campus" {{ old('event_scale') == 'Campus' ? 'selected' : '' }}>Campus /
                                        Internal</option>
                                    <option value="City" {{ old('event_scale') == 'City' ? 'selected' : '' }}>City /
                                        Regional</option>
                                    <option value="National" {{ old('event_scale') == 'National' ? 'selected' : '' }}>
                                        National</option>
                                    <option value="International"
                                        {{ old('event_scale') == 'International' ? 'selected' : '' }}>International
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Event Date *</label>
                                <input type="date" name="event_date" class="form-control"
                                    value="{{ old('event_date') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Location *</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location') }}"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Expected Participants *</label>
                                <input type="number" name="expected_participants" class="form-control"
                                    value="{{ old('expected_participants') }}" min="1" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Target Audience Description *</label>
                                <textarea name="target_audience" class="form-control" rows="2" required>{{ old('target_audience') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-cash-coin text-danger me-2"></i> 2. Sponsorship
                            Request Details</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-semibold">What type of sponsorship do you primarily request?
                                    *</label>
                                <select name="request_type" id="request_type" class="form-select form-select-lg"
                                    required>
                                    <option value="" disabled selected>Select an option...</option>
                                    <option value="Fresh Money Funding"
                                        {{ old('request_type') == 'Fresh Money Funding' ? 'selected' : '' }}>Fresh Money
                                        Funding</option>
                                    <option value="Product Support"
                                        {{ old('request_type') == 'Product Support' ? 'selected' : '' }}>Product Support /
                                        Merchandise</option>
                                    <option value="Internet Support"
                                        {{ old('request_type') == 'Internet Support' ? 'selected' : '' }}>Internet /
                                        Connectivity Support</option>
                                    <option value="Media Promotion"
                                        {{ old('request_type') == 'Media Promotion' ? 'selected' : '' }}>Media Promotion /
                                        Broadcast</option>
                                    <option value="Booth Activation"
                                        {{ old('request_type') == 'Booth Activation' ? 'selected' : '' }}>Booth Activation
                                    </option>
                                    <option value="Partnership"
                                        {{ old('request_type') == 'Partnership' ? 'selected' : '' }}>Strategic Partnership
                                    </option>
                                    <option value="Other" {{ old('request_type') == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 d-none" id="other_support_fields">
                                <div class="bg-light p-3 rounded-3 border">
                                    <label class="form-label fw-semibold text-primary">Support Needed Description *</label>
                                    <textarea name="support_description" id="support_description" class="form-control" rows="2"
                                        placeholder="Specify exactly what product, media, or internet support you need..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4 border-start border-danger border-4 d-none"
                    id="packages_section">
                    <div
                        class="card-header bg-white p-4 border-bottom-0 rounded-top-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam text-danger me-2"></i> 3. Sponsorship
                            Packages</h5>
                        <button type="button" class="btn btn-sm btn-outline-danger fw-bold rounded-pill"
                            id="add_package_btn">
                            <i class="bi bi-plus-circle me-1"></i> Add Package
                        </button>
                    </div>
                    <div class="card-body p-4 pt-0" id="packages_container">
                        <div class="package-block bg-white border rounded-3 p-4 mb-3 position-relative shadow-sm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-7 text-muted">Package Name *</label>
                                    <input type="text" name="packages[0][name]" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-7 text-muted">Package Price (IDR)</label>
                                    <input type="number" name="packages[0][price]" class="form-control form-control-sm">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold fs-7 text-muted">Sponsor Benefits *</label>
                                    <textarea name="packages[0][benefits]" class="form-control form-control-sm" rows="2"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-7 text-muted">Exposure Details *</label>
                                    <input type="text" name="packages[0][exposure]"
                                        class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold fs-7 text-muted">Slot Availability *</label>
                                    <input type="text" name="packages[0][slots]" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-file-text text-danger me-2"></i> <span
                                id="final_step_number">3</span>. Executive Summary & Document</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-semibold d-flex justify-content-between">
                                    <span>Executive Summary *</span>
                                    <span class="fs-7 text-muted">Characters: <span id="char_count"
                                            class="text-danger fw-bold">0</span> / Min 50</span>
                                </label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                            </div>

                            <div class="col-12 mt-4 p-4 bg-light rounded-3 border border-dashed text-center">
                                <label class="form-label fw-bold text-danger fs-5 mb-3 d-block"><i
                                        class="bi bi-file-earmark-pdf-fill"></i> Upload Official Proposal PDF</label>
                                <input type="file" name="proposal_file" class="form-control form-control-lg mx-auto"
                                    accept=".pdf" style="max-width: 500px;" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center mt-3 mb-5">
                    <button type="submit" class="btn btn-danger btn-lg px-5 rounded-pill fw-bold shadow-sm">
                        Submit Proposal <i class="bi bi-send-fill ms-2"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
