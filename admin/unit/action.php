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
    $itemName = $_POST['item_unit'];

 if(!empty($itemName)){
	   // SQL query to add item to database
	   $sql = "INSERT INTO unit (unit_name) VALUES ('$itemName')";

	   if ($conn->query($sql) === TRUE) {


    echo ' <script> location.replace("http://localhost/sms_1/admin/?page=unit/unit"); </script>';
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
	   $sql = "DELETE FROM  unit WHERE unit_name = '$umit'";

	   if ($conn->query($sql) === TRUE) {


    echo ' <script> location.replace("http://localhost/sms_1/admin/?page=unit/unit"); </script>';
    } else {
		   echo "Error: " . $sql . "<br>" . $conn->error;
	   }
   }
 }
// Close connection
// $conn->close();


