<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/Authentication.php";
require_once "classes/formValidation.php";

if(!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$title = "Create User - Sports Warehouse";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$products = $product->getProducts();

$formValidation = new formValidation();



$usernameMsg = "";
$password1Msg = "";
$password2Msg = "";

$message = "";
$exist="";

if (isset($_POST["submit"])){
    $usernameMsg = $formValidation->checkEmpty("username");
    $password1Msg = $formValidation->checkEmpty("password1");
    $password2Msg = $formValidation->checkEmpty("password2");
    $password2Msg =  $password2Msg." ".$formValidation->checkPasswordMatch("password1","password2");

    if ($formValidation->returnValidation()==true){
        $exist = Authentication::checkIfExists($_POST["username"]);
        if ($exist==true){
            $message = "Username ".$_POST["username"]." has been taken, please choose another username";
        }else{
            $message = Authentication::createUser($_POST["username"], $_POST["password1"]);
            // $_SESSION["username"] = $_POST["username"];
        }
    }
}




ob_start();

include "templates/createUser.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"
?>