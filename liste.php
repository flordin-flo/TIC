<?php
include 'config.php';

// Récupérer les filtres sélectionnés
$selectedSpecialite = $_GET['specialite'] ?? '';
$selectedStatut = $_GET['statut'] ?? '';
$selectedMention = $_GET['mention'] ?? '';

// Construire dynamiquement la requête avec les filtres
$conditions = [];
$params = [];
$types = '';

if ($selectedSpecialite !== '') {
    $conditions[] = "specialite = ?";
    $params[] = $selectedSpecialite;
    $types .= 's';
}
if ($selectedStatut !== '') {
    $conditions[] = "statut = ?";
    $params[] = $selectedStatut;
    $types .= 's';
}
if ($selectedMention !== '') {
    $conditions[] = "mention = ?";
    $params[] = $selectedMention;
    $types .= 's';
}

$sql = "SELECT * FROM stagiaires";
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

if ($stmt = $conn->prepare($sql)) {
    if (count($params) > 0) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // En cas d'erreur préparation, on récupère tout
    $result = $conn->query("SELECT * FROM stagiaires");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des stagiaires</title>
 <link rel="stylesheet" href="liste.css">
</head>
<body>
    <h2>Liste des stagiaires</h2>

    <a href="ajouter.php" class="btn btn-primary">Ajouter un stagiaire</a>

    <form method="GET" class="filter-form" >
        <div>
            <label for="specialite">Spécialité :</label>
            <select name="specialite" id="specialite">
                <option value="">-- choisir une Spécialité --</option>
                <option value="developpement web" <?= ($selectedSpecialite == 'developpement web') ? 'selected' : '' ?>>Développement Web</option>
                <option value="multimedia" <?= ($selectedSpecialite == 'multimedia') ? 'selected' : '' ?>>Multimédia</option>
                <option value="cyber securite" <?= ($selectedSpecialite == 'cyber securite') ? 'selected' : '' ?>>Cyber Sécurité</option>
                <option value="reseaux" <?= ($selectedSpecialite == 'reseaux') ? 'selected' : '' ?>>Réseaux</option>
                <option value="Système numérique" <?= ($selectedSpecialite == 'Système numérique') ? 'selected' : '' ?>>Système numérique</option>
            </select>
        </div>

        <div>
            <label for="statut">Statut :</label>
            <select name="statut" id="statut">
                <option value="">-- choisir un statut --</option>
                <option value="admis" <?= ($selectedStatut == 'admis') ? 'selected' : '' ?>>Admis</option>
                <option value="redoublant" <?= ($selectedStatut == 'redoublant') ? 'selected' : '' ?>>Redoublant</option>
                <option value="exclu" <?= ($selectedStatut == 'exclu') ? 'selected' : '' ?>>Exclu</option>
            </select>
        </div>

        <div>
            <label for="mention">Mention :</label>
            <select name="mention" id="mention">
                <option value="">-- choisir une mention --</option>
                <option value="tres bien" <?= ($selectedMention == 'tres bien') ? 'selected' : '' ?>>Très bien</option>
                <option value="bien" <?= ($selectedMention == 'bien') ? 'selected' : '' ?>>Bien</option>
                <option value="passable" <?= ($selectedMention == 'passable') ? 'selected' : '' ?>>Passable</option>
                <option value="mediocre" <?= ($selectedMention == 'mediocre') ? 'selected' : '' ?>>Médiocre</option>
            </select>
        </div>

        <div class="buttons">
            <button type="submit" class="btn btn-secondary">Filtrer</button>
            <?php if ($selectedSpecialite || $selectedStatut || $selectedMention) : ?>
                <a href="liste.php" class="btn btn-outline-secondary">Réinitialiser</a>
            <?php endif; ?>
        </div>
    </form>

    <table >
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Spécialité</th>
                <th>Moyenne</th>
                <th>Statut</th>
                <th>Mention</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . htmlspecialchars($row['nom']) . "</td>
                <td>" . htmlspecialchars($row['prenom']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['specialite']) . "</td>
                <td>" . htmlspecialchars($row['moyenne']) . "</td>
                <td>" . htmlspecialchars($row['statut']) . "</td>
                <td>" . htmlspecialchars($row['mention']) . "</td>
                <td>
                    <a href='modifier.php?id=" . $row['id'] . "' class='btn btn-warning'>Modifier</a>
                    <a href='supprimer.php?id=" . $row['id'] . "' class='btn btn-danger'>Supprimer</a>
                </td>
            </tr>";
        }

        if (isset($stmt) && $stmt) {
            $stmt->close();
        }
        ?>
        </tbody>
    </table>
</body>
</html>
