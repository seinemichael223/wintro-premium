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

document.getElementById("profile-picture-input").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const profilePicture = document.getElementById("profile-picture");
            profilePicture.innerHTML = `<img src="${e.target.result}" alt="Profile Picture">`;
        };
        reader.readAsDataURL(file);
    }
});


// Info 
function editDetails() {
    // Hide the Edit and Change buttons
    document.getElementById("editButton").style.display = "none";
    document.getElementById("changeButton").style.display = "none";

    const fullName = document.getElementById("fullName").textContent;
    const birthday = document.getElementById("birthday").textContent;
    const gender = document.getElementById("gender").textContent;

    const formHtml = `
        <tr>
            <th class="label">Full Name</th>
            <td><input type="text" id="newFullName" value="${fullName}"></td>
        </tr>
        <tr>
            <th class="label">Birthday</th>
            <td><input type="date" id="newBirthday" value="${birthday}"></td>
        </tr>
        <tr>
            <th class="label">Gender</th>
            <td>
                <select id="newGender">
                    <option value="Male" ${gender === "Male" ? "selected" : ""}>Male</option>
                    <option value="Female" ${gender === "Female" ? "selected" : ""}>Female</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn save-btn" onclick="saveDetails()">Save</button>
                <button class="btn cancel-btn" onclick="cancelEdit()">Cancel</button>
            </td>
        </tr>
    `;

    document.getElementById("infoTable").innerHTML = formHtml;
}

function changePassword() {
    // Hide the Edit and Change buttons
    document.getElementById("editButton").style.display = "none";
    document.getElementById("changeButton").style.display = "none";

    const formHtml = `
        <tr>
            <th class="label">Password</th>
            <td><input type="password" id="newPassword" placeholder="Enter new password"></td>
        </tr>
        <tr>
            <th class="label">Show Password</th>
            <td><input type="checkbox" id="showPassword" onclick="togglePassword()"> Show</td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn save-btn" onclick="savePassword()">Save</button>
                <button class="btn cancel-btn" onclick="cancelEdit()">Cancel</button>
            </td>
        </tr>
    `;

    document.getElementById("infoTable").innerHTML = formHtml;
}

function togglePassword() {
    const passwordField = document.getElementById("newPassword");
    const showPasswordCheckbox = document.getElementById("showPassword");

    if (showPasswordCheckbox.checked) {
        // Change input type to text to show the password
        passwordField.type = "text";
    } else {
        // Change input type back to password to mask it
        passwordField.type = "password";
    }
}

function saveDetails() {
    const fullName = document.getElementById("newFullName").value;
    const birthday = document.getElementById("newBirthday").value;
    const gender = document.getElementById("newGender").value;

    const updatedHtml = `
        <tr>
            <th class="label">Full Name</th>
            <td class="value" id="fullName">${fullName}</td>
        </tr>
        <tr>
            <th class="label">Birthday</th>
            <td class="value" id="birthday">${birthday}</td>
        </tr>
        <tr>
            <th class="label">Gender</th>
            <td class="value" id="gender">${gender}</td>
        </tr>
        <tr>
            <th class="label">Email</th>
            <td class="value" id="email">useremail@example.com</td>
        </tr>
        <tr>
            <th class="label">Password</th>
            <td class="value" id="password">*****</td>
        </tr>
    `;

    document.getElementById("infoTable").innerHTML = updatedHtml;

    // Show the buttons again
    document.getElementById("editButton").style.display = "block";
    document.getElementById("changeButton").style.display = "block";
}

function savePassword() {
    const password = document.getElementById("newPassword").value;

    // Validate the password
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,8}$/;

    if (!passwordRegex.test(password)) {
        alert("Password must be between 6-8 characters, include an uppercase letter, a number, and a special character.");
        return;
    }

    const updatedHtml = `
        <tr>
            <th class="label">Full Name</th>
            <td class="value" id="fullName">Adam Wong</td>
        </tr>
        <tr>
            <th class="label">Birthday</th>
            <td class="value" id="birthday">2000-01-01</td>
        </tr>
        <tr>
            <th class="label">Gender</th>
            <td class="value" id="gender">Male</td>
        </tr>
        <tr>
            <th class="label">Email</th>
            <td class="value" id="email">useremail@example.com</td>
        </tr>
        <tr>
            <th class="label">Password</th>
            <td class="value" id="password">********</td> <!-- Password is masked here -->
        </tr>
    `;

    document.getElementById("infoTable").innerHTML = updatedHtml;

    // Show the buttons again
    document.getElementById("editButton").style.display = "block";
    document.getElementById("changeButton").style.display = "block";

    // Optionally store the password securely (not shown in UI)
    console.log("Saved password:", password); // Example: For debugging purposes
}

function cancelEdit() {
    location.reload(); // Reloads the page to restore the original content
}

function showSection(section) {
    // Hide all sections
    document.getElementById('info-section').classList.add('hidden');
    document.getElementById('address-section').classList.add('hidden');
    document.getElementById('orders-section').classList.add('hidden');

    // Show the selected section
    if (section === 'info') {
        document.getElementById('info-section').classList.remove('hidden');
    } else if (section === 'address') {
        document.getElementById('address-section').classList.remove('hidden');
    } else if (section === 'orders') {
        document.getElementById('orders-section').classList.remove('hidden');
    }
}

// Show the info section by default
window.onload = function() {
    showSection('info');
};

// Address Book
document.addEventListener("DOMContentLoaded", function () {
    let currentEditIndex = null;
    let currentBillEditIndex = null;

    // Utility function to check and show "No Address" message with Add New button
    function updateEmptyState(listSelector, emptyMessage, formSelector) {
        const list = document.querySelector(listSelector);
        if (list.children.length === 0) {
            list.innerHTML = `
                <div class="empty-message">
                    ${emptyMessage} 
                    <button class="add-new-btn">Add New</button>
                </div>
            `;
            list.querySelector(".add-new-btn").addEventListener("click", function () {
                document.querySelector(formSelector).classList.remove("hidden");
                document.querySelector(`${formSelector} form`).reset(); // Clear form for new input
                if (listSelector.includes("ship")) {
                    currentEditIndex = null; // Ensure we're not in edit mode
                } else if (listSelector.includes("bill")) {
                    currentBillEditIndex = null; // Ensure we're not in edit mode
                }
            });
        }
    }

    // Event delegation for Shipping Address actions
    document.querySelector(".ship-list").addEventListener("click", function (e) {
        if (e.target.closest(".address-edit")) {
            const row = e.target.closest(".row");
            const shipInfo = row.querySelector(".ship-info");
            document.querySelector(".fieldset5").classList.remove("hidden");

            // Pre-fill the form with existing data
            document.querySelector("#ship-fn").value = shipInfo.querySelector(".ship-name").textContent;
            document.querySelector("#ship-phoneNo").value = shipInfo.querySelector(".ship-phoneNo").textContent;
            document.querySelector("#ship-Email").value = shipInfo.querySelector(".ship-email").textContent;
            document.querySelector("#ship-street").value = shipInfo.querySelector(".ship-street").textContent;
            const street2 = shipInfo.querySelector(".ship-street2").textContent.split(", ");
            document.querySelector("#ship-city").value = street2[1].trim();
            document.querySelector("#ship-postcode").value = street2[0].trim();
            document.querySelector("#ship-state").value = street2[2].trim();

            currentEditIndex = row;
        }

        if (e.target.closest(".delete")) {
            const row = e.target.closest(".row");
            row.remove(); // Remove the specific address row
            updateEmptyState(".ship-list", "No Shipping Addresses. Click 'Add New' to create one.", ".fieldset5");
        }

        if (e.target.closest(".add")) {
            document.querySelector(".fieldset5").classList.remove("hidden");
            document.querySelector("#shippingForm").reset(); // Clear form for new input
            currentEditIndex = null;
        }
    });

    // Event delegation for Billing Address actions
    document.querySelector(".bill-list").addEventListener("click", function (e) {
        if (e.target.closest(".address-edit")) {
            const row = e.target.closest(".row");
            const billInfo = row.querySelector(".bill-info");
            document.querySelector(".fieldset6").classList.remove("hidden");

            // Pre-fill the form with existing data
            document.querySelector("#bill-fn").value = billInfo.querySelector(".bill-name").textContent;
            document.querySelector("#bill-phoneNo").value = billInfo.querySelector(".bill-phoneNo").textContent;
            document.querySelector("#bill-Email").value = billInfo.querySelector(".bill-email").textContent;
            document.querySelector("#bill-street").value = billInfo.querySelector(".bill-street").textContent;
            const street2 = billInfo.querySelector(".bill-street2").textContent.split(", ");
            document.querySelector("#bill-city").value = street2[1].trim();
            document.querySelector("#bill-postcode").value = street2[0].trim();
            document.querySelector("#bill-state").value = street2[2].trim();

            currentBillEditIndex = row;
        }

        if (e.target.closest(".delete")) {
            const row = e.target.closest(".row");
            row.remove(); // Remove the specific address row
            updateEmptyState(".bill-list", "No Billing Addresses. Click 'Add New' to create one.", ".fieldset6");
        }

        if (e.target.closest(".add")) {
            document.querySelector(".fieldset6").classList.remove("hidden");
            document.querySelector("#billingForm").reset(); // Clear form for new input
            currentBillEditIndex = null;
        }
    });

    // Save button for Shipping Address
    document.querySelector("#saveBtn1").addEventListener("click", function (e) {
        e.preventDefault();

        const name = document.querySelector("#ship-fn").value;
        const phoneNo = document.querySelector("#ship-phoneNo").value;
        const email = document.querySelector("#ship-Email").value;
        const street = document.querySelector("#ship-street").value;
        const city = document.querySelector("#ship-city").value;
        const postcode = document.querySelector("#ship-postcode").value;
        const state = document.querySelector("#ship-state").value;

        if (name && phoneNo && email && street && city && postcode && state) {
            const newAddress = `
                <div class="row">
                    <div class="ship-info">
                        <div class="ship-name">${name}</div>
                        <div class="ship-phoneNo">${phoneNo}</div>
                        <div class="ship-email">${email}</div>
                        <div class="ship-street">${street}</div>
                        <div class="ship-street2">${postcode}, ${city}, ${state}.</div>
                    </div>
                    <div class="actions">
                        <div class="address-edit"><p>EDIT</p></div>
                        <div class="pipe"><p>|</p></div>
                        <div class="delete"><p>DELETE</p></div>
                        <div class="pipe"><p>|</p></div>
                        <div class="add"><p>ADD NEW</p></div>
                    </div>
                </div>
            `;

            const list = document.querySelector(".ship-list");
            if (list.querySelector(".empty-message")) {
                list.innerHTML = "";
            }

            if (currentEditIndex) {
                currentEditIndex.outerHTML = newAddress;
                currentEditIndex = null;
            } else {
                list.insertAdjacentHTML("beforeend", newAddress);
            }

            document.querySelector(".fieldset5").classList.add("hidden");
            document.querySelector("#shippingForm").reset();
        } else {
            alert("Please fill in all required fields.");
        }
    });

    // Save button for Billing Address (similar to Shipping Address)
    document.querySelector("#saveBtn2").addEventListener("click", function (e) {
        e.preventDefault();

        const name = document.querySelector("#bill-fn").value;
        const phoneNo = document.querySelector("#bill-phoneNo").value;
        const email = document.querySelector("#bill-Email").value;
        const street = document.querySelector("#bill-street").value;
        const city = document.querySelector("#bill-city").value;
        const postcode = document.querySelector("#bill-postcode").value;
        const state = document.querySelector("#bill-state").value;

        if (name && phoneNo && email && street && city && postcode && state) {
            const newAddress = `
                <div class="row">
                    <div class="bill-info">
                        <div class="bill-name">${name}</div>
                        <div class="bill-phoneNo">${phoneNo}</div>
                        <div class="bill-email">${email}</div>
                        <div class="bill-street">${street}</div>
                        <div class="bill-street2">${postcode}, ${city}, ${state}.</div>
                    </div>
                    <div class="actions">
                        <div class="address-edit"><p>EDIT</p></div>
                        <div class="pipe"><p>|</p></div>
                        <div class="delete"><p>DELETE</p></div>
                        <div class="pipe"><p>|</p></div>
                        <div class="add"><p>ADD NEW</p></div>
                    </div>
                </div>
            `;

            const list = document.querySelector(".bill-list");
            if (list.querySelector(".empty-message")) {
                list.innerHTML = "";
            }

            if (currentBillEditIndex) {
                currentBillEditIndex.outerHTML = newAddress;
                currentBillEditIndex = null;
            } else {
                list.insertAdjacentHTML("beforeend", newAddress);
            }

            document.querySelector(".fieldset6").classList.add("hidden");
            document.querySelector("#billingForm").reset();
        } else {
            alert("Please fill in all required fields.");
        }
    });

    // Cancel buttons
    document.querySelector("#cancelBtn1").addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(".fieldset5").classList.add("hidden");
        currentEditIndex = null;
    });

    document.querySelector("#cancelBtn2").addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(".fieldset6").classList.add("hidden");
        currentBillEditIndex = null;
    });
});

//Disable receive button
function disableButton(button) {
    button.disabled = true;  // Disable the button
    button.style.backgroundColor = 'black';  // Change the button color to black
    button.style.color = 'white';  // Change text color to white to maintain visibility
    button.innerText = 'RECEIVED';  // Change the text inside the button
  }