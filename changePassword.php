<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/Authentication.php";
require_once "classes/formValidation.php";

if(!isset($_SESSION)){
    session_start();
}

Authentication::protect();

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$title = "Change Password";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$products = $product->getProducts();

$formValidation = new formValidation();

$message = "";
if (isset($_POST["submit"])){
    $message = $formValidation -> checkEmpty("password1");

    if ($formValidation -> returnValidation()===true){

        if ($_POST["password1"]!==$_POST["password2"]){
            $message = "Re-typed password doesn't match";
        }else{
            $message = Authentication::changePassword($_SESSION["username"],$_POST["password0"],$_POST["password1"]);
        }
    }
}


ob_start();

include "templates/changePassword.html.php";

$output = ob_get_clean();

include "templates/layout.html.php";
?>