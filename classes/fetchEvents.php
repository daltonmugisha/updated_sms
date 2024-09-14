<?php     
session_start(); 
// Include database configuration file  
require_once 'dbConfig.php'; 
$userId = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : 0; 

// Filter events by calendar date 
$where_sql = ''; 
if(!empty($_GET['start']) && !empty($_GET['end'])){ 
    $where_sql .= " WHERE start BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' AND useid = '$userId' "; 
} 
 
// Fetch events from database 
$sql = "SELECT * FROM events $where_sql"; 
$result = $db->query($sql);  
 
$eventsArr = array(); 
if($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){ 
        array_push($eventsArr, $row); 
    } 
} 
 
// Render event data in JSON format 
echo json_encode($eventsArr);