<?php include 'data.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <h2>Create Single Product</h1>
            <form>
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">Select Category</option>
                    <option value="trophy">Trophy</option>
                    <option value="fashion">Fashion</option>
                    <option value="books">Books</option>
                    <option value="toys">Toys</option>
                </select><br>

                <label for="product-name">Product Name</label>
                <input type="text" id="product-name" name="product-name" placeholder="10-30 characters"><br>

                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5"></textarea><br>

                <label for="size">Size</label>
                <input type="checkbox" id="size-small" name="size" value="Small">
                <label for="size-small" style="display: inline;">Small</label>
                <input type="checkbox" id="size-medium" name="size" value="Medium">
                <label for="size-medium" style="display: inline;">Medium</label>
                <input type="checkbox" id="size-large" name="size" value="Large">
                <label for="size-large" style="display: inline;">Large</label>
                <input type="checkbox" id="size-other" name="size" value="Other">
                <label for="size-other" style="display: inline;">Other</label>
                <input type="text" id="size-other-text" name="size-other-text" placeholder="Specify other size"><br>


                <label for="colour">Colour</label>

                <input type="checkbox" id="colour-red" name="colour" value="Red">
                <label for="colour-red" style="display: inline;">Red</label>
                <input type="checkbox" id="colour-blue" name="colour" value="Blue">
                <label for="colour-blue" style="display: inline;">Blue</label>
                <input type="checkbox" id="colour-green" name="colour" value="Green">
                <label for="colour-green" style="display: inline;">Green</label>
                <input type="checkbox" id="colour-other" name="colour" value="Other">
                <label for="colour-other" style="display: inline;">Other</label>
                <input type="text" id="colour-other-text" name="colour-other-text" placeholder="Specify other colour"><br>


                <label for="material">Material</label>
                <select id="material" name="material">
                    <option value="">Select Material</option>
                    <option value="acrylic">Acrylic</option>
                    <option value="crystal">Crystal</option>
                    <option value="metal">Metal</option>
                    <option value="plastic">Plastic</option>
                </select><br>

                <label>Personalization Setting</label>
                <input type="radio" id="personalization-yes" name="personalization" value="yes">
                <label for="personalization-yes" style="display: inline;">Yes</label>
                <input type="radio" id="personalization-no" name="personalization" value="no" checked>
                <label for="personalization-no" style="display: inline;">No</label><br>

                <label for="unit-price">Unit Price (RM)</label>
                <input type="number" id="unit-price" name="unit-price" step="0.01"><br>

                <label for="bulk-price">Bulk Price (RM)</label>
                <input type="number" id="bulk-price" name="bulk-price" step="0.01"><br>

                <label for="stock-quantity">Stock Quantity</label>
                <input type="number" id="stock-quantity" name="stock-quantity" min="0"><br>

                <label for="image-video">Image/Video (s)</label>
                <input type="file" id="image-video" name="image-video" accept="image/jpeg, image/png, video/mp4" multiple><br>

                <button type="submit">Create</button>
                <button type="button" onclick="window.location.href='/'">Cancel</button><br>
            </form>
    </main>

    <?php include 'footer.php'; ?>
</body>

</html>