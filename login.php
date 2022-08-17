<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/Authentication.php";

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION["username"])){
    header("location:user.php");
}


if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$title = "Login - Sports Warehouse";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$products = $product->getProducts();

$message = "";
$loginSuccess = "";

if (isset($_POST["submit"])){
    if(!empty($_POST["username"]) && !empty($_POST["password"])){
        $loginSuccess = Authentication::login($_POST["username"],$_POST["password"]);
    }

    if ($loginSuccess==false){
        $message = "Username or password incorrect";
    }
}




ob_start();

include "templates/login.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"
?>