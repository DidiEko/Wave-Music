<?php
// public/find_name.php (Sondages)

// --- SÉCURITÉ : Garde d'accès ---
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// 1. Inclusion du Modèle
// Chemin corrigé pour trouver 'src/Poll.php'
require_once __DIR__ . '/../src/Poll.php';

// 2. Création des données (comme dans l'original)
$artistPoll = new Poll('Vote pour l\'artiste de la semaine', ['Nekfeu','Orelsan','SCH']);
$top10Poll = new Poll('Vote pour le Top 10', ['Song1','Song2','Song3']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Sondages</title>
<link rel="stylesheet" href="style.css"> </head>
<body>

<?php include 'navbar.php'; ?>

<main>
    <section class="poll">
        <h1><?= $artistPoll->question ?></h1>
        <form>
            <?php foreach($artistPoll->options as $option): ?>
                <label>
                    <input type="radio" name="artist">
                    <?= $option ?>
                </label><br>
            <?php endforeach; ?>
            <button>Voter</button>
        </form>
    </section>

    <section class="poll">
        <h1><?= $top10Poll->question ?></h1>
        <form>
            <?php foreach($top10Poll->options as $option): ?>
                <label>
                    <input type="checkbox" name="top10[]">
                    <?= $option ?>
                </label><br>
            <?php endforeach; ?>
            <button>Voter</button>
        </form>
    </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>