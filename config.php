<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "TIC";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}
?>