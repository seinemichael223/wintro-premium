<?php
require_once 'includes/config_session-inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $pageTitle ?? 'Home'; ?></title>
    <meta charset="Utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="stylesheet" rel="stylesheet" type="text/css" href="homepage.css">
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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="../Profile/profile.html"><i class="fa-regular fa-user"></i></a>
                    <a href="../includes/logout-inc.php">Logout</a>
                    <a href="../includes/product_details-inc.php"><i class="fa-solid fa-cart-shopping"></i></a>
                <?php else: ?>
                    <a href="../Reg_Login/login.php">Login</a>
                <?php endif; ?>
                <p>RM 0.00</p>
            </div>
        </div>

        <div class="navBar">
            <div class="navBtn">
                <li><a href="../Homepage/homepage.php"><span>HOME</span></a></li>
                <li><a href="../AboutUs/aboutUs.html">ABOUT US</a></li>
                <li class="dropdown">
                    <a href="#" id="product-link">PRODUCT</a>
                    <div class="dropdown-overlay" id="product-dropdown">
                        <div class="dropdown-content">
                            <div class="column">
                                <h4><a href="../Product/Awards&Trophies/awards_trophies.php">Awards and Trophies</a></h4>
                                <ul>
                                    <li><a href="../Product/Awards&Trophies/trophy.php">Trophy</a></li>
                                    <li><a href="#">Medal</a></li>
                                    <li><a href="#">Crystal</a></li>
                                    <li><a href="#">Pewter Award</a></li>
                                </ul>
                                <h4><a href="#">Gifts & Souvenirs</a></h4>
                                <ul>
                                    <li><a href="#">Stationary Hamper</a></li>
                                    <li><a href="#">Food Hamper</a></li>
                                </ul>
                                <h4><a href="#">Nametags</a></h4>
                            </div>
                            <div class="column">
                                <h4><a href="#">Clothing</a></h4>
                                <ul>
                                    <li><a href="#">Jersey</a></li>
                                    <li><a href="#">T-shirt</a></li>
                                    <li><a href="#">Uniform</a></li>
                                    <li><a href="#">Corporate</a></li>
                                </ul>
                                <h4><a href="#">Printings</a></h4>
                                <ul>
                                    <li><a href="#">Sticker</a></li>
                                    <li><a href="#">Certificate</a></li>
                                    <li><a href="#">Banner</a></li>
                                    <li><a href="#">Signboard</a></li>
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
                <li><a href="../HowToOrder/HowToOrder.html">HOW TO ORDER</a></li>
            </div>
        </div>
    </div>