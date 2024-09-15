<?php
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Methods: *");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_db-3130313f7a";

$connect = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case "GET":
    $current_date = date('Y-m-d');

    // Ensure the user is logged in and has a valid session

  
      // Fetch user email
      $SELECT = "SELECT * FROM users ";
      $userResult = mysqli_query($connect, $SELECT);
      if ($userResult && mysqli_num_rows($userResult) > 0) {
        while ($userRow = mysqli_fetch_array($userResult)) {


          $email  = $userRow['email'];
          $userId  = $userRow['id'];
          // Fetch events for the current date
          $fetchevents = "SELECT * FROM events WHERE useid='$userId' AND start='$current_date' AND sent = 'NO'";
          $eventResult = mysqli_query($connect, $fetchevents);
          if ($eventResult && mysqli_num_rows($eventResult) > 0) {
            while ($eventRow = mysqli_fetch_array($eventResult)) {

              $ID = $eventRow['id'];
              $startdate = $eventRow['start'];
              $title = $eventRow['title'];
              $message = $eventRow['description'];
             $update = "UPDATE events SET sent='YES' WHERE id = '$ID'";
             mysqli_query($connect, $update);
              // Prepare and send the email
              $mail = new PHPMailer(true);

              try {
                // SMTP settings
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "bookvistaa@gmail.com";
                $mail->Password = 'lgku hqks fojd soxu'; // Replace with your real password
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';

                // Recipients
                $mail->setFrom('bookvistaa@gmail.com', 'Stockify Event Reminder | ' . $title);
                $mail->addAddress($email);

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Stockify Reminder';
                $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
            </head>
            <body> 
            <center>
                <div style="border:1px solid purple;padding:10px;border-radius:10px;">
                    <center>
                        <h2 style="font-family: Audiowide;">STOCKIFY</h2>
                    </center>
                    <h3>Hello!! Reminder.</h3>
                    <p>You have set an event for today (' . $startdate . '), and we remind you to check it:</p>
                    <p style="font-weight:bold;background:purple;font-size:20px;padding:5px;color:white;">
                    ' . $message . '
                    </p>
                    <p>For more information, visit us at <a href="https://co.switchiify.com">Switchiify | Home</a>.</p>
                    <h6>Switchiify Inc, 2020-2025</h6>
                </div>
            </center> 
            </body>
            </html>';

                // Send the email
                if ($mail->send()) {
                  echo json_encode(['status' => 'success', 'message' => 'Reminder sent successfully.']);
                } else {
                  echo json_encode(['status' => 'error', 'message' => 'Could not send email.']);
                }
              } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
              }
            }
          } else {
            // No events for today
            echo json_encode(['status' => 'info', 'message' => 'No events for today.']);
          }
        }
      } else {
        // No user found
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
      }
    

    break;

  default:
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    break;
}
