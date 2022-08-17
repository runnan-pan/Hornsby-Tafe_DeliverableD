<?php

require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/formValidation.php";

$category = new Category();
$categoryRows = $category->getCategories();

if(!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$title = "Checkout - Sports Warehouse";

$form = new formValidation();
$cart = new shoppingCart();

//set up error message
$fNameMsg = "";
$lNameMsg = "";
$streetAddressMsg = "";
$suburbMsg = "";
$stateMsg = "";
$postcodeMsg = "";
$contactNumberMsg = "";
$emailMsg = "";
$creditCardNoMsg = "";
$creditCardDateMsg = "";
$creditCardNameMsg = "";
$creditCardCSVMsg = "";


if (isset($_POST["submit"])){
    $fNameMsg = $form->checkEmpty("firstName");
    $lNameMsg = $form->checkEmpty("lastName");
    $streetAddressMsg = $form->checkEmpty("streetAddress");
    $suburbMsg = $form->checkEmpty("suburb");
    $stateMsg = $form->checkEmpty("state");
    $postcodeMsg = $form->checkEmpty("postcode");
    $contactNumberMsg = $form->checkEmpty("contactNumber");
    $emailMsg = $form->checkEmpty("email");
    $creditCardNoMsg = $form->checkEmpty("creditCardNumber");
    $creditCardDateMsg = $form->checkEmpty("expiryDate");
    $creditCardNameMsg = $form->checkEmpty("nameOnCard");
    $creditCardCSVMsg = $form->checkEmpty("CSV");

    $fNameMsg = $fNameMsg." ".$form->checkName("firstName");
    $lNameMsg = $lNameMsg." ".$form->checkName("lastName");
    $suburbMsg = $suburbMsg." ".$form->checkName("suburb");
    if (empty($postcodeMsg)){$postcodeMsg=$form->checkPostcode("postcode");}
    if (empty($emailMsg)){$emailMsg=$form->checkEmail("email");}

    if (empty($creditCardNoMsg)){$creditCardNoMsg=$form->checkNumeric("creditCardNumber");}
    if (empty($creditCardDateMsg)){$creditCardDateMsg=$form->checkDateFormat("expiryDate");}
    if (empty($creditCardNameMsg)){$creditCardNameMsg=$form->checkName("nameOnCard");}
    if (empty($creditCardCSVMsg)){$creditCardCSVMsg=$form->checkNumeric("CSV");}




    if ($form->returnValidation()==true){
        $cart = $_SESSION["cart"];
        $cart -> saveCart($_POST["streetAddress"].", ".$_POST["suburb"]." ".$_POST["state"]." ".$_POST["postcode"],$_POST["contactNumber"],$_POST["creditCardNumber"],$_POST["CSV"],$_POST["email"],$_POST["expiryDate"],$_POST["firstName"],$_POST["lastName"],$_POST["nameOnCard"]);
        
        unset ($_SESSION["cart"]);
        header("location:orderCompleted.php");
    }
}








ob_start();

include "templates/checkout.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"

?>