<?php
    session_start();

    // Check if logged in
    ob_start();
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
        header("Location: index.php"); 
        exit();
    };


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['add_product'])) {
            $product = [
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'desc' => $_POST['desc'],
                'image' => $_FILES['image']['name'],
                'username' => $_SESSION['user']['username'],
            ];
            
            move_uploaded_file($_FILES['image']['tmp_name'], "./assets/product_img/".$_FILES['image']['name']);   
            $file = json_decode(file_get_contents('./assets/storage/product.json'),true);
            $file[] = $product;
            file_put_contents('./assets/storage/product.json', json_encode($file));
            echo "<script>alert(\"Item added successfully\")</script>";
        }};
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
                    <img src="<?php echo $_SESSION['user']['avatar']?>" alt="" class="nav_pc_item__avt">
                    <ul class="account-setting-container hide">
                        <li>
                            <h3>Hi <?php echo $_SESSION['user']['business_name'] ?></h3>
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

    <!-- Add section -->
    <div class="add_product">
        <h2 class="add_product__title">
            Add Product
        </h2>
        <form action="vendor_add_product.php" method="post" enctype="multipart/form-data" id="add_form">
            <div class="add_container">
                <div class="add_item">
                    <span class="add_desc">Product name</span>
                    <input id="product_name" type="text" required placeholder="Please input product's name" name="name" class="add_box">
                    <span class="form_field__message"></span>
                </div>
                <div class="add_item">
                    <span class="add_desc">Price</span>
                    <input id="product_price" type="number" required placeholder="Please input the price" name="price" class="add_box">
                    <span class="form_field__message"></span>
                </div>
                <div class="add_item">
                    <span class="add_desc">Product image</span>
                    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required class="add_box">
                </div>
                <div class="add_item">
                    <span class="add_desc">Description</span>
                    <input id="product_desc" type="text" maxlength="500" required placeholder="Please input the description" name="desc" class="add_box">
                    <span class="form_field__message"></span>
                </div>
                <br>
                <br>
                <div class="add_item">
                    <input type="submit" value="add_product" name="add_product" id="submit_product_btn">
                </div>
            </div>
        </form>


    </div>


    </main>
    <script src="./assets/js/validator.js"></script>
    <script>
        var productName = document.querySelector("#product_name");
        var productPrice = document.querySelector("#product_price");
        var productDesc = document.querySelector("#product_desc");
        var submitButton = document.querySelector("#submit_product_btn");

        function addProductValidation() {
            var productNameValue = productName.value.trim();
            var productPriceValue = productPrice.value.trim();
            var productDescValue = productDesc.value.trim();
            var isValidProductName = false;
            var isValidProductPrice = false;
            var isValidProductDesc = false;

            // Validate product name
            if (!checkBetweenLength(productNameValue, 10, 20)) {
                showError(productName, "Name of product must be between 10 and 20 characters");
            } else {
                showSuccess(productName)
                isValidProductName = true;
            }

            // Validate product price
            if (!checkNumberPostitive(productPriceValue)) {
                showError(productPrice, "Price of product must be a positive number");
            } else {
                showSuccess(productPrice);
                isValidProductPrice = true;
            }

            // Validate product description
            if (!checkMaxLength(productDescValue)) {
                showError(productDesc, "Description of product must be at most 500");
            } else {
                showSuccess(productDesc);
                isValidProductDesc = true;
            }

            // If all fields satisfy the validation requirements, return true, otherwise return false
            if(isValidProductName && isValidProductPrice && isValidProductDesc) {
                return true
            }
            return false
        }
        
        submitButton.addEventListener('click', function(event) {
            let isValid = addProductValidation();
            if (!isValid) {
                event.preventDefault();
            }
        })
        

    </script>     
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