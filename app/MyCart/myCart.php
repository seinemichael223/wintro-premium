<?php
require_once '../includes/cart-inc.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home</title>
        <meta charset="Utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="stylesheet" rel="stylesheet" type="text/css" href="myCart.css">
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
                <a href="../MyCart/myCart.html"><i class="fa-solid fa-cart-shopping"></i></a>
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
                    <li><a href="../Services/service.html">SERVICES</a></li>
                    <li><a href="../ContactUs/ContactUs.html">CONTACT US</a></li>
                    <li><a href="../HowToOrder/HowToOrder.html">HOW TO ORDER</a></li>
                </div>
            </div>               
        </div>

            <div id="MyCart" class="content active">
                <div class="smallNav">
                    <ul>
                        <li><a href="../Homepage/homepage.php">Home</a></li>
                        <p>|</p>
                        <li><a href="#"><span class="colored">My Cart</span></a></li>
                    </ul>           
                </div>

                <div class="title">
                    <h5>My Cart</h5>
                </div>

                <div class="cart-container">
                    <div class="tabs">
                        <div class="cart">
                            <div id="cartTab" class="active" onclick="switchTab('cart')">My Cart</div>
                        </div>
                        <div class="wish">
                            <div id="wishlistTab" onclick="switchTab('wishlist')">Wishlist</div>
                        </div>
                    </div>

                    <div class="item-summary">
                        <?php
                        $cart = $_SESSION['cart'] ?? [];
                        $totalCost = 0;

                        if (!empty($cart)): ?>
                            <div class="item-list">
                                <?php foreach ($cart as $id => $item): ?>
                                    <div class="item">
                                        <div class="item-image">
                                            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                        </div>

                                        <div class="item-info">
                                            <div class="info">
                                                <div class="column1">
                                                    <div class="item-name">
                                                        <p><?= htmlspecialchars($item['name']) ?></p>
                                                    </div>
                                                    <div class="item-details">
                                                        <p>Quantity: <?= intval($item['quantity']) ?></p>
                                                    </div>
                                                </div>

                                                <div class="item-actions">
                                                    <form method="post" action="../includes/cart-inc.php">
                                                        <input type="hidden" name="product_id" value="<?= $id ?>">
                                                        <button type="submit" name="action" value="delete" class="fa-solid fa-xmark"></button>
                                                    </form>
                                                    <div class="quantity">
                                                        <input type="text" value="<?= intval($item['quantity']) ?>" id="quantity-input">
                                                    </div>

                                                    <p><span class="item-price">RM<?= number_format($item['price'], 2) ?></span></p>
                                                </div>
                                            </div>

                                            <div class="actions">
                                                <div class="edit" onclick="">Edit</div>
                                                <div class="move" onclick="moveToWishlist(this)">Move to Wishlist</div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $totalCost += intval($item['quantity']) * floatval($item['price']); ?>
                                <?php endforeach; ?>
                            </div>
                            <p><strong>Total Cost: RM<?= number_format($totalCost, 2) ?></strong></p>
                        <?php else: ?>
                            <p>Your cart is empty.</p>
                        <?php endif; ?>
                    </div>

                    <br>
                    <a href="../includes/product_details-inc.php">Add More Products</a>
                </div>
            </div>

            <div class="subtitle">
                <p> - Recently Viewed - </p>
            </div>

            <div class="category1 swiper"> 
                <div class="category2-slider">
                    <ul class="card-list swiper-wrapper">
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 1</h4>
                                <p class="card-description">Description of Trophy 1</p>
                            </div>
                        </li>
            
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 2</h4>
                                <p class="card-description">Description of Trophy 2</p>
                            </div>
                        </li>
            
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 3</h4>
                                <p class="card-description">Description of Trophy 3</p>
                            </div>
                        </li>
                        
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 2</h4>
                                <p class="card-description">Description of Trophy 2</p>
                            </div>
                        </li>
            
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 3</h4>
                                <p class="card-description">Description of Trophy 3</p>
                            </div>
                        </li>

                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 2</h4>
                                <p class="card-description">Description of Trophy 2</p>
                            </div>
                        </li>
                        
                    </ul>
            
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>          
        </div>

        <div id="WishList" class="content">
            <div class="smallNav">
                <ul>
                    <li><a href="../Homepage/homepage.php">Home</a></li>
                    <p>|</p>
                    <li><a href="#"><span class="colored">Wishlist</span></a></li>
                </ul>           
            </div>

            <div class="title">
                <h5>Wishlist</h5>
            </div>

            <div class="wishlist-container">
                <div class="tabs">
                    <div class="cart">
                        <div id="cartTab" class="active" onclick="switchTab('cart')">My Cart</div>
                    </div>
                    <div class="wish">
                        <div id="wishlistTab" onclick="switchTab('wishlist')">Wishlist</div>
                    </div>
                </div>

                <div class="wishlist-boxes">
                    <div class="box">
                        <i class="fa-solid fa-heart"></i>
                        <div class="box-info">
                            <h6>Trophy A BAW270</h6>
                            <p>Colour: Gold</p>
                            <p><span class="box-price">RM XX.XX</span></p>
                        </div>
                        <div class="box-image">
                            <img src="image/pt0914f.png" alt="product">
                        </div>
                        <div class="box-actions">
                            <div class="edit" onclick="">Edit</div>
                            <div class="move" onclick="moveToCart(this)">Move to Cart</div>
                        </div>
                    </div>

                    <div class="box">
                        <i class="fa-solid fa-heart"></i>
                        <div class="box-info">
                            <h6>Trophy A BAW270</h6>
                            <p>Colour: Gold</p>
                            <p><span class="box-price">RM XX.XX</span></p>
                        </div>
                        <div class="box-image">
                            <img src="image/pt0914f.png" alt="product">
                        </div>
                        <div class="box-actions">
                            <div class="edit" onclick="">Edit</div>
                            <div class="move" onclick="moveToCart(this)">Move to Cart</div>
                        </div>
                    </div>

                    <div class="box">
                        <i class="fa-solid fa-heart"></i>
                        <div class="box-info">
                            <h6>Trophy A BAW270</h6>
                            <p>Colour: Gold</p>
                            <p><span class="box-price">RM XX.XX</span></p>
                        </div>
                        <div class="box-image">
                            <img src="image/pt0914f.png" alt="product">
                        </div>
                        <div class="box-actions">
                            <div class="edit" onclick="">Edit</div>
                            <div class="move" onclick="moveToCart(this)">Move to Cart</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="subtitle">
                <p> - You May Also Like - </p>
            </div>

            <div class="category2 swiper"> 
                <div class="category2-slider">
                    <ul class="card-list swiper-wrapper">
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 1</h4>
                                <p class="card-description">Description of Trophy 1</p>
                            </div>
                        </li>
            
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 2</h4>
                                <p class="card-description">Description of Trophy 2</p>
                            </div>
                        </li>
            
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 3</h4>
                                <p class="card-description">Description of Trophy 3</p>
                            </div>
                        </li>
                        
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 2</h4>
                                <p class="card-description">Description of Trophy 2</p>
                            </div>
                        </li>
            
                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 3</h4>
                                <p class="card-description">Description of Trophy 3</p>
                            </div>
                        </li>

                        <li class="card-item swiper-slide">
                            <a href="#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            <div class="card-info">
                                <h4 class="card-title">Trophy 2</h4>
                                <p class="card-description">Description of Trophy 2</p>
                            </div>
                        </li>
                        
                    </ul>
            
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
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

        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script type="text/javascript" src="myCart.js"></script>

    </body>
</html>
