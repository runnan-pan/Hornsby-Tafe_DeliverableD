<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/Authentication.php";

if(!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$title = "Sports Warehouse";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$products = $product->getProducts();


ob_start();

include "templates/success.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"
?>