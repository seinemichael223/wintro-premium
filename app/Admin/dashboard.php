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
          <p><?php echo $pendingOrders; ?></p>
        </div>
        <div id="card2">
          <h2>Total Sales of This Month</h2><br>
          <p>RM<?php echo number_format($totalSales, 2); ?></p>
        </div>
        <div id="card3">
          <h2>Top-Selling Category</h2><br>
          <p><?php echo $topSellingCategory; ?></p>
        </div>
      </div>
    </section>
    <section>
      <div class="stats-row">
        <div id="card4">
          <h2>Site Visits of This Month</h2><br>
          <p><?php echo $siteVisits; ?></p>
        </div>
        <div id="card5">
          <h2>Registrations of This Month</h2><br>
          <p><?php echo $registrations; ?></p>
        </div>

        <div id="card6">
          <h2>Orders of This Month</h2><br>
          <p><?php echo $ordersLastMonth; ?></p>
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