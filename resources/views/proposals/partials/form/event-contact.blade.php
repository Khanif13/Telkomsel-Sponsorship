<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-calendar-event text-danger me-2"></i> 1. Event &
            Contact Information</h5>
    </div>
    <div class="card-body p-4 pt-0">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Event Name *</label>
                <input type="text" name="event_name" class="form-control" value="{{ old('event_name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Organizer / Institution *</label>
                <input type="text" name="organizer" class="form-control"
                    value="{{ old('organizer', Auth::user()->organizer_name) }}" required>
            </div>

            <div class="col-12 mt-4">
                <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Contact Person Details</h6>
            </div>
            <div class="col-md-4 mt-0">
                <label class="form-label fw-semibold fs-7 text-muted">Full Name *</label>
                <input type="text" name="contact_name" class="form-control"
                    value="{{ old('contact_name', Auth::user()->name) }}" required>
            </div>
            <div class="col-md-4 mt-0">
                <label class="form-label fw-semibold fs-7 text-muted">Email Address *</label>
                <input type="email" name="contact_email" class="form-control"
                    value="{{ old('contact_email', Auth::user()->contact_email) }}" required>
            </div>
            <div class="col-md-4 mt-0">
                <label class="form-label fw-semibold fs-7 text-muted">Phone / WhatsApp *</label>
                <input type="text" name="contact_phone" class="form-control"
                    value="{{ old('contact_phone', Auth::user()->phone_number) }}" placeholder="e.g. 0812..." required>
            </div>

            <div class="col-12 mt-4">
                <h6 class="fw-bold text-muted mb-3 border-bottom pb-2">Event Specifics</h6>
            </div>
            <div class="col-md-6 mt-0">
                <label class="form-label fw-semibold">Event Category *</label>
                <select name="event_category" class="form-select" required>
                    <option value="" disabled selected>Select category...</option>
                    <option value="Technology & IT" {{ old('event_category') == 'Technology & IT' ? 'selected' : '' }}>
                        Technology & IT</option>
                    <option value="Business & Startup"
                        {{ old('event_category') == 'Business & Startup' ? 'selected' : '' }}>Business & Startup
                    </option>
                    <option value="Arts & Entertainment"
                        {{ old('event_category') == 'Arts & Entertainment' ? 'selected' : '' }}>Arts & Entertainment
                    </option>
                    <option value="Sports & E-Sports"
                        {{ old('event_category') == 'Sports & E-Sports' ? 'selected' : '' }}>Sports & E-Sports</option>
                    <option value="Academic & Education"
                        {{ old('event_category') == 'Academic & Education' ? 'selected' : '' }}>Academic & Education
                    </option>
                    <option value="Other" {{ old('event_category') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-6 mt-0">
                <label class="form-label fw-semibold">Event Scale *</label>
                <select name="event_scale" class="form-select" required>
                    <option value="" disabled selected>Select scale...</option>
                    <option value="Campus" {{ old('event_scale') == 'Campus' ? 'selected' : '' }}>Campus / Internal
                    </option>
                    <option value="City" {{ old('event_scale') == 'City' ? 'selected' : '' }}>City / Regional
                    </option>
                    <option value="National" {{ old('event_scale') == 'National' ? 'selected' : '' }}>National</option>
                    <option value="International" {{ old('event_scale') == 'International' ? 'selected' : '' }}>
                        International</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Event Date *</label>
                <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold">Location *</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
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
