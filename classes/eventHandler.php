<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Methods: *");

require_once 'dbConfig.php'; 
     
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 

    $eventTitle = $_POST['title'];
    $eventDesc = $_POST['description'];
    $eventURL = $_POST['url'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $types = $_POST['type'];

    if($types == 'addEvent'){ 
     
        if(!empty($eventTitle)){ 
            // Insert event data into the database 
            $sqlQ = "INSERT INTO events (title,description,url,start,end) VALUES (?,?,?,?,?)"; 
            $stmt = $db->prepare($sqlQ); 
            $stmt->bind_param("sssss", $eventTitle, $eventDesc, $eventURL, $start, $end); 
            $insert = $stmt->execute(); 
     
            if($insert){ 
                $output = [ 
                    'status' => 1 
                ]; 
                echo json_encode($output); 
            }else{ 
                echo json_encode(['error' => 'Event Add request failed!']); 
            } 
        } 
    }elseif($types == 'editEvent'){ 
        
          
        $event_id = $_POST['id']; 
     
        if(!empty($eventTitle)){ 
            // Update event data into the database 
            $sqlQ = "UPDATE events SET title=?,description=?,url=?,start=?,end=? WHERE id=?"; 
            $stmt = $db->prepare($sqlQ); 
            $stmt->bind_param("sssssi", $eventTitle, $eventDesc, $eventURL, $start, $end, $event_id); 
            $update = $stmt->execute(); 
     
            if($update){ 
                $output = [ 
                    'status' => 1 
                ]; 
                echo json_encode($output); 
            }else{ 
                echo json_encode(['error' => 'Event Update request failed!']); 
            } 
        } 
    }elseif($types == 'deleteEvent'){ 
        $id = $_POST['id']; 
     
        $sql = "DELETE FROM events WHERE id=$id"; 
        $delete = $db->query($sql); 
        if($delete){ 
            $output = [ 
                'status' => 1 
            ]; 
            echo json_encode($output); 
        }else{ 
            echo json_encode(['error' => 'Event Delete request failed!']); 
        } 
    } 
     
      
} else {
    // If the request method is not POST, handle the error
    echo "Error: This script only accepts POST requests";
}
?>
