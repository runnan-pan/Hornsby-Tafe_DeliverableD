<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/formValidation.php";

if(!isset($_SESSION)){
    session_start();
}

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();

$formValidation = new formValidation();

if (isset($_GET["itemId"])){
    $product->getProduct($_GET["itemId"]);
}else{
    header("location: viewProducts.php");
}

$title = $product->getProductName()." - Sports Warehouse";
$message = "";

//add product to shopping cart
if (isset($_POST["addToCart"])){
    if (!empty($_POST["itemId"]) and !empty($_POST["qty"])){
        $itemId = $_POST["itemId"];
        $qty = $_POST["qty"];
        $price = $_POST["price"];
        $photoPath = $_POST["photoPath"];
    }

    $item = new CartItem($product->getProductName(),$qty,$price,$itemId,$photoPath);

    if (!isset($_SESSION["cart"])){
        $cart = new shoppingCart();
    }else{
        $cart = $_SESSION["cart"];
    }

    $cart -> addItem($item);
    $_SESSION["cart"] = $cart;

    $message = "Added to cart, you have <span class='boldtext'>".$cart->countQtyOfOneItem($itemId)."</span> in your cart.";
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

ob_start();

include "templates/itemDetails.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"


?>