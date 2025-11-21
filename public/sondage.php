<?php
session_start();

const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../../src/config/database.ini';

$config = parse_ini_file(DATABASE_CONFIGURATION_FILE, true);

$db = $config['database'];
$pdo = new PDO(
    "mysql:host={$db['host']};port={$db['port']};dbname={$db['dbname']};charset=utf8mb4",
    $db['username'],
    $db['password']
);

// IDs des musiques sélectionnées
$ids = [4, 9, 10, 11, 12, 15, 16, 17, 18, 20];

$sql = "
    SELECT m.id, m.titre, m.lien_youtube, m.annee_sortie, a.nom_artiste
    FROM musique_wave AS m
    JOIN artistes_wave AS a ON m.artiste_id = a.id
    WHERE m.id IN (" . implode(',', $ids) . ")
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$musics = $stmt->fetchAll();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $classement = $_POST["classement"]; // tableau id => position
    echo "<pre>";
    print_r($classement);
    echo "</pre>";
    // Ici tu pourras enregistrer dans la base
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>WAVE - Vote Musical</title>
    <link rel="stylesheet" href="css/sondage.css">
</head>

</head>

<body>

    <?php include './nav/nav.php'; ?>

    <div class="container">
        <h1>🎵 Classe ton Top 10</h1>

        <form method="post">

            <table class="table-classement">
                <tr>
                    <th>Ordre</th>
                    <th>Titre</th>
                    <th>Artiste</th>
                    <th>Clip</th>
                </tr>

                <?php foreach ($musics as $music): ?>
                    <tr>
                        <td>
                            <select name="classement[<?= $music['id'] ?>]" required>
                                <option value="">--</option>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                        <td><?= htmlspecialchars($music['titre']) ?></td>
                        <td><?= htmlspecialchars($music['nom_artiste']) ?></td>
                        <td>
                            <a href="<?= htmlspecialchars($music['lien_youtube']) ?>" target="_blank">▶️ Voir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <button type="submit" class="btn">💾 Enregistrer</button>
        </form>
    </div>

    <footer>
        &copy; 2025 WAVE - Tous droits réservés
    </footer>

</body>

</html>