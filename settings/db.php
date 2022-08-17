<?php
//this file contains the database settings for the application
//it detects if the application is running locally or on a remote server
//the correct database settings are set
//this file needs to be included in all the files that connect to the database
//check if script is running locally
if($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_ADDR"] == "127.0.0.1")
{
//website is running unser locahost - use local DB details
$dsn = "mysql:host=localhost;dbname=sportswh;charset=utf8";
$username = "root";
$password = "";
}
else
{
//website is running on the remote server
$dsn = "mysql:host=localhost;dbname=hornsbytafetest_magenta06;charset=utf8";
$username = "hornsbytafetest_magenta06";
$password = "diamond$13%";
}
?>