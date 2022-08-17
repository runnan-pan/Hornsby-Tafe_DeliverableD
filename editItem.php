<?php
require_once "classes/Product.php";
require_once "classes/Category.php";
require_once "classes/ShoppingCart.php";
require_once "classes/formValidation.php";
require_once "classes/Authentication.php";
require_once "classes/Photo.php";

if(!isset($_SESSION)){
    session_start();
}

Authentication::protect("admin");

if (!isset($_SESSION["cart"])){
    $cartItemQty = 0;
}else{
    $cartItemQty = $_SESSION["cart"] -> count();
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

//delete photo
if (isset($_POST["deletePhoto"])){
    include "settings/db.php";
    $db = new DBAccess($dsn, $username, $password);
    $pdo = $db->connect();

    if (!empty($_POST["oldPhoto"])){
        $file = "images/productImages/".$_POST["oldPhoto"];
        unlink($file);
    }

    $sql = "update  item
    set     photo = null
    where   itemId = :itemId";
    $stmt = $pdo -> prepare($sql);
    $stmt -> bindValue(":itemId",$_POST["itemId"],PDO::PARAM_INT);
    $db->executeNonQuery($stmt,false);

    $product = new Product();
    $product->getProduct($_GET["itemId"]);
}

if (isset($_POST["update"])){
    $itemNameMsg = $formValidation->checkEmpty("productName");
    $priceMsg = $formValidation->checkEmpty("originalPrice");
    $priceMsg = $priceMsg.$formValidation->checkNumberPositive("originalPrice");

    $salePriceMsg = $formValidation->checkNumberPositive("salesPrice");

    if (isset($_POST["salesPrice"]) && $_POST["salesPrice"]===""){
        $salePriceMsg = "Please enter '0' if the item is NOT on sale";
        $formValidation->setValidToFalse();
    }
    
    //Check photo
    if (isset($_FILES["newPhoto"]) and $_FILES["newPhoto"]["error"]!=4){
        $photo = new Photo("images/productImages","newPhoto");
        $photoMsg = $photo->checkExtentionCorrect();
        $photoMsg = $photoMsg.$photo->checkFileSize("newPhoto");

        if ($photo->returnValid()===true){
            $photo -> uploadFile("newPhoto","images/productImages/".basename($_FILES["newPhoto"]["name"]));
        }else{
            $formValidation->setValidToFalse();
        }
    }else{
        $photoMsg = "";
    }
    
    
    $salePrice = "";

    if ($formValidation->returnValidation()===true){
        $product->updateProduct($_POST["productName"],$_POST["originalPrice"],$_POST["salesPrice"],$_POST["itemDescription"],$_POST["itemCategory"],$_POST["featured"],$_POST["itemId"]);
        $itemId = $_POST["itemId"];
        header("location:itemDetails.php?itemId=$itemId");
    }
}else{
    $itemNameMsg = "";
    $priceMsg = "";
    $salePriceMsg = "";
    $photoMsg = "";
}

ob_start();

include "templates/editItem.html.php";

$output = ob_get_clean();

include "templates/layout.html.php"


?>