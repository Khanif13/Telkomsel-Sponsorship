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
                <select name="request_type" id="request_type" class="form-select form-select-lg" required>
                    <option value="" disabled selected>Select an option...</option>
                    <option value="Fresh Money Funding"
                        {{ old('request_type') == 'Fresh Money Funding' ? 'selected' : '' }}>Fresh Money Funding
                    </option>
                    <option value="Product Support" {{ old('request_type') == 'Product Support' ? 'selected' : '' }}>
                        Product Support / Merchandise</option>
                    <option value="Internet Support" {{ old('request_type') == 'Internet Support' ? 'selected' : '' }}>
                        Internet / Connectivity Support</option>
                    <option value="Media Promotion" {{ old('request_type') == 'Media Promotion' ? 'selected' : '' }}>
                        Media Promotion / Broadcast</option>
                    <option value="Booth Activation" {{ old('request_type') == 'Booth Activation' ? 'selected' : '' }}>
                        Booth Activation</option>
                    <option value="Partnership" {{ old('request_type') == 'Partnership' ? 'selected' : '' }}>Strategic
                        Partnership</option>
                    <option value="Other" {{ old('request_type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="col-12 d-none" id="other_support_fields">
                <div class="bg-light p-3 rounded-3 border">
                    <label class="form-label fw-semibold text-primary">Support Needed Description *</label>
                    <textarea name="support_description" id="support_description" class="form-control" rows="2"
                        placeholder="Specify exactly what product, media, or internet support you need...">{{ old('support_description') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4 border-start border-danger border-4 d-none" id="packages_section">
    <div
        class="card-header bg-white p-4 border-bottom-0 rounded-top-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-box-seam text-danger me-2"></i> 3. Sponsorship Packages</h5>
        <button type="button" class="btn btn-sm btn-outline-danger fw-bold rounded-pill" id="add_package_btn">
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
                    <input type="text" name="packages[0][exposure]" class="form-control form-control-sm">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold fs-7 text-muted">Slot Availability *</label>
                    <input type="text" name="packages[0][slots]" class="form-control form-control-sm">
                </div>
            </div>
        </div>
    </div>
</div>
