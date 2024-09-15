<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_db-3130313f7a";
  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Item details from form
    $person = $_POST['person'];
    $money = $_POST['money'];

    $selected = $_POST['selected'];
    if( $selected == 'They-owe-me'){

      $what = "OWEME";
      $status = "Waiting for payment" ;

    }elseif ($selected == 'I-owe-them') {
      $what = "OWETHE";
      $status = "You have not payed" ; 


    }
 if(!empty($person) || !empty($money)){
	   // SQL query to add item to database
	   $sql = "INSERT INTO cash (person, money, whoowe ,status) VALUES ('$person', '$money', '$what', '$status')";

	   if ($conn->query($sql) === TRUE) {


     echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
    } else {
		   echo "Error: " . $sql . "<br>" . $conn->error;
	   }
   }
 }

 if (isset($_POST['delete'])) {
    // Item details from form
    $ids = $_POST['deletei'];

 if(!empty($ids)){
	   // SQL query to add item to database
	   $sql = "DELETE FROM  cash WHERE id = '$ids'";

	   if ($conn->query($sql) === TRUE) {


     echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
    } else {
		   echo "Error: " . $sql . "<br>" . $conn->error;
	   }
   }
 }

//  half paid

if (isset($_POST['ihalf'])) {
  // Item details from form
  $half = $_POST['half'];
  $oldmoney = $_POST['oldmoney'];
  $money = $_POST['money'];
  $balance = $_POST['balance'];
 
if(!empty($half)){
   // SQL query to add item to database
   $sql = "UPDATE cash SET status = 'I paid some', balance = balance + '$money' WHERE id = '$half'";

   if ($conn->query($sql) === TRUE) {


   echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
  } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
 }
}

// full payed

if (isset($_POST['ifull'])) {
  // Item details from form
  $full = $_POST['full'];

if(!empty($full)){
   // SQL query to add item to database
   $sql = "UPDATE cash  SET status = 'I payed' WHERE id = '$full'";

   if ($conn->query($sql) === TRUE) {


   echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
  } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
 }
}

// NOT YET PAID

if (isset($_POST['waitingfor'])) {
  // Item details from form
  $waiting = $_POST['waiting'];

if(!empty($waiting)){
   // SQL query to add item to database
   $sql = "UPDATE cash  SET status = 'You have not paid' WHERE id = '$waiting'";

   if ($conn->query($sql) === TRUE) {


   echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
  } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
 }
}



// section two


//  half paid

if (isset($_POST['donepay'])) {
  // Item details from form
  $done = $_POST['donepayid'];

if(!empty($done)){
   // SQL query to add item to database
   $sql = "UPDATE cash  SET status = 'They paid me' WHERE id = '$done'";

   if ($conn->query($sql) === TRUE) {


   echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
  } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
 }
}

// full payed

if (isset($_POST['theypaid'])) {
  // Item details from form
  $theypaid = $_POST['theypaidid'];
  $oldmoney = $_POST['oldmoney'];
  $money = $_POST['money'];
  // $balance = $_POST['balance'];
 
if(!empty($theypaid)){
   // SQL query to add item to database
   $sql = "UPDATE cash SET status = 'They payed some', balance = balance + '$money' WHERE id = '$theypaid'";


   if ($conn->query($sql) === TRUE) {


   echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
  } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
 }
}

// NOT YET PAID

if (isset($_POST['notpayed'])) {
  // Item details from form
  $notpayed = $_POST['notpayedid'];

if(!empty($notpayed)){
   // SQL query to add item to database
   $sql = "UPDATE cash  SET status = 'Waiting for payment' WHERE id = '$notpayed'";

   if ($conn->query($sql) === TRUE) {


   echo ' <script> location.replace("http://localhost:8080/sms/admin/?page=deps/deps"); </script>';
  } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
   }
 }
}
// Close connection
// $conn->close();


