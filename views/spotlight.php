<?php
require_once __DIR__ . '/../src/Models/Artist.php';
require_once __DIR__ . '/../src/Models/Song.php';

// Placeholder pour l'artiste de la semaine
$artist = new Artist('Nekfeu', 'Rappeur talentueux du rap français.', 'assets/nekfeu.jpg');
$songs = [
    new Song('On Verra'),
    new Song('Ma Dope'),
    new Song('Reuf'),
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Spotlight</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="index.php?p=home">Accueil</a>
        <a href="index.php?p=spotlight">Spotlight</a>
        <a href="index.php?p=find_name">Sondages</a>
        <a href="index.php?p=top10">Top 10</a>
        <a href="index.php?p=calendar">Concerts</a>
        <a href="index.php?p=chipies">Les Chipies</a>
        <a href="index.php?p=login">Admin</a>
    </nav>
</header>

<main>
    <section class="spotlight">
        <h1>Artiste de la semaine : <?= $artist->name ?></h1>
        <img src="<?= $artist->image ?>" alt="<?= $artist->name ?>" width="250">
        <p><?= $artist->bio ?></p>
        <h2>Meilleurs sons :</h2>
        <ul>
            <?php foreach($songs as $song): ?>
                <li><?= $song->title ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
</body>
</html>
