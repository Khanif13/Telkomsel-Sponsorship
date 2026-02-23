<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-white p-4 border-bottom-0 rounded-top-4">
        <h5 class="fw-bold text-dark mb-0"><i class="bi bi-file-text text-danger me-2"></i> <span
                id="final_step_number">3</span>. Executive Summary & Document</h5>
    </div>
    <div class="card-body p-4 pt-0">
        <div class="row g-4">
            <div class="col-12">
                <label class="form-label fw-semibold d-flex justify-content-between">
                    <span>Executive Summary (Optional)</span>
                    <span class="fs-7 text-muted">Characters: <span id="char_count"
                            class="text-danger fw-bold">0</span></span>
                </label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="col-12 mt-4">
                <div class="p-4 bg-light rounded-4 border border-secondary border-opacity-25">
                    <label class="form-label fw-bold text-dark fs-6 mb-3 d-block">
                        <i class="bi bi-cloud-arrow-up-fill text-danger me-2"></i> Attach Proposal Document
                    </label>

                    <div class="row g-4">
                        <div class="col-md-6 border-end border-secondary border-opacity-25">
                            <label class="form-label fw-semibold fs-7 text-muted">Option A: Link (Google Drive /
                                Docs)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-link-45deg"></i></span>
                                <input type="url" name="proposal_link" class="form-control"
                                    placeholder="https://docs.google.com/..." value="{{ old('proposal_link') }}">
                            </div>
                            <div class="form-text fs-7 mt-2">Make sure the link access is set to "Anyone with the link
                                can view".</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-7 text-muted">Option B: Upload PDF File</label>
                            <input type="file" name="proposal_file" class="form-control" accept=".pdf">
                            <div class="form-text fs-7 mt-2">Max file size: 10MB.</div>
                        </div>
                    </div>

                    <div class="mt-3 text-center text-muted fs-7 fw-semibold">
                        * Please provide at least one of the options above.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
