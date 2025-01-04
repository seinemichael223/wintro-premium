<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Wintro Premium</title>
</head>

<body>
    <header>
        <nav>
            <!-- Checkbox for toggling menu -->
            <input type="checkbox" id="check">

            <!-- Menu icon -->
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>

            <!-- Site logo -->
            <a href="dashboard.php">
                <label class="logo">
                    <img src="logo.png" alt="profile pic" height="80px">
                </label>
            </a>

            <!-- Navigation links -->
            <ul>
                <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

                <li><a class="<?php echo $currentPage == 'dashboard.php' ? 'active' : ''; ?>" href="dashboard.php">Dashboard</a></li>
                <li><a class="<?php echo $currentPage == 'sales.php' ? 'active' : ''; ?>" href="sales.php">Sales</a></li>
                <li><a class="<?php echo $currentPage == 'products_view.php' ? 'active' : ''; ?>" href="products_view.php">Products</a></li>
                <li><a class="<?php echo $currentPage == 'orders.php' ? 'active' : ''; ?>" href="orders.php">Orders</a></li>
                <li><a class="<?php echo $currentPage == 'customers_view.php' ? 'active' : ''; ?>" href="customers_view.php">Customers</a></li>
        </nav>
    </header>

</body>

</html>