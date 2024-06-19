<?php
$servername = "mysql";
$username = "root";
$password = "password";
$dbname = "school";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully <br>";



// Gebruikersinvoer (bijv. van een formulier)
$username = $_POST['naam'];
$email = $_POST['e-mail'];
$password = $_POST['wachtwoord'];
$Age = $_POST['leeftijd'];
$geslacht = $_POST['geslacht'];
$adres = $_POST['adres'];

// Hash het wachtwoord
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Voorbereid de query voor het invoegen van de gebruiker
$stmt = $conn->prepare("INSERT INTO CRUDusers (username, email, WW, Age, geslacht, adres) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $username, $email, $hashedPassword, $Age, $geslacht, $adres);

// Voer de query uit
$stmt->execute();

//echo "Nieuw record succesvol aangemaakt" . "<br>";

$stmt->close();



//het laten zien van de database
$sql = "SELECT userID, username, email, WW, Age, geslacht, adres FROM CRUDusers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    //echo "userID: " . $row["userID"]. " -|| username: " . $row["username"]. " -|| email: " . $row["email"]." -|| wachtwoord: " . $row["WW"]. "<br>";
  }
} else {
  echo "0 results";
}
header("Location: CRUDlogin.php");
$conn->close();
?>