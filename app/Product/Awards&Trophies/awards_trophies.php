<?php
require_once '../../includes/dbh-inc.php';
require_once '../../includes/product_card-inc.php';

// Fetch products in the 'Trophy' category
$query = "SELECT * FROM product WHERE sub_category_id = 1";
$result = $pdo->query($query); // Use $conn here for consistency

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="Utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="stylesheet" rel="stylesheet" type="text/css" href="awards_trophies.css">
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
                <a href="../../MyCart/myCart.html"><i class="fa-solid fa-cart-shopping"></i></a>
                <p>RM 0.00</p>
            </div>
        </div>
        <div class="navBar">
            <div class="navBtn">
                <li><a href="../../Homepage/homepage.php">HOME</a></li>
                <li><a href="#">ABOUT US</a></li>
                <li class="dropdown">
                    <a href="#" id="product-link">PRODUCT</a>
                    <div class="dropdown-overlay" id="product-dropdown">
                        <div class="dropdown-content">
                            <div class="column">
                                <h4><a href="#">Awards and Trophies</a></h4>
                                <ul>
                                    <li><a href="#">Trophy</a></li>
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
                <li><a href="../../Services/service.html">SERVICES</a></li>
                <li><a href="../../ContactUs/ContactUs.html">CONTACT US</a></li>
                <li><a href="../../HowToOrder/HowToOrder.html">HOW TO ORDER</a></li>
            </div>
        </div>
    </div>

    <div class="smallNav">
        <ul>
            <li><a href="../../Homepage/homepage.php">Home</a></li>
            <p>|</p>
            <li><a href="#"><span class="colored">Awards and Trophies</span></a></li>
        </ul>
    </div>

    <div class="product-title">
        <div class="background-darker">
            <h2>TROPHY</h2>
        </div>
    </div>

    <div class="outer-container" id="outer-container">
        <nav class="sidebar" id="sidebar">
            <div class="sedebar-container">
                <div class="text">Categories</div>
                <ul>
                    <li>
                        <a href="#" class="award-btn"><span class="cat-title">AWARDS & TROPHIES<span class="fas fa-angle-down first"></span></span></a>
                        <ul class="award-show">
                            <li><a href="#"><span class="highlighted">Trophy</span></a></li>
                            <li><a href="#">Medal</a></li>
                            <li><a href="#">Crystal</a></li>
                            <li><a href="#">Pewter Award</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="gift-btn"><span class="cat-title">GIFTS & SOUVENIRS<span class="fas fa-angle-down second"></span></span></a>
                        <ul class="gift-show">
                            <li><a href="#">Stationary Hamper</a></li>
                            <li><a href="#">Food Hamper</a></li>
                        </ul>
                    </li>

                    <li><a href="#" class="nametag-btn"><span class="cat-title">NAMETAGS<span class="fas fa-angle-down third"></span></span></a></li>

                    <li>
                        <a href="#" class="cloth-btn"><span class="cat-title">CLOTHINGS<span class="fas fa-angle-down forth"></span></span></a>
                        <ul class="cloth-show">
                            <li><a href="#">Jersey</a></li>
                            <li><a href="#">T-shirt</a></li>
                            <li><a href="#">Uniform</a></li>
                            <li><a href="#">Corporate</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="print-btn"><span class="cat-title">PRINTINGS<span class="fas fa-angle-down fifth"></span></a>
                        <ul class="print-show">
                            <li><a href="#">Sticker</a></li>
                            <li><a href="#">Certificate</a></li>
                            <li><a href="#">Banner</a></li>
                            <li><a href="#">Signboard</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="office-btn"><span class="cat-title">OFFICE EQUIPMENT<span class="fas fa-angle-down sixth"></span></span></a>
                        <ul class="office-show">
                            <li><a href="#">Pre Inked Stamp & Cop</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="sport-btn"><span class="cat-title">SPORT EQUIPMENT<span class="fas fa-angle-down seventh"></span></span></a>
                        <ul class="sport-show">
                            <li><a href="#">Basketball</a></li>
                            <li><a href="#">Badmintopn</a></li>
                            <li><a href="#">Football</a></li>
                            <li><a href="#">Table Tennis</a></li>
                            <li><a href="#">Futsal</a></li>
                            <li><a href="#">Stopwatch</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="double-slider-box">
                <h3 class="range-title">FILTER BY PRICE</h3>
                <div class="range-slider">
                    <span class="slider-track"></span>
                    <input type="range" name="min_val" class="min_val" min="0" max="500" value="0" oninput="slideMin()">
                    <input type="range" name="max_val" class="max_val" min="0" max="500" value="500">
                    <div class="tooltip min-tooltip"></div>
                    <div class="tooltip max-tooltip"></div>
                </div>

                <div class="input-box">
                    <div class="min-box">
                        <div class="input-wrap">
                            <span class="dash">-</span>
                            <input type="text" name="min_input" class="input-field1">
                        </div>
                    </div>
                    <div class="max-box">
                        <div class="input-wrap">
                            <input type="text" name="max_input" class="input-field2 max-input">
                            <button class="filterBtn">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="main-content">
            <div class="content-header">
                <span>Show xx Results</span>
                <select>
                    <option>Sort by latest</option>
                </select>
            </div>
            <div class="product-grid">
                <!-- Product Card -->
                <?php
                displayProducts($pdo);
                ?>
            </div>
            <!-- Pagination -->
            <div class="product-pagination">
                <span class="page-number active">1</span>
                <span class="page-number">2</span>
                <span class="page-next">&gt;</span>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="awards_trohpies.js"></script>
</body>

</html>