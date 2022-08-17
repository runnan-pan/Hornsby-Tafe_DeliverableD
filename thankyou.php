<?php
require_once "classes/ShoppingCart.php";
require_once "classes/Category.php";

if(!isset($_SESSION)){
    session_start();
}

$category = new Category();
$categoryRows = $category->getCategories();


$title = "Thank you";
$message = "Sports warehouse is coming soon. If you have any questions, we would love to hear from you, please complete the following information. ";

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

ob_start();

include "templates/thankyou.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"

?>