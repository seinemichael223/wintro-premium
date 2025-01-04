function toggleDropdown() {
    var item = document.querySelector('.item-custom');
    item.classList.toggle('open');  // Toggle the 'open' class on the container
}

let itemCount = 1; // Initial count for items

    function toggleDropdown(item) {
        const parent = item.parentElement;
        parent.classList.toggle('open');  // Toggle the 'open' class to show/hide the form
    }

    function addItem() {
        itemCount++; // Increment the item count
        const newItem = document.createElement('div');
        newItem.classList.add('item-custom');

        newItem.innerHTML = `
            <div class="item-title" onclick="toggleDropdown(this)">Item ${itemCount} <i class="fa-solid fa-angle-down"></i></div>
            <div class="form-container">
                <form>
                    <input type="text">
                    <label>32 characters remaining</label>
                    <input type="text">
                    <label>32 characters remaining</label>
                    <input type="text">
                    <label>32 characters remaining</label>
                </form>
            </div>
        `;

        // Append the new item to the container
        document.getElementById('items-container').appendChild(newItem);
    }

 //File Handler   
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('fileUploadForm');
        const noArtworkRadio = document.getElementById('no-artwork');
        const uploadArtworkRadio = document.getElementById('upload-artwork');
        const fileDropArea = document.getElementById('fileDropArea');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');
        const fileHelpText = document.getElementById('fileHelpText');
        

        // Toggle file upload area based on radio selection
        noArtworkRadio.addEventListener('change', function () {
            fileDropArea.style.display = 'none';
            fileHelpText.style.display = 'none';
            fileList.innerHTML = ''; // Clear any selected files
        });

        uploadArtworkRadio.addEventListener('change', function () {
            fileDropArea.style.display = 'block';
            fileHelpText.style.display = 'block';
        });
        // Make the entire drop area clickable
        fileDropArea.addEventListener('click', function () {
            fileInput.click(); // Simulates a click on the hidden file input
        });
    
        // Handle file selection via the file picker
        fileInput.addEventListener('change', function () {
            updateFileList(fileInput.files);
        });
    
        // Drag-and-drop functionality
        fileDropArea.addEventListener('dragover', function (e) {
            e.preventDefault();
            fileDropArea.classList.add('drag-over'); // Visual feedback
        });
    
        fileDropArea.addEventListener('dragleave', function () {
            fileDropArea.classList.remove('drag-over'); // Remove visual feedback
        });
    
        fileDropArea.addEventListener('drop', function (e) {
            e.preventDefault();
            fileDropArea.classList.remove('drag-over');
            const files = e.dataTransfer.files;
            fileInput.files = files; // Assign dropped files to the input
            updateFileList(files); // Update the file list
        });
    
        // Function to update the file list
        function updateFileList(files) {
            fileList.innerHTML = ''; // Clear the file list
            Array.from(files).forEach((file) => {
                if (file.size > 2 * 1024 * 1024) {
                    alert(`File "${file.name}" exceeds the 2MB size limit.`);
                    return;
                }
                if (!['image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
                    alert(`File "${file.name}" is not a valid image format.`);
                    return;
                }
    
                const listItem = document.createElement('li');
                listItem.textContent = file.name;
                fileList.appendChild(listItem);
            });
        }
        // Handle form submission (uploading the file)
        
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
        
            const formData = new FormData(form);
            const isFileUpload = formData.has('files') && formData.get('files').size > 0;
        
            if (isFileUpload) {
                // Handle file upload
                fetch('productDetail.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Upload successful:', data);
                    if (data.status === 'success') {
                        alert('File uploaded successfully!');
                    } else {
                        alert('Upload error: ' + data.messages.join('\n'));
                    }
                })
                .catch(error => {
                    console.error('Error during upload:', error);
                    alert('Error uploading file! ' + error.message);
                });
            } else {
                // Regular form submission without file
                form.submit(); // Allow normal form submission
            }
        });
    });
    
    


document.addEventListener('DOMContentLoaded', function() {
    // Function to get current stock
    function getCurrentStock() {
        const stockText = document.querySelector('.stock').textContent;
        console.log('Stock text:', stockText); // Add this line
        const stockMatch = stockText.match(/\d+/);
        console.log('Stock match:', stockMatch); // Add this line
        return stockMatch ? parseInt(stockMatch[0]) : 0;
    }
    function showStockWarning(message) {
        const warningElement = document.getElementById('stock-warning');
        warningElement.textContent = message;
    
        setTimeout(() => {
            warningElement.textContent = ''; // Clear message after 3 seconds
        }, 3000);
    }
    

    // Function to decrease the quantity
    window.decreaseValue = function() {
        var quantityField = document.getElementById('counterValue');
        var quantity = parseInt(quantityField.value);
        if (quantity > 1) {
            quantityField.value = quantity - 1;
        }
    }

    // Function to increase the quantity
    window.increaseValue = function() {
        var quantityField = document.getElementById('counterValue');
        var quantity = parseInt(quantityField.value);
        const currentStock = getCurrentStock();
        
        if (quantity < currentStock) {
            quantityField.value = quantity + 1;
        } else {
            showStockWarning(`Maximum stock available: ${currentStock}`);
        }
    }

    // Function to validate manual input
    function validateQuantity(input) {
        input.value = input.value.replace(/[^0-9]/g, '');
        let value = parseInt(input.value) || 1;
        const currentStock = getCurrentStock();
        
        if (value < 1) {
            value = 1;
        }
        if (value > currentStock) {
            value = currentStock;
            showStockWarning(`Quantity adjusted to maximum stock: ${currentStock}`);
        }
        
        input.value = value;
    }

    // Add event listener for the input field
    document.getElementById('counterValue').addEventListener('input', function() {
        validateQuantity(this);
    });
});
    
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