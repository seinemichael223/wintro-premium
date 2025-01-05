<?php
require_once '../includes/dbh-inc.php'; // Include your database connection file
require_once '../includes/config_session-inc.php'; // Include your session configuration file

// Set default values if session variables are not set
$username = $_SESSION['username'] ?? 'Guest';
$email = $_SESSION['user_email'] ?? 'Not Provided';
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
                                    <h4><a href="#">Awards and Trophies</a></h4>
                                    <ul>
                                        <li><a href="../Product/Awards&Trophies/awards_trophies.html">Trophy</a></li>
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
        
        <div class="smallNav">
            <ul>
                <li><a href="../Homepage/homepage.php">Home</a></li>
                <p>|</p>
                <li><a href="#"><span class="colored">About Us</span></a></li>
            </ul>           
        </div>

        <div class="management-container">

            <div class="management-container">
                <div class="title">
                    <div class="title-content">
                        <div class="profile-picture-container">
                            <label for="profile-picture-input">
                                <div class="profile-picture" id="profile-picture">
                                    <span>Upload</span>
                                </div>
                            </label>
                            <input type="file" id="profile-picture-input" accept="image/*" hidden>
                        </div>
                        <div class="welcome">
                            <div>Welcome, <?php echo htmlspecialchars($username); ?></div>
                            <div>User email: <?php echo htmlspecialchars($email); ?> <a href="../Reg_Login/login.html">Log Out</a></div>
                        </div>
                    </div>
                </div>

                <div class="manage-account-info" id="info-section">
                    <div class="account-bar">
                        <div class="info" onclick="showSection('info')"><p>Account Info</p></div>
                        <div class="address" onclick="showSection('address')"><p>Address Book</p></div>
                        <div class="orders" onclick="showSection('orders')"><p>My Orders</p></div>
                    </div>
                
                    <div class="info-content" id="info-content">
                        <div class="edit" id="editButton" onclick="editDetails()">EDIT</div>
                        <div class="change" id="changeButton" onclick="changePassword()">CHANGE</div>
                        <table id="infoTable">
                            <tr>
                                <th class="label">Full Name</th>
                                <td class="value" id="fullName"><?php echo htmlspecialchars($username); ?></td>
                            </tr>
                            <tr>
                                <th class="label">Email</th>
                                <td class="value" id="email"><?php echo htmlspecialchars($email); ?></td>
                            </tr>
                            <tr>
                                <th class="label">Password</th>
                                <td class="value" id="password">********</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>



            
            <div class="manage-account-address hidden" id="address-section">
                <div class="account-bar">
                    <div class="info" onclick="showSection('info')"><p>Account Info</p></div>
                    <div class="address" onclick="showSection('address')"><p>Address Book</p></div>
                    <div class="orders" onclick="showSection('orders')"><p>My Orders</p></div>
                </div>
            
                <div class="address-content" id="address-content">
                        <div class="shipping-address">
                            <h5>Shipping Address</h5>
                            <div class="ship-list">
                                <div class="row">
                                    <div class="ship-info">
                                        <div class="ship-name">Adam</div>
                                        <div class="ship-phoneNo">012-123-1234</div>
                                        <div class="ship-email">123@gmail.com</div>
                                        <div class="ship-street">No.1A, Lorong1A, Jalan Permai</div>
                                        <div class="ship-street2">94300, Kota Samarahan, Sarawak.</div>
                                    </div>
                                    <div class="actions">
                                        <div class="address-edit"><p>EDIT</p></div>
                                        <div class="pipe"><p>|</p></div>
                                        <div class="delete"><p>DELETE</p></div>
                                        <div class="pipe"><p>|</p></div>
                                        <div class="add"><p>ADD NEW</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <fieldset class="fieldset5 hidden">
                            <legend class="legend3">Shipping Address</legend>
                            <div class="shipping-form">
                                <form name="shippingForm" id="shippingForm" onsubmit="return(validate('shippingForm'));">
                                    <div class="input-box">
                                        <label for="ship-fn">Full name<span class="star"> *</span></label>
                                        <input type="text" name="ship-fn" id="ship-fn">
                                    </div>
                    
                                    <div class="input-box">
                                        <label for="ship-phoneNo">Phone number<span class="star"> *</span></label>
                                        <input type="tel" name="ship-phoneNo" id="ship-phoneNo" placeholder="012-123-1234">
                                    </div>
                     
                                    <div class="input-box">
                                        <label for="ship-Email">Email address<span class="star"> *</span></label>
                                        <input type="text" name="ship-Email" id="ship-Email">
                                    </div>
                    
                                    <div class="input-box">
                                        <label for="ship-street">Street Address<span class="star"> *</span></label>
                                        <input type="text" name="ship-street" id="ship-street">
                                    </div>
                                    
                                    <div class="column">
                                        <div class="input-box">
                                            <label for="ship-city">City<span class="star"> *</span></label>
                                            <input type="text" name="ship-city" id="ship-city">
                                        </div>
                                        <div class="input-box">
                                            <label for="ship-postcode">Postcode<span class="star"> *</span></label>
                                            <input type="text" name="ship-postcode" id="ship-postcode">
                                        </div>
                                    </div>
                    
                                    <div class="input-box">
                                        <div class="select-state">
                                            <label for="ship-state">State<span class="star"> *</span></label>
                                            <select name="ship-state" id="ship-state">
                                                <option value="Sabah">Sabah</option>
                                                <option value="Sarawak">Sarawak</option>
                                                <option value="Johor">Johor</option>
                                                <option value="Kedah">Kedah</option>
                                                <option value="Kelantan">Kelantan</option>
                                                <option value="Melaka">Melaka</option>
                                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                <option value="Pahang">Pahang</option>
                                                <option value="Penang">Penang</option>
                                                <option value="Perak">Perak</option>
                                                <option value="Perlis">Perlis</option>
                                                <option value="Selangor">Selangor</option>
                                                <option value="Terengganu">Terengganu</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-btn">
                                        <button type="submit" id="saveBtn1">Save</button>
                                        <button id="cancelBtn1">Cancel</button>
                                    </div>   
                                </form>
                            </div>
                        </fieldset>

                        <div class="billing-address">
                            <h5>Billing Address</h5>
                            <div class="bill-list">
                                <div class="row">
                                    <div class="bill-info">
                                        <div class="bill-name">Adam</div>
                                        <div class="bill-phoneNo">012-123-1234</div>
                                        <div class="bill-email">123@gmail.com</div>
                                        <div class="bill-street">No.1A, Lorong1A, Jalan Permai</div>
                                        <div class="bill-street2">94300, Kota Samarahan, Sarawak.</div>
                                    </div>
                                    <div class="actions">
                                        <div class="address-edit"><p>EDIT</p></div>
                                        <div class="pipe"><p>|</p></div>
                                        <div class="delete"><p>DELETE</p></div>
                                        <div class="pipe"><p>|</p></div>
                                        <div class="add"><p>ADD NEW</p></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <fieldset class="fieldset6 hidden">
                            <legend class="legend3">Billing Address</legend>
                            <div class="billing-form">
                                <form name="billingForm" id="billingForm" onsubmit="return(validate('billingForm'));">
                                    <div class="input-box">
                                        <label for="bill-fn">Full name<span class="star"> *</span></label>
                                        <input type="text" name="bill-fn" id="bill-fn">
                                    </div>
                    
                                    <div class="input-box">
                                        <label for="bill-phoneNo">Phone number<span class="star"> *</span></label>
                                        <input type="tel" name="bill-phoneNo" id="bill-phoneNo" placeholder="+60 12-123-1234">
                                    </div>
                    
                                    <div class="input-box">
                                        <label for="bill-Email">Email address<span class="star"> *</span></label>
                                        <input type="text" name="bill-Email" id="bill-Email">
                                    </div>
                    
                                    <div class="input-box">
                                        <label for="bill-street">Street Address<span class="star"> *</span></label>
                                        <input type="text" name="bill-street" id="bill-street">
                                    </div>
                                    
                                    <div class="column">
                                        <div class="input-box">
                                            <label for="bill-city">City<span class="star"> *</span></label>
                                            <input type="text" name="bill-city" id="bill-city">
                                        </div>
                                        <div class="input-box">
                                            <label for="bill-postcode">Postcode<span class="star"> *</span></label>
                                            <input type="text" name="bill-postcode" id="bill-postcode">
                                        </div>
                                    </div>
                    
                                    <div class="input-box">
                                        <div class="select-state">
                                            <label for="bill-state">State<span class="star"> *</span></label>
                                            <select name="bill-state" id="bill-state">
                                                <option value="Sabah">Sabah</option>
                                                <option value="Sarawak">Sarawak</option>
                                                <option value="Johor">Johor</option>
                                                <option value="Kedah">Kedah</option>
                                                <option value="Kelantan">Kelantan</option>
                                                <option value="Melaka">Melaka</option>
                                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                <option value="Pahang">Pahang</option>
                                                <option value="Penang">Penang</option>
                                                <option value="Perak">Perak</option>
                                                <option value="Perlis">Perlis</option>
                                                <option value="Selangor">Selangor</option>
                                                <option value="Terengganu">Terengganu</option>
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="form-btn">
                                        <button type="submit" id="saveBtn2">Save</button>
                                        <button id="cancelBtn2">Cancel</button>
                                    </div>   
                                </form>
                            </div>
                        </fieldset>
                </div>
            </div>
            
            <div class="manage-account-orders hidden" id="orders-section">
                <div class="account-bar">
                    <div class="info" onclick="showSection('info')"><p>Account Info</p></div>
                    <div class="address" onclick="showSection('address')"><p>Address Book</p></div>
                    <div class="orders" onclick="showSection('orders')"><p>My Orders</p></div>
                </div>
            
                <div class="orders-content" id="orders-content">
                    <div class="order-card">
                        <img src="placeholder.png" alt="Product Image">
                        <div class="order-details">
                          <p><span>Product:</span> XXX</p>
                          <p><span>Order ID:</span> A12345</p>
                          <p><span>Order Status:</span> Shipped</p>
                          <p><span>Tracking No:</span> ABC00000123</p>
                          <p><span>Time & Date:</span> 25-12-2024 12:00 PM</p>
                          <p><span>Total:</span> RM 120.00</p>
                        </div>
                        <div class="cols3">
                            <a href="#" class="receipt-button">RECEIPT</a>
                            <button class="status-button" onclick="disableButton(this)">RECEIVE</button>
                          </div>
                      </div>
                    
                      <div class="order-card">
                        <img src="placeholder.png" alt="Product Image">
                        <div class="order-details">
                          <p><span>Product:</span> XXX</p>
                          <p><span>Order ID:</span> C12345</p>
                          <p><span>Order Status:</span> Delivered</p>
                          <p><span>Tracking No:</span> ABC00000456</p>
                          <p><span>Time & Date:</span> 25-12-2024 12:00 PM</p>
                          <p><span>Total:</span> RM 120.00</p>
                        </div>
                        <div class="cols3">
                          <a href="#" class="receipt-button">RECEIPT</a>
                          <button class="status-button" onclick="disableButton(this)">RECEIVE</button>
                        </div>
                      </div>
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
