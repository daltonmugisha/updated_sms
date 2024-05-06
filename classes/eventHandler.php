<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'title' field is set in the POST data
    if (isset($_POST['title'])) {
        // Retrieve the values from the POST data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $url = $_POST['url'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        // Now you can use these variables as needed
        // For example, you can echo them or perform database operations
        echo "Title: " . $title . "<br>";
        echo "Description: " . $description . "<br>";
        echo "URL: " . $url . "<br>";
        echo "Start: " . $start . "<br>";
        echo "End: " . $end . "<br>";

        // Here you can perform any other processing or validation
        // For example, saving the data to a database
    } else {
        // If 'title' field is not set in the POST data, handle the error
        echo "Error: 'title' field is not set in the POST data";
    }
} else {
    // If the request method is not POST, handle the error
    echo "Error: This script only accepts POST requests";
}
?>
