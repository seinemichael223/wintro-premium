<?php
require_once '../includes/dbh-inc.php';
require_once '../includes/config_session-inc.php';

// Handle status update
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];
    
    try {
        $pdo->beginTransaction();
        
        // Update order status instead of payment status
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$new_status, $order_id]);
        
        $pdo->commit();
        $_SESSION['success_msg'] = "Order #$order_id status updated to $new_status successfully";
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['error_msg'] = "Error updating order #$order_id status. Please try again.";
    }
    
    header("Location: orders_view.php");
    exit();
}

// Get filters
$status_filter = $_GET['status'] ?? 'all';
$date_filter = $_GET['date'] ?? 'all';
$search = $_GET['search'] ?? '';

// Build query
$query = "SELECT 
            o.id as order_id,
            o.status as order_status,
            o.order_date,
            t.payment_amount,
            t.payer_email,
            t.address_street,
            t.address_city,
            t.address_state,
            t.address_zip,
            t.address_country,
            u.username,
            GROUP_CONCAT(
                CONCAT(td.quantity, 'x ', td.product_name) 
                SEPARATOR ', '
            ) as order_items,
            SUM(td.quantity) as total_quantity
          FROM orders o
          JOIN transactions t ON o.id = t.tid
          JOIN users u ON o.user_id = u.id
          LEFT JOIN transaction_details td ON t.tid = td.tid
          WHERE 1=1";

$params = [];

if ($status_filter !== 'all') {
    $query .= " AND o.status = ?";  // Changed from t.payment_status to o.status
    $params[] = $status_filter;
}

if ($date_filter !== 'all') {
    switch ($date_filter) {
        case 'today':
            $query .= " AND DATE(o.order_date) = CURDATE()";
            break;
        case 'week':
            $query .= " AND o.order_date >= DATE_SUB(NOW(), INTERVAL 1 WEEK)";
            break;
        case 'month':
            $query .= " AND o.order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
            break;
    }
}

if ($search) {
    $query .= " AND (u.username LIKE ? OR t.payer_email LIKE ? OR t.tid LIKE ?)";
    $search_param = "%$search%";
    $params = array_merge($params, [$search_param, $search_param, $search_param]);
}

$query .= " GROUP BY t.tid ORDER BY t.transaction_date DESC";

// Execute query
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="orders_view.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="admin-container">
        <h1>Order Management</h1>
        
        <?php if (isset($_SESSION['success_msg'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success_msg'];
                    unset($_SESSION['success_msg']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_msg'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['error_msg'];
                    unset($_SESSION['error_msg']);
                ?>
            </div>
        <?php endif; ?>

        <!-- Filters -->
        <div class="filters">
            <form method="GET" class="filter-form">
                <div class="filter-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="all" <?php echo $status_filter === 'all' ? 'selected' : ''; ?>>All Orders</option>
                        <option value="pending" <?php echo $status_filter === 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="processing" <?php echo $status_filter === 'processing' ? 'selected' : ''; ?>>Processing</option>
                        <option value="shipped" <?php echo $status_filter === 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                        <option value="delivered" <?php echo $status_filter === 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                        <option value="cancelled" <?php echo $status_filter === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="date">Date Range:</label>
                    <select name="date" id="date">
                        <option value="all" <?php echo $date_filter === 'all' ? 'selected' : ''; ?>>All Time</option>
                        <option value="today" <?php echo $date_filter === 'today' ? 'selected' : ''; ?>>Today</option>
                        <option value="week" <?php echo $date_filter === 'week' ? 'selected' : ''; ?>>Last 7 Days</option>
                        <option value="month" <?php echo $date_filter === 'month' ? 'selected' : ''; ?>>Last 30 Days</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="search">Search:</label>
                    <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by ID, customer name, or email...">
                </div>

                <button type="submit" class="filter-btn">Apply Filters</button>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="orders-table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Order Items</th>
                        <th>Total Qty</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Shipping Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                        <td>#<?php echo htmlspecialchars($transaction['tid'] ?? ''); ?></td>
                        <td>
                            <div class="customer-info">
                                <span class="customer-name"><?php echo htmlspecialchars($transaction['username'] ?? ''); ?></span>
                                <span class="customer-email"><?php echo htmlspecialchars($transaction['payer_email'] ?? ''); ?></span>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($transaction['order_items'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($transaction['total_quantity'] ?? '0'); ?></td>
                        <td><?php echo date('M d, Y H:i', strtotime($transaction['transaction_date'] ?? 'now')); ?></td>
                        <td>RM <?php echo number_format($transaction['payment_amount'] ?? 0, 2); ?></td>
                        <td>
                            <span class="status-badge status-<?php echo strtolower($transaction['order_status'] ?? 'pending'); ?>">
                                <?php echo htmlspecialchars(ucfirst($transaction['order_status'] ?? 'Pending')); ?>
                            </span>
                        </td>
                        <td>
                            <?php 
                                echo htmlspecialchars($transaction['address_street'] ?? '') . ', ' .
                                    htmlspecialchars($transaction['address_city'] ?? '') . ', ' .
                                    htmlspecialchars($transaction['address_state'] ?? '') . ' ' .
                                    htmlspecialchars($transaction['address_zip'] ?? '') . ', ' .
                                    htmlspecialchars($transaction['address_country'] ?? '');
                            ?>
                        </td>
                            <td>
                                <button onclick="viewOrder(<?php echo $transaction['tid']; ?>)" class="action-btn view-btn">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="updateStatus(<?php echo $transaction['tid']; ?>)" class="action-btn edit-btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Update Order Status</h2>
        <form id="updateStatusForm" method="POST">
            <input type="hidden" name="order_id" id="modal_order_id">
            <div class="form-group">
                <label for="new_status">Status:</label>
                <select name="new_status" id="new_status" required>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <button type="submit" name="update_status" class="submit-btn">Update Status</button>
        </form>
    </div>
</div>

    <script src="orders_view.js"></script>
</body>
</html>