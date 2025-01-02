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

  var form = document.getElementById("myForm"),
    imgInput = document.querySelector(".img"),
    file = document.getElementById("imgInput"),
    userName = document.getElementById("name"),
    age = document.getElementById("age"),
    city = document.getElementById("city"),
    email = document.getElementById("email"),
    phone = document.getElementById("phone"),
    post = document.getElementById("post"),
    sDate = document.getElementById("sDate"),
    submitBtn = document.querySelector(".submit"),
    userInfo = document.getElementById("data"),
    modal = document.getElementById("userForm"),
    modalTitle = document.querySelector("#userForm .modal-title"),
    newUserBtn = document.querySelector(".newUser")


let getData = localStorage.getItem('userProfile') ? JSON.parse(localStorage.getItem('userProfile')) : []

let isEdit = false, editId
showInfo()

newUserBtn.addEventListener('click', ()=> {
    submitBtn.innerText = 'Submit',
    modalTitle.innerText = "Fill the Form"
    isEdit = false
    imgInput.src = "./image/Profile Icon.webp"
    form.reset()
})


file.onchange = function(){
    if(file.files[0].size < 1000000){  // 1MB = 1000000
        var fileReader = new FileReader();

        fileReader.onload = function(e){
            imgUrl = e.target.result
            imgInput.src = imgUrl
        }

        fileReader.readAsDataURL(file.files[0])
    }
    else{
        alert("This file is too large!")
    }
}


function showInfo(){
    document.querySelectorAll('.employeeDetails').forEach(info => info.remove())
    getData.forEach((element, index) => {
        let createElement = `<tr class="employeeDetails">
            <td>${index+1}</td>
            <td><img src="${element.picture}" alt="" width="50" height="50"></td>
            <td>${element.employeeName}</td>
            <td>${element.employeeAge}</td>
            <td>${element.employeeCity}</td>
            <td>${element.employeeEmail}</td>
            <td>${element.employeePhone}</td>
            <td>${element.employeePost}</td>
            <td>${element.startDate}</td>


            <td>
                <button class="btn btn-success" onclick="readInfo('${element.picture}', '${element.employeeName}', '${element.employeeAge}', '${element.employeeCity}', '${element.employeeEmail}', '${element.employeePhone}', '${element.employeePost}', '${element.startDate}')" data-bs-toggle="modal" data-bs-target="#readData"><i class="bi bi-eye"></i></button>

                <button class="btn btn-primary" onclick="editInfo(${index}, '${element.picture}', '${element.employeeName}', '${element.employeeAge}', '${element.employeeCity}', '${element.employeeEmail}', '${element.employeePhone}', '${element.employeePost}', '${element.startDate}')" data-bs-toggle="modal" data-bs-target="#userForm"><i class="bi bi-pencil-square"></i></button>

                <button class="btn btn-danger" onclick="deleteInfo(${index})"><i class="bi bi-trash"></i></button>
                            
            </td>
        </tr>`

        userInfo.innerHTML += createElement
    })
}
showInfo()


function readInfo(pic, name, age, city, email, phone, post, sDate){
    document.querySelector('.showImg').src = pic,
    document.querySelector('#showName').value = name,
    document.querySelector("#showAge").value = age,
    document.querySelector("#showCity").value = city,
    document.querySelector("#showEmail").value = email,
    document.querySelector("#showPhone").value = phone,
    document.querySelector("#showPost").value = post,
    document.querySelector("#showsDate").value = sDate
}


function editInfo(index, pic, name, Age, City, Email, Phone, Post, Sdate){
    isEdit = true
    editId = index
    imgInput.src = pic
    userName.value = name
    age.value = Age
    city.value =City
    email.value = Email,
    phone.value = Phone,
    post.value = Post,
    sDate.value = Sdate

    submitBtn.innerText = "Update"
    modalTitle.innerText = "Update The Form"
}


function deleteInfo(index){
    if(confirm("Are you sure want to delete?")){
        getData.splice(index, 1)
        localStorage.setItem("userProfile", JSON.stringify(getData))
        showInfo()
    }
}


form.addEventListener('submit', (e)=> {
    e.preventDefault()

    const information = {
        picture: imgInput.src == undefined ? "./image/Profile Icon.webp" : imgInput.src,
        employeeName: userName.value,
        employeeAge: age.value,
        employeeCity: city.value,
        employeeEmail: email.value,
        employeePhone: phone.value,
        employeePost: post.value,
        startDate: sDate.value
    }

    if(!isEdit){
        getData.push(information)
    }
    else{
        isEdit = false
        getData[editId] = information
    }

    localStorage.setItem('userProfile', JSON.stringify(getData))

    submitBtn.innerText = "Submit"
    modalTitle.innerHTML = "Fill The Form"

    showInfo()

    form.reset()

    imgInput.src = "./image/Profile Icon.webp"  

    // modal.style.display = "none"
    // document.querySelector(".modal-backdrop").remove()
})