<?php
session_start();
require_once '../includes/dbh-inc.php';

// Define upload directory path
$target_dir = "../Product/Awards&Trophies/uploads/";

// Create uploads directory if it doesn't exist
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$upload_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Begin transaction
    $pdo->beginTransaction();

    try {
        // Validate and sanitize input
        $product_name = trim($_POST['name']);
        $product_description = trim($_POST['description']);
        $unit_price = filter_var($_POST['unit_price'], FILTER_VALIDATE_FLOAT);
        $bulk_price = filter_var($_POST['bulk_price'], FILTER_VALIDATE_FLOAT);
        $sub_category = filter_var($_POST['sub_category'], FILTER_VALIDATE_INT);
        
        // Input validation
        $errors = [];
        if (empty($product_name)) $errors[] = "Product name is required";
        if ($unit_price === false || $unit_price < 0) $errors[] = "Valid unit price is required";
        if ($bulk_price !== false && $bulk_price < 0) $errors[] = "Bulk price cannot be negative";
        if (!$sub_category) $errors[] = "Valid sub-category is required";

        if (!empty($errors)) {
            throw new Exception(implode("<br>", $errors));
        }

        // Handle file upload
        $image_path = null;
        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
            $file_tmp = $_FILES["product_image"]["tmp_name"];
            $file_name = time() . '_' . basename($_FILES["product_image"]["name"]); // Add timestamp to prevent duplicates
            $target_file = $target_dir . $file_name;
            
            // Verify file type
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = mime_content_type($file_tmp);
            
            if (!in_array($file_type, $allowed_types)) {
                throw new Exception("Only JPG, PNG & GIF files are allowed.");
            }
            
            if (!move_uploaded_file($file_tmp, $target_file)) {
                throw new Exception("Failed to upload file.");
            }
            
            $image_path = "uploads/" . $file_name;
        } else {
            throw new Exception("Product image is required.");
        }

        // Insert product into database
        $stmt = $pdo->prepare("
            INSERT INTO product (
                product_name, 
                product_description, 
                product_image, 
                product_unit_price, 
                product_bulk_price, 
                sub_category_id
            ) VALUES (
                :name, 
                :description, 
                :image, 
                :unit_price, 
                :bulk_price, 
                :sub_category
            )
        ");
        
        $stmt->execute([
            ':name' => $product_name,
            ':description' => $product_description,
            ':image' => $image_path,
            ':unit_price' => $unit_price,
            ':bulk_price' => $bulk_price,
            ':sub_category' => $sub_category
        ]);

        $product_id = $pdo->lastInsertId();

        // Handle product options (colors and sizes)
        if (!empty($_POST['colours']) || !empty($_POST['sizes'])) {
            $colours = array_filter(array_map('trim', explode(',', $_POST['colours'])));
            $sizes = array_filter(array_map('trim', explode(',', $_POST['sizes'])));

            // If either colours or sizes are specified, create product options
            if (!empty($colours) || !empty($sizes)) {
                $option_stmt = $pdo->prepare("
                    INSERT INTO options (
                        product_id, 
                        option_colour, 
                        option_size
                    ) VALUES (
                        :product_id, 
                        :colour, 
                        :size
                    )
                ");

                // If only colors are specified
                if (!empty($colours) && empty($sizes)) {
                    foreach ($colours as $colour) {
                        $option_stmt->execute([
                            ':product_id' => $product_id,
                            ':colour' => $colour,
                            ':size' => null
                        ]);
                    }
                }
                // If only sizes are specified
                elseif (empty($colours) && !empty($sizes)) {
                    foreach ($sizes as $size) {
                        $option_stmt->execute([
                            ':product_id' => $product_id,
                            ':colour' => null,
                            ':size' => $size
                        ]);
                    }
                }
                // If both colors and sizes are specified, create all combinations
                else {
                    foreach ($colours as $colour) {
                        foreach ($sizes as $size) {
                            $option_stmt->execute([
                                ':product_id' => $product_id,
                                ':colour' => $colour,
                                ':size' => $size
                            ]);
                        }
                    }
                }
            }
        }

        // Commit transaction
        $pdo->commit();

        $_SESSION['success'] = "Product added successfully!";
        header("Location: products_view.php");
        exit();
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $pdo->rollBack();
        $_SESSION['error'] = "Error adding product: " . $e->getMessage();
        header("Location: products_view.php");
        exit();
    }
}

// Fetch categories and subcategories
$stmt = $pdo->query("
    SELECT c.category_id, c.category_name, sc.sub_category_id, sc.sub_category_name 
    FROM category c 
    LEFT JOIN sub_category sc ON c.category_id = sc.category_id
    ORDER BY c.category_name, sc.sub_category_name
");
$categories = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if (!isset($categories[$row['category_id']])) {
        $categories[$row['category_id']] = [
            'name' => $row['category_name'],
            'subcategories' => []
        ];
    }
    if ($row['sub_category_id']) {
        $categories[$row['category_id']]['subcategories'][] = [
            'id' => $row['sub_category_id'],
            'name' => $row['sub_category_name']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container mt-4">
        <h2>Add New Product</h2>

        <!-- Display Success/Error Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']); ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select id="category" class="form-select" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $id => $category): ?>
                        <option value="<?= htmlspecialchars($id); ?>">
                            <?= htmlspecialchars($category['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Subcategory</label>
                <select name="sub_category" id="sub_category" class="form-select" required>
                    <option value="">Select Category First</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" required>
                <div class="invalid-feedback">Please provide a product name.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="product_image" class="form-control" accept="image/jpeg,image/png,image/gif" required>
                <div class="invalid-feedback">Please select a valid image file (JPG, PNG, or GIF).</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Unit Price</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="0.01" min="0" name="unit_price" class="form-control" required>
                    <div class="invalid-feedback">Please provide a valid price.</div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Bulk Price (Optional)</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" step="0.01" min="0" name="bulk_price" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Colors (Optional, comma-separated)</label>
                <input type="text" name="colours" class="form-control" placeholder="e.g., Red, Blue, Green">
            </div>

            <div class="mb-3">
                <label class="form-label">Sizes (Optional, comma-separated)</label>
                <input type="text" name="sizes" class="form-control" placeholder="e.g., S, M, L, XL">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add Product</button>
                <a href="products_view.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // Dynamic subcategory loading
        document.getElementById('category').addEventListener('change', function() {
            const categoryId = this.value;
            const subCategorySelect = document.getElementById('sub_category');
            subCategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
            
            if (categoryId) {
                const categories = <?= json_encode($categories) ?>;
                const subcategories = categories[categoryId].subcategories;
                
                subcategories.forEach(subcategory => {
                    const option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subCategorySelect.appendChild(option);
                });
            }
        });
    </script>
</body>
</html>
