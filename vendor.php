<?php


    session_start();
    if(isset($_POST['add_product'])) {
        $product = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'desc' => $_POST['desc'],
            'image' => $_FILES['image']['name'],
            'image_size' => $_FILES['image']['size'],
            // 'image_folder' => '../uploaded_img/'.$img,
          ];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploaded_image/".$_FILES['image']['name']);                
        $_SESSION['products'][] = $product;
        echo "<script>alert(\"Item added successfully\")</script>";
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

    <!-- Add section -->
    <div class="add_product">
        <h2 class="add_product__title">
            Add Product
        </h2>
        <form action="vendor.php" method="post" enctype="multipart/form-data" id="add_form">
            <div class="add_container">
                <div class="add_item">
                    <span class="add_desc">Product name</span>
                    <input type="text" required maxlength="20" placeholder="Please input product's name" name="name" class="add_box">
                </div>
                <div class="add_item">
                    <span class="add_desc">Price</span>
                    <input type="number" required min="0" max="9999999" placeholder="Please input the price" name="price" class="add_box">
                </div>
                <!-- <div class="add_item">
                    <span class="add_desc">Category</span>
                    <select name="category" id="category" class="add_box">
                        <option value="sport">Sport</option>
                        <option value="techno">Techno</option>
                        <option value="book">Book</option>
                        <option value="toy">Toy</option>
                        <option value="food">Food</option>
                        <option value="clothes">Clothes</option>
                        <option value="computer">Computer</option>
                        <option value="ram">RAM</option>
                    </select>
                </div> -->
                <div class="add_item">
                    <span class="add_desc">Product image</span>
                    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required class="add_box">
                </div>
                <div class="add_item">
                    <span class="add_desc">Description</span>
                    <input type="text" maxlength="500" required placeholder="Please input the description" name="desc" class="add_box">
                </div>
                <br>
                <br>
                <div class="add_item">
                    <input type="submit" value="add_product" name="add_product">
                </div>
            </div>
        </form>

        

    </div>


    </main>



</body>
</html>