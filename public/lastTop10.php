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
        m.lien_youtube,
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
    <meta name="color-scheme" content="dark light">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Top 10 des musiques - WAVE</title>

    <style>
        body {
            background: #0d0d0d;
            color: #fff;
        }

        .top10-container {
            max-width: 550px;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .music-card {
            padding: 1rem 1.3rem;
            border-radius: 1rem;
            border: 1px solid #444;
            background: #151515;
            color: #fff;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .music-card:hover {
            transform: scale(1.03);
            background: #1b1b1b;
        }

        /* Styles podium */
        .first {
            border-color: #ffd700;
            background: linear-gradient(135deg, #2b2100, #5f4e00, #ffd70040);
        }

        .second {
            border-color: #c0c0c0;
            background: linear-gradient(135deg, #2a2a2a, #6f6f6f, #c0c0c040);
        }

        .third {
            border-color: #cd7f32;
            background: linear-gradient(135deg, #2d1f14, #7a4c2e, #cd7f3240);
        }

        .music-rank {
            font-weight: 700;
            font-size: 1rem;
            opacity: 0.85;
        }

        .music-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0.2rem 0 0.2rem 0;
        }

        .music-artist {
            margin: 0;
            opacity: 0.85;
        }

        .music-meta {
            margin-top: 0.4rem;
            font-size: 0.85rem;
            opacity: 0.8;
        }

        a.card-link {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>

    <?php include 'nav/nav.php'; ?>

    <main class="container">
        <h1>🎵 Top 10 des musiques</h1>
        <p>Classement mis à jour automatiquement.</p>

        <section class="top10-container">
            <?php foreach ($musics as $index => $music): ?>

                <?php
                $rank = $index + 1;

                // Podium
                $extraClass = '';
                if ($rank === 1) $extraClass = 'first';
                elseif ($rank === 2) $extraClass = 'second';
                elseif ($rank === 3) $extraClass = 'third';

                // S'il manque la clé ou que c'est NULL → $url sera null
                $url = $music['lien_youtube'] ?? null;
                ?>

                <?php if (!empty($url)): ?>
                    <a href="<?= htmlspecialchars((string)$url) ?>" target="_blank" class="card-link">
                <?php endif; ?>

                    <article class="music-card <?= $extraClass ?>">
                        <div class="music-rank">#<?= $rank ?></div>

                        <h2 class="music-title">
                            <?= htmlspecialchars($music['titre']) ?>
                        </h2>

                        <p class="music-artist">
                            <?= htmlspecialchars($music['nom_artiste']) ?>
                            (<?= htmlspecialchars($music['pays_unicode']) ?>)
                        </p>

                        <p class="music-meta">
                            Sortie en <strong><?= htmlspecialchars($music['annee_sortie']) ?></strong>
                        </p>
                    </article>

                <?php if (!empty($url)): ?>
                    </a>
                <?php endif; ?>

            <?php endforeach; ?>
        </section>
    </main>

    <footer>
        &copy; 2025 WAVE - Tous droits réservés
    </footer>

</body>
</html>