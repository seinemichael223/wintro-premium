// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    let searchTimeout;

    // Function to perform the search
    function performSearch() {
        const searchQuery = searchInput.value.trim();
        
        // Create URL with search parameter
        const searchUrl = `customers_view.php${searchQuery ? '?search=' + encodeURIComponent(searchQuery) : ''}`;
        
        // Show loading state
        document.body.style.cursor = 'wait';
        
        // Fetch the search results
        fetch(searchUrl)
            .then(response => response.text())
            .then(html => {
                // Create a temporary div to hold the response
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                
                // Find the table in both current page and response
                const currentTable = document.querySelector('.table-responsive');
                const newTable = tempDiv.querySelector('.table-responsive');
                
                // Replace the current table with the new one
                if (currentTable && newTable) {
                    currentTable.innerHTML = newTable.innerHTML;
                }
                
                // Update the URL without refreshing the page
                window.history.pushState({}, '', searchUrl);
            })
            .catch(error => {
                console.error('Search error:', error);
                // Optionally show an error message to the user
                alert('An error occurred while searching. Please try again.');
            })
            .finally(() => {
                // Reset cursor
                document.body.style.cursor = 'default';
            });
    }

    // Handle search button click
    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        performSearch();
    });

    // Handle Enter key press
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });

    // Handle input changes (real-time search with debouncing)
    searchInput.addEventListener('input', function() {
        // Clear the previous timeout
        clearTimeout(searchTimeout);
        
        // Set a new timeout to perform the search after 500ms of no typing
        searchTimeout = setTimeout(performSearch, 500);
    });

    // Handle form submission
    const form = searchInput.closest('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            performSearch();
        });
    }

    // Handler for clear button
    const clearButton = document.querySelector('a[href="customers_view.php"]');
    if (clearButton) {
        clearButton.addEventListener('click', function(e) {
            e.preventDefault();
            searchInput.value = '';
            performSearch();
        });
    }
});