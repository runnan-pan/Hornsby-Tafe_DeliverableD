<?php
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";

$category = new Category();
$categoryRows = $category->getCategories();

if(!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$title = "Order Completed - Sports Warehouse";

ob_start();

include "templates/orderCompleted.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"

?>