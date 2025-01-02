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
    newUserBtn = document.querySelector(".newUser");

let getData = localStorage.getItem('userProfile') ? JSON.parse(localStorage.getItem('userProfile')) : [];

// Preload 10 preset data if no data is available
if (getData.length === 0) {
    getData = [
        {
            picture: './image/Profile Icon.webp',
            employeeName: 'John Doe',
            employeeAge: 29,
            employeeCity: 'New York',
            employeeEmail: 'john@example.com',
            employeePhone: '01234567890',
            employeePost: 'Manager',
            startDate: '2020-05-12'
        },
        {
            picture: './image/Profile Icon.webp',
            employeeName: 'Jane Smith',
            employeeAge: 34,
            employeeCity: 'Los Angeles',
            employeeEmail: 'jane@example.com',
            employeePhone: '01234567891',
            employeePost: 'Developer',
            startDate: '2019-08-20'
        },
        // Add 8 more preset data here following the same structure
        // For brevity, just add 8 more entries following the same format
    ];
    localStorage.setItem('userProfile', JSON.stringify(getData));  // Save to localStorage
}

let isEdit = false, editId;
showInfo();

newUserBtn.addEventListener('click', () => {
    submitBtn.innerText = 'Submit',
    modalTitle.innerText = "Fill the Form"
    isEdit = false
    imgInput.src = "./image/Profile Icon.webp"
    form.reset()
});

file.onchange = function() {
    if (file.files[0].size < 1000000) {  // 1MB = 1000000
        var fileReader = new FileReader();

        fileReader.onload = function(e) {
            imgUrl = e.target.result;
            imgInput.src = imgUrl;
        }

        fileReader.readAsDataURL(file.files[0]);
    } else {
        alert("This file is too large!");
    }
};

function showInfo() {
    document.querySelectorAll('.employeeDetails').forEach(info => info.remove());
    getData.forEach((element, index) => {
        let createElement = `<tr class="employeeDetails">
            <td>${index + 1}</td>
            <td><img src="${element.picture}" alt="" width="50" height="50"></td>
            <td>${element.employeeName}</td>
            <td>${element.employeeAge}</td>
            <td>${element.employeeCity}</td>
            <td>${element.employeeEmail}</td>
            <td>${element.employeePhone}</td>
            <td>${element.employeePost}</td>
            <td>${element.startDate}</td>
            <td>
                <button class="btn btn-success" onclick="readInfo('${element.picture}', '${element.employeeName}', '${element.employeeAge}', '${element.employeeCity}', '${element.employeeEmail}', '${element.employeePhone}', '${element.employeePost}', '${element.startDate}')" data-bs-toggle="modal" data-bs-target="#readData">View</button>
                <button class="btn btn-warning" onclick="editInfo(${index}, '${element.picture}', '${element.employeeName}', '${element.employeeAge}', '${element.employeeCity}', '${element.employeeEmail}', '${element.employeePhone}', '${element.employeePost}', '${element.startDate}')" data-bs-toggle="modal" data-bs-target="#userForm">Edit</button>
                <button class="btn btn-danger" onclick="deleteInfo(${index})">Delete</button>
            </td>
        </tr>`;

        userInfo.insertAdjacentHTML("beforeend", createElement);
    });
}

function deleteInfo(id) {
    if (confirm('Are you sure you want to delete this record?')) {
        getData.splice(id, 1);
        localStorage.setItem('userProfile', JSON.stringify(getData));
        showInfo();
    }
}

function readInfo(picture, name, age, city, email, phone, post, startDate) {
    document.querySelector(".showImg").src = picture;
    document.getElementById("showName").value = name;
    document.getElementById("showAge").value = age;
    document.getElementById("showCity").value = city;
    document.getElementById("showEmail").value = email;
    document.getElementById("showPhone").value = phone;
    document.getElementById("showPost").value = post;
    document.getElementById("showsDate").value = startDate;
}

submitBtn.addEventListener('click', function() {
    let nameVal = userName.value,
        ageVal = age.value,
        cityVal = city.value,
        emailVal = email.value,
        phoneVal = phone.value,
        postVal = post.value,
        sDateVal = sDate.value;
    
    if (!nameVal || !ageVal || !cityVal || !emailVal || !phoneVal || !postVal || !sDateVal) {
        alert("Please fill all fields!");
        return;
    }

    const newUser = {
        picture: imgInput.src,
        employeeName: nameVal,
        employeeAge: ageVal,
        employeeCity: cityVal,
        employeeEmail: emailVal,
        employeePhone: phoneVal,
        employeePost: postVal,
        startDate: sDateVal
    }

    if (isEdit) {
        getData[editId] = newUser;
        submitBtn.innerText = 'Submit';
    } else {
        getData.push(newUser);
    }

    localStorage.setItem('userProfile', JSON.stringify(getData));
    showInfo();
    modal.classList.remove('show');
});
