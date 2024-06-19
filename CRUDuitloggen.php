<?php 
session_start();

$uitlog = $_POST['uitloggen'];
if($uitlog){
    session_unset();
    session_destroy();
    header("Location: CRUDlogin.php");
}
?>