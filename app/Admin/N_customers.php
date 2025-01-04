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

<body>
    <main>
        <h1>Customers List</h1>
        <p>Click the name to view customer details.</p>
        <section class="table" id="customers_table">
            <section class="table__header">
                <div class="input-group">
                    <input type="search" placeholder="Search">
                </div>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Customer ID <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Name <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Total Spend(RM) <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Last Order Date <span class="icon-arrow">&UpArrow;</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Alert box to show fullcustomer information
                        // Fetch data from the customers table in the database
                        $sql = "SELECT * FROM customers"; // Adjust the query if needed
                        $result = $con->query($sql);

                        // Check if there are rows to fetch
                        if ($result->num_rows > 0) {
                            // Output data for each row
                            while ($row = $result->fetch_assoc()) {
                                $id = htmlspecialchars($row['customer_id']);
                                $name = htmlspecialchars($row['name']);
                                $email = htmlspecialchars($row['email']);
                                $totalSpend = htmlspecialchars($row['total_spend']);
                                $lastOrderDate = htmlspecialchars($row['last_order_date']);
                                echo "<tr>";
                                echo "<td>{$id}</td>";
                                echo "<td onclick=\"showCustomerDetails('$id', '$name', '$email', '$totalSpend', '$lastOrderDate')\" '>{$name}</td>";
                                echo "<td>{$email}</td>";
                                echo "<td>{$totalSpend}</td>";
                                echo "<td>{$lastOrderDate}</td>";
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