<?php
require_once '../includes/dbh-inc.php';
include '../Admin/dashboard_summary.php';
// Calculate total sales for the current month
$totalSales = getTotalSalesForCurrentMonth($pdo);
$pendingOrders = getPendingOrdersCount($pdo);
$ordersThisMonth = getOrdersCountForCurrentMonth($pdo);
$registrations = getRegistrationsForCurrentMonth($pdo);
$topSellingProduct = getTopSellingProduct($pdo);
$successfulTransactions = getSuccessfulTransactionCount($pdo);

?>

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
  <?php include 'header.php'; ?>
</head>

<body>

  <main>
    <h1>Dashboard</h1>
    <section>
      <div class="stats">
        <div id="card1">
          <h2>Pending Order</h2><br>
          <h1><?php echo $pendingOrders; ?></h1>
        </div>
        <div id="card2">
          <h2>Total Sales of This Month</h2><br>
          <h1>RM<?php echo number_format($totalSales, 2); ?></h1>
        </div>
        <div id="card3">
          <h2>Top-Selling Category</h2><br>
          <h1><?php echo "" . $topSellingProduct['product_name'] . "<br>";
              echo "Quantity Sold: " . $topSellingProduct['total_quantity_sold']; ?></h1>
        </div>
      </div>
    </section>
    <section>
      <div class="stats-row">
        <div id="card4">
          <h2>Successful Payment Transaction</h2><br>
          <h1><?php echo $successfulTransactions; ?></h1>
        </div>
        <div id="card5">
          <h2>Registrations of This Month</h2><br>
          <h1><?php echo $registrations; ?></h1>
        </div>

        <div id="card6">
          <h2>Orders of This Month</h2><br>
          <h1><?php echo $ordersThisMonth; ?></h1>
        </div>
      </div>
    </section>
    <section>
      <div class="background-container">
        <img src="background.png" alt="" class="responsive-img">

      </div>
    </section>
  </main>

  <?php include 'footer.php'; ?>
</body>

</html>