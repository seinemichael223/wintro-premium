// Countdown 5 mins
const startingMinutes = 5;
let time = startingMinutes * 60;

const countdownEl = document.getElementById('timeLeft'); // Corrected ID
const countdownEl2 = document.getElementById('timeLeft1');

setInterval(updateCountdown, 1000);

function updateCountdown() {
    const minutes = Math.floor(time / 60);
    let seconds = time % 60;
    
    // Pad seconds with a leading zero if less than 10
    seconds = seconds < 10 ? '0' + seconds : seconds;
    countdownEl.innerHTML = `${minutes}:${seconds}`; 
    countdownEl2.innerHTML = `${minutes}:${seconds}`; 
    time--;

    // Optional: Stop the countdown when it reaches 0
    if (time < 0) {
        clearInterval(updateCountdown);
        countdownEl.innerHTML = "0:00";
        countdownEl2.innerHTML = "0:00";
    }
}

// Show current time
function displayDateTime() {
    const now = new Date();

    // Format the date and time
    const date = now.toLocaleDateString("en-GB"); // e.g., "25/12/2025" in DD/MM/YYYY format
    const time = now.toLocaleTimeString("en-US", { hour: '2-digit', minute: '2-digit', hour12: true }); // e.g., "12:00 PM"

    // Combine date and time
    const formattedDateTime = `${date} ${time}`;

    // Set the formatted date and time in the element
    document.getElementById("currentDateTime").textContent = formattedDateTime;
}

// Call the function when the page loads
displayDateTime();

// Auto add - or /, limit input length, restrict to digit
document.addEventListener("input", function(event) {

    const cardnoField = document.querySelector('input[name="cardNo"]');
    if (cardnoField && event.target === cardnoField) {
        let cardno = cardnoField.value.replace(/\D/g, ""); // Remove all non-digit characters
        if (cardno.length > 16) {
            cardno = cardno.substring(0, 16); // Limit to 16 digits
        }
        if (cardno.length > 4) cardno = cardno.replace(/(\d{4})(?=\d)/g, "$1-"); // Add dash every 4 digits
        cardnoField.value = cardno;
    }

    const expdateField = document.querySelector('input[name="expDate"]');
    if (expdateField && event.target === expdateField) {
        let expdate = expdateField.value.replace(/\D/g, ""); // Remove all non-digit characters
        if (expdate.length > 4) {
            expdate = expdate.substring(0, 4); // Limit to 4 digits
        }
        if (expdate.length > 2) expdate = expdate.replace(/(\d{2})(?=\d)/g, "$1/"); // Add slash after MM
        expdateField.value = expdate;
    }

    const cvvField = document.querySelector('input[name="cvv"]');
    if (cvvField && event.target === cvvField) {
        let cvv = cvvField.value.replace(/\D/g, ""); // Remove all non-digit characters
        if (cvv.length > 3) {
            cvv = cvv.substring(0, 3); // Limit to 3 digits
        }
        cvvField.value = cvv;
    }
});

// Validate form
// Validate empty field, cardNo, expdate and cvv format for both forms
function validateForm() {
    const form = document.getElementById('paymentForm'); // Dynamically select the form using the ID
    const inputs = form.querySelectorAll("input"); // Get all input fields in the selected form

    for (const input of inputs) {
        if (input.value.trim() === "") { // `trim()` removes whitespace and ensures input is clean
            alert(`Please fill in the empty field.`); // Notify user which field is empty
            input.focus(); // Focus on the first empty input field
            return false; // Prevent form submission
        }
    }

    const cardnoField = form.querySelector('input[name="cardNo"]');
    if (cardnoField) {
        const cardno = cardnoField.value.replace(/\-/g, ""); // Remove dash for validation
        const cardnoPattern = /^\d{16}$/; // 16-digit number with no spaces
        if (!cardnoPattern.test(cardno)) {
            alert("Please provide a 16-digit card number.");
            cardnoField.focus();
            return false;
        }
    }

    // Validate Expiration Date (MM/YY format)
    const expdateField = form.querySelector('input[name="expDate"]');
    if (expdateField) {
        const expdate = expdateField.value.replace(/\//g, ""); // Remove slash for validation
        const expdatePattern = /^(0[1-9]|1[0-2])\d{2}$/; // MMYY format without slash
        if (!expdatePattern.test(expdate)) {
            alert("Expiration date must be in MM/YY format.");
            expdateField.focus();
            return false;
        }
    }

    const cvvField = form.querySelector('input[name="cvv"]');
    
    if (cvvField) {
      const cvv = cvvField.value;
      const cvvPattern = /^\d{3}$/;
  
      if (!cvvPattern.test(cvv)) {
        alert("Please provide 3-digit CVV/CVC.");
        cvvField.focus();
        return false;
      }
    }

    // All inputs are valid
    return true;
}
