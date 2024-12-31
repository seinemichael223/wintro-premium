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

// Function to handle the form submission and add the new address
function addAddress(formId, selectId) {
    const form = document.getElementById(formId);
    const select = document.getElementById(selectId);

    // Get the form data
    const fullName = form.querySelector(`#${formId} input[name*='fn']`).value;
    const phoneNo = form.querySelector(`#${formId} input[name*='phoneNo']`).value;
    const email = form.querySelector(`#${formId} input[name*='Email']`).value;
    const street = form.querySelector(`#${formId} input[name*='street']`).value;
    const city = form.querySelector(`#${formId} input[name*='city']`).value;
    const postcode = form.querySelector(`#${formId} input[name*='postcode']`).value;
    const state = form.querySelector(`#${formId} select[name*='state']`).value;

    // Validate that all required fields are filled
    if (!fullName || !phoneNo || !email || !street || !city || !postcode || !state) {
        return false;
    }

    // Create a new option element
    const option = document.createElement("option");
    option.value = `${street}, ${city}, ${postcode}, ${state}`;
    option.textContent = `${fullName} - ${street}, ${city}, ${postcode}, ${state}`;
    select.appendChild(option);

    // Clear the form fields after adding the address
    form.reset();

    // Hide the form
    form.closest('fieldset').classList.add('hidden');

    return false; // Prevent actual form submission
}

// Attach event listeners to the Save buttons
document.getElementById("saveBtn1").addEventListener("click", function (event) {
    event.preventDefault();
    addAddress("shippingForm", "ship-address-select");
});

document.getElementById("saveBtn2").addEventListener("click", function (event) {
    event.preventDefault();
    addAddress("billingForm", "bill-address-select");
});

// Show/hide the form when "Add New" is clicked
document.getElementById("add-ship").addEventListener("click", function () {
    document.querySelector(".fieldset5").classList.remove("hidden");
});

document.getElementById("add-bill").addEventListener("click", function () {
    document.querySelector(".fieldset6").classList.remove("hidden");
});

// Cancel button to hide the form
document.getElementById("cancelBtn1").addEventListener("click", function (event) {
    event.preventDefault();
    document.querySelector(".fieldset5").classList.add("hidden");
});

document.getElementById("cancelBtn2").addEventListener("click", function (event) {
    event.preventDefault();
    document.querySelector(".fieldset6").classList.add("hidden");
});

// Function to populate the form with the selected address details for editing
function editAddress(selectId, formId) {
    const select = document.getElementById(selectId);
    const form = document.getElementById(formId);

    // Get the selected address option
    const selectedOption = select.options[select.selectedIndex];
    if (!selectedOption || selectedOption.value === "") {
        alert("Please select an address to edit.");
        return;
    }

    // Extract details from the selected option's value
    const [street, city, postcode, state] = selectedOption.value.split(", ");
    const [fullName] = selectedOption.textContent.split(" - ");

    // Populate the form fields
    form.querySelector(`#${formId} input[name*='fn']`).value = fullName;
    form.querySelector(`#${formId} input[name*='street']`).value = street;
    form.querySelector(`#${formId} input[name*='city']`).value = city;
    form.querySelector(`#${formId} input[name*='postcode']`).value = postcode;
    form.querySelector(`#${formId} select[name*='state']`).value = state;

    // Show the form
    form.closest('fieldset').classList.remove('hidden');
}

// Function to save the edited address
function saveEditedAddress(selectId, formId) {
    const select = document.getElementById(selectId);
    const form = document.getElementById(formId);

    // Get updated form data
    const fullName = form.querySelector(`#${formId} input[name*='fn']`).value;
    const phoneNo = form.querySelector(`#${formId} input[name*='phoneNo']`).value;
    const email = form.querySelector(`#${formId} input[name*='Email']`).value;
    const street = form.querySelector(`#${formId} input[name*='street']`).value;
    const city = form.querySelector(`#${formId} input[name*='city']`).value;
    const postcode = form.querySelector(`#${formId} input[name*='postcode']`).value;
    const state = form.querySelector(`#${formId} select[name*='state']`).value;

    // Validate required fields
    if (!fullName || !street || !city || !postcode || !state) {
        return false;
    }

    // Update the selected option
    const selectedOption = select.options[select.selectedIndex];
    selectedOption.value = `${street}, ${city}, ${postcode}, ${state}`;
    selectedOption.textContent = `${fullName} - ${street}, ${city}, ${postcode}, ${state}`;

    // Clear and hide the form
    form.reset();
    form.closest('fieldset').classList.add('hidden');

    return false;
}

// Attach event listeners to the Edit buttons
document.getElementById("edit-ship").addEventListener("click", function () {
    editAddress("ship-address-select", "shippingForm");
});

document.getElementById("edit-bill").addEventListener("click", function () {
    editAddress("bill-address-select", "billingForm");
});

// Attach event listeners to Save buttons to handle edited address saving
document.getElementById("saveBtn1").addEventListener("click", function (event) {
    event.preventDefault();
    saveEditedAddress("ship-address-select", "shippingForm");
});

document.getElementById("saveBtn2").addEventListener("click", function (event) {
    event.preventDefault();
    saveEditedAddress("bill-address-select", "billingForm");
});

// Cancel buttons to hide the form without changes
document.getElementById("cancelBtn1").addEventListener("click", function (event) {
    event.preventDefault();
    document.querySelector(".fieldset5").classList.add("hidden");
});

document.getElementById("cancelBtn2").addEventListener("click", function (event) {
    event.preventDefault();
    document.querySelector(".fieldset6").classList.add("hidden");
});

// Get modal elements
const deleteModal = document.getElementById('deleteModal');
const confirmDeleteBtn = document.getElementById('confirmDelete');
const cancelDeleteBtn = document.getElementById('cancelDelete');

// Variable to track which dropdown is being handled
let currentSelect = null;

// Show modal on shipping delete button click
document.getElementById('deleteBtn').addEventListener('click', () => {
    currentSelect = document.getElementById('ship-address-select'); // Set the current dropdown
    deleteModal.classList.remove('hidden');
});

// Show modal on billing delete button click
document.getElementById('deleteBtn2').addEventListener('click', () => {
    currentSelect = document.getElementById('bill-address-select'); // Set the current dropdown
    deleteModal.classList.remove('hidden');
});

// Hide modal when "No" is clicked
cancelDeleteBtn.addEventListener('click', () => {
    deleteModal.classList.add('hidden');
});

// Perform deletion when "Yes" is clicked
confirmDeleteBtn.addEventListener('click', () => {
    if (currentSelect) {
        const selectedOption = currentSelect.options[currentSelect.selectedIndex];

        if (selectedOption && selectedOption.value) {
            currentSelect.remove(currentSelect.selectedIndex); // Remove the selected address
        } else {
            alert('Please select an address to delete.');
        }
    }

    deleteModal.classList.add('hidden'); // Hide modal after action
});

