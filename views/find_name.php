<?php
require_once __DIR__ . '/../src/Models/Poll.php';

$artistPoll = new Poll('Vote pour l\'artiste de la semaine', ['Nekfeu','Orelsan','SCH']);
$top10Poll = new Poll('Vote pour le Top 10', ['Song1','Song2','Song3']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Sondages</title>
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
<section class="poll">
    <h1><?= $artistPoll->question ?></h1>
    <form>
        <?php foreach($artistPoll->options as $option): ?>
            <label><input type="radio" name="artist"><?= $option ?></label><br>
        <?php endforeach; ?>
        <button>Voter</button>
    </form>
</section>

<section class="poll">
    <h1><?= $top10Poll->question ?></h1>
    <form>
        <?php foreach($top10Poll->options as $option): ?>
            <label><input type="checkbox" name="top10[]"><?= $option ?></label><br>
        <?php endforeach; ?>
        <button>Voter</button>
    </form>
</section>
</main>
</body>
</html>
