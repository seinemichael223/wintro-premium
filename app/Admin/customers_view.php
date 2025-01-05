<?php
session_start();
require_once '../includes/dbh-inc.php';
require_once 'customers_search.php';

// Get search query if exists
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Get customers using the search function
$customers = searchCustomers($pdo, $search);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="customers_style.css" rel="stylesheet">
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container mt-4">
        <?php
        // Handle success/error messages
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
            unset($_SESSION['error']);
        }
        ?>

        <h2>Customer List</h2>

        <!-- Rest of your HTML remains the same -->
        <div class="d-flex align-items-center mb-3">
            <div class="input-group" style="width: 300px;">
                <input type="text" 
                       id="searchInput" 
                       class="form-control" 
                       placeholder="Search customers..."
                       value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" id="searchButton">Search</button>
            </div>
            <a href="customers_view.php" class="btn btn-secondary ms-2">Clear</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Registration Date</th>
                        <th>Actions</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= htmlspecialchars($customer['id']) ?></td>
                            <td><?= htmlspecialchars($customer['full_name']) ?></td>
                            <td><?= htmlspecialchars($customer['username']) ?></td>
                            <td>
                                <?php if (!empty($customer['email'])): ?>
                                    <a href="mailto:<?= htmlspecialchars($customer['email']) ?>">
                                        <?= htmlspecialchars($customer['email']) ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($customer['phone_number']) ?></td>
                            <td>
                                <?php
                                $addressParts = array_filter([
                                    $customer['address_street'] ?? '',
                                    $customer['address_city'] ?? '',
                                    $customer['address_state'] ?? '',
                                    $customer['address_zip'] ?? '',
                                    $customer['address_country'] ?? ''
                                ]);
                                echo htmlspecialchars(implode(', ', $addressParts));
                                ?>
                            </td>
                            <td><?= !empty($customer['date_created']) ? date('Y-m-d H:i', strtotime($customer['date_created'])) : '' ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" 
                                            class="btn btn-danger btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal<?= $customer['id'] ?>">
                                        Delete
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?= $customer['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this customer?</p>
                                                <p><strong>Customer:</strong> <?= htmlspecialchars($customer['full_name']) ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST" action="customers_delete.php">
                                                    <input type="hidden" name="customer_id" value="<?= $customer['id'] ?>">
                                                    <button type="submit" class="btn btn-danger">Delete Customer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="customers_search.js"></script>
</body>
</html>