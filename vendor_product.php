<?php
    session_start();
    ob_start();

    // Check if logged in
    
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
        header("Location: ./www/index.php"); 
        exit();
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
    <link rel="stylesheet" href="./assets/css/vendor.css">
</head>
<body>
     <!-- Header section -->
     <header>

            <!-- Logo -->
        <div class="brand">
            <img src="assets/img/logo.png" alt="" class="brand__logo">
            <p class="brand__text">Zalada</p>
        </div>

            <!-- Navigation bar -->
        <nav>
            <ul class="nav_pc_container">
                <li class="nav_pc_item">
                    <a href="./about.html" class="nav_pc_item__link">About</a>
                </li>
                <li class="nav_pc_item">
                    <a href="./privacy_policies.html" class="nav_pc_item__link">Policies</a>
                </li>

                <!-- User -->
                <li class="nav_pc_item">
                    <img src="<?php echo $_SESSION['user']['avatar']?>" alt="User's avatar" class="nav_pc_item__avt">
                    <ul class="account-setting-container hide">
                        <li>
                            <h3>Hi <?php echo $_SESSION['user']['business_name'] ?></h3>
                        </li>
                        <li class="account-setting-item">
                            <a href="my_account.php">My account</a>
                        </li>
                        <li class="account-setting-item">
                            <a href="./www/index.php">Log out</a>
                        </li>
                    </ul>
                </li>
                <li class="nav_pc_item">
                    <h1><?php echo $_SESSION['user']['business_name'] ?></h1>
                </li>
            </ul>
        </nav>
    </header>
    <!-- Main section -->
    <main>

        <!-- Back to Vendor main section -->
        <div class="vendor_back_to_main">
            <a href="./vendor_main.php" class="vendor_back_to_main__btn"><i class="fa-solid fa-chevron-left"></i>Back</a>
        </div>


        <h1>My Product</h1>

        <table border=1px class="vendor_product_list">
            <thead>
                <th>Product Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
            </thead>

            <tbody>
                <!-- Insert data of each product for each row in the table <tbody> -->
                <?php
                    // Take the data out from product.json and decode 
                    $products = json_decode(file_get_contents("./assets/storage/product.json"), true);

                        // Check if array emtpy
                    if (!empty($products)) {

                            // If not empty
                        // Loop each element in $products to take each data of each product 
                        foreach($products as $product) {
                            // Compare the username of who added the product with the current username
                            if ($product['username'] == $_SESSION['user']['username']) {
                                // If the same, take the data out and add new row; if not, next
                            $image = $product['image'];
                            $name = $product['name'];
                            $price = $product['price'];
                            $desc = $product['desc'];
                            echo "<tr>";
                            echo    "<td><img class=\"vendor_product__img\" src=\"./assets/product_img/$image\" alt=\"Product image\"></td>";
                            echo "<td>$name</td>";
                            echo "<td>$price</td>";
                            echo "<td>$desc</td>";
                            echo "</tr>";
                }}} else {
                            // If empty show No product added
                        echo "<span class=\"vendor_no_product\"> No product added </span>";
                    };
                ?>

            </tbody>

        </table>
    </main>

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