
let isEditing = false;
const originalStatuses = [];

function enterEditMode() {
    if (isEditing) return;

    const statusCells = document.querySelectorAll(".status");
    originalStatuses.length = 0; // Clear previous data

    statusCells.forEach(cell => {
        // Save original status
        const originalStatus = cell.textContent.trim();
        originalStatuses.push(originalStatus);

        // Replace status text with dropdown
        const dropdown = document.createElement("select");
        dropdown.innerHTML = `
            <option value="Delivered" ${originalStatus === "Delivered" ? "selected" : ""}>Delivered</option>
            <option value="Cancelled" ${originalStatus === "Cancelled" ? "selected" : ""}>Cancelled</option>
            <option value="Pending" ${originalStatus === "Pending" ? "selected" : ""}>Pending</option>
            <option value="Shipped" ${originalStatus === "Shipped" ? "selected" : ""}>Shipped</option>
            `;
        cell.textContent = "";
        cell.appendChild(dropdown);
    });

    // Update button states
    document.getElementById("edit-button").classList.add("hidden");
    document.getElementById("save-button").classList.remove("hidden");
    document.getElementById("cancel-button").classList.remove("hidden");

    isEditing = true;
}

function saveChanges() {

    if (!isEditing) return;

    const statusCells = document.querySelectorAll(".status");

    statusCells.forEach(cell => {
        const dropdown = cell.querySelector("select");
        if (dropdown) {
            const selectedStatus = dropdown.value;
            cell.textContent = selectedStatus; // Replace dropdown with selected status
        }

    });

    isEditing = false;

    alert("Changes saved!");
    resetButtons();
}

function cancelChanges() {
    if (!isEditing) return;

    const statusCells = document.querySelectorAll(".status");

    statusCells.forEach((cell, index) => {
        const dropdown = cell.querySelector("select");
        if (dropdown) {
            cell.textContent = originalStatuses[index]; // Restore original status
        }
    });

    isEditing = false;

    alert("Changes cancelled!");
    resetButtons();
}

function resetButtons() {
    document.getElementById("edit-button").classList.remove("hidden");
    document.getElementById("save-button").classList.add("hidden");
    document.getElementById("cancel-button").classList.add("hidden");
}