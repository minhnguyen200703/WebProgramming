<?php
session_start();

function read_and_filter() {
  $file_name = 'products.csv';
  $fp = fopen($file_name, 'r');
  // first row => field names
  $first = fgetcsv($fp);
  $products = [];
  while ($row = fgetcsv($fp)) {
    $i = 0;
    $product = [];
    foreach ($first as $col_name) {
      $product[$col_name] =  $row[$i];
      // treat sizes differently
      // make it an array
      if ($col_name == 'sizes') {
        $product[$col_name] = explode(',', $product[$col_name]);
      }
      $i++;
    }
    if (isset($_GET['min_price']) && is_numeric($_GET['min_price'])){
        if ($product['price'] < $_GET['min_price']) {
            continue;
        }
    }
    if (isset($_GET['max_price']) && is_numeric($_GET['max_price'])){
        if ($product['price'] > $_GET['max_price']) {
            continue;
        }
    }
    if (isset($_GET['name']) && !empty($_GET['name'])){
        if (strpos($product['name'], $_GET['name'])=== false) {
            continue;
        }
    }
    if (isset($_GET['']) && is_array($_GET[''])){
        $containAll=true;
        foreach ($_GET[''] as $) {
            $containAll=false;
            break;
        }
    }
    if (!$containAll) {
        continue;
    }
    $products[] = $product;
  }
  // overwrite the session variable
  $_SESSION['products'] = $products;
}

if (isset($_SESSION['products'])) {
  echo '<pre>';
  print_r($_SESSION['products']);
  echo '</pre>';
}

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
    <main>
        <form method="get" action="cus_product.php">
            <select>
                <option>Desc Price</option>
            </select>


        </form>

    </main>
</body>

</html>