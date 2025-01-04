  document.getElementById("create-product-btn").addEventListener("click", function() {
    var productName = document.getElementById("product-name").value.trim();
    var price = document.getElementById("price").value.trim();
    var category = document.getElementById("category").value;
    var newCategory = document.getElementById("new-category").value.trim();

    // Check if product name, price, and category are valid
    if (!productName || !price || (!category && !newCategory)) {
      alert("Please fill in all the fields and select or add a category.");
      return;
    }

    // If user added a new category, validate and add it to the dropdown
    if (newCategory) {
      var select = document.getElementById("category");

      // Format the new category value (lowercase with hyphens)
      var newCategoryValue = newCategory.toLowerCase().replace(/\s+/g, '-');

      // Check if the new category already exists
      var existingOptions = Array.from(select.options);
      if (existingOptions.some(option => option.value === newCategoryValue)) {
        alert("This category already exists.");
        return;
      }

      // Add the new category to the dropdown
      var newOption = document.createElement("option");
      newOption.value = newCategoryValue;
      newOption.textContent = newCategory;
      select.appendChild(newOption);

      // Optionally, reset the new category input field
      document.getElementById("new-category").value = '';
      alert("New category added!");
    }

    // Simulate creating the product
    alert("The new product(s) created successfully!");

    // Optionally, reset the product fields after creating the product
    document.getElementById("product-name").value = '';
    document.getElementById("price").value = '';
    document.getElementById("category").value = '';
  });


// JavaScript function to display order details in an alert
function showOrderDetails(orderId, customerId, totalAmount, orderDate, status) {
  alert(`Order Information:\n\n` +
      `Order ID: ${orderId}\n` +
      `Customer ID: ${customerId}\n` +
      `Total Amount: RM${totalAmount}\n` +
      `Order Date: ${orderDate}\n` +
      `Status: ${status}`);
}

  // JavaScript function to display customer details in an alert
  function showCustomerDetails(id, name, email, totalSpend, lastOrderDate) {
      alert(`Customer Information:\n\n` +
          `Customer ID: ${id}\n` +
          `Name: ${name}\n` +
          `Email: ${email}\n` +
          `Total Spend: RM${totalSpend}\n` +
          `Last Order Date: ${lastOrderDate}`);
  }

  // Script for Admin Profile Info 
  function editDetails() {
      // Hide the Edit button
      document.getElementById("editButton").style.display = "none";

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
      <th class="label">Password</th>
      <td><input type="password" id="newPassword" placeholder="Enter new password"></td>
  </tr>
  <tr>
      <th class="label">Show Password</th>
      <td><input type="checkbox" id="showPassword" onclick="togglePassword()"> Show</td>
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

  function saveDetails() {
      const fullName = document.getElementById("newFullName").value;
      const birthday = document.getElementById("newBirthday").value;
      const gender = document.getElementById("newGender").value;
      const password = document.getElementById("newPassword").value;

      // Validate the password
      if (password) {
          const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,8}$/;
          if (!passwordRegex.test(password)) {
              alert("Password must be between 6-8 characters, include an uppercase letter, a number, and a special character.");
              return;
          }
      }

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
      <td class="value" id="password">********</td> <!-- Password is masked here -->
  </tr>
  `;

      document.getElementById("infoTable").innerHTML = updatedHtml;

      // Show the Edit button again
      document.getElementById("editButton").style.display = "block";

      // Optionally store the updated password securely (not shown in UI)
      if (password) {
          console.log("Updated password:", password); // For debugging purposes
      }
  }

  function togglePassword() {
      const passwordField = document.getElementById("newPassword");
      const showPasswordCheckbox = document.getElementById("showPassword");

      passwordField.type = showPasswordCheckbox.checked ? "text" : "password";
  }

  function cancelEdit() {
      location.reload(); // Reloads the page to restore the original content
  }

  //Disable receive button
  function disableButton(button) {
      button.disabled = true; // Disable the button
      button.style.backgroundColor = 'black'; // Change the button color to black
      button.style.color = 'white'; // Change text color to white to maintain visibility
      button.innerText = 'RECEIVED'; // Change the text inside the button
  }
