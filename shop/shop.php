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
    <link rel="stylesheet" href="../home-page/home-page.css">
    <link rel="stylesheet" href="../contactus/contactus.css">
    <link rel="stylesheet" href="../shop/shop.css">
    <title>Shop - Newbies Gamers</title>
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
        <h1 style="color: #333;">Shop</h1>
        <h5 style="color:#b4c3da;">Home / Shop</h5>
    </div>
    <!-- ended with title page -->





    <!-- started with products options -->
    <div class="tabs">
        <button class="active" data-cont=".cd">CD's</button>
        <button data-cont=".consoles">consoles</button>
        <button data-cont=".cellphones">CellPhones</button>
        <button data-cont=".offers">Offers</button>
        <button data-cont=".others">Others</button>
    </div>

    <!-- start search button -->
    <div class="search-container">
        <input type="text" placeholder="Search for a product.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>
    <!-- end search button -->



    <!-- started filters -->
    <div class="tabs-filter">
        <button onclick="ShowFilters()"><i class="fa fa-filter"></i>Filter</button>
        <div class="filters" style="display: none;">
            <div>
                <h2>Type</h2>
                <button>
                    <label for="type">
                        <select name="type" id="type">
                            <option value="All">All</option>
                            <option value="cd">CDs</option>
                            <option value="consoles">Consoles</option>
                            <option value="accessories">Accessories</option>
                            <option value="phones">Phones</option>
                            <option value="cards">Online cards</option>
                            <option value="electronics">Electronics</option>
                        </select>
                    </label>
                </button>
            </div>
            <div>
                <h2>Category</h2>
                <label for="category">
                    <button>
                        <select name="category" id="category">
                            <option value="All">All</option>
                            <option value="action">Action</option>
                            <option value="gaming">Gaming</option>
                            <option value="strategy">Strategy</option>
                            <option value="PS2">PS2</option>
                            <option value="PS3">PS3</option>
                            <option value="PS4">PS4</option>
                            <option value="PS5">PS5</option>
                            <option value="Nintendo">Nintendo</option>
                            <option value="XBox">XBox</option>
                            <option value="iphone">IPhone</option>
                            <option value="Samsung">Samsung</option>
                            <option value="PsPlus">PS Plus</option>
                        </select>
                    </button>
                </label>
            </div>
            <div>
                <h2>Sort By Newness</h2>
                <label for="newness">
                    <button>
                        <select name="newness" id="newness">
                            <option value="none">None</option>
                            <option value="newest">By newest</option>
                            <option value="oldest">By oldest</option>
                        </select>
                    </button>
                </label>
            </div>
            <div>
                <h2>Sort By Popularity</h2>
                <label for="popularity">
                    <button>
                        <select name="popularity" id="popularity">
                            <option value="none">None</option>
                            <option value="highest">By Highest</option>
                            <option value="lowest">By Lowest</option>
                        </select>
                    </button>
                </label>
            </div>
            <div>
                <h2>Sort By Price</h2>
                <label for="price">
                    <button>
                        <select name="price" id="price">
                            <option value="none">None</option>
                            <option value="highest">By Highest</option>
                            <option value="lowest">By Lowest</option>
                        </select>
                    </button>
                </label>
            </div>
        </div>
    </div>
     <!-- ended filters -->


    <div>
        <h2 class="shop-title">Shop</h2>
        <h4 class="results-title">Showing 1-4 of 4 results</h4>
    </div>

    <div class="content">
        <!-- start first tab -->
        <div class="cd reveal-by-x" style="display: block;">
            <div class="shop-products">
                <div class="shop-products-title" id="shop-products">
                    <h1>CD's</h1>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end first tab -->

        <!-- start of second tab -->
        <div class="consoles reveal-by-x">
            <div class="shop-products">
                <div class="shop-products-title" id="shop-products">
                    <h1>Consoles</h1>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of second tab -->

        <!-- start of third tab -->
        <div class="cellphones reveal-by-x">
            <div class="shop-products">
                <div class="shop-products-title" id="shop-products">
                    <h1>CellPhones</h1>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of third tab -->

        <!-- start of fourth tab -->
        <div class="offers reveal-by-x">
            <div class="shop-products">
                <div class="shop-products-title" id="shop-products">
                    <h1>Offers</h1>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of fourth tab -->

        <!-- start of fifth tab -->
        <div class="others reveal-by-x">
            <div class="shop-products">
                <div class="shop-products-title" id="shop-products">
                    <h1>Others</h1>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="product1" id="product">
                    <div class="product_info">
                        <div class="img_section">
                            <img src="../images/console.png" alt="product 1">
                        </div>
                        <div class="attributes_section">
                            <h1><i>Product 1</i></h1>
                            <h2><i>50$</i></h2>
                            <a href="../product_info/product_info.php">
                                <img class="info" src="../images/info.png" title="read more" alt="read more info">
                            </a>
                            <a href="">
                                <img class="add_to_basket" src="../images/shopping_cart.png" title="Add To Basket"
                                    alt="Add To Basket">
                            </a>

                            <a href="">
                                <img class="add_to_fav" src="../images/addfav.png" title="Add To Favorites"
                                    alt="Add To Favorites">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of fifth tab -->
    </div>


    <!-- ended with products -->

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
</body>

</php>