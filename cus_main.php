<?php
  session_start();

//    Check if logged in

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    } else {
        header("Location: index.php"); 
        exit();
    }

//   Write down order

    if(isset($_GET['cart'])){
        $cart = $_GET['cart'];
        $username = $_GET['user'];
        $hub = $_GET['hub'];
        $address = $_GET['address'];
        $order = [];
        array_push($order, $cart, $username, $hub, "active", $address);
        $file = json_decode(file_get_contents('./assets/storage/order.json'),true);
        $file[] = $order;
        file_put_contents('./assets/storage/order.json', json_encode($file));
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
        <div class="brand">
            <img src="assets/img/logo.png" alt="" class="brand__logo">
            <p class="brand__text">Zalada</p>
        </div>
        <nav>
            <ul class="nav_pc_container">
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">About</a>
                </li>
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">Policies</a>
                </li>
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">Help</a>
                </li>
                <li class="nav_pc_item">
                    <a href="#" class="nav_pc_item__link">Contact</a>
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
                            <a href="index.php">Log out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
        <!-- Main section -->
    <main>
            <!-- Search and Filtering -->
        <!-- <div class="search_container">
            <div class="search_box">
                <div class="search_btn"><i class="fas fa-search"></i></div>
                <input type="text" class="input_search" placeholder="What are you looking for?">
            </div>
        </div> -->

        <!-- Search and filtering -->

        

        <div class="main_header">
            <h3>Tất cả sản phẩm</h3>

            <div class="search_and_filtering">
                <form method="get" action="cus_main.php">
                    Min Price <input type="number" name="min_price"><br>
                    Max Price <input type="number" name="max_price"><br>
                    Name <input type="text" name="name"><br>
                    <br>
                    <input type="submit" name="act" value="Filter">
                </form>
            </div>

            <div class="shopping_cart">
                <a href="cus_cart.php">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <!-- Product list -->

        <div class="product_list">
            
            <div class="product_list_container">
                
                <?php
                    $products = json_decode(file_get_contents("./assets/storage/product.json"), true);
                    
                    if (!empty($products)) {
                        $count = 0;
                        foreach($products as $product) {
                            if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])) {
                                if ($product['price'] < $_GET['min_price']) {
                                    $count ++;
                                continue;
                                }
                            }
                            if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])) {
                                if ($product['price'] > $_GET['max_price']) {
                                    $count ++;
                                continue;
                                }
                            }
                            if (isset($_GET['name']) && !empty($_GET['name'])) {
                                if (strpos($product['name'], $_GET['name']) === false) {
                                    $count ++;
                                continue;
                                }
                            }
                            $image = $product['image'];
                            $name = $product['name'];
                            $price = $product['price'];
                            $desc = $product['desc'];
                            echo "<a href=\"cus_product.php?name=$name \" class=\"product_list__item\">";
                            echo "<div class=\"product_list__item_price\">";
                            echo    "<h2>$price</h2>";
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
                        if ($count == count($products)) {
                            echo "<span class=\"no_product\"> No product added </span>";
                        }
                    } else {
                        echo "<span class=\"no_product\"> No product added </span>";
                    };
                ?>
               

                
                
                
            </div>

        </div>

    </main>
    <script>
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