document.addEventListener('DOMContentLoaded', function() {
    // Initialize default section
    showSection('info');
    
    // Add active class handling for buttons
    const buttons = document.querySelectorAll('.account-bar button');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            buttons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Handle alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Initialize any dropdowns
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        const trigger = dropdown.querySelector('a');
        const content = dropdown.querySelector('.dropdown-overlay');
        
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            content.classList.toggle('show');
        });
    });
});

function showSection(sectionId) {
    // Hide all sections
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.classList.add('hidden');
        section.style.display = 'none';
    });
    
    // Show selected section with animation
    const selectedSection = document.getElementById(sectionId + '-content');
    if (selectedSection) {
        selectedSection.classList.remove('hidden');
        selectedSection.style.display = 'block';
        selectedSection.style.opacity = '0';
        setTimeout(() => {
            selectedSection.style.opacity = '1';
        }, 10);
    }
}

function editDetails() {
    location.href = 'edit_info.php';
}

function editAddress() {
    location.href = 'edit_address.php';
}

function validateForm(formId) {
    const form = document.getElementById(formId);
    let isValid = true;
    
    // Remove existing error messages
    form.querySelectorAll('.error-message').forEach(el => el.remove());
    
    // Validate required fields
    form.querySelectorAll('[required]').forEach(field => {
        field.classList.remove('error');
        
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error');
            
            // Add error message
            const errorMsg = document.createElement('div');
            errorMsg.className = 'error-message';
            errorMsg.textContent = 'This field is required';
            field.parentNode.appendChild(errorMsg);
        }
        
        // Email validation
        if (field.type === 'email' && field.value.trim()) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(field.value.trim())) {
                isValid = false;
                field.classList.add('error');
                
                const errorMsg = document.createElement('div');
                errorMsg.className = 'error-message';
                errorMsg.textContent = 'Please enter a valid email address';
                field.parentNode.appendChild(errorMsg);
            }
        }
        
        // Phone validation
        if (field.type === 'tel' && field.value.trim()) {
            const phoneRegex = /^\+?[\d\s-]{8,}$/;
            if (!phoneRegex.test(field.value.trim())) {
                isValid = false;
                field.classList.add('error');
                
                const errorMsg = document.createElement('div');
                errorMsg.className = 'error-message';
                errorMsg.textContent = 'Please enter a valid phone number';
                field.parentNode.appendChild(errorMsg);
            }
        }
    });
    
    return isValid;
}

// Handle form submissions with fetch API
async function submitForm(formId, url) {
    const form = document.getElementById(formId);
    if (!validateForm(formId)) return false;
    
    try {
        const formData = new FormData(form);
        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });
        
        if (!response.ok) throw new Error('Network response was not ok');
        
        const result = await response.json();
        if (result.success) {
            showMessage('Changes saved successfully', 'success');
            setTimeout(() => window.location.href = 'profile.php', 1000);
        } else {
            showMessage(result.message || 'An error occurred', 'error');
        }
    } catch (error) {
        showMessage('An error occurred while saving changes', 'error');
        console.error('Error:', error);
    }
    
    return false;
}

function showMessage(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    
    const container = document.querySelector('.management-container');
    container.insertBefore(alertDiv, container.firstChild);
    
    setTimeout(() => {
        alertDiv.style.opacity = '0';
        setTimeout(() => alertDiv.remove(), 300);
    }, 5000);
}