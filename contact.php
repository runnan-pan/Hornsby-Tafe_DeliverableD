<?php
$title = "Contact Us";

require_once "classes/formValidation.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";

if(!isset($_SESSION)){
    session_start();
}

$formValidating = new FormValidation();

$category = new Category();
$categoryRows = $category->getCategories();

ob_start();

if (isset($_POST["submit"])){
    $fNameMessage = $formValidating -> checkEmpty("firstName");
    $fNameMessage = $fNameMessage. " ".$formValidating -> checkName("firstName");

    $lNameMessage = $formValidating -> checkEmpty("lastName");
    $lNameMessage = $lNameMessage. " ".$formValidating -> checkName("lastName");

    $emailMessage = $formValidating ->checkEmail("email");

    $commentsMessasge = $formValidating -> checkEmpty("question");

    if ($formValidating -> returnValidation() === true){
        header("location:thankyou.php");
    }else{
        include "templates/contact.html.php";
    }
}else{
    $fNameMessage = "";
    $lNameMessage = "";
    $emailMessage = "";
    $commentsMessasge = "";
    $phoneMessage = "";
    include "templates/contact.html.php";
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$output = ob_get_clean();

include "templates/layout.html.php"

?>