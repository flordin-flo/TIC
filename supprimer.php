<?php include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM stagiaires WHERE id=$id");
header("Location: liste.php");
?>