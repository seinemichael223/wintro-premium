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
    <script src="orders.js" defer></script>

    <?php include 'header.php'; ?>

</head>

<body>
    <main>
        <h1>Order Management</h1>
        <p>Click the order ID to view details.</p>
        <div class="button-group">
            <button id="edit-button" onclick="enterEditMode()">Update Status</button>
            <button id="save-button" class="hidden" onclick="saveChanges()">Save</button>
            <button id="cancel-button" class="hidden" onclick="cancelChanges()">Cancel</button>
        </div>
        <section class="table" id="orders_table">
            <section class="table__header">
                <div class="input-group">
                    <input type="search" placeholder="Search">
                </div>
            </section>

            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Customer ID <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Total Amount (RM) <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Order Date <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Status <span class="icon-arrow">&UpArrow;</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch data from the orders table in the database
                        $sql = "SELECT * FROM orders"; // Adjust the query if needed
                        $result = $con->query($sql);

                        // Check if there are rows to fetch
                        if ($result->num_rows > 0) {
                            // Output data for each row
                            while ($row = $result->fetch_assoc()) {
                                $orderId = htmlspecialchars($row['order_id']);
                                $customerId = htmlspecialchars($row['customer_id']);
                                $totalAmount = htmlspecialchars($row['total_amount']);
                                $orderDate = htmlspecialchars($row['order_date']);
                                $status = htmlspecialchars($row['status']);

                                echo "<tr>";
                                echo "<td onclick=\"showOrderDetails('$orderId', '$customerId', '$totalAmount', '$orderDate', '$status')\">{$orderId}</td>";
                                echo "<td>{$customerId}</td>";
                                echo "<td>{$totalAmount}</td>";
                                echo "<td>{$orderDate}</td>";
                                echo "<td class='status' data-original-status='{$status}'>{$status}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
    </main>

    <?php include 'footer.php'; ?>


</body>

</html>