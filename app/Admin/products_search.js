document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const productsTableBody = document.getElementById('productsTableBody');
    let searchTimeout; // For debouncing

    // Real-time search with debouncing
    searchInput.addEventListener('input', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 500); // Wait 500ms after user stops typing
    });

    // Search button click handler
    searchButton.addEventListener('click', (e) => {
        e.preventDefault();
        performSearch();
    });

    // Enter key handler
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            performSearch();
        }
    });

    function performSearch() {
        const searchText = searchInput.value.trim();
        const url = `products_search.php?ajax=true&search=${encodeURIComponent(searchText)}`;
        
        // Show loading state
        document.body.style.cursor = 'wait';
        if (productsTableBody) {
            productsTableBody.style.opacity = '0.6';
        }

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(products => {
                if (productsTableBody) {
                    updateTable(products);
                    // Update URL without page reload
                    window.history.pushState({}, '', `products_view.php${searchText ? '?search=' + encodeURIComponent(searchText) : ''}`);
                } else {
                    console.error('Table body element not found');
                }
            })
            .catch(error => {
                console.error('Error during search:', error);
                // Optionally show error to user
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger mt-3';
                errorDiv.textContent = 'An error occurred while searching. Please try again.';
                productsTableBody.parentElement.insertBefore(errorDiv, productsTableBody);
                setTimeout(() => errorDiv.remove(), 5000); // Remove error after 5 seconds
            })
            .finally(() => {
                // Reset loading state
                document.body.style.cursor = 'default';
                if (productsTableBody) {
                    productsTableBody.style.opacity = '1';
                }
            });
    }

    function updateTable(products) {
        productsTableBody.innerHTML = products.map(product => `
            <tr>
                <td>${escapeHtml(product.product_id)}</td>
                <td>${escapeHtml(product.product_name)}</td>
                <td>${getImageHtml(product.product_image)}</td>
                <td>${escapeHtml(product.category_name)}</td>
                <td>${escapeHtml(product.sub_category_name)}</td>
                <td class="product-description">${formatDescription(product.product_description)}</td>
                <td>${getOptionsHtml(product.options)}</td>
                <td>${formatPrice(product.product_unit_price)}</td>
                <td>${formatPrice(product.product_bulk_price)}</td>
                <td>${formatNumber(product.total_stock)}</td>
                <td>${getActionButtons(product.product_id, product.product_name)}</td>
            </tr>
        `).join('');

        // Reinitialize Bootstrap modals after table update
        const deleteModals = document.querySelectorAll('.delete-modal');
        deleteModals.forEach(modal => {
            new bootstrap.Modal(modal);
        });

        // Show "no results" message if needed
        if (products.length === 0) {
            productsTableBody.innerHTML = `
                <tr>
                    <td colspan="11" class="text-center">No products found matching your search.</td>
                </tr>
            `;
        }
    }

    function getOptionsHtml(options) {
        if (!options || options.length === 0) {
            return '<p>No options available</p>';
        }

        return `
            <table class="table table-sm table-borderless mb-0 product-options-table">
                <thead>
                    <tr>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    ${options.map(option => `
                        <tr>
                            <td>${escapeHtml(option.option_colour || 'N/A')}</td>
                            <td>${escapeHtml(option.option_size)}</td>
                            <td>${formatNumber(option.stock_quantity)}</td>
                        </tr>
                    `).join('')}
                </tbody>
            </table>
        `;
    }

    function escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    function formatDescription(description) {
        if (!description) return '';
        return description
            .replace(/â€™/g, "'")
            .replace(/â€³/g, '"')
            .replace(/â€"/g, '-')
            .replace(/\n/g, '<br>');
    }

    function formatPrice(price) {
        return Number(price).toFixed(2);
    }

    function formatNumber(num) {
        return Number(num).toLocaleString();
    }

    function getImageHtml(imagePath) {
        if (!imagePath) return '<p>No image available</p>';
        const cleanPath = imagePath.replace('uploads/', '');
        const baseDir = '../Product/Awards&Trophies/uploads/';
        return `<img src="${baseDir}${escapeHtml(cleanPath)}" alt="Product Image" width="100">`;
    }

    function getActionButtons(productId, productName) {
        return `
            <div class="action-buttons">
                <a href="products_edit.php?id=${productId}" class="btn btn-warning btn-sm">Edit</a>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal${productId}">Delete</button>
                ${getDeleteModal(productId, productName)}
            </div>
        `;
    }

    function getDeleteModal(productId, productName) {
        return `
            <div class="modal fade delete-modal" id="deleteModal${productId}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this product?</p>
                            <p><strong>Product:</strong> ${escapeHtml(productName)}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form method="POST" action="products_delete.php">
                                <input type="hidden" name="product_id" value="${productId}">
                                <input type="hidden" name="confirm_delete" value="1">
                                <button type="submit" class="btn btn-danger">Yes, Delete Product</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
});