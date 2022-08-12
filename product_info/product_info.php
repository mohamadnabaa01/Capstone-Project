<!DOCTYPE html>
<html lang="en">
<?php

    session_start();
    if(!isset($_SESSION['logged_bool'])){
        header("Location: ../login/login.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../main/main.css">
    <link rel="stylesheet" href="../contactus/contactus.css">
    <link rel="stylesheet" href="../shop/shop.css">
    <link rel="stylesheet" href="../product_info/product_info.css">
    <title>Product Name x - Newbies Gamers</title>
</head>

<body>


    <!-- started with the menu bar -->
    <header>
        <nav class="nav-bar">
            <a href="" class="nav-branding">Newbie Gamers.</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="../home-page/home-page.php" class="home_menu nav-link" title="Home Page"> <i
                            class="fa fa-home fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../shop/shop.php" class="shop_menu nav-link" title="Shop Page"><i
                            class="fa fa-shopping-cart fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../appointments/appointments.php" class="appointments_menu nav-link"
                        title="Appointments"><i class="fa fa-wrench fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../contactus/contactus.php" class="contact_menu nav-link" title="Contact Us Page"><i
                            class="fa fa-phone fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../aboutus/aboutus.php" class="about_menu nav-link" title="About us Page"><i
                            class="fa fa-book fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../basket/basket.php" class="basket_menu nav-link" title="View my Shopping Basket"><i
                            class="fa fa-shopping-basket fa-lg"></i></a>
                </li>
                <li class="nav-item">
                    <a href="../profile/profile.php" class="myaccount_menu nav-link" title="View my account"><i
                            class="fa fa-user fa-lg" style="margin-bottom: 30px;"></i></a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

        </nav>
    </header>
    <!-- ended with the menu bar -->


    <!-- started with title page -->
    <div class="title">
        <h1 style="color: #333;">Product x name</h1>
        <h5 style="color:#b4c3da;">Shop / Product Info</h5>
    </div>
    <!-- ended with title page -->



    <!-- started with product info -->
    <div class="product_info_page">
        <img src="../images/Gaming-Wallpaper.png" alt="product Name" class="product_image reveal-by-x">
        <div class="product_right_part reveal-by-y">
            <h1><i> Product Name x</i>
            </h1>
            <p class="product_description">
            <h3 style="color: royalblue;"><i>Description:</i></h3>
            <i>Lorem ipsum dolor sit amet consectetur, adipisicing elit.<br> Eligendi architecto neque voluptatum
                molestiae
                odio nostrum provident<br> id inventore, incidunt et temporibus re</i></p>

            <div class="product-info-part">
                <h3 style="color: royalblue;"><i>Price:</i></h3>
                <h3>65$</h3>
            </div>
            <div class="product-info-part">
                <h3 style="color: royalblue;"><i>Type: </i></h3>
                <h3>Console</h3>
            </div>
            <div class="product-info-part">
                <h3 style="color: royalblue;"><i>Category: </i></h3>
                <h3>PS4</h3>
            </div>
            <div class="product-info-part">
                <h3 style="color: royalblue;"><i>Age Group:</i></h3>
                <h3>age 12+</h3>
            </div>
            <!-- <label for="points">Quantity:</label> -->
            <input type="number" id="points" name="points" title="Quantity to add to basket"> <br> <br>
            <button class="product_info_addtobasket" title="Add this product to your shopping basket"><i
                    class="fa fa-shopping-basket"></i>Add to Basket</button>
            <button class="product_info_addtofavorites" title="Add this product to your favorites list"><i
                    class="fa fa-heart"></i>Add to Favorites</button>

        </div>
    </div>
    <!-- ended with product info -->




    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->



    <!-- started with footer -->
    <footer>
        <ol class="footer-list">
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Newbies Gamers Home</h3>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#features" title="View Our specialists and features">Our
                                Specialists & Features</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#about-us" title="Know more about us">About Us</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#contact-us"
                                title="Contact us for any enquiries or thoughts">Contact Us</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#shop-products" title="Take a look at our products">Our
                                Products</a>
                        </li>
                        <li>
                            <a href="../home-page/home-page.php#testimonials"
                                title="See what our customers said about our service">Our Customers' opinions</a>
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Newbies Gamers Shop</h3>
                        </li>
                        <li>
                            <a href="../shop/shop.php" title="View all available products in Newbies Gamers and fill your basket to buy">Shop Now</a>
                        </li>
                        <li>
                            <a href="../basket/basket.php" title="View your shopping basket"><i class="fa fa-shopping-basket"></i>View your shopping basket</a>
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>About Newbies Gamers</h3>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.php#history" title="Know about our history">Our History</a>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.php#establishment" title="Know about our establishment">Our
                                Establishment</a>
                        </li>
                        <li>
                            <a href="../aboutus/aboutus.php#specials" title="See what makes us special">Our
                                Specials</a>
                        </li>
                        <li>
                            <i class="fa fa-location-arrow" title="Newbies Gamers shop location"></i>Beirut, Lebanon
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Book an Appointment</h3>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#laptop-repair">Laptop Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#laptop-cleaning">Laptop Cleaning</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#cpu-repair">CPU Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#cpu-cleaning">CPU Cleaning</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#phone-repair">Phone Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#ps-repair">PS Repair</a>
                        </li>
                        <li>
                            <a href="../appointments/appointments.php#controller-repair">Controller Repair</a>
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Contact Us</h3>
                        </li>
                        <li>
                            <a href="../contactus/contactus.php" title="Share your thoughts and concerns to us">Share
                                your thoughts</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope" title="Our email to contact us"></i>newbies_gamers@gmail.com
                        </li>
                        <li>
                            <i class="fa fa-phone" title="Call us or chat by whatsapp with us"></i>+961 01 111 111
                        </li>
                    </ol>
                </div>
            </li>
            <li>
                <div>
                    <ol class="footer-list-element">
                        <li>
                            <h3>Follow Us on Our Socials</h3>
                        </li>
                        <li>
                            <a href="https://www.facebook.com" title="Newbies Gamers facebook account link"><i
                                    class="fa fa-facebook"></i>Facebook</a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com" title="Newbies Gamers instagram account link"><i
                                    class="fa fa-instagram"></i>Instagram</a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com" title="Newbies Gamers twitter account link"><i
                                    class="fa fa-twitter"></i>Twitter</a>
                        </li>
                    </ol>
                </div>
            </li>
        </ol>
    </footer>
    <!-- ended with footer -->

    
    <script src="../shop/shop.js"></script>
    <script src="../product_info/product_info.js"></script>
</body>

</php>