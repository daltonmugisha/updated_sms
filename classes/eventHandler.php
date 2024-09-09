<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');

include('./dbConfig.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventTitle = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $eventDesc = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $start = isset($_POST['start']) ? htmlspecialchars($_POST['start']) : '';
    $end = isset($_POST['end']) ? htmlspecialchars($_POST['end']) : '';
    $types = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';

    if ($types == 'addEvent') { 
        if (!empty($eventTitle)) { 
            $sqlQ = "INSERT INTO events (title, description, start, end) VALUES (?, ?, ?, ?)"; 
            $stmt = $db->prepare($sqlQ); 
            if ($stmt) {
                $stmt->bind_param("ssss", $eventTitle, $eventDesc, $start, $end); 
                $insert = $stmt->execute(); 
                if ($insert) { 
                    echo json_encode(['status' => 1]); 
                } else { 
                    echo json_encode(['error' => 'Event Add request failed!']); 
                }
            } else {
                echo json_encode(['error' => 'Database prepare failed: ' . $db->error]);
            }
        } else {
            echo json_encode(['error' => 'Event title is required.']);
        }
    } elseif ($types == 'editEvent') { 
        $event_id = isset($_POST['id']) ? intval($_POST['id']) : 0; 
        if (!empty($eventTitle) && $event_id > 0) { 
            $sqlQ = "UPDATE events SET title=?, description=?, start=?, end=? WHERE id=?"; 
            $stmt = $db->prepare($sqlQ); 
            if ($stmt) {
                $stmt->bind_param("ssssi", $eventTitle, $eventDesc, $start, $end, $event_id); 
                $update = $stmt->execute(); 
                if ($update) { 
                    echo json_encode(['status' => 1]); 
                } else { 
                    echo json_encode(['error' => 'Event Update request failed!']); 
                }
            } else {
                echo json_encode(['error' => 'Database prepare failed: ' . $db->error]);
            }
        } else {
            echo json_encode(['error' => 'Event title and ID are required.']);
        }
    } elseif ($types == 'deleteEvent') { 
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0; 
        if ($id > 0) { 
            $sql = "DELETE FROM events WHERE id=?"; 
            $stmt = $db->prepare($sql); 
            if ($stmt) {
                $stmt->bind_param("i", $id); 
                $delete = $stmt->execute(); 
                if ($delete) { 
                    echo json_encode(['status' => 1]); 
                } else { 
                    echo json_encode(['error' => 'Event Delete request failed!']); 
                }
            } else {
                echo json_encode(['error' => 'Database prepare failed: ' . $db->error]);
            }
        } else {
            echo json_encode(['error' => 'Event ID is required.']);
        }
    } else {
        echo json_encode(['error' => 'Invalid request type.']);
    }
} else {
    echo json_encode(['error' => 'This script only accepts POST requests']);
}
?>
