<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/Authentication.php";
require_once "classes/formValidation.php";



if(!isset($_SESSION)){
    session_start();
}

Authentication::protect("admin");

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$title = "Add Item - Sports Warehouse";

$category = new Category();
$categoryRows = $category->getCategories();

$product = new Product();
$products = $product->getProducts();

$formValidation = new formValidation();

$message = "";

if (isset($_POST["add-item"])){
    $itemNameMsg = $formValidation->checkEmpty("productName");
    $cateMsg = $formValidation->checkEmpty("itemCategory");
    $priceMsg = $formValidation->checkEmpty("originalPrice");
    $priceMsg = $priceMsg.$formValidation->checkNumberPositive("originalPrice");
    $salePriceMsg = $formValidation->checkNumberPositive("salesPrice");

    if (isset($_POST["salesPrice"]) && $_POST["salesPrice"]===""){
        $salePriceMsg = "Please enter '0' if the item is NOT on sale";
        $formValidation->setValidToFalse();
    }

    if ($formValidation->returnValidation()===true){
        $itemId = $product->addProduct($_POST["productName"],$_POST["originalPrice"],$_POST["salesPrice"],$_POST["itemDescription"],$_POST["itemCategory"],$_POST["featured"]);
        header("location:itemDetails.php?itemId=$itemId");
    }

}else{
    $itemNameMsg = "";
    $cateMsg = "";
    $priceMsg = "";
    $salePriceMsg = "";
}



ob_start();

include "templates/addItem.html.php";

$output = ob_get_clean();

include "templates/layout.html.php";


?>