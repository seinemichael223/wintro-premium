

<?php
// back end functionality?
// Sample PHP variables for dynamic content
$username = "Henry Cavill";
$pendingOrders = 10; // Example value for pending orders
$totalSales = 12110.75; // Example value for total sales
$topSellingCategory = "Trophy"; // Example value for top-selling category
$siteVisits = 1098; // Example value for site visits
$registrations = 782; // Example value for registrations
$ordersLastMonth = 304; // Example value for orders last month
?>

<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'waddb';

// Connect to the database
$con = mysqli_connect($host, $user, $pass, $db);

/* Check connection
if ($con) {
    echo 'connected successfully to waddb database<br>';
}


// Insert query
    $sql="INSERT INTO customers (customer_id, name, email, total_spend, last_order_date) values (1235, 'John', 'john@gmail.com', 88.88, '2024.10.10')";

// Execute the query
$query=mysqli_query($con, $sql);
if($query)
    echo 'data inserted successfully';

?>
*/
