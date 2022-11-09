<?php

session_start();
include("../php/connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}
if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] != 'admin') {
    header("Location: ../home-page/home-page.php");
}
$admin_id = $_SESSION['logged_id'];
$query = "SELECT first_name, last_name FROM admins WHERE admin_id = $admin_id";
$stmt = $connection->prepare($query);
$stmt->execute();
$results = $stmt->get_result();
$row = $results->fetch_assoc();


//sum of all customers
$query_total_customers = "SELECT COUNT(customer_id) as count FROM customers";
$stmt_total_customers = $connection->prepare($query_total_customers);
$stmt_total_customers->execute();
$results_total_customers = $stmt_total_customers->get_result();
$row_total_customers = $results_total_customers->fetch_assoc();


//count of all appointments
$query_total_appointments = "SELECT COUNT(appointment_id) as total_appointments FROM appointments";
$stmt_total_appointments = $connection->prepare($query_total_appointments);
$stmt_total_appointments->execute();
$results_total_appointments = $stmt_total_appointments->get_result();
$row_total_appointments = $results_total_appointments->fetch_assoc();

//sum of all appointments
$query_total_profit = "SELECT SUM(total_price_including_tax) as total_profit FROM checkouts";
$stmt_total_profit = $connection->prepare($query_total_profit);
$stmt_total_profit->execute();
$results_total_profit = $stmt_total_profit->get_result();
$row_total_profit = $results_total_profit->fetch_assoc();

//get total checkouts made
$query_total_checkouts = "SELECT COUNT(checkout_id) as total_checkout FROM checkouts";
$stmt_total_checkouts = $connection->prepare($query_total_checkouts);
$stmt_total_checkouts->execute();
$results_total_checkouts = $stmt_total_checkouts->get_result();
$row_total_checkouts = $results_total_checkouts->fetch_assoc();

//form of adding new product
$product_name = "";
$product_price = 0;
$product_type = "";
$product_category = "";
$product_description = "";
$product_age = "";
$product_image = "";
$product_inventory = 0;
$product_sales_number = 0;

if (isset($_POST["product_name"])) {
    $product_name = $_POST["product_name"];
}

if (isset($_POST["product_price"])) {
    $product_price = $_POST["product_price"];
}

if (isset($_POST["product_type"])) {
    $product_type = $_POST["product_type"];
}

if (isset($_POST["product_category"])) {
    $product_category = $_POST["product_category"];
}

if (isset($_POST["product_desciption"])) {
    $product_description = $_POST["product_desciption"];
}

if (isset($_POST["product_age"])) {
    $product_age = $_POST["product_age"];
}

if (isset($_POST['product_inventory'])) {
    $product_inventory = $_POST['product_inventory'];
}

if (isset($_POST['product_sales'])) {
    $product_sales_number = $_POST['product_sales'];
}

if ($product_name != "" && $product_price != 0 && $product_type != "" && $product_category != "" && $product_description != "" && $product_age != "" && $product_inventory != 0) {
    //make directory in images/Products that have same name as product
    mkdir('../images/Products/' . $product_name);
    $target_dir = "../images/Products/$product_name/";
    $filename = basename($_FILES['product_image']['name']);
    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $product_image = $filename;
            //set timezone to beirut
            date_default_timezone_set('Asia/Beirut');
            $modified_on = date('Y-m-d h:i:s');
            $modified_by = $row['first_name'] . ' ' . $row['last_name'];

            //insert into table products
            $stmt_add_new_product = $connection->prepare("INSERT INTO products(name, price, type, category, description, age, image, inventory, sales_number, last_modified_by, last_modified_on) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt_add_new_product->bind_param("sisssssiiss", $product_name, $product_price, $product_type, $product_category, $product_description, $product_age, $product_image, $product_inventory, $product_sales_number, $modified_by, $modified_on);
            $stmt_add_new_product->execute();
            $stmt_add_new_product->close();

            //select last product id
            $select_last_product_id = $connection->prepare("SELECT product_id FROM products ORDER BY product_id DESC LIMIT 1");
            $select_last_product_id->execute();
            $result_last_product_id = $select_last_product_id->get_result();
            $row_last_product_id = $result_last_product_id->fetch_assoc();
            $product_id = $row_last_product_id['product_id'];

            //insert into history prices current price
            $price_change = '0';
            $stmt_add_product_price_history = $connection->prepare("INSERT INTO history_product_prices(product_id, price, price_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_price_history->bind_param("iisss", $product_id, $product_price, $price_change, $modified_by, $modified_on);
            $stmt_add_product_price_history->execute();
            $stmt_add_product_price_history->close();

            //insert into history inventory current inventory
            $inventory_change = '0';
            $stmt_add_product_inventory_history = $connection->prepare("INSERT INTO history_product_inventory(product_id, inventory, inventory_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_inventory_history->bind_param("iisss", $product_id, $product_inventory, $inventory_change, $modified_by, $modified_on);
            $stmt_add_product_inventory_history->execute();
            $stmt_add_product_inventory_history->close();

            //insert into histoy sales current sales 0
            $sales_change = '0';
            $stmt_add_product_sales_history = $connection->prepare("INSERT INTO history_product_sales(product_id, sales_number, sales_change, modified_by, modified_on) VALUES (?,?,?,?,?)");
            $stmt_add_product_sales_history->bind_param("iisss", $product_id, $product_sales_number, $sales_change, $modified_by, $modified_on);
            $stmt_add_product_sales_history->execute();
            $stmt_add_product_sales_history->close();

            header("Location: product-admin.php?product-added=1");
        }
    }
}

//remove product offer
if (isset($_GET['getProducttoRemove'])) {
    $product_id = $_GET['getProducttoRemove'];
    $stmt_delete_product_offer = $connection->prepare("DELETE FROM products_offers WHERE product_id = '" . $product_id . "'");
    $stmt_delete_product_offer->execute();
    header("Location: offers-admin.php?product_offer_deleted=1");
}

//get products in ascending 
$query_nbofsales = "SELECT name,inventory,sales_number FROM products ORDER BY sales_number ASC;";
$stmt_nbofsales = $connection->prepare($query_nbofsales);
$stmt_nbofsales->execute();
$results_nbofsales = $stmt_nbofsales->get_result();


//get top products 
$query_top_products = "SELECT name,sales_number FROM products ORDER BY sales_number DESC LIMIT 5;";
$stmt_top_products = $connection->prepare($query_top_products);
$stmt_top_products->execute();
$results_top_products = $stmt_top_products->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="../images/Newbie Gamers-logos.jpeg">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    </meta>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="../admin-main/admin-main.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="stylesheet" href="offers-admin.css">
    <title>Admin | Offers - Newbies Gamers</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body onunload="myFunction()">

    <!-- started popup message logout -->
    <div class="popup" id="logout-confirmation">
        <img src="../images/question-mark.png" alt="">
        <h2>Log Out Confirmation</h2>
        <p>Are you sure that you want to logout?</p>
        <button type="button" onclick="GoToLogIn()">YES</button>
        <button type="button" onclick="CloseLogOutPopUp()">NO</button>
    </div>

    <!-- started popup message logout -->
    <div class="popup" id="product-offer-added-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Offer Added Confirmation</h2>
        <p>A new product offer was added successfully</p>
        <button type="button" onclick="CloseProductOfferAddedPopUp()">OK</button>
    </div>

    <!-- started popup product offer deleted -->
    <div class="popup" id="product-offer-deleted-confirmation">
        <img src="../images/tick.png" alt="">
        <h2>Product Offer Was Removed</h2>
        <p>The offer on the product was removed successfully</p>
        <button type="button" onclick="CloseProductOfferDeletedPopUp()">OK</button>
    </div>

    <!-- started popup message remove product -->
    <div class="popup" id="remove-product-offer-confirmation">
        <img src="../images/question-mark.png" alt="remove confirmation">
        <h2>Delete Confirmation</h2>
        <p id="remove-product-offer-confirmation-text"></p>
        <button type="button" onclick="DeleteProductOffer()">YES</button>
        <button type="button" onclick="CloseRemoveProductOfferPopUp()">NO</button>
    </div>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>
                <span class="lab la-newbiesgamers"></span> <span>Newbies Gamers</span>
            </h2>
        </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="../home-admin/home-admin.php" id="dashboard-link">
                        <span class="las la-igloo" class="active"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="../customer-admin/customer-admin.php" id="customers-link">
                        <span class="las la-users"></span>
                        <span>Customers</span>
                    </a>
                </li>
                <li>
                    <a href="../appointments-admin/appointments-admin.php" id="appointments-link">
                        <span class="las la-clipboard-list"></span>
                        <span>Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="../checkouts-admin/checkouts-admin.php" id="checkouts-link">
                        <span class="las la-receipt"></span>
                        <span>Checkouts</span>
                    </a>
                </li>
                <li>
                    <a href="../store_sale-admin/store_sale-admin.php" id="store_sale-link">
                        <span class="las la-money-check"></span>
                        <span>Store Sales</span>
                    </a>
                </li>
                <li>
                    <a href="../product-admin/product-admin.php" id="products-link">
                        <span class="las la-box"></span>
                        <span>Products</span>
                    </a>
                </li>
                <li>
                    <a href="../offers-admin/offers-admin.php" id="offers-link">
                        <span class="las la-percent"></span>
                        <span>Offers</span>
                    </a>
                <li>
                <li>
                    <a href="../repairs-admin/repairs-admin.php" id="repairs-link">
                        <span class="las la-tools"></span>
                        <span>Repairs</span>
                    </a>
                </li>
                <li>
                    <a href="../admin-admin/admin-admin.php" id="admins-link">
                        <span class="las la-user-circle"></span>
                        <span>Admin Accounts</span>
                    </a>
                </li>
                <li>
                    <a>
                        <a class="logout-btn" onclick="OpenLogOutPopUp()">
                            <span class="las la-sign-out-alt"></span>
                            <span>Logout</span>
                        </a>
                    </a>
                </li>
            </ul>

        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span><i class="las la-bars"></i></span>
                </label>
                Offers List
            </h2>

            <div class="user-wrapper">
                <img src="../images/info.png" width="40px" height="40px" alt="">
                <div>
                    <h4> <?php echo $row["first_name"], " ", $row['last_name']; ?></h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <div class="card-single">
                    <div>
                        <h1><?php echo  $row_total_customers['count']; ?></h1>
                        <span>Customers</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_appointments['total_appointments'] ?></h1>
                        <span>Appointments</span>
                    </div>
                    <div>
                        <span class="las la-clipboard"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo $row_total_checkouts['total_checkout'] ?></h1>
                        <span>Chekouts</span>
                    </div>
                    <div>
                        <span class="las la-shopping-bag"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1>$<?php echo $row_total_profit['total_profit'] ?></h1>
                        <span>Profit</span>
                    </div>
                    <div>
                        <span class="las la-google-wallet"></span>
                    </div>
                </div>
            </div>

            <!-- list of all products offers -->

            <div class="recent-grid" style="display: block !important;">
                <div class="projects">
                    <div class="card">

                        <div class="card-header">
                            <h3>Products Offers List</h3>
                        </div>

                        <div id="myPlot" style="width:100%;max-width:700px;"></div>
                        <div id="myPlot2" style="width:100%;max-width:700px;"></div>

                        <div class="card-single add_product">
                            <button class="add_product_offer" id="add_product_offer" onclick="OpenAddProductOffer()" title="Add a new product offer">
                                <span class="las la-plus"></span>
                                Add Product Offer
                            </button>
                        </div>

                        <div class="card-header">
                            <h3>
                                <p style="text-decoration: underline; color: royalblue;" id="filter-text"></p>
                                <br>
                                <p id="table-sort"></p>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="div-search">
                                    <span class="las la-search" style="font-size: 1.8rem; color: royalblue;"></span>
                                    <input type="text" id="SearchInput" onkeyup="FilterTable()" placeholder="Search in table Products Offers...">
                                </div>
                                <table width="100%" id="products_offers_table">
                                    <thead>
                                        <tr>
                                            <td id="product-name-column" title="Sort Product Name by descending">Product Name</td>
                                            <td id="old-price-column" title="Sort Old Price by descending">Old Price</td>
                                            <td id="new-price-column" title="Sort New Price by descending">New Price</td>
                                            <td id="offer-percentage-column" title="Sort Offer Percentage by descending">Offer Percentage</td>
                                            <td id="offer-begin-date-column" title="Sort Offer Begin Date by descending">Offer Begin Date</td>
                                            <td id="offer-end-date-column" title="Sort Offer End Date by descending">Offer End Date</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Last Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Last Modified On</td>
                                            <td>Remove</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt_select_all_products_offers = $connection->prepare("SELECT * FROM products_offers");
                                        $stmt_select_all_products_offers->execute();
                                        $result_products_offers = $stmt_select_all_products_offers->get_result();
                                        while ($row_products_offers = $result_products_offers->fetch_assoc()) {
                                            $stmt_select_product_name = $connection->prepare("SELECT name FROM products WHERE product_id = '" . $row_products_offers['product_id'] . "'");
                                            $stmt_select_product_name->execute();
                                            $result_product_name = $stmt_select_product_name->get_result();
                                            $row_product_name = $result_product_name->fetch_assoc();
                                            get_all_products_offers(
                                                $row_products_offers['product_id'],
                                                $row_product_name['name'],
                                                $row_products_offers['old_price'],
                                                $row_products_offers['new_price'],
                                                $row_products_offers['offer_percentage'],
                                                $row_products_offers['offer_begin_date'],
                                                $row_products_offers['offer_end_date'],
                                                $row_products_offers['last_modified_by'],
                                                $row_products_offers['last_modified_on']
                                            );
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- adding new product offer form -->
            <div id="add_product_offer_form" class="modal">
                <span onclick="CloseAddProductOffer()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content" action="offers-admin.php" method="POST" enctype="multipart/form-data">
                    <div class="container">
                        <h1 class="title">Add New Product Offer</h1>
                        <br>
                        <p class="title">Please fill in this form to add a new product offer</p>
                        <br>

                        <select name="product_name" id="product_name">
                            <?php
                            $stmt_select_products_names = $connection->prepare("SELECT name FROM products");
                            $stmt_select_products_names->execute();
                            $results_products_names = $stmt_select_products_names->get_result();
                            while ($row_products_names = $results_products_names->fetch_assoc()) {
                                get_all_products_names_for_add_product_offer_form($row_products_names['name']);
                            }
                            ?>
                        </select>

                        <label for="product_price">
                            <b>Product Price</b>
                        </label>
                        <br>
                        <input style="height: 35px;" type="number" placeholder="Enter product's price" name="product_price" id="product_price" value="" required>
                        <br><br>

                        <label for="product_type">
                            <b>Product Type</b>
                        </label>
                        <br>

                        <label for="product_category">
                            <b>Product Category</b>
                        </label>
                        <br>

                        <label for="product_desciption">
                            <b>Desciption</b>
                        </label>
                        <input type="text" title="Enter product's desciption" placeholder="Enter product's desciption" name="product_desciption" id="product_desciption" value="" required>

                        <label for="product_age">
                            <b>Age Restriction</b>
                        </label>
                        <input type="text" title="Enter product's age restriction" placeholder="Enter product's age restriction" name="product_age" id="product_age" value="" required>

                        <label for="product_inventory">
                            <b>Current Inventory:</b>
                        </label>
                        <br>
                        <input type="number" title="Enter product's current inventory in stock" placeholder="Enter product's current inventory in stock" name="product_inventory" id="product_inventory" style="height: 35px;" value="" required>

                        <br>
                        <br>

                        <label for="product_sales">
                            <b>Current Sales Number:</b>
                        </label>
                        <br>

                        <input type="number" title="Enter product's current sales number (if any, else 0)" placeholder="Enter product's current sales number (if any, else 0)" name="product_sales" id="product_sales" style="height: 35px;" value="" required>

                        <br>
                        <br>

                        <label>
                            <b>Upload Product Image:</b>
                        </label>
                        <input type="file" title="Choose from your files an image for the product" name="product_image" id="product_image" value="" required>
                        <br>

                        <div class="clearfix">
                            <button type="submit" class="addproductbtn" title="Add new product">
                                <strong>Add Product</strong>
                            </button>
                        </div>
                    </div>
                </form>
            </div>



            <!-- form of price history for product -->
            <div id="price-history" class="modal">
                <span onclick="CloseProductHistoryPrices()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content">
                    <div class="container">
                        <h1 class="title">Product Prices History</h1>
                        <p class="title">Showing Prices History for product <?php echo $row_get_product['name']; ?></p>
                        <br>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" id="product_prices_history_table">
                                    <thead>
                                        <tr>
                                            <td id="product-price-column" title="Sort Price by descending">Price</td>
                                            <td id="product-price-change-column" title="Sort Price Change by descending">Price Change</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Modified On</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['product_id']) && isset($_GET['price_history'])) {
                                            while ($row_product_prices_history = $result_history_product_prices->fetch_assoc()) {
                                                get_all_product_history_prices(
                                                    $row_product_prices_history['price'],
                                                    $row_product_prices_history['price_change'],
                                                    $row_product_prices_history['modified_by'],
                                                    $row_product_prices_history['modified_on']
                                                );
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <!-- form of inventory history for product -->
            <div id="inventory-history" class="modal">
                <span onclick="CloseProductHistoryInventory()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content">
                    <div class="container">
                        <h1 class="title">Product Inventory History</h1>
                        <p class="title">Showing Inventory History for product <?php echo $row_get_product['name']; ?></p>
                        <br>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" id="product_inventory_history_table">
                                    <thead>
                                        <tr>
                                            <td id="product-inventory-column" title="Sort Inventory by descending">Inventory</td>
                                            <td id="product-inventory-change-column" title="Sort Inventory Change by descending">Inventory Change</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Modified On</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['product_id']) && isset($_GET['inventory_history'])) {
                                            while ($row_product_inventory_history = $result_product_history_inventory->fetch_assoc()) {
                                                get_all_product_history_inventory(
                                                    $row_product_inventory_history['inventory'],
                                                    $row_product_inventory_history['inventory_change'],
                                                    $row_product_inventory_history['modified_by'],
                                                    $row_product_inventory_history['modified_on']
                                                );
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <!-- form of sales history for product -->
            <div id="sales-history" class="modal">
                <span onclick="CloseProductHistorySales()" class="close" title="Close Modal">&times;</span>
                <form class="modal-content">
                    <div class="container">
                        <h1 class="title">Product Sales History</h1>
                        <p class="title">Showing Sales History for product <?php echo $row_get_product['name']; ?></p>
                        <br>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%" id="product_sales_history_table">
                                    <thead>
                                        <tr>
                                            <td id="product-sales-column" title="Sort Sales by descending">Sales</td>
                                            <td id="product-sales-change-column" title="Sort Sales Change by descending">Sales Change</td>
                                            <td id="product-last-modified-by-column" title="Sort Last Modified By by descending">Modified By</td>
                                            <td id="product-last-modified-on-column" title="Sort Last Modified On by descending">Modified On</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['product_id']) && isset($_GET['sales_history'])) {
                                            while ($row_product_sales_history = $result_product_history_sales->fetch_assoc()) {
                                                get_all_product_history_sales(
                                                    $row_product_sales_history['sales_number'],
                                                    $row_product_sales_history['sales_change'],
                                                    $row_product_sales_history['modified_by'],
                                                    $row_product_sales_history['modified_on']
                                                );
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- started return to top button -->
    <button onclick="ReturnToTop()" id="TopBtn" title="Return to Top"><i class="fa fa-arrow-up"></i></button>
    <!-- ended return to top button -->

</body>

<script src="offers-admin.js"></script>
<script src="../admin-main/admin-main.js"></script>
<script>
    const array_products = [];
    const array_products_count = [];
    <?php
    //get lowest products 
    $query_lowest_selling_products = "SELECT name, sales_number FROM products ORDER BY sales_number ASC LIMIT 5;";
    $stmt_lowest_selling_products = $connection->prepare($query_lowest_selling_products);
    $stmt_lowest_selling_products->execute();
    $results_lowest_selling_products = $stmt_lowest_selling_products->get_result();
    while ($row_lowest_selling_products = $results_lowest_selling_products->fetch_assoc()) {
    ?>
        array_products.push("<?php
                                echo $row_lowest_selling_products['name'];
                                ?>");
        array_products_count.push("<?php
                                    echo $row_lowest_selling_products['sales_number'];
                                    ?>");
    <?php }
    ?>;
    var xArray = array_products;
    var yArray = array_products_count;

    var data = [{
        x: xArray,
        y: yArray,
        type: "bar"
    }];

    var layout = {
        title: "Lowest Selling Products"
    };

    Plotly.newPlot("myPlot", data, layout);

    const array_products2 = [];
    const array_products_count2 = [];
    <?php
    //get lowest products 
    $query_highest_selling_products = "SELECT name, sales_number FROM products ORDER BY sales_number DESC LIMIT 5";
    $stmt_highest_selling_products = $connection->prepare($query_highest_selling_products);
    $stmt_highest_selling_products->execute();
    $results_highest_selling_products = $stmt_highest_selling_products->get_result();
    while ($row_highest_selling_products = $results_highest_selling_products->fetch_assoc()) {
    ?>
        array_products2.push("<?php
                                echo $row_highest_selling_products['name'];
                                ?>");
        array_products_count2.push("<?php
                                    echo $row_highest_selling_products['sales_number'];
                                    ?>");
    <?php }
    ?>;
    var xArray2 = array_products2;
    var yArray2 = array_products_count2;

    var data2 = [{
        x: xArray2,
        y: yArray2,
        type: "bar"
    }];

    var layout2 = {
        title: "Highest Selling Products"
    };

    Plotly.newPlot("myPlot2", data2, layout2);

    //for type bar chart

    const array_products_top = [];
    const array_products_count_top = [];
    <?php
    if (isset($results_top_products)) {
        while ($row_top_products = $results_top_products->fetch_assoc()) {
    ?>
            array_products_top.push("<?php
                                        echo $row_top_products['name'];
                                        ?>");
            array_products_count_top.push("<?php
                                            echo $row_top_products['sales_number'];
                                            ?>");
    <?php }
    }
    ?>;
    var xArray = array_products_count_top;
    var yArray = array_products_top;

    var data = [{
        x: xArray,
        y: yArray,
        type: "bar",
        orientation: "h",
        marker: {
            color: "green"
        }
    }];

    var layout = {
        title: "Top products being sold"
    };

    //second chart which is the lowest

    //pie chart of Type
    const array_types = [];
    const array_types_count = [];
    <?php
    //get all product types
    $stmt_get_all_product_types = $connection->prepare("SELECT * FROM product_types");
    $stmt_get_all_product_types->execute();
    $result_product_types = $stmt_get_all_product_types->get_result();
    while ($row_product_types = $result_product_types->fetch_assoc()) {
    ?>
        array_types.push("<?php
                            echo $row_product_types['type'];
                            ?>");
        <?php
        //check all products who have type "type"
        $query_product_types_count = "SELECT COUNT(*) as products_same_type_count FROM products WHERE type = '" . $row_product_types['type'] . "'";
        $stmt_product_types_count = $connection->prepare($query_product_types_count);
        $stmt_product_types_count->execute();
        $results_product_types_count = $stmt_product_types_count->get_result();
        $row_product_types_count = $results_product_types_count->fetch_assoc();

        ?>;
        array_types_count.push("<?php
                                echo $row_product_types_count['products_same_type_count'];
                                ?>");
    <?php }
    ?>;
    var xValues = array_types;
    var yValues = array_types_count;
    var random_colors = [];

    const size = array_types.length;

    function getNewColor(start) {
        for (var i = start; i < size; i++) {
            const random = "#" + Math.floor(Math.random() * (255 + 1));
            if (random_colors.values != random) {
                random_colors.push(random);
            } else {
                getNewColor(i);
            }
        }
    }
    getNewColor(0);

    var barColors = random_colors;
    new Chart("TypeChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Distribution of Products by Type"
            }
        }
    });

    //pie chart of Category
    const array_categories = [];
    const array_categories_count = [];
    <?php
    //get all product types
    $stmt_get_all_product_categories = $connection->prepare("SELECT * FROM product_categories");
    $stmt_get_all_product_categories->execute();
    $result_product_categories = $stmt_get_all_product_categories->get_result();
    while ($row_product_categories = $result_product_categories->fetch_assoc()) {
    ?>
        array_categories.push("<?php
                                echo $row_product_categories['category'];
                                ?>");
        <?php
        //check all products who have category "category"
        $query_product_categories_count = "SELECT COUNT(*) as products_same_category_count FROM products WHERE category = '" . $row_product_categories['category'] . "'";
        $stmt_product_categories_count = $connection->prepare($query_product_categories_count);
        $stmt_product_categories_count->execute();
        $results_product_categories_count = $stmt_product_categories_count->get_result();
        $row_product_categories_count = $results_product_categories_count->fetch_assoc();

        ?>;
        array_categories_count.push("<?php
                                        echo $row_product_categories_count['products_same_category_count'];
                                        ?>");
    <?php }
    ?>;
    var xValues2 = array_categories;
    var yValues2 = array_categories_count;
    var random_colors = [];

    const size2 = array_categories.length;

    function getNewColor2(start) {
        for (var i = start; i < size2; i++) {
            const random = "#" + Math.floor(Math.random() * (255 + 1));
            if (random_colors.values != random) {
                random_colors.push(random);
            } else {
                getNewColor2(i);
            }
        }
    }
    getNewColor2(0);

    var barColors = random_colors;
    new Chart("CategoryChart", {
        type: "bar",
        data: {
            labels: xValues2,
            datasets: [{
                backgroundColor: barColors,
                data: yValues2
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: "Distribution of Products by Category"
            }
        }
    });
</script>

</html>