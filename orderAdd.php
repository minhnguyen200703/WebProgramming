<?php
    session_start();
    if(isset($_GET['cart'])){
        $cart = $_GET['cart'];
        $cart = json_decode($cart);
    };

    $_SESSION['order'][] = $cart;
    unset($_SESSION['order'])

?>
