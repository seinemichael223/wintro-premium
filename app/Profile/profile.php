<?php
require_once '../includes/dbh-inc.php';
require_once '../includes/config_session-inc.php';

/*if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

try {
    // Fetch user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        throw new Exception("User not found");
    }

    // Fetch user address
    $addrStmt = $pdo->prepare("SELECT * FROM user_address WHERE uid = ?");
    $addrStmt->execute([$userId]);
    $address = $addrStmt->fetch(PDO::FETCH_ASSOC);

    // Fetch user orders
    $orderStmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
    $orderStmt->execute([$userId]);
    $orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    $_SESSION['error'] = "An error occurred: " . $e->getMessage();
    error_log($e->getMessage());
}*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home</title>
        <meta charset="Utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="stylesheet" rel="stylesheet" type="text/css" href="profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    </head>

    <body>
        <div class="container">
            <div class="header1">
                <div class="info1">
                    <p>Call Us +60 12 345 6789</p>
                </div>
                <div class="info2">
                    <p>Free Shipping for Orders over RM199.90</p>
                </div>
            </div>
            <div class="header2">
                <div class="search">
                    <i class="fa-solid fa-bars"></i>
                    <div class="input-container">
                        <input type="text" name="search" id="search" placeholder="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="logo">
                    <img src="image/wpLogo2.png" alt="logo">
                </div>
                <div class="icons">
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-regular fa-user"></i>
                    <a href="../MyCart/myCart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                    <p>RM 0.00</p>
                </div>
            </div>
            <div class="navBar">
                <div class="navBtn">
                    <li><a href="../Homepage/homepage.php">HOME</a></li>
                    <li><a href="../AboutUs/aboutUs.html">ABOUT US</a></li>
                    <li class="dropdown">
                            <a href="#" id="product-link">PRODUCT</a>
                            <div class="dropdown-overlay" id="product-dropdown">
                                <div class="dropdown-content">
                                    <div class="column">
                                        <h4><a href="../Product/product_pages/awards_trophies.php">Awards and Trophies</a></h4>
                                        <ul>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Trophy</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Medal</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Crystal</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Pewter Award</a></li>
                                        </ul>
                                        <h4><a href="../Product/product_pages/awards_trophies.php">Gifts & Souvenirs</a></h4>
                                        <ul>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Stationary Hamper</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Food Hamper</a></li>
                                        </ul>
                                        <h4><a href="../Product/product_pages/awards_trophies.php">Nametags</a></h4>
                                    </div>
                                    <div class="column">
                                        <h4><a href="../Product/product_pages/awards_trophies.php">Clothing</a></h4>
                                        <ul>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Jersey</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">T-shirt</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Uniform</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Corporate</a></li>
                                        </ul>
                                        <h4><a href="../Product/product_pages/awards_trophies.php">Printings</a></h4>
                                        <ul>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Sticker</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Certificate</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Banner</a></li>
                                            <li><a href="../Product/product_pages/awards_trophies.php">Signboard</a></li>
                                        </ul>
                                    </div>
                                    <div class="column">
                                        <h4><a href="#">Office Equipment</a></h4>
                                        <ul>
                                            <li><a href="#">Pre Inked Stamp & Cop</a></li>
                                        </ul>
                                        <h4><a href="#">Sport Equipment</a></h4>
                                        <ul>
                                            <li><a href="#">Basketball</a></li>
                                            <li><a href="#">Badminton</a></li>
                                            <li><a href="#">Football</a></li>
                                            <li><a href="#">Table Tennis</a></li>
                                            <li><a href="#">Futsal</a></li>
                                            <li><a href="#">Stopwatch</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="../Services/service.html">SERVICES</a></li>
                        <li><a href="../ContactUs/ContactUs.php">CONTACT US</a></li>
                        <li><a href="../HowToOrder/HowToOrder.html"><span>HOW TO ORDER</span></a></li>
                    </div>
                </div> 
            </div>               
        </div>
        
        <div class="smallNav">
            <ul>
                <li><a href="../Homepage/homepage.php">Home</a></li>
                <p>|</p>
                <li><a href="#"><span class="colored">Profile</span></a></li>
            </ul>           
        </div>

        <div class="management-container">
        <h2>Welcome,//echo htmlspecialchars($user['full_name']);</h2>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <div class="manage-account">
            <div class="account-bar">
                <button onclick="showSection('info')" class="active">Account Info</button>
                <button onclick="showSection('address')">Address Book</button>
                <button onclick="showSection('orders')">My Orders</button>
            </div>

            <!-- Account Info Section -->
            <div id="info-content" class="section">
                <h3>Account Information</h3>
                <button onclick="editDetails()" class="edit-btn">Edit Details</button>
                <table class="info-table">
                    <tr>
                        <th>Full Name</th>
                        <td>//echo htmlspecialchars($user['full_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>//echo htmlspecialchars($user['full_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>//echo htmlspecialchars($user['email']); ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>//echo htmlspecialchars($user['phone_number']); ?></td>
                    </tr>
                </table>
            </div>

            <!-- Address Section -->
            <div id="address-content" class="section hidden">
                <h3>Shipping Address</h3>
                <button onclick="editAddress()" class="edit-btn">Edit Address</button>
                
                <?php if ($address): ?>
                    <div class="address-card">
                        <p>// echo htmlspecialchars($address['address_street']); ?></p>
                        <p>// echo htmlspecialchars($address['address_city']) . ', ' . 
                            //htmlspecialchars($address['address_state']) . ' ' . 
                            //htmlspecialchars($address['address_zip']); ?></p>
                        <p>// echo htmlspecialchars($address['address_country']); ?></p>
                    </div>
                <?php else: ?>
                    <p>No address found. Please add your address.</p>
                <?php endif; ?>
            </div>

            <!-- Orders Section -->
            <div id="orders-content" class="section hidden">
                <h3>Order History</h3>
                <?php if ($orders): ?>
                    <ul>
                        <?php foreach ($orders as $order): ?>
                            <li>Order //# echo htmlspecialchars($order['id']); ?> - Date: // echo htmlspecialchars($order['order_date']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No orders found.</p>
                <?php endif; ?>
            </div>
        </div>
        </div>

        <footer>
            <div class="foot1">
                <div class="foot1-logo">
                    <img src="image/wp_Logo1.png" alt="Footer-Logo">
                </div>
                <div class="company">
                    <div class="CompanyName">
                        <p>Wintro Premium Enterprise</p>
                    </div>
                    <div class="CompanyAddress">
                        <p>34, Jalan Teratai & Taman Johor Jaya, 81100 Johor Bahru Johor</p>
                    </div>
                    <div class="followUs">
                        <p>FOLLOW US</p>
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-square-instagram"></i>
                    </div>
                </div>
            </div>

            <div class="foot2">
                <div class="foot2-title">
                <p>Company Information</p>
                </div>
                <ul class="info-list">
                    <li class="info">
                        <a href="../AboutUs/aboutUs.html">About Us</a>
                    </li>
                    <li class="info">
                        <a href="../Services/service.html">Our Services</a>
                    </li>
                    <li class="info">
                        <a href="../ContactUs/ContactUs.html">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="foot3">
                <div class="foot3-title">
                    <p>Products</p>
                </div>
                <ul class="product-list">
                    <li class="product">
                        <a href="#">Awards & Trophies</a>
                    </li>
                    <li class="product">
                        <a href="#">Gift & Souvenirs</a>
                    </li>
                    <li class="product">
                        <a href="#">Clothing</a>
                    </li>
                    <li class="product">
                        <a href="#">Printing</a>
                    </li>
                    <li class="product">
                        <a href="#">Office Equipment</a>
                    </li>
                    <li class="product">
                        <a href="#">Sport Equipment</a>
                    </li>
                    <li class="product">
                        <a href="#">Nametags</a>
                    </li>
                </ul>
            </div>

            <div class="foot4">
                <div class="foot4-title">
                    <p>Quick Links</p>
                </div>
                <ul class="links-list">
                    <li class="link">
                        <a href="../Terms & Conditions/terms.html">Terms & Conditions</a>
                    </li>
                    <li class="link">
                        <a href="../Policy/policy.html">Privacy Policy</a>
                    </li>
                    <li class="link">
                        <a href="../FAQs/faqs.html">FAQs</a>
                    </li>
                </ul>
                <div class="chatWithUs">
                    <i class="fa-regular fa-message"></i>
                    <a href="#">CHAT WITH US</a>
                </div>
            </div>
        </footer>

        <div class="footer-bottom">
            <p>© 2024 Wintro Premium Enterprise. All rights reserved.</p>
        </div>

        <script type="text/javascript" src="profile.js"></script>
    </body>
</html>
