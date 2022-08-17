<?php

require_once "DBAccess.php";

class Photo{
    private $_targetDirectory;
    private $_photoName;
    private $_valid = true;

    public function __construct($targetDirectory,$photoName){
        $this->_targetDirectory = $targetDirectory;
        $this->_photoName = basename($_FILES[$photoName]["name"]);
    }

    public function checkExtentionCorrect(){
        $message = "";
        $extention = "";
        $extentions = ["jpg","png","jpeg","gif"];

        $extention = strtolower(pathinfo($this->_targetDirectory.$this->_photoName,PATHINFO_EXTENSION));

        if (!in_array($extention,$extentions)){
            $message = "Sorry, only JPG, JPEG, PNG & GIF files allowed";
            $this->_valid = false;
        }

        return $message;
    }

    public function checkFileSize($field){
        $message = "";

        if ($_FILES[$field]["error"] == 1){
            $message = "Sorry, your file is too large.";
            $this->_valid = false;
        }
        return $message;
    }

    public function uploadFile($photoPath,$targetFile){
        $message = "";
        
        include "settings/db.php";
        $db = new DBAccess($dsn, $username, $password);
        $pdo = $db->connect();

        if (move_uploaded_file($_FILES[$photoPath]["tmp_name"],$targetFile)){
            //if there is old photo, delete old photo
            if (!empty($_POST["oldPhoto"])){
                $file = "images/productImages/".$_POST["oldPhoto"];
                unlink($file);
            }

            $sql = "update  item
                    set     photo = :photo
                    where   itemId = :itemId";
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindValue(":photo",basename($_FILES[$photoPath]["name"]),PDO::PARAM_STR);
            $stmt -> bindValue(":itemId",$_POST["itemId"],PDO::PARAM_INT);
            $db->executeNonQuery($stmt,false);
        }else{
            $message = "Sorry, there was an error uploading your file. Error Code:".$_FILES[$photoPath]["error"];
        }

        return $message;
    }

    public function returnValid(){
        return $this->_valid;
    }
}



?>