<?php
session_start();

// Database configuration
$servername = "mysql";
$dbUsername = "root";
$dbPassword = "password";
$dbname = "school";

// Create a connection to MySQLi
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize user input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_SESSION['userID'] === 1){
    $ID = $conn->real_escape_string($_POST['UserID']);
    }else{$ID = $_SESSION['userID'];}

    // Construct SQL query
    $sqlDelete = "DELETE FROM CRUDusers WHERE userID=$ID";

    // Execute the query and check for errors
    if ($conn->query($sqlDelete) === TRUE) {
        // Successful deletion
    } else {
        // Error handling (optional, but you can add error logging here)
    }
}

// Close the connection
$conn->close();
?>