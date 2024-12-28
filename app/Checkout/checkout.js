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

// Function to toggle the visibility of the shipping and billing forms
function toggleDeliveryForms() {

const doorstep = document.getElementById("doorstep");
// Get the form elements
const addressForm = document.querySelector(".fieldset3");
    
    // Show/hide the form based on the selected method
    if (doorstep.checked) {
        addressForm.classList.remove("hidden");
    } else {
        addressForm.classList.add("hidden");
    }
}

// Add event listeners to the delivery method radio buttons
document.getElementById("self-pickup").addEventListener("click", toggleDeliveryForms);
document.getElementById("doorstep").addEventListener("click", toggleDeliveryForms);
// Call the function on page load to ensure the correct form is visible by default
window.onload = function() {
    toggleDeliveryForms();
};

// Function to validate and submit both forms
function submitForms() {
    // Validate the shipping form
    const shippingForm = document.getElementById("shippingForm");
    const billingForm = document.getElementById("billingForm");

    // Check if both forms are valid before submitting
    if (validate('shippingForm') && validate('billingForm')) {
        // Submit both forms
        shippingForm.submit();
        billingForm.submit();
    } else {
        // Validation failed, don't submit
        return false;
    }
}

// Function to reset both forms
function resetForms() {
    // Get both the shipping and billing forms
    const shippingForm = document.getElementById("shippingForm");
    const billingForm = document.getElementById("billingForm");

    // Reset both forms
    shippingForm.reset();
    billingForm.reset();
}

// Validate empty field, email, and phone number format for both forms
function validate(formId) {
    const form = document.getElementById(formId); // Dynamically select the form using the ID
    const inputs = form.querySelectorAll("input"); // Get all input fields in the selected form
  
    // Check for empty fields
    for (const input of inputs) {
        if (input.value.trim() === "") { // Trim to remove spaces and ensure input is clean
            alert("Please fill in the empty field.");
            input.focus(); // Stay at current page
            return false;
        }
    }

    // Validate email for the shipping form
    const emailField = form.querySelector('input[name="ship-Email"]'); // select email input
    if (emailField) {
        const email = emailField.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // RegEx for email format
    
        if (!emailPattern.test(email)) {
            alert("Please provide a valid email address.");
            emailField.focus();
            return false;
        }
    }

    // Validate phone number for the shipping form
    const telField = form.querySelector('input[name="ship-phoneNo"]');
    if (telField) {
        const tel = telField.value;
        const telPattern = /^0\d{2}-\d{3}-\d{4}$/; // RegEx for phone number format
    
        if (!telPattern.test(tel)) {
            alert("Please provide a valid phone number.");
            telField.focus();
            return false;
        }
    }

    // Validate phone number for the billing form
    const telField2 = form.querySelector('input[name="bill-phoneNo"]');
    if (telField2) {
        const tel = telField2.value;
        const telPattern = /^0\d{2}-\d{3}-\d{4}$/; // RegEx for phone number format
    
        if (!telPattern.test(tel)) {
            alert("Please provide a valid phone number.");
            telField2.focus();
            return false;
        }
    }

    // Validate email for the billing form
    const emailField2 = form.querySelector('input[name="bill-Email"]'); // select email input
    if (emailField2) {
        const email2 = emailField2.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // RegEx for email format
    
        if (!emailPattern.test(email2)) {
            alert("Please provide a valid email address.");
            emailField2.focus();
            return false;
        }
    }

    // Validate postcode for the shipping form
    const postcodeField = form.querySelector('input[name="ship-postcode"]');
    if (postcodeField) {
        const postcode = postcodeField.value;
        const postcodePattern = /^\d{5}$/; // RegEx for 5-digit Malaysian postcode
    
        if (!postcodePattern.test(postcode)) {
            alert("Please provide a valid 5-digit postcode.");
            postcodeField.focus();
            return false;
        }
    }

    // Validate postcode for the billing form
    const postcodeField2 = form.querySelector('input[name="bill-postcode"]');
    if (postcodeField2) {
        const postcode = postcodeField2.value;
        const postcodePattern = /^\d{5}$/; // RegEx for 5-digit Malaysian postcode
    
        if (!postcodePattern.test(postcode)) {
            alert("Please provide a valid 5-digit postcode.");
            postcodeField2.focus();
            return false;
        }
    }

    return true; // Return true if all validations pass
}

// Function to toggle the billing form and autofill the values from the shipping form
function toggleBillingForm() {
    const billingCheckbox = document.getElementById("billing-address");
    const billingForm = document.querySelector(".billing-form");
    const shippingForm = document.querySelector(".shipping-form");

    // If the checkbox is checked, autofill the billing form
    if (billingCheckbox.checked) {
        // Autofill billing form fields with shipping form values
        document.getElementById("bill-fn").value = document.getElementById("ship-fn").value;
        document.getElementById("bill-phoneNo").value = document.getElementById("ship-phoneNo").value;
        document.getElementById("bill-Email").value = document.getElementById("ship-Email").value;
        document.getElementById("bill-street").value = document.getElementById("ship-street").value;
        document.getElementById("bill-city").value = document.getElementById("ship-city").value;
        document.getElementById("bill-postcode").value = document.getElementById("ship-postcode").value;
        document.getElementById("bill-state").value = document.getElementById("ship-state").value;
    } else {
        // If the checkbox is unchecked, clear the billing form fields
        document.getElementById("bill-fn").value = "";
        document.getElementById("bill-phoneNo").value = "";
        document.getElementById("bill-Email").value = "";
        document.getElementById("bill-street").value = "";
        document.getElementById("bill-city").value = "";
        document.getElementById("bill-postcode").value = "";
        document.getElementById("bill-state").value = "";
    }
}
