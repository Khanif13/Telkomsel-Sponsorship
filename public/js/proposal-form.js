document.addEventListener('DOMContentLoaded', function () {
    const requestTypeSelect = document.getElementById('request_type');
    const packagesSection = document.getElementById('packages_section');
    const otherSupportFields = document.getElementById('other_support_fields');
    const finalStepNumber = document.getElementById('final_step_number');

    function toggleSections() {
        if (!requestTypeSelect) return;
        
        const selectedType = requestTypeSelect.value;

        // Jika memilih Fresh Money Funding
        if (selectedType === 'Fresh Money Funding' || selectedType === '') {
            if(packagesSection) packagesSection.classList.add('d-none');
            if(otherSupportFields) otherSupportFields.classList.add('d-none');
            if(finalStepNumber) finalStepNumber.innerText = '3';
        } else {
            // Tampilkan form packages & support detail
            if(packagesSection) packagesSection.classList.remove('d-none');
            if(otherSupportFields) otherSupportFields.classList.remove('d-none');
            if(finalStepNumber) finalStepNumber.innerText = '4';
        }
    }

    // Jalankan saat dropdown diubah
    if (requestTypeSelect) {
        requestTypeSelect.addEventListener('change', toggleSections);
        // Jalankan sekali saat halaman pertama kali dimuat
        toggleSections(); 
    }
});