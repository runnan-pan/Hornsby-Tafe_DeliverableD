<?php
require_once "classes/Authentication.php";

if(!isset($_SESSION)){
    session_start();
}

Authentication::logout();
?>