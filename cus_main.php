<?php
  session_start();

//    Check if logged in

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    } else {
        header("Location: ./www/index.php"); 
        exit();
    }

//   Write down order

    if(isset($_GET['cart'])){
        // Get value from url by $_GET method
        $cart = $_GET['cart'];
        $username = $_GET['user'];
        $hub = $_GET['hub'];
        $address = $_GET['address'];

        // Push all data to an array
        $order = [];
        array_push($order, $cart, $username, $hub, "active", $address);

        // Take the file out, decode to get an array, append new order, encode and write back to file
        $file = json_decode(file_get_contents('./assets/storage/order.json'),true);
        $file[] = $order;
        file_put_contents('./assets/storage/order.json', json_encode($file));
        // Unset data
        unset($cart, $username, $hub);
    };
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azada</title>

    <!-- Font families -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Hachi+Maru+Pop&family=Hubballi&family=Inter:wght@300;400;500;600;700;800&family=Kalam:wght@700&family=Montserrat:wght@254&family=Open+Sans:wght@326;379&family=Permanent+Marker&family=Poppins:wght@100&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,700&family=Rubik+Glitch&display=swap');
    </style>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/cus.css">
</head>
<body>
    <!-- Header section -->
    <header>

        <!-- Logo -->
        <div class="brand">
            <img src="assets/img/logo.png" alt="" class="brand__logo">
            <p class="brand__text">Zalada</p>
        </div>

        <!-- Nav bar -->
        <nav>
            <ul class="nav_pc_container">
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">About</a>
                </li>
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">Policies</a>
                </li>
                <li class="nav_pc_item">
                    <img src="<?php echo $_SESSION['user']['avatar']?>" alt="" class="nav_pc_item__avt">
                    <ul class="account-setting-container hide">
                        <li>
                            <h3>Hi <?php echo $_SESSION['user']['real_name'] ?></h3>
                        </li>
                        <li class="account-setting-item">
                            <a href="my_account.php">My account</a>
                        </li>
                        <li class="account-setting-item">
                            <a href="./www/index.php">Log out</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h1><?php echo $_SESSION['user']['real_name'] ?></h1>
                </li>

            </ul>
        </nav>

    </header>

        <!-- Main section -->
    <main>

        
        
        <!-- Main header -->
        <div class="main_header">
            <h3>Tất cả sản phẩm</h3>
            
                <!-- Search and filtering -->
            <div class="search_and_filtering">
                <form method="get" action="cus_main.php">
                    Min Price <input class="filtering_price_data" type="number" name="min_price"><br>
                    Max Price <input class="filtering_price_data" type="number" name="max_price"><br>
                    Name <input class="search_bar" type="text" name="name"><br>
                    <br>
                    <input class="filter_submit_btn" type="submit" name="act" value="Filter">
                </form>
            </div>

                <!-- Shopping cart -->
            <div class="shopping_cart">
                <a href="cus_cart.php">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <!-- Product list -->

        <div class="product_list">
            
            <div class="product_list_container">
                    <!-- Render all data for every product in product.json -->
                <?php
                    // Get the content and decode json file
                    $products = json_decode(file_get_contents("./assets/storage/product.json"), true);
                    // Check if empty
                    if (!empty($products)) {
                        // The count variable to check if no product satisfied the filter/search condition
                        $count = 0;
                            // Loop each product from $products contain all product data
                        foreach($products as $product) {
                                // Check if min value is entered or not
                            if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
                                // If yes, Check if the product's price is lower than minprice then continue, skip this product and add 1 to count
                                if ($product['price'] < $_GET['min_price']) {
                                    $count ++;
                                continue;
                                }
                            }
                                // Check if max value is entered or not
                            if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
                                // If yes, Check if the product's price is higher than maxprice then continue, skip this product and add 1 to count
                                if ($product['price'] > $_GET['max_price']) {
                                    $count ++;
                                continue;
                                }
                            }
                            // Check if name value is entered or not
                            if (isset($_GET['name']) && !empty($_GET['name'])) {
                                // Check if the product name equal to the search value, if not then skip this product and add 1 to count
                                if (strpos($product['name'], $_GET['name']) === false) {
                                    $count ++;
                                continue;
                                }
                            }

                            // If there is no filter and search value, or the product satisfy all the filter and search value, take the value and render the product 
                            $image = $product['image'];
                            $name = $product['name'];
                            $price = $product['price'];
                            $desc = $product['desc'];
                            // The a href will link to the cus_product with url appended with name value of the product
                            echo "<a href=\"cus_product.php?name=$name \" class=\"product_list__item\">";
                            echo "<div class=\"product_list__item_price\">";
                            echo    "<h2>$$price</h2>";
                            echo "</div>";
                            echo "<div class=\"product_list__item_img\">";
                            echo    "<img src=\"./assets/product_img/$image\" alt=\"Product's image\">";
                            echo "</div>";
                            echo "<div class=\"product_list__item_name\">";
                            echo     "<h1>$name</h1>";
                            echo "</div>";
                            echo "<div class=\"product_list__item_desc\">";
                            echo    "<p>$desc</p>";
                            echo "</div>";
                            echo "<div class=\"product_list__item_buybtn\">";
                            echo     "<button class=\"form_field__label btn-hover color-9\">";
                            echo         "Add to cart";
                            echo     "</button>";
                            echo "</div>";
                            echo    "</a>";
                        }

                        // If the count, the number of NOT SHOWN product, equal to the total number of product aka there is no satisfied product, show No product added
                        if ($count == count($products)) {
                            echo "<span class=\"no_product\"> No product satisfied the search and filter </span>";
                        }
                    } else {
                        // If the data in json file empty, show No product added
                        echo "<span class=\"no_product\"> No product added </span>";
                    };
                ?>         
                
            </div>

        </div>

    </main>

    <!-- Footer section -->

    <footer>

    </footer>


    <script>

            // Open the Accouunt setting subnav bar
        var avatarElement = document.querySelector('.nav_pc_item__avt');
        var accountSetting = document.querySelector('.account-setting-container');

        avatarElement.onclick = function() {
            if (accountSetting.classList.contains('hide')) {
                accountSetting.classList.remove('hide');
            } else {
                accountSetting.classList.add('hide');
            }
    }
    </script>       
</body>

</html>