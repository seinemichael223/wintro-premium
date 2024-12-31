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
                    <i class="fa-regular fa-user"></i>
                    <a href="../MyCart/myCart.html"><i class="fa-solid fa-cart-shopping"></i></a>
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
                            <a href = "#" class="card-link">
                                <img src="image/trophy.png" alt="card image" class="card-image"> 
                            </a>
                            </li>

                            <li class="card-item swiper-slide">
                                <a href = "#" class="card-link">
                                    <img src="image/trophy.png" alt="card image" class="card-image"> 
                                </a>
                            </li>

                            <li class="card-item swiper-slide">
                                <a href = "#" class="card-link">
                                    <img src="image/trophy.png" alt="card image" class="card-image"> 
                                </a>
                            </li>

                            <li class="card-item swiper-slide">
                                <a href = "#" class="card-link">
                                    <img src="image/trophy.png" alt="card image" class="card-image"> 
                                </a>
                            </li>

                            <li class="card-item swiper-slide">
                                <a href = "#" class="card-link">
                                    <img src="image/trophy.png" alt="card image" class="card-image"> 
                                </a>
                            </li>

                            <li class="card-item swiper-slide">
                                <a href = "#" class="card-link">
                                    <img src="image/trophy.png" alt="card image" class="card-image"> 
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
                    <p>ONLINE QUOTATION</p>
                    <div class="quotation-paragraph">
                        <p>This is quotation paragraph. This is quotation paragraph.This is quotation paragraph.This is quotation paragraph.This is quotation paragraph.</p>
                    </div>
                    <div class="btn1">
                    <button>Get A Free Quote</button>
                    </div>
                </div>
            </div>

            <div class="sections">
                <div class="instant-support">
                    <div class="sentence4">
                        <p>INSTANT SUPPORT</p>
                    </div>
                    <div class="paragraph4">
                        <p>This is instant support paragraph.This is instant support paragraph.This is instant support paragraph.This is instant support paragraph.This is instant support paragraph.This is instant support paragraph.This is instant support paragraph.This is instant support paragraph.This is instant support paragraph.</p>
                    </div>
                    <div class="btn2">
                        <button>Chat With Us</button>
                    </div>
                </div>
                <div class="custom-design">
                    <div class="sentence5">
                        <p>CUSTOMIZATION DESIGN</p>
                    </div>
                    <div class="paragraph5">
                        <p>This is customization content.This is customization content.This is customization content.This is customization content.This is customization content.This is customization content.This is customization content.This is customization content.This is customization content.This is customization content.</p>
                    </div>
                    <div class="btn3">
                        <button>Shop Now</button>
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
        
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script type="text/javascript" src="homepage.js"></script>
    </body>
</html>