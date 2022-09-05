<<<<<<< Updated upstream
<?php

  // Asc name comparison function
  function name_cmp($p1, $p2) {
    // use the built-in string comparison
    return strcmp($p1['name'], $p2['name']);
  }

   // Dsc name comparison function
   function dsc_name_cmp($p1, $p2) {
    // use the built-in string comparison
    return strcmp($p2['name'], $p1['name']);
  }

  // Asc price comparison function
  function price_cmp($p1, $p2) {
    return (int)$p1['price'] - (int)$p2['price'];
  }

  // Dsc price comparison function
  function dsc_price_cmp($p1, $p2) {
    return (int)$p2['price'] - (int)$p1['price'];
  }
  session_start();

  // mapping from selected values to comparison function names
  $mapping = [
    'name' => 'name_cmp',
    'price' => 'price_cmp',
    'dsc_name' => 'dsc_name_cmp',
    'dsc_price' => 'dsc_price_cmp'
  ];

  // by default: use name_cmp
  $selected_func = 'name_cmp';
  if (isset($_GET['compare_by']) && !empty($_GET['compare_by'])) {
    if (array_key_exists($_GET['compare_by'], $mapping)) {
      $selected_func = $mapping[$_GET['compare_by']];
    }
  }

  
//   usort($_SESSION['products'], $selected_func);
//   echo '<pre>';
//   print_r($_SESSION['products']);
//   echo '</pre>';
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
            <!-- Search bar -->
        <div class="search_container">
            <div class="search_box">
                <div class="search_btn"><i class="fas fa-search"></i></div>
                <input type="text" class="input_search" placeholder="What are you looking for?">
            </div>
        </div>

        <!-- Category -->

        <!-- <div class="category">
            <div class="category_container">
                <button onclick="filterSelection('Sport')" class="category_item">
                    Sport
                </button>
                <button onclick="filterSelection('Techno')" class="category_item">
                    Techno
                </button>
                <button onclick="filterSelection('Books')" class="category_item">
                    Books
                </button>
                <button onclick="filterSelection('Toys')" class="category_item">
                    Toys
                </button>
                <button onclick="filterSelection('Food')" class="category_item">
                    Food
                </button>
                <button onclick="filterSelection('Clothes')" class="category_item">
                    Clothes
                </button>
                <button onclick="filterSelection('Computer')" class="category_item">
                    Computer
                </button>
                <button onclick="filterSelection('RAM')" class="category_item">
                    RAM
                </button>
            </div>
        </div> -->

        <div class="main_header">
            <h3>Tất cả sản phẩm</h3>
            <div class="cus_filter">
                <select id="compare_by" name="compare_by">
                    <option value="">Select a sort condition</option>
                    <option value="name">Asc Name</option>
                    <option value="dsc_name">Dsc Name</option>
                    <option value="price">Asc Price</option>
                    <option value="dsc_price">Dsc Price</option>
                </select>
            </div>
        </div>

        <!-- Product list -->

        <div class="product_list">
            <div class="product_list_container">
                <?php
                    if (!empty($_SESSION['products'])) {
                        foreach($_SESSION['products'] as $product) {
                            $image = $product['image'];
                            $name = $product['name'];
                            $price = $product['price'];
                            $desc = $product['desc'];
                            echo "<a href=\"cus_product.php?name=$name \" class=\"product_list__item\">";
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
                            echo "<div class=\"product_list__item_buybtn\">";
                            echo     "<button class=\"form_field__label btn-hover color-9\">";
                            echo         "Add to cart";
                            echo     "</button>";
                            echo "</div>";
                            echo    "</a>";
                    }
                    } else {
                        echo "<span class=\"no_product\"> No product added </span>";
                    };
                ?>
               

                
                
                
            </div>

        </div>




    </main>

        <!-- Filtering feature -->
    <!-- <script>
            // Taken from w3school
            
        filterSelection("all")
        function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "all") c = "";
        // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
        for (i = 0; i < x.length; i++) {
            removeClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) addClass(x[i], "show");
        }
        }

        // Show filtered elements
        function addClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
            element.className += " " + arr2[i];
            }
        }
        }

        // Hide elements that are not selected
        function removeClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
        }

        // Add active class to the current control button (highlight it)
        var btnContainer = document.getElementById("myBtnContainer");
        var btns = btnContainer.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
        }
    </script> -->

    <script>
        let select_ele = document.querySelector("#compare_by");
        select_ele.addEventListener("change", function() {
            let selected_value = select_ele.value;
            location.href = "cus_main.php?compare_by=" + selected_value;
        });
    </script>
</body>

=======
<?php

  // Asc name comparison function
  function name_cmp($p1, $p2) {
    // use the built-in string comparison
    return strcmp($p1['name'], $p2['name']);
  }

   // Dsc name comparison function
   function dsc_name_cmp($p1, $p2) {
    // use the built-in string comparison
    return strcmp($p2['name'], $p1['name']);
  }

  // Asc price comparison function
  function price_cmp($p1, $p2) {
    return (int)$p1['price'] - (int)$p2['price'];
  }

  // Dsc price comparison function
  function dsc_price_cmp($p1, $p2) {
    return (int)$p2['price'] - (int)$p1['price'];
  }
  session_start();
  
//   Write down order
    if(isset($_GET['cart'])){
        $cart = $_GET['cart'];
        file_put_contents("order.json", $cart, FILE_APPEND);
        unset($cart);
    };
  // mapping from selected values to comparison function names
  $mapping = [
    'name' => 'name_cmp',
    'price' => 'price_cmp',
    'dsc_name' => 'dsc_name_cmp',
    'dsc_price' => 'dsc_price_cmp'
  ];

  // by default: use name_cmp
  $selected_func = 'name_cmp';
  if (isset($_GET['compare_by']) && !empty($_GET['compare_by'])) {
    if (array_key_exists($_GET['compare_by'], $mapping)) {
      $selected_func = $mapping[$_GET['compare_by']];
    }
  }

  
//   usort($_SESSION['products'], $selected_func);
//   echo '<pre>';
//   print_r($_SESSION['products']);
//   echo '</pre>';
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
            <!-- Search bar -->
        <div class="search_container">
            <div class="search_box">
                <div class="search_btn"><i class="fas fa-search"></i></div>
                <input type="text" class="input_search" placeholder="What are you looking for?">
            </div>
        </div>

        <!-- Category -->

        <!-- <div class="category">
            <div class="category_container">
                <button onclick="filterSelection('Sport')" class="category_item">
                    Sport
                </button>
                <button onclick="filterSelection('Techno')" class="category_item">
                    Techno
                </button>
                <button onclick="filterSelection('Books')" class="category_item">
                    Books
                </button>
                <button onclick="filterSelection('Toys')" class="category_item">
                    Toys
                </button>
                <button onclick="filterSelection('Food')" class="category_item">
                    Food
                </button>
                <button onclick="filterSelection('Clothes')" class="category_item">
                    Clothes
                </button>
                <button onclick="filterSelection('Computer')" class="category_item">
                    Computer
                </button>
                <button onclick="filterSelection('RAM')" class="category_item">
                    RAM
                </button>
            </div>
        </div> -->

        <div class="main_header">
            <h3>Tất cả sản phẩm</h3>
            <div class="cus_filter">
                <select id="compare_by" name="compare_by">
                    <option value="">Select a sort condition</option>
                    <option value="name">Asc Name</option>
                    <option value="dsc_name">Dsc Name</option>
                    <option value="price">Asc Price</option>
                    <option value="dsc_price">Dsc Price</option>
                </select>
            </div>
        </div>

        <!-- Product list -->

        <div class="product_list">
            <div class="product_list_container">
                <?php
                    if (!empty($_SESSION['products'])) {
                        foreach($_SESSION['products'] as $product) {
                            $image = $product['image'];
                            $name = $product['name'];
                            $price = $product['price'];
                            $desc = $product['desc'];
                            echo "<a href=\"cus_product.php?name=$name \" class=\"product_list__item\">";
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
                            echo "<div class=\"product_list__item_buybtn\">";
                            echo     "<button class=\"form_field__label btn-hover color-9\">";
                            echo         "Add to cart";
                            echo     "</button>";
                            echo "</div>";
                            echo    "</a>";
                    }
                    } else {
                        echo "<span class=\"no_product\"> No product added </span>";
                    };
                ?>
               

                
                
                
            </div>

        </div>




    </main>

        <!-- Filtering feature -->
    <!-- <script>
            // Taken from w3school
            
        filterSelection("all")
        function filterSelection(c) {
        var x, i;
        x = document.getElementsByClassName("filterDiv");
        if (c == "all") c = "";
        // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
        for (i = 0; i < x.length; i++) {
            removeClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) addClass(x[i], "show");
        }
        }

        // Show filtered elements
        function addClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
            element.className += " " + arr2[i];
            }
        }
        }

        // Hide elements that are not selected
        function removeClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
        }

        // Add active class to the current control button (highlight it)
        var btnContainer = document.getElementById("myBtnContainer");
        var btns = btnContainer.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
        }
    </script> -->

    <script>
        let select_ele = document.querySelector("#compare_by");
        select_ele.addEventListener("change", function() {
            let selected_value = select_ele.value;
            location.href = "cus_main.php?compare_by=" + selected_value;
        });
    </script>
</body>

>>>>>>> Stashed changes
</html>