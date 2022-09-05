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
                    <a href="#" class="nav_pc_item__profile">
                        <img src="./assets/img/user.png" alt="">
                    </a>
                </li>
            </ul>
        </nav>

    </header>

        <!-- Main -->
    <main>
        <h2>Shopping cart</h2>
        <form action="">
            <table border=1px class="cus_cart_list">
                    <thead>
                        <th>Product Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Description</th>
                    </thead>

                    <tbody class="cus_cart_body">  

                    </tbody>
            </table>
            <input style="padding: 16px 24px; border: 1px solid #000;" type="submit" value="cart_add" name="cart_add">
        </form>
        <button class="checkout_btn">
            Check out
        </button>
        <button class="reset_card">12312321</button>        

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
        cart.map(item => {
            cardBody.innerHTML += `
                <tr>
                    <td><img src="${item.product.image}" alt="Product's image"></td>
                    <td>${item.product.name}</td>
                    <td>${item.product.price}</td>
                    <td>${item.quantity}</td>
                    <td>${item.product.detail}</td>
                    <td>
                        <button onclick="removeItem(${item.product.name})">Remove</button>
                    </td>
                </tr>
            `
        })
    };
    let storage = localStorage.getItem('cart')
    var order = []
    function orderSend () {
        window.location.href = `http://localhost/WebProgramming/cus_main.php?cart=${storage}`
        alert('Order placed. Thank you for your order!')
    }
    
    document.querySelector(".reset_card").addEventListener("click", function () {
        localStorage.removeItem('cart')
        location.reload()
    })

    function removeItem(name) {
        let storage = localStorage.getItem('cart')
        if (storage) {
            cart = JSON.parse(storage)
        cart = cart.filter(item => item.product.name != name)
        localStorage.setItem('cart', JSON.stringify(cart))
        // showCart(cart) 
        }}

    </script>

    <script>
            document.querySelector(".checkout_btn").addEventListener("click", orderSend)
    </script>
</body>
</html>
