<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Methods: *");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stock_db-3130313f7a";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    die(json_encode(['status' => 'error', 'message' => "Connection failed: " . mysqli_connect_error()]));
}

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function getAndSendEmail($connect, $supplier_id) {
    $current_date = date('Y-m-d');

    // Ensure supplier_id is safe for the query (use prepared statement)
    $stmt = $connect->prepare("SELECT * FROM supplier_list WHERE id = ?");
    $stmt->bind_param("i", $supplier_id);
    $stmt->execute();
    $userResult = $stmt->get_result();

    if ($userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();

        $email = $userRow['email'];
        $userId = $userRow['id'];
        $push = $userRow['push'];
       

        if ($push == 1) {
            // Fetch purchase orders
            $stmt = $connect->prepare("SELECT * FROM purchase_order_list WHERE supplier_id = ? ORDER BY id DESC LIMIT 1");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $eventResult = $stmt->get_result();

            if ($eventResult->num_rows > 0) {
                while ($eventRow = $eventResult->fetch_assoc()) {
                    $ID = $eventRow['id'];
                    $remarks = $eventRow['remarks'];
                    $CODE = $eventRow['po_code'];

                    // Prepare and send the email
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "bookvistaa@gmail.com";
                        $mail->Password = 'lgku hqks fojd soxu'; // Replace with your real password
                        $mail->Port = 587;
                        $mail->SMTPSecure = 'tls';

                        // Recipients
                        $mail->setFrom('bookvistaa@gmail.com', 'Stockify Purchase Order from SWCFY TEC');
                        $mail->addAddress($email);

                        // Email content
                        $mail->isHTML(true);
                        $mail->Subject = 'Purchase Order';
                        $mail->Body = "
                        <html>
                        <body>
                            <center>
                                <div style='border:1px solid purple;padding:10px;border-radius:10px;'>
                                    <h2 style='font-family: Audiowide;'>STOCKIFY</h2>
                                    <h3>Hello!! View this purchase order by clicking the button below.</h3>
                                    <p>Switchiify has created a purchase order with PO-CODE: $CODE</p>
                                    <a href='http://localhost/sms_1/poview.php?id=$ID'>
                                        <button>VIEW THE PURCHASE ORDER</button>
                                    </a>
                                    <h5>Remarks</h5>
                                    <p>$remarks</p>
                                    <p>For more information, visit us at <a href='https://co.switchiify.com'>Switchiify | Home</a>.</p>
                                    <h6>Switchiify Inc, 2020-2025</h6>
                                </div>
                            </center>
                        </body>
                        </html>";

                        if ($mail->send()) {
                            // echo json_encode(['status' => 'success', 'message' => 'Reminder sent successfully.']);
                        } else {
                            // echo json_encode(['status' => 'error', 'message' => 'Could not send email.']);
                        }
                    } catch (Exception $e) {
                        // echo json_encode(['status' => 'error', 'message' => "Mailer Error: {$mail->ErrorInfo}"]);
                    }
                }
            } else {
                // echo json_encode(['status' => 'info', 'message' => 'No purchase orders for today.']);
            }
        } else {
            // echo json_encode(['status' => 'info', 'message' => 'Push notifications are disabled for this supplier.']);
        }
    } else {
        // echo json_encode(['status' => 'error', 'message' => 'Supplier not found.']);
    }
}


?>
