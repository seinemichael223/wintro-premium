<?php
require_once '../includes/dbh-inc.php';
?>

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
    <?php include 'header.php'; ?>
</head>
<style>
    
</style>
<body>
    <main>
        <h1>Product Management</h1>
        <p>Click the product ID to view details.</p>

        <span class="material-icons">add_circles</span>
        <a href="create_product.php?action=edit"><span class="material-icons">edit</span></a>
        <span class="material-icons" style="float: right;">add_circles</span>
        <span class="material-icons" style="float: right;">edit</span>
        <a href="create_product.php"> <span class="material-icons">delete</span></a>

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
                            <th> Unit Price (RM) <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Bulk Price (RM) <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Stock Level <span class="icon-arrow">&UpArrow;</span></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </section>
        </section>

    </main>

    <?php include 'footer.php'; ?>
</body>

</html>