<?php
session_start();

const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../src/config/database.ini';

// Lire le fichier de config
$config = parse_ini_file(DATABASE_CONFIGURATION_FILE, true);

if (!$config) {
    throw new Exception("Erreur lors de la lecture du fichier de configuration : " . DATABASE_CONFIGURATION_FILE);
}

// Paramètres DB
$db       = $config['database'];
$host     = $db['host'];
$port     = $db['port'];
$dbname   = $db['dbname'];
$username = $db['username'];
$password = $db['password'];

// Connexion à la DB
$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);

// Requête : musiques + artistes (TOP 10)
$sql = "
    SELECT 
        m.id AS musique_id,
        m.titre,
        m.annee_sortie,
        a.id AS artiste_id,
        a.nom_artiste,
        a.pays_unicode
    FROM musique_wave AS m
    JOIN artistes_wave AS a ON m.artiste_id = a.id
    ORDER BY m.annee_sortie DESC, m.titre ASC
    LIMIT 10
";

// Prépare + exécute
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Tableau des musiques
$musics = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Top 10 des musiques - WAVE</title>

    <style>
        .top10-container {
            display: grid;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .top10-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .music-card {
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid #333;
        }

        .music-rank {
            font-weight: 700;
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .music-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0.2rem 0 0.4rem 0;
        }

        .music-artist {
            margin: 0;
            opacity: 0.9;
        }

        .music-meta {
            margin-top: 0.4rem;
            font-size: 0.9rem;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <?php include 'nav/nav.php'; ?>

    <main class="container">
        <h1>🎵 Top 10 des musiques</h1>
        <p>Top 10 généré automatiquement à partir de la base WAVE.</p>

        <?php if (empty($musics)) : ?>
            <p>Aucune musique trouvée dans la base.</p>
        <?php else : ?>
            <section class="top10-container">
                <?php foreach ($musics as $index => $music) : ?>
                    <article class="music-card">
                        <div class="music-rank">#<?= $index + 1 ?></div>
                        <h2 class="music-title">
                            <?= htmlspecialchars($music['titre']) ?>
                        </h2>
                        <p class="music-artist">
                            <?= htmlspecialchars($music['nom_artiste']) ?>
                            (<?= htmlspecialchars($music['pays_unicode']) ?>)
                        </p>
                        <p class="music-meta">
                            Sortie en
                            <strong><?= htmlspecialchars($music['annee_sortie']) ?></strong>
                        </p>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>

    <footer>
        &copy; 2025 WAVE - Tous droits réservés
    </footer>
</body>

</html>
