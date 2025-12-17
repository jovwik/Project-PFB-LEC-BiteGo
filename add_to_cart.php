<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$menu_id = intval($_POST['menu_id']);

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_SESSION['cart'][$menu_id])){
    $_SESSION['cart'][$menu_id]++;
} else {
    $_SESSION['cart'][$menu_id] = 1;
}

header("Location: cart.php");
exit;
?>