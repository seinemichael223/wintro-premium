// Overlay of Product
document.getElementById('product-link').addEventListener('click', function (e) {
    e.preventDefault();
    const dropdown = document.getElementById('product-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

// Close the dropdown when clicking outside
document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('product-dropdown');
    const productLink = document.getElementById('product-link');

    if (!dropdown.contains(e.target) && e.target !== productLink) {
        dropdown.style.display = 'none';
    }
});

function validateForm() {
    const form = document.getElementById('quotationForm');
    const inputs = form.querySelectorAll('input');

    // Check for empty fields
    for (const input of inputs) {
        if (input.value.trim() === "") { // Trim to remove spaces and ensure input is clean
            alert("Please fill in the empty field.");
            input.focus(); // Stay at current page
            return false;
        }
    }

    // Validate email
    const emailField = form.querySelector('input[name="Email"]');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (emailField && !emailPattern.test(emailField.value)) {
        alert("Please provide a valid email address.");
        emailField.focus();
        return false;
    }

    // Validate phone number
    const telField = form.querySelector('input[name="phoneNo"]');
    const telPattern = /^0\d{2}-\d{3}-\d{4}$/;
    if (telField && !telPattern.test(telField.value)) {
        alert("Please provide a valid phone number.");
        telField.focus();
        return false;
    }

    // Validate postcode
    const postcodeField = form.querySelector('input[name="code"]');
    const postcodePattern = /^\d{5}$/;
    if (postcodeField && !postcodePattern.test(postcodeField.value)) {
        alert("Please provide a valid 5-digit postcode.");
        postcodeField.focus();
        return false;
    }

    return true;
}
