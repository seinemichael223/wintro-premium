<?php
require_once '../includes/config_session-inc.php';
require_once '../includes/dbh-inc.php';
require_once '../includes/fetch_options.php';
require_once '../includes/fetch_prices.php';
require_once '../includes/fetch_optionID.php';
require_once '../includes/fetch_stock.php';


if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $_SESSION['product_id'] = $product_id;
} elseif (isset($_SESSION['product_id'])) {
    $product_id = $_SESSION['product_id']; // Retrieve from session if not in URL
} else {
    // Redirect if no product ID is found
    header('Location: ../../productPage.php');
    exit();
}

// Fetch product details from the database
$sql = "SELECT * FROM product WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['product_id' => $product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<p>Product not found.</p>";
    exit();
}

//fetchOptions
$options = fetchOptions($pdo, $product_id);
// Separate sizes and colors from options
$sizes = array_unique(array_column($options, 'option_size'));
$colors = array_unique(array_column($options, 'option_colour'));

//fetchPrice
$prices = fetchPrices($pdo, $product_id);
$selected_size = $_POST['size'] ?? null;
$selected_color = $_POST['color'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="Utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link id="stylesheet" rel="stylesheet" type="text/css" href="productDetail.css">
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
            <li><a href="../Product/Awards&Trophies/awards_trophies.html">Awards and Trophies</a></li>
            <p>|</p>
            <li><a href="#">Trophy</a></li>
            <p>|</p>
            <li><a href="#"><span class="colored"><?php echo htmlspecialchars($product['product_name']); ?></span></a></li>

        </ul>
    </div>

    <div class="content">
        <div class="product-container">
            <div class="product-page">
                <!-- Product Images -->
                <div class="product-images">
                    <div class="big-image">
                        <?php
                        echo '<img id="mainImage" src="../../Product/Awards&Trophies/' . htmlspecialchars($product['product_image']) . '" alt="Main Product Image">';
                        ?>

                    </div>
                    <!-- <div class="small-images">
                        <img src="image/product-background.jpg" alt="Thumbnail Image 1" onclick="updateMainImage(this)">
                        <img src="image/trophy.png" alt="Thumbnail Image 2" onclick="updateMainImage(this)">
                        <img src="image/trophy.png" alt="Thumbnail Image 3" onclick="updateMainImage(this)">
                    </div> -->
                </div>
                <!-- Product Details -->
                <div class="product-details">
                    <div class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></div>
                    <div class="price">RM <?php echo htmlspecialchars($product['product_unit_price']); ?></div>
                    <div class="type-color-dropdown">
                        <form action="productDetail.php" method="POST" id="product-form">
                            <!-- Size -->
                            <div class="type-dropdown">
                                <label for="size">Size:</label>
                                <select id="size" name="size" onchange="this.form.submit()" required>
                                    <option value="" disabled selected>Select a size</option> <!-- Placeholder -->
                                    <?php
                                    foreach ($sizes as $size) {
                                        echo '<option value="' . htmlspecialchars($size) . '" ' . ($selected_size == $size ? 'selected' : '') . '>' . htmlspecialchars($size) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Color -->
                            <div class="color-dropdown">
                                <label for="color">Color:</label>
                                <select id="color" name="color" onchange="this.form.submit()" required>
                                    <option value="" disabled selected>Select a color</option> <!-- Placeholder -->
                                    <?php
                                    foreach ($colors as $color) {
                                        echo '<option value="' . htmlspecialchars($color) . '" ' . ($selected_color == $color ? 'selected' : '') . '>' . htmlspecialchars($color) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Stock Display -->
                    <div>
                        <span class="stock">Stock:</span>
                        <?php
                        // Check if form was submitted
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            // echo "<p>Selected Size: $selected_size</p>";
                            // echo "<p>Selected Color: $selected_color</p>";

                            if ($selected_size && $selected_color) {
                                // Get the option_id for the selected size and color
                                $option_id = fetchOptionId($pdo, $product_id, $selected_size, $selected_color);
                                // echo "<p>Option ID: $option_id</p>";
                                if ($option_id) {
                                    // Fetch stock quantity for the option_id
                                    $stock = fetchStock($pdo, $option_id);
                                } else {
                                    $stock = null; // No matching option_id found
                                }

                                if ($stock) {
                                    echo htmlspecialchars($stock['stock_quantity']);
                                } else {
                                    echo "<p>Out of stock</p>";
                                }
                            } else {
                                echo "<p>-</p>";
                            }
                        }
                        ?>
                    </div>

                    <?php
                    $prices = fetchPrices($pdo, $product_id);
                    ?>

                    <!-- Bulk Discount -->
                    <div class="bulk">Bulk Discount:</div>
                    <table>
                        <tr>
                            <th>Unit Price</th>
                            <th>Bulk Price</th>
                        </tr>
                        <tr>
                            <td>
                                <?= isset($prices['product_unit_price'])
                                    ? 'RM ' . htmlspecialchars($prices['product_unit_price'])
                                    : 'N/A'; ?>
                            </td>
                            <td>
                                <?= isset($prices['product_bulk_price'])
                                    ? 'RM ' . htmlspecialchars($prices['product_bulk_price'])
                                    : 'N/A'; ?>
                            </td>
                        </tr>
                    </table>


                    <!-- Personalization -->
                    <div class="personalization">
                        <p>Personalization Options:</p>
                        <div class="radio">
                            <input type="radio" name="personalization" id="no-personalization" checked>
                            <label for="no-personalization">No personalization</label>
                        </div>
                        <div class="radio">
                            <input type="radio" name="personalization" id="personalization">
                            <label for="personalization">Personalization - Enter text below</label>
                        </div>
                        <div id="items-container">
                            <div class="item-custom">
                                <div class="item-title" onclick="toggleDropdown(this)">Item 1<i class="fa-solid fa-angle-down"></i></div>
                                <div class="form-container">
                                    <form>
                                        <input type="text">
                                        <label>32 characters remaining</label>
                                        <input type="text">
                                        <label>32 characters remaining</label>
                                        <input type="text">
                                        <label>32 characters remaining</label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button class="add-custom" onclick="addItem()">+ Add items</button>
                    </div>

                    <!-- File Upload -->
                    <div class="upload-file">
                        <div class="upload">Upload Artwork/Logo: </div>
                        <div class="art-logo">
                            <input type="radio" name="artwork" id="no-artwork" value="no">
                            <label for="no-artwork">No Thanks</label>
                        </div>
                        <div class="art-logo">
                            <input type="radio" name="artwork" id="artwork" value="yes">
                            <label for="artwork">Yes, I would like to upload a logo/ artwork</label>
                        </div>
                        <div class="file-drop-area" id="fileDropArea" style="display: none;">
                            <p>Drop files here</p>
                            <input type="file" id="fileInput" multiple>
                        </div>

                        <ul class="file-list" id="fileList"></ul>
                    </div>

                    <div class="instruct">
                        <p>Special Instruction: </p>
                        <textarea name="instruct-text" id="instruct-text"></textarea>
                    </div>

                    <!-- Quantity -->
                    <div class="quantity">
                        <div class="qty">
                            <p>Quantity: </p>
                            <div class="qty-btn">
                                <button class="decrement" onclick="decreaseValue()">-</button>
                                <input type="text" id="counterValue" value="1" readonly />
                                <button class="increment" onclick="increaseValue()">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="buttons">
                        <p>Need to customize this product or have questions?</p>
                        <div class="yellow">
                            <button class="send-inquiry"><a href="#">Send Inquiry</a></button>
                            <button class="chat-now"><a href="#">Chat Now</a></button>
                        </div>
                        <div class="blue">
                            <button class="add-to-cart">Add to Cart</button>
                        </div>
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

    <script type="text/javascript" src="productDetail.js"></script>
</body>

</html>