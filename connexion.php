<?php
include 'config.php'; // Connexion à la base

// Vérifie que les champs sont remplis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nom && $prenom && $email) {

        $stmt = $conn->prepare("SELECT * FROM admins WHERE nom = ? AND prenom = ? AND email = ?");
        $stmt->bind_param("sss", $nom, $prenom, $email);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($result && $result->num_rows > 0) {
            session_start();
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $email;
            header("Location: liste.php");
            exit;
        } else {
  
            header("Location: formulaire.php?erreur=1");
            // echo'identifiant incorect';
            exit;
        }
    }
}
header("Location: formulaire.php?erreur=1");

exit;
