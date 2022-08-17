<?php

class formValidation {
    private $valid = true;
    private $_missingFields = [];

    public function checkEmpty($fieldName){
        $message = "";

        if (!isset($_POST[$fieldName]) or empty($_POST[$fieldName])){
            $this -> _missingFields[]=$fieldName;
            $this -> valid = false;
            $message = "Please provide data";
        }

        return $message;
    }

    public function checkEmail($fieldName){
        $message = "";

        if (isset($_POST[$fieldName])){
            if (!filter_var($_POST[$fieldName],FILTER_VALIDATE_EMAIL)){
                $this->_missingFields[] = $fieldName;
                $this-> valid = false;
                $message = "Please enter a valid email";
            }
        }
        return  $message;
    }

    public function checkName($fieldName){
        $message = "";

        if (isset($_POST[$fieldName]) and !empty($_POST[$fieldName])){
            if (!preg_match("/^[a-zA-z \-']*$/",$_POST[$fieldName])){
                $this -> _missingFields[] = $fieldName;
                $this -> valid = false;
                $message = "Only letters, apostrophe,hyphens and white space allowed";
            }
        }
        return $message;
    }

    public function checkNumeric($fieldName){
        $message = "";

        if (!isset($_POST[$fieldName]) or !is_numeric($_POST[$fieldName])){
            $this->valid = false;
            $message = "Only numbers are allowed";
        }
        return $message;
    }

    public function checkDateFormat($fieldName){
        $message = "";

        if (!isset($_POST[$fieldName]) or !preg_match("~\d\d/\d\d~",$_POST[$fieldName])){
            $this->valid = false;
            $message = "Please enter the date in correct format";
        }

        return $message;
    }

    public function checkPostcode($fieldName){
        $message = "";

        if (!isset($_POST[$fieldName]) or !preg_match("~\d\d\d\d~",$_POST[$fieldName])){
            $this->valid = false;
            $message = "Postcode should be 4 digits only";
        }

        return $message;
    }

    public function checkNumberPositive($fieldName){
        $message = "";

        if (isset($_POST[$fieldName]) and !empty($_POST[$fieldName])){
            if ($_POST[$fieldName]<0){
                $message = "Price must be greater than 0";
                $this-> valid = false;
            }
        }
        return $message;
    }

    public function checkPasswordMatch($fieldName1,$fieldName2){
        $message = "";

        if (!empty($_POST[$fieldName1]) && !empty($_POST[$fieldName2])){
            if (($_POST[$fieldName1]) !== $_POST[$fieldName2]){
                $message = "Password does not match.";
                $this->valid = false;
            }
        }
        
        return $message;
    }

    public function setErrorClass($fieldName){
        if (in_array($fieldName,$this -> _missingFields)){
            return "class=\"error\"";
        }
    }

    public function setValue($fieldName){
        if (isset($_POST[$fieldName])){
            return htmlentities($_POST[$fieldName]);
        }
    }

    public function returnValidation(){
        return $this->valid;
    }

    public function returnSelected($fieldName,$value){
        if (isset($_POST[$fieldName]) and $_POST[$fieldName]===$value){
            echo "selected";
        }
    }

    public function setValidToFalse(){
        $this->valid = false;
    }

}


?>