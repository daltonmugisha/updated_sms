<?php  
// Database configuration  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_db-3130313f7a";
  
// Create database connection  
$db = new mysqli($servername, $username, $password, $dbname);  
  
// Check connection  
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error);  
}else{
    // echo "god";
}

