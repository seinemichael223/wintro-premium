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

// Validate empty field, email and password format for form
function validate() {
    const fullNameField = document.querySelector('input[name="fn"]'); // Get all input fields in the selected form
    
    if (fullNameField) {
      if (fullNameField.value.trim() === "") { //trim() to remove space ensure input clean
        alert(`Please fill in the Full Name field.`);
        input.focus(); // Stay at current page
        return false;
      }
    }
  
      const emailField = document.querySelector('input[name="Email"]'); // select email input
      
      if (emailField) {
        if (emailField.value.trim() === "") { //trim() to remove space ensure input clean
          alert(`Please fill in the Email field.`);
          input.focus(); // Stay at current page
          return false;
        }
      }

      if (emailField) {
        const email = emailField.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // RegEx for email format
    
        if (!emailPattern.test(email)) {
          alert("Please provide a valid email address.");
          emailField.focus();
          return false;
        }
      }

      const telField = document.querySelector('input[name="phoneNo"]'); // select phoneNo input
      
      if (telField) {
        if (telField.value.trim() === "") { //trim() to remove space ensure input clean
          alert(`Please fill in the Phone Number field.`);
          input.focus(); // Stay at current page
          return false;
        }
      }

      if (telField) {
        const tel = telField.value;
        const telPattern = /^0\d{2}-\d{3}-\d{4}$/; // RegEx for phoneNo format
    
        if (!telPattern.test(tel)) {
          alert("Please provide a valid phone number.");
          telField.focus();
          return false;
        }
      }

        return true;
    }