<?php include 'config.php';
$id = $_GET['id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE stagiaires SET nom=?, prenom=?, email=?, naissance=?, lieu_naissance=?, specialite=?, moyenne=?, mention=?, statut=? WHERE id=?");
    $stmt->bind_param("ssssssdssi", $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['naissance'], $_POST['lieu_naissance'], $_POST['specialite'], $_POST['moyenne'], $_POST['mention'], $_POST['statut'], $id);
    $stmt->execute();
    header("Location: liste.php");
}
$result = $conn->query("SELECT * FROM stagiaires WHERE id=$id");
$data = $result->fetch_assoc();
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier Stagiaire</title>
    <link rel="stylesheet" href="modifier.css">
</head>
<body>
    <h2>Modifier un Stagiaire</h2>
    <form method="POST" novalidate>
        <div>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($data['nom']) ?>" required>
        </div>

        <div>
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($data['prenom']) ?>" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
        </div>

        <div>
            <label for="naissance">Date de naissance</label>
            <input type="date" id="naissance" name="naissance" value="<?= htmlspecialchars($data['naissance']) ?>" required>
        </div>

        <div>
            <label for="lieu_naissance">Lieu de naissance</label>
            <input type="text" id="lieu_naissance" name="lieu_naissance" value="<?= htmlspecialchars($data['lieu_naissance']) ?>" required>
        </div>

        <div>
            <label for="specialite">Spécialité</label>
            <select id="specialite" name="specialite" required>
                <option value="developpement web" <?= $data['specialite'] === 'developpement web' ? 'selected' : '' ?>>Développement Web</option>
                <option value="multimedia" <?= $data['specialite'] === 'multimedia' ? 'selected' : '' ?>>Multimédia</option>
                <option value="cyber securite" <?= $data['specialite'] === 'cyber securite' ? 'selected' : '' ?>>Cybersécurité</option>
                <option value="reseaux" <?= $data['specialite'] === 'reseaux' ? 'selected' : '' ?>>Réseaux</option>
                <option value="Système numérique" <?= $data['specialite'] === 'Système numérique' ? 'selected' : '' ?>>Système numérique</option>
            </select>
        </div>

        <div>
            <label for="moyenne">Moyenne</label>
            <input type="number" id="moyenne" name="moyenne" step="0.01" min="0" max="20" value="<?= htmlspecialchars($data['moyenne']) ?>" required>
        </div>

        <div>
            <label for="mention">Mention</label>
            <select id="mention" name="mention" required>
                <option value="tres bien" <?= $data['mention'] === 'tres bien' ? 'selected' : '' ?>>Très bien</option>
                <option value="bien" <?= $data['mention'] === 'bien' ? 'selected' : '' ?>>Bien</option>
                <option value="passable" <?= $data['mention'] === 'passable' ? 'selected' : '' ?>>Passable</option>
                <option value="mediocre" <?= $data['mention'] === 'mediocre' ? 'selected' : '' ?>>Médiocre</option>
            </select>
        </div>

        <div>
            <label for="statut">Statut</label>
            <select id="statut" name="statut" required>
                <option value="admis" <?= $data['statut'] === 'admis' ? 'selected' : '' ?>>Admis</option>
                <option value="redoublant" <?= $data['statut'] === 'redoublant' ? 'selected' : '' ?>>Redoublant</option>
                <option value="exclu" <?= $data['statut'] === 'exclu' ? 'selected' : '' ?>>Exclu</option>
            </select>
        </div>

        <button type="submit">Modifier</button>
        <a href="liste.php" class="btn-back">Retour</a>
    </form>
</body>
</html>
