<?php
require_once '../includes/config_session-inc.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
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
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                        <a href="../Admin/dashboard.php">Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="../MyCart/myCart.php"><i class="fa-solid fa-cart-shopping"></i></a>
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
                                <h4><a href="../Product/product_pages/awards_trophies.php">Awards and Trophies</a></h4>
                                <ul>
                                    <li><a href="../../Product/product_pages/trophy.php">Trophy</a></li>
                                    <li><a href="../../Product/product_pages/medal.php">Medal</a></li>
                                    <li><a href="../../Product/product_pages/crystal.php">Crystal</a></li>
                                    <li><a href="../../Product/product_pages/pewter.php">Pewter Award</a></li>
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
                                <h4><a href="../Product/product_pages/awards_trophies.php">Office Equipment</a></h4>
                                <ul>
                                    <li><a href="../Product/product_pages/awards_trophies.php">Pre Inked Stamp & Cop</a></li>
                                </ul>
                                <h4><a href="../Product/product_pages/awards_trophies.php">Sport Equipment</a></h4>
                                <ul>
                                    <li><a href="../Product/product_pages/awards_trophies.php">Basketball</a></li>
                                    <li><a href="../Product/product_pages/awards_trophies.php">Badminton</a></li>
                                    <li><a href="../Product/product_pages/awards_trophies.php">Football</a></li>
                                    <li><a href="../Product/product_pages/awards_trophies.php">Table Tennis</a></li>
                                    <li><a href="../Product/product_pages/awards_trophies.php">Futsal</a></li>
                                    <li><a href="../Product/product_pages/awards_trophies.php">Stopwatch</a></li>
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
    <div class="slider">
        <div class="slides">
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">

            <div class="slide first">
                <img src="image/slider1.png" alt="first slide">
            </div>

            <div class="slide">
                <img src="image/slider2.png" alt="second slide">
            </div>

            <div class="slide">
                <img src="image/slider3.png" alt="third slide">
            </div>
        </div>

        <div class="navigation-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
        </div>
    </div>

    <div class="aboutUs">
        <h5>About Us</h5>
        <p>
            Wintro Apparel was founded in 2016, we focus
            in t-shirt printing business. We offer the 5 most
            popular t-shirt printing methods among our
            customers.
            We also provide several types of products such
            as, roundneck & collar t-shirt, corporate, work
            wear, production wear, gift and souvenir.
            We listen to our customer needs and provide the
            best outstanding products with unsurpassed
            services.
            At the same time, deliver premium value to our
            customers. We upload the highest standard of
            integrity in all of our action and exhibit a strong
            will to win in the marketplace in every aspect of
            our business.
        </p>
    </div>

    <div class="howToOrder">
        <div class="sentence1">
            <h5>How to Order?</h5>
        </div>
        <div class="order-steps">
            <img src="image/orderStep.png" alt="orderStep">
        </div>
    </div>

    <div class="categoryTitle">
        <div class="sentence2">
            <h5>Browse by Category</h5>
        </div>
    </div>

    <div class="category swiper">
        <div class="category-slider">
            <ul class="card-list swiper-wrapper">
                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="../image/trophy_n_award.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="../image/sport_equip.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="../image/printings.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="../image/office_equip.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="../image/gift_n_souvenir.jpeg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="../image/clothing.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="../image/nametags.webp" alt="card image" class="card-image">
                    </a>
                </li>
            </ul>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </div>

    <div class="sentence3">
        <h5>Our Services</h5>
    </div>

    <div class="service">
        <div class="quotation">
            <p class="subtitle">ONLINE QUOTATION</p>
            <div class="quotation-paragraph">
                <p>We are the leading trophy maker with affordable prices. Send us an online quotation and our staff will reply to you as soon as possible.</p>
            </div>
            <div class="btn1">
                <div class="btn1">
                    <button onclick="window.location.href='../Quotation/quotation.html'">Get A Free Quote</button>
                </div>
            </div>
        </div>
    </div>

    <div class="sections">
        <div class="instant-support">
            <div class="sentence4">
                <p class="subtitle">INSTANT SUPPORT</p>
            </div>
            <div class="paragraph4">
                <p>Our instant live chat and remarkable customer support & service is what we pride ourselves as a trophy supplier to suit out client's needs.</p>
            </div>
            <div class="btn2">
                <a href="https://wa.me/194832932" target="_blank">
                    <button>Chat With Us</button>
                </a>

            </div>
        </div>
        <div class="custom-design">
            <div class="sentence5">
                <p class="subtitle">CUSTOMIZATION DESIGN</p>
            </div>
            <div class="paragraph5">
                <p>All our trophies listed on the website and our catalogue are fully customizable and you can customize it to pretty much any style you desire.</p>
            </div>
            <div class="btn3">
                <button>Shop Now</button>
            </div>
        </div>
    </div>

    <?php include '../footer.php'; ?>
    <?php
    include '../includes/whatsapp-float.html';
    ?>
</body>

</html>
