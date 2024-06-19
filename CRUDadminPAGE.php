<?php 
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

if($_SESSION['userID'] != 1){
    header("Location: CRUDlogin.php");
}
?>

<html>
<head>
    <title>CRUD login</title>
    <link href="CRUDmainPAGE.css" rel="stylesheet">

    <!-- voor het laten zien van de users -->
    <script>
        function SHOWusers(str = '') {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("SHOWusers").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "CRUDread.php" + str, true);
            xmlhttp.send();
        }


        //voor het verwijderen van users
        function AjaxDelete(){
            var form = document.getElementById('deleteForm');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'CRUDdelete.php', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Only call SHOWusers() after a successful response
                    SHOWusers();
                }
            };

            xhr.send(formData);
        }


        //voor het updaten van user info
        function AjaxUpdate() {
            var form = document.getElementById('UpdateUser');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'CRUDupdate.php', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Only call SHOWusers() after a successful response
                    SHOWusers();
                }
            };

            xhr.send(formData);
        }


        //voor het veranderen van je wachtwoord
        function AjaxUpdateWW(){
            var form = document.getElementById('UpdateWWform');
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'CRUDupdateWW.php', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Only call SHOWusers() after a successful response
                    SHOWusers();
                    console.log("wachtwoord veranderd");
                }
            };

            xhr.send(formData);
        }
    </script>

</head>
<body onload="SHOWusers()">
    <div class="grid-container">
        <div class="grid-item1">ADMIN PAGE!!!!!!!!</div>

        <div class="grid-item2">
            <form action="CRUDuitloggen.php" method="POST">
                <input type="submit" name="uitloggen" id="uitlogbutton" value="uitloggen" />
            </form>
        </div>

        <div id="SHOWusers">
            <!-- Content will be loaded here by AJAX -->
        </div>

        <div id="DeleteUser">
            <form id="deleteForm">
                <fieldset id="feld">
                <p id="PDelete">Users Deleten</p>
                    <label for="UserID">Select ID:</label>
                    <input type="text" name="UserID" required><br>

                    <input id="DeleteButton" type="submit" value="Delete User" onclick="AjaxDelete()">
                </fieldset>
            </form>
        </div>

        <div id="UpdateUserInfo">
            <form id="UpdateUser" method="POST">
                <fieldset id="UpdateFeld">
                <p id="PUpdate">Users Updaten</p>
                    <label for="UpdateUserID">Select UserID: </label>
                    <input type="text" name="UpdateUserID" required><br><br>

                    <label for="UpdateInfo">Update Info:   </label>
                    <input type="text" name="UpdateInfo" required><br>

                    <label for="SelectUser"></label>
                    <select name="SelectUser" id="SelectToUpdate">
                        <option value="">Select info to update:</option>
                        <option value="username">username</option>
                        <option value="email">E-mail</option>
                        <option value="Age">geboortedatum</option>
                        <option value="geslacht">geslacht</option>
                        <option value="adres">adres</option>
                    </select>

                    <input id="UpdateButton" type="submit" value="Update User Info" onclick="AjaxUpdate()">
                </fieldset>
            </form>
        </div>

        <div id="UpdatePasswoord">
            <form id="UpdateWWform" methhod="POST">
                <fieldset id="UpdateWWfeld">
                <p id="WWUpdate">wachtwoord veranderen<p>
                    <label for="UpdateUserWW">Select UserID: </label>
                    <input type="text" name="UpdateUserWW" required><br><br>

                    <label for="newWW">nieuw wachtwoord: </label>
                    <input type="text" name="newWW" require><br>

                    <input id="UpdateWWbutton" type="submit" value="Update wachtwoord" onclick="AjaxUpdateWW()">
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>