/**
 * Multi-step form handler helper & upload preview interactions
 *
 * @package ZaminYab
 */

function toggleRentFields(statusId) {
    var select = document.getElementById('land_status');
    if (!select) return;

    var selectedOption = select.options[select.selectedIndex];
    var statusName = selectedOption ? (selectedOption.getAttribute('data-name') || '') : '';

    var saleFields = document.getElementById('zaminyabSaleFields');
    var rentFields = document.getElementById('zaminyabRentFields');

    if (saleFields && rentFields) {
        if (statusName.includes('اجاره') || statusName.includes('رهن')) {
            saleFields.style.display = 'none';
            rentFields.style.display = 'grid';
        } else {
            saleFields.style.display = 'grid';
            rentFields.style.display = 'none';
        }
    }
}

function nextFormStep(currentStep) {
    var title = document.getElementById('title');
    if (currentStep === 1 && title && !title.value) {
        alert('لطفاً عنوان آگهی را پر کنید.');
        return;
    }

    var currentPanel = document.getElementById('step-panel-' + currentStep);
    var currentNav   = document.getElementById('step-nav-' + currentStep);

    if (currentPanel && currentNav) {
        currentPanel.classList.remove('active');
        currentNav.classList.remove('active');
        currentNav.classList.add('completed');
    }

    var nextStep = currentStep + 1;
    var nextPanel = document.getElementById('step-panel-' + nextStep);
    var nextNav   = document.getElementById('step-nav-' + nextStep);

    if (nextPanel && nextNav) {
        nextPanel.classList.add('active');
        nextNav.classList.add('active');
    }
}

function prevFormStep(currentStep) {
    var currentPanel = document.getElementById('step-panel-' + currentStep);
    var currentNav   = document.getElementById('step-nav-' + currentStep);

    if (currentPanel && currentNav) {
        currentPanel.classList.remove('active');
        currentNav.classList.remove('active');
    }

    var prevStep = currentStep - 1;
    var prevPanel = document.getElementById('step-panel-' + prevStep);
    var prevNav   = document.getElementById('step-nav-' + prevStep);

    if (prevPanel && prevNav) {
        prevPanel.classList.add('active');
        prevNav.classList.add('active');
        prevNav.classList.remove('completed');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.getElementById('gallery_files');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            var preview = document.getElementById('imagePreviewContainer');
            if (preview) {
                preview.innerHTML = '';
                for (var i = 0; i < e.target.files.length; i++) {
                    var file = e.target.files[i];
                    var reader = new FileReader();
                    reader.onload = (function(theFile) {
                        return function(event) {
                            var div = document.createElement('div');
                            div.style.width = '80px';
                            div.style.height = '80px';
                            div.style.borderRadius = '6px';
                            div.style.overflow = 'hidden';
                            div.innerHTML = '<img src="' + event.target.result + '" style="width:100%; height:100%; object-fit:cover;">';
                            preview.appendChild(div);
                        };
                    })(file);
                    reader.readAsDataURL(file);
                }
            }
        });
    }

    // Initialize rent toggles
    var select = document.getElementById('land_status');
    if (select) {
        toggleRentFields(select.value);
    }
});
