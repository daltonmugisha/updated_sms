<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_db-3130313f7a";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>