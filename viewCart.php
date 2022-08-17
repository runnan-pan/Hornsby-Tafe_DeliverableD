<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";

if(!isset($_SESSION)){
    session_start();
}

$title = "Shopping cart";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$products = $product->getProducts();

if (isset($_POST["remove"])){
    if(!empty($_POST["itemId"]) and isset($_SESSION["cart"])){
        $item = new CartItem("",0,0,$_POST["itemId"],"");
        
        $cart = $_SESSION["cart"];
        $cart->removeItem($item);
        $_SESSION["cart"] = $cart;
    }
}

if (isset($_POST["update"]) and $_POST["qty"]>0){
    if (!empty($_POST["itemId"]) and isset($_SESSION["cart"])){
        $cart = $_SESSION["cart"];
        $cart->setItemQty($_POST["itemId"],$_POST["qty"]);
        $_SESSION["cart"] = $cart;
    }
}

if (isset($_POST["clearCart"])){
    unset($_SESSION["cart"]);
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

ob_start();

include "templates/displayCart.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"


?>