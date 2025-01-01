<?php
    // Include the contact process script
    include('../includes/contact_us_process.php');
    
    // Initialize variables to store success and error messages
    $errors = [];
    $success = false;

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $result = process_contact_form($_POST);
        $errors = $result['errors'];
        $success = $result['success'];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home</title>
        <meta charset="Utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link id="stylesheet" rel="stylesheet" type="text/css" href="ContactUs.css">
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
                    <li><a href="../ContactUs/ContactUs.php"><span>CONTACT US</span></a></li>
                    <li><a href="../HowToOrder/HowToOrder.html">HOW TO ORDER</a></li>
                </div>
            </div>               
        </div>
        
        <div class="smallNav">
            <ul>
                <li><a href="../Homepage/homepage.php">Home</a></li>
                <p>|</p>
                <li><a href="#"><span class="colored">Contact Us</span></a></li>
            </ul>           
        </div>

        <div class="title">
            <h5>Contact Us</h5>
        </div>

        <div class="boxes">
            <div class="box">
                <i class="fa-solid fa-location-dot"></i>
                <p><span>ADDRESS</span></p>
                <p>34, Jalan Teratai 8, Taman Johor Jaya, 81100 Johor Bahru, Johor</p>
            </div>

            <div class="box">
                <i class="fa-solid fa-clock"></i>
                <p><span>OPENING HOUR</span></p>
                <p>Sun - Thurs: 8.30am - 6pm<br>
                Fri: 8.30am - 2pm<br>
                Sat: Close</p>
            </div>

            <div class="box">
                <i class="fa-solid fa-envelope"></i>
                <p><span>E-MAIL</span></p>
                <p>Send a message to <a href="#">wintropremium@gmail.com</a></p>
            </div>

            <div class="box">
                <i class="fa-solid fa-phone"></i>
                <p><span>CONTACT NUMBER</span></p>
                <p>Call Us on <br><a href="#">+6016-794 0497</a> </p>
            </div>
        </div>

        <div class="subtitle">
            <p>How can we help you?</p>
        </div>

        <div class="form-container">
            <div class="contactUsform">
                <form method="POST" action="../ContactUs/ContactUs.php">
                    <!-- Check if form submission was successful or had errors -->
                    <?php if ($success): ?>
                        <p class="success-message">Thank you for contacting us! We will get back to you shortly.</p>
                    <?php endif; ?>
                    <?php if (!empty($errors)): ?>
                        <ul class="error-list">
                            <?php foreach ($errors as $error): ?>
                                <li class="error-message"><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
    
                    <div class="column">
                        <div class="input-box">
                            <label for="fn">Full Name<span class="star"> *</span></label>
                            <input type="text" name="fn" id="fn" required>
                        </div>
                        <div class="input-box">
                            <label for="Email">Email<span class="star"> *</span></label>
                            <input type="text" name="Email" id="Email" required>
                        </div>
                    </div>

                    <div class="column">
                        <div class="input-box">
                            <label for="cn">Company Name</label>
                            <input type="text" name="cn" id="cn">
                        </div>
                        <div class="input-box">
                            <label for="phoneNo">Phone Number<span class="star"> *</span></label>
                            <input type="tel" name="phoneNo" id="phoneNo" placeholder="012-3456789" required>    
                        </div>
                    </div>

                    <div class="input-box">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject">
                    </div>

                    <div class="input-box">
                        <label for="message">Messages</label>
                        <textarea name="message" id="message" cols="30" rows="5"></textarea>
                    </div>

                    <button type="submit" id="submitBtn">SUBMIT</button>
                </form>
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
                        <a href="../ContactUs/ContactUs.php">Contact Us</a>
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

        <script type="text/javascript" src="ContactUs.js"></script>
    </body>
</html>