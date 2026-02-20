@extends('layouts.dashboard')

@section('page_title', 'Edit Sponsorship Proposal')

@section('content')
    <div class="row justify-content-center pb-5">
        <div class="col-lg-10">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('proposals.index') }}" class="btn btn-outline-secondary rounded-pill fw-semibold shadow-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-pencil me-1"></i> Editing Draft
                </span>
            </div>

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

            <form action="{{ route('proposals.update', $proposal->id) }}" method="POST" enctype="multipart/form-data"
                id="proposalForm">
                @csrf
                @method('PUT')

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar-event text-danger me-2"></i> 1. Event &
                            Contact Information</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Event Name *</label>
                                <input type="text" name="event_name" class="form-control"
                                    value="{{ old('event_name', $proposal->event_name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Organizer / Institution *</label>
                                <input type="text" name="organizer" class="form-control"
                                    value="{{ old('organizer', $proposal->organizer) }}" required>
                            </div>

                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Contact Person Details</h6>
                            </div>
                            <div class="col-md-4 mt-0">
                                <label class="form-label fw-semibold fs-7 text-muted">Full Name *</label>
                                <input type="text" name="contact_name" class="form-control"
                                    value="{{ old('contact_name', $proposal->contact_name) }}" required>
                            </div>
                            <div class="col-md-4 mt-0">
                                <label class="form-label fw-semibold fs-7 text-muted">Email Address *</label>
                                <input type="email" name="contact_email" class="form-control"
                                    value="{{ old('contact_email', $proposal->contact_email) }}" required>
                            </div>
                            <div class="col-md-4 mt-0">
                                <label class="form-label fw-semibold fs-7 text-muted">Phone / WhatsApp *</label>
                                <input type="text" name="contact_phone" class="form-control"
                                    value="{{ old('contact_phone', $proposal->contact_phone) }}" required>
                            </div>

                            <div class="col-12 mt-4">
                                <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Event Specifics</h6>
                            </div>
                            <div class="col-md-6 mt-0">
                                <label class="form-label fw-semibold">Event Category *</label>
                                <select name="event_category" class="form-select" required>
                                    <option value="" disabled>Select category...</option>
                                    @php $selectedCategory = old('event_category', $proposal->event_category); @endphp
                                    <option value="Technology & IT"
                                        {{ $selectedCategory == 'Technology & IT' ? 'selected' : '' }}>Technology & IT
                                    </option>
                                    <option value="Business & Startup"
                                        {{ $selectedCategory == 'Business & Startup' ? 'selected' : '' }}>Business & Startup
                                    </option>
                                    <option value="Arts & Entertainment"
                                        {{ $selectedCategory == 'Arts & Entertainment' ? 'selected' : '' }}>Arts &
                                        Entertainment</option>
                                    <option value="Sports & E-Sports"
                                        {{ $selectedCategory == 'Sports & E-Sports' ? 'selected' : '' }}>Sports & E-Sports
                                    </option>
                                    <option value="Academic & Education"
                                        {{ $selectedCategory == 'Academic & Education' ? 'selected' : '' }}>Academic &
                                        Education</option>
                                    <option value="Other" {{ $selectedCategory == 'Other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-0">
                                <label class="form-label fw-semibold">Event Scale *</label>
                                <select name="event_scale" class="form-select" required>
                                    <option value="" disabled>Select scale...</option>
                                    @php $selectedScale = old('event_scale', $proposal->event_scale); @endphp
                                    <option value="Campus" {{ $selectedScale == 'Campus' ? 'selected' : '' }}>Campus /
                                        Internal</option>
                                    <option value="City" {{ $selectedScale == 'City' ? 'selected' : '' }}>City / Regional
                                    </option>
                                    <option value="National" {{ $selectedScale == 'National' ? 'selected' : '' }}>National
                                    </option>
                                    <option value="International"
                                        {{ $selectedScale == 'International' ? 'selected' : '' }}>International</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Event Date *</label>
                                <input type="date" name="event_date" class="form-control"
                                    value="{{ old('event_date', \Carbon\Carbon::parse($proposal->event_date)->format('Y-m-d')) }}"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Location *</label>
                                <input type="text" name="location" class="form-control"
                                    value="{{ old('location', $proposal->location) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Expected Participants *</label>
                                <input type="number" name="expected_participants" class="form-control"
                                    value="{{ old('expected_participants', $proposal->expected_participants) }}"
                                    min="1" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Target Audience Description *</label>
                                <textarea name="target_audience" class="form-control" rows="2" required>{{ old('target_audience', $proposal->target_audience) }}</textarea>
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
                                    @php $selectedType = old('request_type', $proposal->request_type); @endphp
                                    <option value="Fresh Money Funding"
                                        {{ $selectedType == 'Fresh Money Funding' ? 'selected' : '' }}>Fresh Money Funding
                                    </option>
                                    <option value="Product Support"
                                        {{ $selectedType == 'Product Support' ? 'selected' : '' }}>Product Support /
                                        Merchandise</option>
                                    <option value="Internet Support"
                                        {{ $selectedType == 'Internet Support' ? 'selected' : '' }}>Internet / Connectivity
                                        Support</option>
                                    <option value="Media Promotion"
                                        {{ $selectedType == 'Media Promotion' ? 'selected' : '' }}>Media Promotion /
                                        Broadcast</option>
                                    <option value="Booth Activation"
                                        {{ $selectedType == 'Booth Activation' ? 'selected' : '' }}>Booth Activation
                                    </option>
                                    <option value="Partnership" {{ $selectedType == 'Partnership' ? 'selected' : '' }}>
                                        Strategic Partnership</option>
                                    <option value="Other" {{ $selectedType == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="col-12 {{ $selectedType == 'Fresh Money Funding' ? 'd-none' : '' }}"
                                id="other_support_fields">
                                <div class="bg-light p-3 rounded-3 border">
                                    <label class="form-label fw-semibold text-primary">Support Needed Description *</label>
                                    <textarea name="support_description" id="support_description" class="form-control" rows="2">{{ old('support_description', $proposal->support_description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4 border-start border-danger border-4 {{ old('request_type', $proposal->request_type) == 'Fresh Money Funding' ? '' : 'd-none' }}"
                    id="packages_section">
                    <div
                        class="card-header bg-white p-4 border-bottom-0 rounded-top-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam text-danger me-2"></i> 3. Sponsorship
                            Packages</h5>
                    </div>
                    <div class="card-body p-4 pt-0" id="packages_container">
                        @foreach ($packages as $index => $package)
                            <div class="package-block bg-white border rounded-3 p-4 mb-3 position-relative shadow-sm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7 text-muted">Package Name *</label>
                                        <input type="text" name="packages[{{ $index }}][name]"
                                            class="form-control form-control-sm" value="{{ $package['name'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7 text-muted">Package Price (IDR)</label>
                                        <input type="number" name="packages[{{ $index }}][price]"
                                            class="form-control form-control-sm" value="{{ $package['price'] ?? '' }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-7 text-muted">Sponsor Benefits *</label>
                                        <textarea name="packages[{{ $index }}][benefits]" class="form-control form-control-sm" rows="2">{{ $package['benefits'] ?? '' }}</textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7 text-muted">Exposure Details *</label>
                                        <input type="text" name="packages[{{ $index }}][exposure]"
                                            class="form-control form-control-sm"
                                            value="{{ $package['exposure'] ?? '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7 text-muted">Slot Availability *</label>
                                        <input type="text" name="packages[{{ $index }}][slots]"
                                            class="form-control form-control-sm" value="{{ $package['slots'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-file-text text-danger me-2"></i> <span
                                id="final_step_number">4</span>. Executive Summary & Document</h5>
                    </div>
                    <div class="card-body p-4 pt-0">
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Executive Summary *</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $proposal->description) }}</textarea>
                            </div>

                            <div class="col-12 mt-4 p-4 bg-light rounded-3 border border-dashed text-center">
                                <div class="mb-3">
                                    <span class="badge bg-success mb-2 px-3 py-2 rounded-pill"><i
                                            class="bi bi-file-earmark-pdf"></i> Current File Saved</span><br>
                                    <a href="{{ Storage::url($proposal->proposal_file) }}" target="_blank"
                                        class="fw-bold text-primary text-decoration-none">View Existing Proposal PDF</a>
                                </div>
                                <hr class="opacity-25 w-50 mx-auto">
                                <label class="form-label fw-bold text-danger fs-6 d-block mt-3">Upload New PDF (Only if you
                                    want to replace the current one)</label>
                                <input type="file" name="proposal_file"
                                    class="form-control form-control-lg mx-auto mt-2" accept=".pdf"
                                    style="max-width: 500px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center mt-3 mb-5">
                    <button type="submit" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold shadow-sm text-dark">
                        Save Changes <i class="bi bi-floppy-fill ms-2"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const requestTypeSelect = document.getElementById('request_type');
            const otherFields = document.getElementById('other_support_fields');
            const packagesSection = document.getElementById('packages_section');
            const stepNumber = document.getElementById('final_step_number');

            function toggleFields() {
                if (requestTypeSelect.value === 'Fresh Money Funding') {
                    packagesSection.classList.remove('d-none');
                    otherFields.classList.add('d-none');
                    stepNumber.innerText = '4';
                } else {
                    packagesSection.classList.add('d-none');
                    otherFields.classList.remove('d-none');
                    stepNumber.innerText = '3';
                }
            }

            toggleFields();
            requestTypeSelect.addEventListener('change', toggleFields);
        });
    </script>
@endpush
