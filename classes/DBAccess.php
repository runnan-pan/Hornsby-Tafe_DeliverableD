<?php
class DBAccess{
    private $_dsn;
    private $_userName;
    private $_password;
    private $_pdo;

    public function __construct($dsn,$userName,$password)
    {
        $this -> _dsn = $dsn;
        $this -> _userName = $userName;
        $this ->_password = $password;
    }

    public function connect(){
        try{
            $this ->_pdo = new PDO($this->_dsn,$this->_userName,$this->_password);
            $this ->_pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $error){
            echo "Connection failed: " .$error->getMessage();
        }

        return $this ->_pdo;
    }

    public function disconnect(){
        $this ->_pdo = null;
    }

    public function executeSQL($stmt){
        try{
            $stmt -> execute();
            $rows = $stmt -> fetchAll();
        }catch (PDOException $error){
            echo "Query executeSQL failed: ".$error->getMessage();
        }
        return $rows;
    }

    public function executeSQLReturnOneValue($stmt){
        try {
            $stmt -> execute();
            $value = $stmt -> fetchColumn();
        }catch (PDOException $error){
            echo "Query failed: ". $error ->getMessage();
        }
        return $value;
    }

    public function executeNonQuery($stmt,$pkid=false){
        try{
            $value = $stmt->execute();
            if ($pkid===true){
                $value = $this->_pdo->lastInsertId();
            }

        }catch (PDOException $error){
            if ($error -> getCode()==="23000"){
                $value = -1;
            }else{
                die("Query executeNonQuery failed: ".$error->getMessage());
            }
        }
        return $value;
    }
}


?>