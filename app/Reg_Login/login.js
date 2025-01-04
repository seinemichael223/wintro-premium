// For buttons (movement)
const container = document.getElementById("container");
const registerbtn = document.getElementById("register");
const loginbtn = document.getElementById("login");

registerbtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginbtn.addEventListener("click", () => {
  container.classList.remove("active");
});

// Overlay button
const popUp = document.getElementById("overlay")
const overlayBtn = document.getElementById("signupBtn");

overlayBtn.addEventListener("click", () => {
  popUp.classList.add("open-overlay");
});

// Close overlay
const xBtn = document.getElementById("close");

xBtn.addEventListener("click", () => {
  popUp.classList.remove("open-overlay");
});

// Show and hide password
// For the first icon (sign-up-pwd) (Form 1)
const passwordInput1 = document.getElementById("signup-pwd");
const togglePassword1 = document.getElementById("show-signup-pwd");

togglePassword1.addEventListener("click", () => {
    const currentType = passwordInput1.getAttribute("type");
    passwordInput1.setAttribute(
        "type",
        currentType === "password" ? "text" : "password"
    );
    togglePassword1.classList.toggle("fa-eye");
    togglePassword1.classList.toggle("fa-eye-slash");
});

// For the second icon (sign-in-pwd) (Form 2)
const passwordInput2 = document.getElementById("signin-pwd");
const togglePassword2 = document.getElementById("show-signin-pwd");

togglePassword2.addEventListener("click", () => {
    const currentType = passwordInput2.getAttribute("type");
    passwordInput2.setAttribute(
        "type",
        currentType === "password" ? "text" : "password"
    );
    togglePassword2.classList.toggle("fa-eye");
    togglePassword2.classList.toggle("fa-eye-slash");
});


// // Validate empty field, email and password format for both forms
// function validate(formId) {
//   const form = document.getElementById(formId); // Dynamically select the form using the ID
//   const inputs = form.querySelectorAll("input"); // Get all input fields in the selected form

//   for (const input of inputs) {
//     if (input.value.trim() === "") { //trim() to remove space ensure input clean
//       alert(`Please fill in the ${input.name} field in the ${formId === 'signinForm' ? 'Sign In' : 'Sign Up'} form.`);
//       input.focus(); // Stay at current page
//       return false;
//     }
//   }

//     const emailField = form.querySelector('input[name="Email"]'); // select email input
    
//     if (emailField) {
//       const email = emailField.value;
//       const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // RegEx for email format
  
//       if (!emailPattern.test(email)) {
//         alert("Please provide a valid email address.");
//         emailField.focus();
//         return false;
//       }
//     }

//     const pwdField = form.querySelector('input[name="Password"]'); // select password input

//     if (pwdField) {
//       const password = pwdField.value;
//       const pwdPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,8}$/; //RegEx for pwd format

//       if (!pwdPattern.test(password)) {
//         alert("Invalid password. ");
//         pwdField.focus();
//         return false;
//       }
//     }

//   return true; // Form is valid
// }
