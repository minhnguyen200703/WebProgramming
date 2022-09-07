<?php
    // Function to check if name value equal to value from GET from url
    function name_check($arr) { 
        return $arr["name"] == $_GET['name']; 
    };

    session_start();
    ob_start();

    // Check if logged in
    
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
        header("Location: ./www/index.php"); 
        exit();
    };

        // Take the value out from json file
    $products = json_decode(file_get_contents("./assets/storage/product.json"), true);
    // Slice 1 value from product if the name equal to data in url
    $t_product = array_slice(array_filter($products, "name_check"), 0, 1);
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
    
        <div class="main_header">
        <!-- Back to cus_main -->
            <div class="cus_back_to_main">
                <a href="./cus_main.php" class="cus_back_to_main__btn"><i class="fa-solid fa-chevron-left"></i>Back</a>
            </div>
            <!-- Shopping cart -->
            <div class="shopping_cart">
                    <a href="cus_cart.php">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </a>
        </div>

    </div class="cus_detail_product_container">
        <?php
            $image = $t_product[0]['image'];
            $name = $t_product[0]['name'];
            $price = $t_product[0]['price'];
            $desc = $t_product[0]['desc'];
            echo "<div class=\"detail_product_list__item\">";
            echo "<div class=\"detail_product_list__item_price\">";
            echo    "<h2>$$price</h2>";
            echo "</div>";
            echo "<div class=\"detail_product_list__item_img\">";
            echo    "<img src=\"./assets/product_img/$image\" alt=\"Product's image\">";
            echo "</div>";
            echo "<div class=\"detail_product_list__item_name\">";
            echo     "<h1>$name</h1>";
            echo "</div>";
            echo "<div class=\"detail_product_list__item_desc\">";
            echo    "<p>$desc</p>";
            echo "</div>";
            echo "<div class=\"detail_product_list__item_add\">";
            echo     "<button onclick=\"addProduct()\">Add to cart </button>";
            echo "</div>";
            echo  "</div>";
        ?>

    </main>

    <script>
            // Add product to cart in LOCAL STORAGE
        var cart = []

    function addProduct() {
        // Take the data in cart in LOCAL STORAGE
        let storage = localStorage.getItem('cart')
        if (storage) {
            cart = JSON.parse(storage)
            }
        
            // Take all data of the product by query selector and innerHTML
        var productName = document.querySelector('.detail_product_list__item_name h1').innerHTML;
        var productPrice = document.querySelector('.detail_product_list__item_price h2').innerHTML;
        var productDetail = document.querySelector('.detail_product_list__item_desc p').innerHTML;
        var image = document.querySelector(".detail_product_list__item_img img").src;
        // Append to product object
        var product = {
            name: productName,
            price: productPrice,
            detail: productDetail,
            image: image,
            }

            // Check if the product already exists in the cart or not
        let item = cart.find(c => c.product.name == productName)
        if (item) {
            // If yes, increase the quantity instead
            item.quantity += 1
            // If not, push the product with quantity equal to 1
            } else {
            cart.push({product, quantity:1})
            }

            // Add the new cart array into LOCAL STORAGE
        localStorage.setItem('cart', JSON.stringify(cart))

            // Alert Added
        alert('Added to cart')
}
    </script>

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