<?php

require_once "DBAccess.php";

class Product{
    private $_productName;
    private $_productId;
    private $_price;
    private $_salePrice;
    private $_description;
    private $_photoPath;
    private $_categoryId;
    private $_featured;
    private $_db;

    public function __construct(){
        include "settings/db.php";

        try{
            $this->_db = new DBAccess($dsn,$username,$password);
        }catch (PDOException$e){
            die("Unable to connect to database, ". $e->getMessage());
        }
    }

    public function getProductId(){
        return $this->_productId;
    }

    public function getProductName(){
        return $this->_productName;
    }

    public function setProductName($name){
        $this->_productName = $name;
    }

    public function getPrice(){
        return $this->_price;
    }

    public function setPrice($price){
        $this->_price = $price;
    }

    public function getSalePrice(){
        return $this->_salePrice;
    }

    public function setSalePrice($price){
        $this->_salePrice = $price;
    }

    public function getDescription(){
        return $this->_description;
    }

    public function setDescription($text){
        $this->_description = $text;
    }

    public function getPhotoPath(){
        return $this->_photoPath;
    }

    public function getCategoryId(){
        return $this->_categoryId;
    }

    public function setCategoryId($id){
        $this->_categoryId = $id;
    }

    public function getFeatured(){
        return $this->_featured;
    }

    public function getProduct($id){
        try{
            $pdo = $this->_db->connect();
            $sql = "select  *
                    from    item
                    where   itemId = :itemId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':itemId', $id, PDO::PARAM_INT);

            $rows = $this->_db->executeSQL($stmt);
            $row = $rows[0];

            $this->_productId = $row["itemId"];
            $this->_productName = $row["itemName"];
            $this->_price = $row["price"];
            $this->_salePrice = $row["salePrice"];
            $this->_description = $row["description"];
            $this->_photoPath = $row["photo"];
            $this->_categoryId = $row["categoryId"];
            $this->_featured = $row["featured"];
        }catch (PDOException $e){
            throw $e;
        }
    }
    
    public function addProduct($itemName,$price,$salePrice,$description,$categoryId,$featured){
        try{
            $pdo = $this->_db->connect();
            $sql = "insert into item(itemName,price,salePrice,description,categoryId,featured)
                            values(:itemName,:price,:salePrice,:description,:categoryId,:featured)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":itemName",$itemName,PDO::PARAM_STR);
            $stmt->bindValue(":price",$price,PDO::PARAM_STR);
            $stmt->bindValue(":salePrice",$salePrice,PDO::PARAM_STR);
            $stmt->bindValue(":description",$description,PDO::PARAM_STR);
            $stmt->bindValue(":categoryId",$categoryId,PDO::PARAM_STR);
            $stmt->bindValue(":featured",$featured,PDO::PARAM_STR);
            $id = $this->_db->executeNonQuery($stmt,true);

            return $id;

        }catch(PDOException $e){
            throw $e;
        }
    }

    public function updateProduct($itemName,$price,$salePrice,$description,$categoryId,$featured,$itemId){
        try{
            $pdo = $this->_db->connect();
            $sql = "update  item 
                    set     itemName=:itemName,price=:price,salePrice=:salePrice,description=:description,categoryId=:categoryId,featured=:featured
                    where   itemId = :itemId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":itemName",$itemName,PDO::PARAM_STR);
            $stmt->bindValue(":price",$price,PDO::PARAM_STR);
            $stmt->bindValue(":salePrice",$salePrice,PDO::PARAM_STR);
            $stmt->bindValue(":description",$description,PDO::PARAM_STR);
            $stmt->bindValue(":categoryId",$categoryId,PDO::PARAM_STR);
            $stmt->bindValue(":featured",$featured,PDO::PARAM_STR);
            $stmt->bindValue(":itemId",$itemId,PDO::PARAM_INT);
            $id = $this->_db->executeNonQuery($stmt,false);
        }catch(PDOException $e){
            throw $e;
        }

    }
        

    //TODO*****************************************
    public function setPhotoPath(){

    }

    public function getProducts(){
        try{
            $pdo = $this->_db->connect();
            $sql = "select  *
                    from    item
                    limit   20";
            $stmt = $pdo->prepare($sql);
            $rows = $this->_db->executeSQL($stmt);

            return $rows;
        }catch(PDOException $e){
            throw $e;
        }
    }

    public function getFeaturedProducts(){
        try{
            $pdo = $this->_db->connect();
            $sql = "select  itemId,
                            salePrice,
                            price,
                            itemName,
                            photo
                    from    item
                    where   featured = 1";
            $stmt = $pdo->prepare($sql);
            $rows = $this->_db->executeSQL($stmt);

            return $rows;
        }catch(PDOException $e){
            throw $e;
        }
    }

    public function getProductsByCategory($id){
        try{
            $pdo = $this->_db->connect();
            $sql = "select  itemId,
                            salePrice,
                            price,
                            itemName,
                            photo
                    from    item
                    where   categoryId = :categoryId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":categoryId",$id,PDO::PARAM_INT);
            
            $rows = $this->_db->executeSQL($stmt);

            return $rows;
        }catch(PDOException $e){
            throw $e;
        }
    }
    
    public function searchProducts($name){
        try{
            $pdo = $this->_db->connect();
            $sql = "select  itemId,
                            salePrice,
                            price,
                            itemName,
                            photo
                    from    item
                    where   itemName
                    like    :name";
            $stmt = $pdo->prepare($sql);
            $stmt -> bindValue(":name","%".$name."%",PDO::PARAM_STR);
            
            $rows = $this->_db->executeSQL($stmt);

            return $rows;
        }catch(PDOException $e){
            throw $e;
        }
    }
}


?>