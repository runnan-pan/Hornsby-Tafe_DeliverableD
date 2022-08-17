<?php

require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";

if(!isset($_SESSION)){
    session_start();
}

$title = "Sports Warehouse";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$featuredProducts = $product->getFeaturedProducts();

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

ob_start();

include "templates/index.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"
?>