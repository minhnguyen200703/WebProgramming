<?php
    session_start();
    ob_start();

// Check if logged in
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == false) {
        header("Location: index.php"); 
        exit();
    };

    $hub_user = $_SESSION['user']['distribution_hub'];

    
    $file_name = './assets/storage/hubs.db';
    $fp = fopen($file_name, 'r');
    // first row => field names
    while ($row = fgetcsv($fp)) {
        if ($row[1] == $hub_user) {
            $hub_id = $row[0];
        }
    };

;?>

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

    <!-- Main -->

    <main>
        
    <div class="hub_info">
        <h2>
            Hub name: <?php echo $hub_user?>
        </h2>
    </div>

    <div class="shipper_product_display">
        <table border=1px class="cus_cart_list">
                    <thead>
                        <th>No</th>
                        <th>Order by</th>
                        <th>Access</th>
                    </thead>

                    <tbody class="cus_cart_body">  
                        <?php
                            $order = json_decode(file_get_contents("./assets/storage/order.json"), true);
                            $index = 0;
                            if (is_null($order)) {
                                print_r('There is no order');
                            } else {
                            foreach ($order as $key => $orderDetail) {
                                if ($orderDetail[3] == "active") {
                                if ($hub_id == $orderDetail[2]) {
                                    ++$index;

                                    echo "
                                    <tr>
                                        <td>$index</td>
                                        <td>$orderDetail[1]</td>
                                        <td>
                                            <a href=\"shipper_detail.php?index=$key\">;
                                        </td>
                                    </tr>
                                    "
                                    ;
                                }
                            }}};
                        ?>
                    </tbody>
            </table>
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
