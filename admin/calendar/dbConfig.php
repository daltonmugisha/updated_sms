<?php  
// Database configuration  
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'stock_db-3130313f7a'); 
  
// Create database connection  
$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);  
  
// Check connection  
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error);  
}else{
    // echo "god";
}