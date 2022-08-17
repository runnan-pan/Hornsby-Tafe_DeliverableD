<?php

require_once("DBAccess.php");

class Authentication{                 
    const LoginPageURL = "login.php"; //constants hold values that do not change
    const SuccessPageURL = "success.php";

    private static $_db;

    public static function createUser($uname, $pword){
        $hash = password_hash($pword, PASSWORD_DEFAULT);
        //get database settings
        include "settings/db.php";
        try{
            self::$_db = new DBAccess($dsn, $username, $password);//create database object, as the class is static we need to use the keyword self instead of this
        }catch (PDOException $e){
            die("Unable to connect to database, ". $e->getMessage());
        }

        //add user to database
        try{
            $pdo = self::$_db->connect();
            $sql = "insert into user(username, password) values(:username, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $uname, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hash, PDO::PARAM_STR);

            $result = self::$_db->executeNonQuery($stmt);
        }catch (PDOException $e){
            throw $e;
        }

        return "New user($uname) has been added";
    }

    public static function deleteUserAccount($uname){
        include "settings/db.php";
        try{
            self::$_db = new DBAccess($dsn, $username, $password);//create database object, as the class is static we need to use the keyword self instead of this
        }catch (PDOException $e){
            die("Unable to connect to database, ". $e->getMessage());
        }

        //delete user from database
        try{
            $pdo = self::$_db->connect();
            $sql = "delete from user where username = '$uname'";
            $stmt = $pdo->prepare($sql);
            self::$_db->executeNonQuery($stmt);
        }catch (PDOException $e){
            throw $e;
        }

        return "The account ($uname) has been deleted.";
    }

        //check if username exists
    public static function checkIfExists($uname){
        include "settings/db.php";
        try{
            self::$_db = new DBAccess($dsn, $username, $password);//create database object, as the class is static we need to use the keyword self instead of this
        }catch (PDOException $e){
            die("Unable to connect to database, ". $e->getMessage());
        }

        try{
            $pdo = self::$_db->connect();
            $sql = "select username from user";
            $stmt = $pdo->prepare($sql);
            $userNames = self::$_db->executeSQL($stmt);

            if (!empty($userNames)){
                foreach ($userNames as $name){
                    $userNameArray[]=$name["username"];
                }
            }else{
                $userNameArray = [];
            }


            if (in_array($uname,$userNameArray)){
                return true;
            }else{
                return false;
            }
        }catch (PDOException $e){
            throw $e;
        }
    }

    public static function login($uname, $pword){
        $hash = "";

        include "settings/db.php";

        try{
            self::$_db = new DBAccess($dsn, $username, $password);
        }catch (PDOException $e){
            die("Unable to connect to database, ". $e->getMessage());
        }

        //check if user exists in database
        try{
            $pdo = self::$_db->connect();
            $sql = "select password from user where username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $uname, PDO::PARAM_STR);
            $hash = self::$_db->executeSQLReturnOneValue($stmt);
        }catch (PDOException $e){
            throw $e;
        }
        
        if(password_verify($pword, $hash)){
            $_SESSION["username"] = $uname;
            header("Location: " . self::SuccessPageURL);
            exit;
        }else{
            return false;
        }
    }

    public static function changePassword($uname,$oldPassword,$newPassword){
        include "settings/db.php";
        $message = "";

        try{
            self::$_db = new DBAccess($dsn, $username, $password);
        }catch (PDOException $e){
            die("Unable to connect to database, ". $e->getMessage());
        }

        try{
            $pdo = self::$_db->connect();
            $sql = "select password from user where username=:username";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $uname, PDO::PARAM_STR);
            $hash = self::$_db->executeSQLReturnOneValue($stmt);
        }catch (PDOException $e){
            throw $e;
        }

        if(password_verify($oldPassword,$hash)){
            $hash = password_hash($newPassword,PASSWORD_DEFAULT);
            try{
                $pdo = self::$_db->connect();
                $sql = "update user set password = :password where username = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":username", $uname, PDO::PARAM_STR);
                $stmt->bindParam(":password", $hash, PDO::PARAM_STR);
    
                $result = self::$_db->executeNonQuery($stmt);

                $message = "Password has been updated";
            }catch (PDOException $e){
                throw $e;
            }

        }else{
            $message = "Old password is not correct";
        }

        return $message;
    }

    public static function logout(){
        unset($_SESSION["username"]);
        header("Location: " . self::LoginPageURL);
        exit;
    }

    //check if user is logged in
    public static function protect(){
        if(!isset($_SESSION["username"])){
            header("Location: " . self::LoginPageURL);//redirect the user to the login page
            exit;
        }
    }
}
?>