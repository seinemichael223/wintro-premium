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
function toggleAddressBox() {
    const doorstep = document.getElementById("doorstep");
    // Get the form elements
    const addressBox = document.querySelector(".addressBox");
        
        // Show/hide the form based on the selected method
        if (doorstep.checked) {
            addressBox.classList.remove("hidden");
        } else {
            addressBox.classList.add("hidden");
        }
    }
    
    // Add event listeners to the delivery method radio buttons
    document.getElementById("self-pickup").addEventListener("click", toggleAddressBox);
    document.getElementById("doorstep").addEventListener("click", toggleAddressBox);
    // Call the function on page load to ensure the correct form is visible by default
    window.onload = function() {
        toggleAddressBox();
};

// Show other saved shipping address
document.getElementById('ship-angle').addEventListener('click', function() {
    const otherAddress = document.querySelector('.other-shipAddress');
    otherAddress.classList.toggle('hidden');
});

// Show other saved billing address
document.getElementById('bill-angle').addEventListener('click', function() {
    const otherAddress = document.querySelector('.other-billAddress');
    otherAddress.classList.toggle('hidden');
});

// Swap content between addresses when the other address is clicked
document.querySelector('.other-shipAddress').addEventListener('click', function () {
    const shippingInfo = document.querySelector('.shipping-info');
    const otherAddress = document.querySelector('.other-shipAddress');

    // Swap contents
    const tempContent = shippingInfo.innerHTML;
    shippingInfo.innerHTML = otherAddress.innerHTML;
    otherAddress.innerHTML = tempContent;

    // Hide the other address after swapping
    otherAddress.classList.add('hidden');
});

// Swap content between addresses when the other address is clicked
document.querySelector('.other-billAddress').addEventListener('click', function () {
    const billingInfo = document.querySelector('.billing-info');
    const otherAddress = document.querySelector('.other-billAddress');

    // Swap contents
    const tempContent = billingInfo.innerHTML;
    billingInfo.innerHTML = otherAddress.innerHTML;
    otherAddress.innerHTML = tempContent;

    // Hide the other address after swapping
    otherAddress.classList.add('hidden');
});

// Utility function to toggle visibility
function toggleVisibility(hiddenElement, visibleElement) {
    hiddenElement.classList.add('hidden');
    visibleElement.classList.remove('hidden');
}

// Elements for Shipping Address
const shippingBox = document.querySelector('.shipping-box');
const shippingInfo = document.querySelector('.shipping-info');
const shippingForm = document.getElementById('shippingForm');
const editShippingBtn = document.getElementById('edit-ship');
const addShippingBtn = document.getElementById('add-ship');
const saveShippingBtn = document.getElementById('saveBtn1');
const cancelShippingBtn = document.getElementById('cancelBtn1');

// Elements for Billing Address
const billingBox = document.querySelector('.billing-box');
const billingInfo = document.querySelector('.billing-info');
const billingForm = document.getElementById('billingForm');
const editBillingBtn = document.getElementById('edit-bill');
const addBillingBtn = document.getElementById('add-bill');
const saveBillingBtn = document.getElementById('saveBtn2');
const cancelBillingBtn = document.getElementById('cancelBtn2');

// Handle "Edit" for Shipping
editShippingBtn.addEventListener('click', () => {
    toggleVisibility(shippingBox, shippingForm.closest('.fieldset5'));
});

// Handle "Add New" for Shipping
addShippingBtn.addEventListener('click', () => {
    toggleVisibility(shippingBox, shippingForm.closest('.fieldset5'));
});

saveShippingBtn.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission

    if (!validate('shippingForm')) {
        return; // Stop further execution if validation fails
    }

    // Get values from the form
    const name = document.getElementById('ship-fn').value;
    const phoneNo = document.getElementById('ship-phoneNo').value;
    const email = document.getElementById('ship-Email').value;
    const street = document.getElementById('ship-street').value;
    const city = document.getElementById('ship-city').value;
    const postcode = document.getElementById('ship-postcode').value;
    const state = document.getElementById('ship-state').value;

    // Update the shipping information display
    shippingInfo.innerHTML = `
        <div class="name">${name}</div>
        <div class="phoneNo">${phoneNo}</div>
        <div class="email">${email}</div>
        <div class="shipping-address">${street}, ${city}, ${postcode}, ${state}.</div>
    `;

    toggleVisibility(shippingForm.closest('.fieldset5'), shippingBox);
});

// Handle "Cancel" for Shipping
cancelShippingBtn.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission
    toggleVisibility(shippingForm.closest('.fieldset5'), shippingBox);
});

// Handle "Edit" for Billing
editBillingBtn.addEventListener('click', () => {
    toggleVisibility(billingBox, billingForm.closest('.fieldset6'));
});

// Handle "Add New" for Billing
addBillingBtn.addEventListener('click', () => {
    toggleVisibility(billingBox, billingForm.closest('.fieldset6'));
});

saveBillingBtn.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission

    if (!validate('billingForm')) {
        return; // Stop further execution if validation fails
    }

    // Get values from the form
    const name = document.getElementById('bill-fn').value;
    const phoneNo = document.getElementById('bill-phoneNo').value;
    const email = document.getElementById('bill-Email').value;
    const street = document.getElementById('bill-street').value;
    const city = document.getElementById('bill-city').value;
    const postcode = document.getElementById('bill-postcode').value;
    const state = document.getElementById('bill-state').value;

    // Update the billing information display
    billingInfo.innerHTML = `
        <div class="name">${name}</div>
        <div class="phoneNo">${phoneNo}</div>
        <div class="email">${email}</div>
        <div class="billing-address">${street}, ${city}, ${postcode}, ${state}.</div>
    `;

    toggleVisibility(billingForm.closest('.fieldset6'), billingBox);
});

// Handle "Cancel" for Shipping
cancelBillingBtn.addEventListener('click', (e) => {
    e.preventDefault(); // Prevent form submission
    toggleVisibility(billingForm.closest('.fieldset6'), billingBox);
});

// Overlay button
const popUp = document.getElementById("overlay")
const overlayBtn = document.getElementById("deleteBtn");

overlayBtn.addEventListener("click", () => {
  popUp.classList.add("open-overlay");
});

// Close overlay
const xBtn = document.getElementById("cancelBtn");

xBtn.addEventListener("click", () => {
  popUp.classList.remove("open-overlay");
});

const overlayBtn2 = document.getElementById("deleteBtn2");

overlayBtn2.addEventListener("click", () => {
  popUp.classList.add("open-overlay");
});

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
