<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
<link rel="stylesheet" href="formulaire.css">
</head>
<body>
    <h2> CENTRE TIC-NKOK</h2>
    <form method="POST" action="connexion.php">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
        </div>
        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <button type="submit">Liste des stagiaires</button>
        <a href="index.html" class="btn-secondary">Retour</a>
    </form>
</body>
</html>

