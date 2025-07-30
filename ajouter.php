<?php include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO stagiaires (nom, prenom, email, naissance, lieu_naissance, specialite, moyenne, mention, statut) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssdss", $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['naissance'], $_POST['lieu_naissance'], $_POST['specialite'], $_POST['moyenne'], $_POST['mention'], $_POST['statut']);
    $stmt->execute();
    header("Location: liste.php");
    exit;
}
?>

<?php
// Ici tu peux avoir ta logique PHP si nécessaire (ex: traitement POST)
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Ajouter un Stagiaire</title>
<link rel="stylesheet" href="ajouter.css">
</head>
<body>
    <h2>Ajouter un Stagiaire</h2>
    <form method="POST" novalidate>
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="naissance">Date de naissance</label>
        <input type="date" id="naissance" name="naissance" required>

        <label for="lieu_naissance">Lieu de naissance</label>
        <input type="text" id="lieu_naissance" name="lieu_naissance" required>

        <label for="specialite">Spécialité</label>
        <select id="specialite" name="specialite" required>
            <option value="" disabled selected>-- Choisir une spécialité --</option>
            <option value="developpement web">Développement Web</option>
            <option value="multimedia">Multimédia</option>
            <option value="cyber securite">Cybersécurité</option>
            <option value="reseaux">Réseaux</option>
            <option value="Système numérique">Système numérique</option>
        </select>

        <label for="moyenne">Moyenne</label>
        <input type="number" id="moyenne" name="moyenne" step="0.01" min="0" max="20" required>

        <label for="mention">Mention</label>
        <select id="mention" name="mention" required>
            <option value="" disabled selected>-- Choisir une mention --</option>
            <option value="tres bien">Très bien</option>
            <option value="bien">Bien</option>
            <option value="passable">Passable</option>
            <option value="mediocre">Médiocre</option>
        </select>

        <label for="statut">Statut</label>
        <select id="statut" name="statut" required>
            <option value="" disabled selected>-- Choisir un statut --</option>
            <option value="admis">Admis</option>
            <option value="redoublant">Redoublant</option>
            <option value="exclu">Exclu</option>
        </select>

        <button type="submit">Ajouter</button>
        <a href="liste.php" class="btn-back">Retour</a>
    </form>
</body>
</html>
