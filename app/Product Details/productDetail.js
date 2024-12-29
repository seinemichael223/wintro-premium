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

    const fileDropArea = document.getElementById('fileDropArea');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    // Handle drag over event
    fileDropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        fileDropArea.classList.add('drag-over');
    });

    // Handle drag leave event
    fileDropArea.addEventListener('dragleave', () => {
        fileDropArea.classList.remove('drag-over');
    });

    // Handle drop event
    fileDropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        fileDropArea.classList.remove('drag-over');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    // Handle file selection from input
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        handleFiles(files);
    });

    // Handle the files by displaying them in the list
    function handleFiles(files) {
        const fileListArray = Array.from(files);
        fileListArray.forEach(file => {
            const li = document.createElement('li');
            const link = document.createElement('a');

            // Set the file name as the link text
            link.textContent = file.name;

            // Create a downloadable link for the file
            link.href = URL.createObjectURL(file);
            link.download = file.name;

            li.appendChild(link);
            fileList.appendChild(li);
        });
    }

    function increaseValue() {
        const input = document.getElementById('counterValue');
        input.value = parseInt(input.value) + 1;
    }
    
    function decreaseValue() {
        const input = document.getElementById('counterValue');
        const currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }

    function updateMainImage(thumbnail) {
        const mainImage = document.getElementById("mainImage");
        mainImage.src = thumbnail.src;
        mainImage.alt = thumbnail.alt;
    }
    
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