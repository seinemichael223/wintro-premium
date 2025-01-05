<?php
$pageTitle = "Home";
include '../header.php';
require_once '../includes/config_session-inc.php';
include '../includes/whatsapp-float.html';
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
                        <img src="image/Category/trophy_n_award.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="image/Category/sport_equip.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="image/Category/printings.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="image/Category/office_equip.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="image/Category/gift_n_souvenir.jpeg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <img src="image/Category/clothing.jpg" alt="card image" class="card-image">
                    </a>
                </li>

                <li class="card-item swiper-slide">
                    <a href="#" class="card-link">
                        <!-- <img src="image/nametags.webg" alt="card image" class="card-image"> -->
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
</body>

</html>