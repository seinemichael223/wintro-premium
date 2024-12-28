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

document.addEventListener("DOMContentLoaded", () => {
    const dropdownButtons = document.querySelectorAll(".dropdown-btn");

    dropdownButtons.forEach(button => {
        button.addEventListener("click", event => {
            event.preventDefault();

            // Find the dropdown content
            const dropdown = button.nextElementSibling;

            // Toggle active state and dropdown visibility
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
                button.classList.remove("active");
            } else {
                dropdown.style.display = "block";
                button.classList.add("active");
            }
        });
    });
});