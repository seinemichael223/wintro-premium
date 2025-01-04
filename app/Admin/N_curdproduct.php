<?php include 'data.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="table.css">
    <script src="script.js"></script>
    <script src="table.js" defer></script>
    <title>TRIAL</title>
    <?php include 'header.php'; ?>
</head>
<style>
    .button-group {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            float: right;
        }

        .button-group button {
            width: auto;
            padding: 9.6px 19.2px;
            background-color: yellow;
            color: #032062;
            border: none;
            border-radius: 4.8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s ease-in-out;
            text-align: center;
        }

        .button-group button:hover {
            transform: scale(1.05);        }

        .button-group button:active {
            transform: scale(0.95);
        }

        .button-group button.hidden {
            display: none;
        }
</style>
<body>
    <main>
        <h1>Product Management</h1>
        <p>Click the product ID to view details.</p>

        <!---<span class="material-icons">add_circles</span>
        <a href="create_product.php?action=edit"><span class="material-icons">edit</span></a>
        <span class="material-icons" style="float: right;">add_circles</span>
        <span class="material-icons" style="float: right;">edit</span>
        <a href="create_product.php"> <span class="material-icons">delete</span></a>--->
        <div class="button-group">
            <button id="edit-button" onclick="enterEditMode()">New Product</button>

        </div>
        <section class="table" id="products_table">
            <section class="table__header">
                <div class="input-group">
                    <input type="search" placeholder="Search">
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Category ID<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Category<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Product ID <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Product Name<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Unit Price (RM)<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Bulk Price (RM)<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Stock Level<span class="icon-arrow">&UpArrow;</span></th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </section>



    </main>

    <?php include 'footer.php'; ?>
</body>

</html>