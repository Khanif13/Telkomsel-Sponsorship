document.addEventListener('DOMContentLoaded', function () {
    
    const proposalForm = document.getElementById('proposalForm');
    if (!proposalForm) return;

    // 1. DYNAMIC LOGIC & NUMBERING
    const requestTypeSelect = document.getElementById('request_type');
    const otherSupportFields = document.getElementById('other_support_fields');
    const packagesSection = document.getElementById('packages_section');
    const inputSupport = document.getElementById('support_description');
    const finalStepNumber = document.getElementById('final_step_number');

    function toggleRequestFields() {
        const type = requestTypeSelect.value;
        
        if (type === 'Fresh Money Funding') {
            otherSupportFields.classList.add('d-none');
            packagesSection.classList.remove('d-none');
            inputSupport.required = false;
            
            if(finalStepNumber) finalStepNumber.textContent = '4';
            
        } else {
            packagesSection.classList.add('d-none');
            
            if(finalStepNumber) finalStepNumber.textContent = '3';
            
            if (type !== '') {
                otherSupportFields.classList.remove('d-none');
                inputSupport.required = true;
            } else {
                otherSupportFields.classList.add('d-none');
                inputSupport.required = false;
            }
        }
    }

    requestTypeSelect.addEventListener('change', toggleRequestFields);
    toggleRequestFields();

    // 2. DYNAMIC PACKAGES MULTIPLICATOR
    let packageIndex = 1; 
    const btnAddPackage = document.getElementById('add_package_btn');
    const packagesContainer = document.getElementById('packages_container');

    btnAddPackage.addEventListener('click', function () {
        const packageHTML = `
            <div class="package-block bg-white border rounded-3 p-4 mb-3 position-relative shadow-sm mt-3 border-top border-danger border-3">
                <button type="button" class="btn btn-sm btn-light text-danger position-absolute top-0 end-0 m-2 remove-package-btn" title="Remove Package">
                    <i class="bi bi-x-circle-fill fs-5"></i>
                </button>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold fs-7 text-muted">Package Name <span class="text-danger">*</span></label>
                        <input type="text" name="packages[${packageIndex}][name]" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold fs-7 text-muted">Package Price (IDR)</label>
                        <input type="number" name="packages[${packageIndex}][price]" class="form-control form-control-sm">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold fs-7 text-muted">Sponsor Benefits <span class="text-danger">*</span></label>
                        <textarea name="packages[${packageIndex}][benefits]" class="form-control form-control-sm" rows="2" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold fs-7 text-muted">Exposure Details <span class="text-danger">*</span></label>
                        <input type="text" name="packages[${packageIndex}][exposure]" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold fs-7 text-muted">Slot Availability <span class="text-danger">*</span></label>
                        <input type="text" name="packages[${packageIndex}][slots]" class="form-control form-control-sm" required>
                    </div>
                </div>
            </div>
        `;
        packagesContainer.insertAdjacentHTML('beforeend', packageHTML);
        packageIndex++;
    });

    packagesContainer.addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-package-btn');
        if (btn) {
            btn.closest('.package-block').remove();
        }
    });

    // 3. EXECUTIVE SUMMARY CHARACTER COUNTER
    const execSummary = document.getElementById('description');
    const charCount = document.getElementById('char_count');

    function updateCharCount() {
        const len = execSummary.value.length;
        charCount.textContent = len;
        
        // Changed from 100 to 50
        if (len < 50) {
            charCount.classList.add('text-danger');
            charCount.classList.remove('text-success');
        } else {
            charCount.classList.add('text-success');
            charCount.classList.remove('text-danger');
        }
    }

    execSummary.addEventListener('input', updateCharCount);
    updateCharCount(); 
});