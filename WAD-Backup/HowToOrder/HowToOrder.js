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