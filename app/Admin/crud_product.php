<?php include 'data.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Bootstrap 5 icons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>try CRUD Operations</title>
    <link rel="stylesheet" type="text/css" href="table.css">

    <link rel="stylesheet" href="crudstyle.css">
    <?php include 'header.php'; ?>


</head>

<body>

    <section class="p-3">

        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary newUser" data-bs-toggle="modal" data-bs-target="#userForm">New User <i class="bi bi-people"></i></button>
            </div>
        </div>

        <div class="row">

            <div class="col-12">
                <section class="table__header">
                    <div class="input-group">
                        <input type="search" placeholder="Search">
                    </div>
                </section>
                <table class="table" id="products_table">

                    <thead>
                        <tr>
                            <th>Category ID<span class="icon-arrow">&UpArrow;</span></th>
                            <th>Category<span class="icon-arrow">&UpArrow;</span></th>
                            <th>Product ID <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Product Name<span class="icon-arrow">&UpArrow;</span></th>
                            <th>Unit Price (RM) <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Bulk Price (RM) <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Stock Level <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php
                    // Fetch data from the products table in the database
                    $sql = "SELECT * FROM products"; // Adjust the query if needed
                    $result = $con->query($sql);

                    // Check if there are rows to fetch
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            $categoryId = htmlspecialchars($row['category_id']);
                            $category = htmlspecialchars($row['category']);
                            $productId = htmlspecialchars($row['product_id']);
                            $productName = htmlspecialchars($row['product_name']);
                            $unitPrice = htmlspecialchars($row['unit_price']);
                            $bulkPrice = htmlspecialchars($row['bulk_price']);
                            $stockLevel = htmlspecialchars($row['stock_level']);
                            echo "<tr>";
                            echo "<td>{$categoryId}</td>";
                            echo "<td>{$category}</td>";
                            echo "<td>{$productId}</td>";
                            echo "<td>{$productName}</td>";
                            echo "<td>{$unitPrice}</td>";
                            echo "<td>{$bulkPrice}</td>";
                            echo "<td>{$stockLevel}</td>";
                            echo "<td>
                            <button class='btn btn-success' onclick='readInfo({$productId})'>View</button>                            
                            <button class='btn btn-warning' onclick='editInfo({$productId})'>Edit</button>
                            <button class='btn btn-danger' onclick='deleteInfo({$productId})'>Delete</button>
                        </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data found</td></tr>";
                    }
                    ?>

                </table>
            </div>
        </div>

    </section>


    <!--Modal Form-->
    <div class="modal fade" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Fill the Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="#" id="myForm">

                        <div class="card imgholder">
                            <label for="imgInput" class="upload">
                                <input type="file" name="" id="imgInput">
                                <i class="bi bi-plus-circle-dotted"></i>
                            </label>
                            <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="img">
                        </div>

                        <div class="inputField">
                            <div>
                                <label for="categoryId">Category ID:</label>
                                <input type="number" name="" id="categoryId" required>
                            </div>
                            <div>
                                <label for="category">Category:</label>
                                <input type="text" name="" id="category" required>
                            </div>
                            <div>
                                <label for="productId">Product ID:</label>
                                <input type="number" name="" id="productId" required>
                            </div>
                            <div>
                                <label for="productName">Product Name:</label>
                                <input type="text" name="" id="productName" required>
                            </div>
                            <div>
                                <label for="unitPrice">Unit Price (RM):</label>
                                <input type="number" name="" id="unitPrice" minlength="11" maxlength="11" required>
                            </div>
                            <div>
                                <label for="bulkPrice">Bulk Price (RM):</label>
                                <input type="number" name="" id="bulkPrice" required>
                            </div>
                            <div>
                                <label for="stockLevel">Stock Level:</label>
                                <input type="number" name="" id="stockLevel" required>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="myForm" class="btn btn-primary submit">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!--Read Data Modal-->
    <div class="modal fade" id="readData">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Profile</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="#" id="myForm">

                        <div class="card imgholder">
                            <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="showImg">
                        </div>

                        <div class="inputField">
                            <div>
                                <label for="categoryId">Category ID:</label>
                                <input type="number" name="" id="categoryId" required>
                            </div>
                            <div>
                                <label for="category">Category:</label>
                                <input type="text" name="" id="category" required>
                            </div>
                            <div>
                                <label for="productId">Product ID:</label>
                                <input type="number" name="" id="productId" required>
                            </div>
                            <div>
                                <label for="productName">Product Name:</label>
                                <input type="text" name="" id="productName" required>
                            </div>
                            <div>
                                <label for="unitPrice">Unit Price (RM):</label>
                                <input type="number" name="" id="unitPrice" minlength="11" maxlength="11" required>
                            </div>
                            <div>
                                <label for="bulkPrice">Bulk Price (RM):</label>
                                <input type="number" name="" id="bulkPrice" required>
                            </div>
                            <div>
                                <label for="stockLevel">Stock Level:</label>
                                <input type="number" name="" id="stockLevel" required>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        const search = document.querySelector('.input-group input'),
            table_rows = document.querySelectorAll('tbody tr'),
            table_headings = document.querySelectorAll('thead th');

        // 1. Searching for specific data of HTML table
        search.addEventListener('input', searchTable);

        function searchTable() {
            table_rows.forEach((row, i) => {
                let table_data = row.textContent.toLowerCase(),
                    search_data = search.value.toLowerCase();

                row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
                row.style.setProperty('--delay', i / 25 + 's');
            })

            document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
                visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
            });
        }

        // 2. Sorting | Ordering data of HTML table

        table_headings.forEach((head, i) => {
            let sort_asc = true;
            head.onclick = () => {
                table_headings.forEach(head => head.classList.remove('active'));
                head.classList.add('active');

                document.querySelectorAll('td').forEach(td => td.classList.remove('active'));
                table_rows.forEach(row => {
                    row.querySelectorAll('td')[i].classList.add('active');
                })

                head.classList.toggle('asc', sort_asc);
                sort_asc = head.classList.contains('asc') ? false : true;

                sortTable(i, sort_asc);
            }
        })

        function sortTable(column, sort_asc) {
            [...table_rows].sort((a, b) => {
                    let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase(),
                        second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();

                    return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
                })
                .map(sorted_row => document.querySelector('tbody').appendChild(sorted_row));
        }
        var form = document.getElementById("myForm"),
            categoryId = document.getElementById("categoryId"),
            category = document.getElementById("category"),
            productId = document.getElementById("productId"),
            productName = document.getElementById("productName"),
            unitPrice = document.getElementById("unitPrice"),
            bulkPrice = document.getElementById("bulkPrice"),
            stockLevel = document.getElementById("stockLevel"),
            submitBtn = document.querySelector(".submit"),
            productInfo = document.getElementById("data"),
            modal = document.getElementById("productForm"),
            modalTitle = document.querySelector("#productForm .modal-title"),
            newProductBtn = document.querySelector(".newProduct");

        let getData = localStorage.getItem('productData') ? JSON.parse(localStorage.getItem('productData')) : [];

        // Preload preset data if no data is available
        if (getData.length === 0) {
            getData = [{
                    category: 'Electronics',
                    productId: 'P001',
                    productName: 'Smartphone',
                    unitPrice: 1000,
                    bulkPrice: 950,
                    stockLevel: 50
                },
                {
                    category: 'Groceries',
                    productId: 'P002',
                    productName: 'Rice 5kg',
                    unitPrice: 25,
                    bulkPrice: 20,
                    stockLevel: 200
                }
            ];
            localStorage.setItem('productData', JSON.stringify(getData)); // Save to localStorage
        }

        let isEdit = false,
            editId;
        showInfo();

        newProductBtn.addEventListener('click', () => {
            submitBtn.innerText = 'Submit',
                modalTitle.innerText = "Add New Product"
            isEdit = false
            form.reset()
        });

        function showInfo() {
            document.querySelectorAll('.productDetails').forEach(info => info.remove());
            getData.forEach((element, index) => {
                let createElement = `<tr class="productDetails">
            <td>${index + 1}</td>
            <td>${element.category}</td>
            <td>${element.productId}</td>
            <td>${element.productName}</td>
            <td>${element.unitPrice}</td>
            <td>${element.bulkPrice}</td>
            <td>${element.stockLevel}</td>
            <td>
                <button class="btn btn-warning" onclick="editInfo(${index}, '${element.category}', '${element.productId}', '${element.productName}', '${element.unitPrice}', '${element.bulkPrice}', '${element.stockLevel}')" data-bs-toggle="modal" data-bs-target="#productForm">Edit</button>
                <button class="btn btn-danger" onclick="deleteInfo(${index})">Delete</button>
            </td>
        </tr>`;

                productInfo.insertAdjacentHTML("beforeend", createElement);
            });
        }

        function deleteInfo(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                getData.splice(id, 1);
                localStorage.setItem('productData', JSON.stringify(getData));
                showInfo();
            }
        }

        function readInfo(categoryId, category, productId, productName, unitPrice, bulkPrice, stockLevel) {
            document.getElementById("showName").value = categoryId;
            document.getElementById("showAge").value = category;
            document.getElementById("showCity").value = productId;
            document.getElementById("showEmail").value = productName;
            document.getElementById("showPhone").value = unitPrice;
            document.getElementById("showPost").value = bulkPrice;
            document.getElementById("showsDate").value = stockLevel;
        }

        submitBtn.addEventListener('click', function() {
            let categoryVal = category.value,
                productIdVal = productId.value,
                productNameVal = productName.value,
                unitPriceVal = unitPrice.value,
                bulkPriceVal = bulkPrice.value,
                stockLevelVal = stockLevel.value;

            if (!categoryVal || !productIdVal || !productNameVal || !unitPriceVal || !bulkPriceVal || !stockLevelVal) {
                alert("Please fill all fields!");
                return;
            }

            const newProduct = {
                category: categoryVal,
                productId: productIdVal,
                productName: productNameVal,
                unitPrice: unitPriceVal,
                bulkPrice: bulkPriceVal,
                stockLevel: stockLevelVal
            };

            if (isEdit) {
                getData[editId] = newProduct;
                submitBtn.innerText = 'Submit';
            } else {
                getData.push(newProduct);
            }

            localStorage.setItem('productData', JSON.stringify(getData));
            showInfo();
            modal.classList.remove('show');
        });

        function editInfo(index, category, productId, productName, unitPrice, bulkPrice, stockLevel) {
            isEdit = true;
            editId = index;
            modalTitle.innerText = "Edit Product";
            submitBtn.innerText = 'Update';

            document.getElementById("category").value = category;
            document.getElementById("productId").value = productId;
            document.getElementById("productName").value = productName;
            document.getElementById("unitPrice").value = unitPrice;
            document.getElementById("bulkPrice").value = bulkPrice;
            document.getElementById("stockLevel").value = stockLevel;
        }
    </script>
      <?php include 'footer.php'; ?>

</body>

</html>