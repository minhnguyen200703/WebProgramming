<<<<<<< Updated upstream <?php
    function test($arr) { 
        return $arr["name"] == $_GET['name']; 
    };
    session_start();
    $t_product = array_slice(array_filter($_SESSION['products'], "test"), 0, 1);


    if(isset($_POST['add_cart'])) {
        $cart = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'desc' => $_POST['desc'],
            'image' => $_FILES['image']['name'],
          ];
        $_SESSION['carts'][] = $product;
        echo "<script>alert(\"Added to cart\")</script>";
        };
?> <!DOCTYPE html>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
            integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                        <a href="#" class="nav_pc_item__profile">
                            <img src="./assets/img/user.png" alt="">
                        </a>
                    </li>
                </ul>
            </nav>

        </header>

        <!-- Main -->
        <?php
            $image = $t_product[0]['image'];
            $name = $t_product[0]['name'];
            $price = $t_product[0]['price'];
            $desc = $t_product[0]['desc'];
            echo "<div class=\"product_list__item\">";
            echo "<div class=\"product_list__item_price\">";
            echo    "<h2>$$price</h2>";
            echo "</div>";
            echo "<div class=\"product_list__item_img\">";
            echo    "<img src=\"./uploaded_image/$image\" alt=\"Product's image\">";
            echo "</div>";
            echo "<div class=\"product_list__item_name\">";
            echo     "<h1>$name</h1>";
            echo "</div>";
            echo "<div class=\"product_list__item_desc\">";
            echo    "<p>$desc</p>";
            echo "</div>";
            echo "<div class=\"product_list__item_add\">";
            echo     "<input type=\"submit\" value=\"Add to cart\" name=\"add_cart\">";
            echo "</div>";
            echo  "</div>";
        ?>
        <main>

        </main>
    </body>
    =======
    <?php
    function test($arr) { 
        return $arr["name"] == $_GET['name']; 
    };
    session_start();
    $t_product = array_slice(array_filter($_SESSION['products'], "test"), 0, 1);


    if(isset($_POST['add_cart'])) {
        $cart = [
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'desc' => $_POST['desc'],
            'image' => $_FILES['image']['name'],
          ];
        $_SESSION['carts'][] = $product;
        echo "<script>alert(\"Added to cart\")</script>";
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
            integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                        <a href="#" class="nav_pc_item__profile">
                            <img src="./assets/img/user.png" alt="">
                        </a>
                    </li>
                </ul>
            </nav>

        </header>

        <!-- Main -->
        <?php
            $image = $t_product[0]['image'];
            $name = $t_product[0]['name'];
            $price = $t_product[0]['price'];
            $desc = $t_product[0]['desc'];
            echo "<div class=\"product_list__item\">";
            echo "<div class=\"product_list__item_price\">";
            echo    "<h2>$$price</h2>";
            echo "</div>";
            echo "<div class=\"product_list__item_img\">";
            echo    "<img src=\"./uploaded_image/$image\" alt=\"Product's image\">";
            echo "</div>";
            echo "<div class=\"product_list__item_name\">";
            echo     "<h1>$name</h1>";
            echo "</div>";
            echo "<div class=\"product_list__item_desc\">";
            echo    "<p>$desc</p>";
            echo "</div>";
            echo "<div class=\"product_list__item_add\">";
            echo     "<button onclick=\"test1\">Add to cart </button>";
            echo "</div>";
            echo  "</div>";
            echo "<button onclick=\"addProduct()\">Add to cart </button>";
        ?>
        <main>

        </main>

        <script>
        var cart = []

        function addProduct() {
            let storage = localStorage.getItem('cart')
            if (storage) {
                cart = JSON.parse(storage)
            }

            var productName = document.querySelector('.product_list__item_name h1').innerHTML;
            var productPrice = document.querySelector('.product_list__item_price h2').innerHTML;
            var productDetail = document.querySelector('.product_list__item_desc p').innerHTML;
            var image = document.querySelector(".product_list__item_img img").src;
            var product = {
                name: productName,
                price: productPrice,
                detail: productDetail,
                image: image,
            }

            let item = cart.find(c => c.product.name == productName)
            if (item) {
                item.quantity += 1

            } else {
                cart.push({
                    product,
                    quantity: 1
                })
            }
            localStorage.setItem('cart', JSON.stringify(cart))
            alert('Added to cart')
        }
        </script>

    </body>
    >>>>>>> Stashed changes

    </html>