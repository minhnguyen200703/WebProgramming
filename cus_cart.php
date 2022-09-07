<?php
    session_start();
    ob_start();

    // Check if logged in
    
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
        header("Location: index.php"); 
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
    <link rel="stylesheet" href="./assets/css/cus.css">
</head>
<body>
    <!-- Header -->
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

        <!-- Main -->
    <main>
        <h2>Shopping cart</h2>
            <table border=1px class="cus_cart_list">
                    <thead>
                        <th>No</th>
                        <th>Product Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                    </thead>

                    <tbody class="cus_cart_body">  

                    </tbody>
            </table>
        <button class="checkout_btn">
            Check out
        </button>
        <button class="reset_card">Reset</button>        

    </main>

    <script>
        showCart()
    function showCart() {
        let cardBody = document.querySelector(".cus_cart_body")
        cardBody.innerHTML = "" 

        let storage = localStorage.getItem('cart')
        if (storage) {
            cart = JSON.parse(storage)
        } else {
            cardBody.innerHTML += `<span>There is no product here</span>`
        }
        cart.forEach((product, index) => {
            let productId = index
            index++

        cardBody.innerHTML += `
            <tr>
                <td>${productId + 1}</td>
                <td><img src="${product.product.image}" alt="Product's image"></td>
                <td>${product.product.name}</td>
                <td>${product.product.price}</td>
                <td>${product.quantity}</td>
                <td>${product.product.detail}</td>
                <td>
                    <a href="#" onclick="removeItem(${productId})">Remove</a>
                </td>
            </tr>
        `
        })
        
    };

    function random (maxValue) {
        return Math.floor(Math.random() * maxValue)
    }
    function orderSend () {
        let storage = (localStorage.getItem('cart'))
        let distributionHub = random(3)
        window.location.href = `http://localhost/WebProgramming/cus_main.php?cart=${storage}&user=<?php echo $_SESSION['user']['username'] ?>&hub=${distributionHub}&address=<?php echo $_SESSION['user']['address'] ?>`
        alert('Order placed. Thank you for your order!')
    }
    
    
    function removeItem(id) {
        let storage = localStorage.getItem('cart')
        if (storage) {
            cart = JSON.parse(storage)}
        // name = name.split('_').join(' ')
        console.log(cart)
        cart.splice(id, 1)
        localStorage.setItem('cart', JSON.stringify(cart))
        showCart()
        }
   
    document.querySelector(".reset_card").addEventListener("click", function () {
        localStorage.removeItem('cart')
        location.reload()
    })

    

    </script>
    <script>
            document.querySelector(".checkout_btn").addEventListener("click", orderSend)
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
