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
                <a href="../Profile/profile.php"><i class="fa-regular fa-user"></i></a>
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
