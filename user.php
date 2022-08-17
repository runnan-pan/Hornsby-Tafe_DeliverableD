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

$title = "Sports Warehouse";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$products = $product->getProducts();

if (isset($_GET["theme"])){
    if ($_GET["theme"]==="pink"){
        setcookie("siteStyle","pink",time()+3600*24*7,"/");
    }
    if ($_GET["theme"]==="yellow"){
        setcookie("siteStyle","yellow",time()+3600*24*7,"/");
    }
    if ($_GET["theme"]==="green"){
        setcookie("siteStyle","green",time()+3600*24*7,"/");
    }
    if ($_GET["theme"]==="blue"){
        setcookie("siteStyle","blue",time()+3600*24*7,"/");
    }
    if ($_GET["theme"]==="white"){
        setcookie("siteStyle","blue",time()-3600*24*7,"/");
    }
    header("location:user.php");
}


ob_start();

include "templates/user.html.php";

$output = ob_get_clean();

include "templates/layout.html.php";
?>