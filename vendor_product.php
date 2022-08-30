<?php
    session_start();
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
                    <a href="#" class="nav_pc_item__profile">
                        <img src="./assets/img/user.png" alt="">
                    </a>
                </li>
            </ul>
        </nav>

    </header>

    <!-- Main section -->

    <main>
        <h1>My Product</h1>

        <table border=1px class="vendor_product_list">
            <thead>
                <th>Product Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <!-- <th>Delete</th> -->
            </thead>

            <tbody>
                <?php
                    if (!empty($_SESSION['products'])) {
                        
                    
                foreach($_SESSION['products'] as $product) {
                    $image = $product['image'];
                    $name = $product['name'];
                    $price = $product['price'];
                    $desc = $product['desc'];
                    echo "<tr>";
                    echo    "<td><img class=\"vendor_product__img\" src=\"./uploaded_image/$image\" alt=\"Product image\"></td>";
                    echo "<td>$name</td>";
                    echo "<td>$price</td>";
                    echo "<td>$desc</td>";
                    echo "</tr>";
                }
                
                    } else {
                        echo "<span class=\"vendor_no_product\"> No product added </span>";
                    };
                ?>

            </tbody>

        </table>
        <!-- <td><button><input type="hidden" name="delete">Delete</button></td> -->
    </main>
</body>
</html>