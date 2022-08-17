<?php
$title = "Contact Us";

require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";

if(!isset($_SESSION)){
    session_start();
}


$category = new Category();
$categoryRows = $category->getCategories();

ob_start();


if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

include "templates/privacyPolicy.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"

?>