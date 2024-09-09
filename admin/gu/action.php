<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "root";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Item details from form
    $itemName = $_POST['guests'];

 if(!empty($itemName)){
	   // SQL query to add item to database
	   $sql = "INSERT INTO guests (guestn) VALUES ('$itemName')";

	   if ($conn->query($sql) === TRUE) {


    echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=gu/gu"); </script>';
    } else {
		   echo "Error: " . $sql . "<br>" . $conn->error;
	   }
   }
 }

 if (isset($_POST['delete'])) {
    // Item details from form
    $umit = $_POST['deletei'];

 if(!empty($umit)){
	   // SQL query to add item to database
	   $sql = "DELETE FROM  guests WHERE guestn = '$umit'";

	   if ($conn->query($sql) === TRUE) {


    echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=gu/gu"); </script>';
    } else {
		   echo "Error: " . $sql . "<br>" . $conn->error;
	   }
   }
 }
// Close connection
// $conn->close();


