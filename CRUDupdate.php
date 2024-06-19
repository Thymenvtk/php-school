<?php
session_start();

$servername = "mysql";
$dbUsername = "root";
$dbPassword = "password";
$dbname = "school";

// Create a connection with MySQLi
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and validate user input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_SESSION['userID'] === 1){
    $ID = $conn->real_escape_string($_POST['UpdateUserID']);
    }else{$ID = $_SESSION['userID'];}
    $Update = $conn->real_escape_string($_POST['UpdateInfo']);
    $select = $conn->real_escape_string($_POST['SelectUser']);

    if (!empty($ID) && !empty($Update) && !empty($select)) {
        // Construct the SQL query
        $sqlUpdate = "UPDATE CRUDusers SET $select = ? WHERE userID = ?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($sqlUpdate)) {
            // Bind parameters
            $stmt->bind_param('ss', $Update, $ID);

            // Execute the query and check for errors
            if ($stmt->execute()) {
                echo "User info updated successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

// Close the connection
$conn->close();
?>