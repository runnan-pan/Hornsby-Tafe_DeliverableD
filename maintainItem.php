<?php

require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/Authentication.php";


if(!isset($_SESSION)){
    session_start();
}

Authentication::protect();

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$category = new Category();

$categoryRows = $category->getCategories();


$title = "Maintain Item - Sports Warehouse";

ob_start();

include "templates/maintainItem.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"

?>