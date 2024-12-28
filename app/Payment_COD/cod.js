const startingMinutes = 5;
let time = startingMinutes * 60;

const countdownEl = document.getElementById('timeLeft'); // Corrected ID

setInterval(updateCountdown, 1000);

function updateCountdown() {
    const minutes = Math.floor(time / 60);
    let seconds = time % 60;
    
    // Pad seconds with a leading zero if less than 10
    seconds = seconds < 10 ? '0' + seconds : seconds;
    countdownEl.innerHTML = `${minutes}:${seconds}`; 
    time--;

    // Optional: Stop the countdown when it reaches 0
    if (time < 0) {
        clearInterval(updateCountdown);
        countdownEl.innerHTML = "0:00";
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