<?php

require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/Authentication.php";

if(!isset($_SESSION)){
    session_start();
}

Authentication::protect();

if (!isset($_SESSION["username"]) or $_SESSION["username"]!=="admin"){
    header("location:login.php");
}

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
}

$category = new Category();

// Update caterogy Name
if (isset($_POST["updateCategoryName"]) && !empty($_POST["categoryName"]) && isset($_POST["categoryId"])){
    $category -> getCategory($_POST["categoryId"]);
    $category -> setCategoryName($_POST["categoryName"]);
    $category -> updateCategory($_POST["categoryId"]);
}

// Add new Category
if (isset($_POST["addNewCategory"]) && isset($_POST["newCategory"]) && !empty($_POST["newCategory"])){
    $category -> setCategoryName($_POST["newCategory"]);
    $category -> insertCategory();
}

$categoryRows = $category->getCategories();

$title = "Maintain Category - Sports Warehouse";

ob_start();

include "templates/maintainCategory.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"

?>