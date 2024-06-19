<?PHP
session_start();

// Database configuratie
$servername = "mysql";
$dbUsername = "root";
$dbPassword = "password";
$dbname = "school";

// Maak een verbinding met MySQLi
$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all users
if($_SESSION['userID'] === 1){
$sql = "SELECT * FROM CRUDusers";
}else{
$ID = $_SESSION['userID'];
$sql = "SELECT * FROM CRUDusers WHERE userID = $ID";
}
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Output the data in a table
echo "<table>
<tr>
<th>UserID<?th>
<th>Username</th>
<th>E-mail</th>
<th>Geboortedatum</th>
<th>Geslacht</th>
<th>Adres</th>
</tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['userID']) . "</td>";
    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td>" . htmlspecialchars($row['Age']) . "</td>";
    echo "<td>" . htmlspecialchars($row['geslacht']) . "</td>";
    echo "<td>" . htmlspecialchars($row['adres']) . "</td>";
    echo "</tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);
?>