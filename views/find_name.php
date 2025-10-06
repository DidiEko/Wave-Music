<?php
// Inclut le fichier contenant la classe Poll
require_once __DIR__ . '/../src/Models/Poll.php';

// Création de sondages avec la classe Poll
$artistPoll = new Poll('Vote pour l\'artiste de la semaine', ['Nekfeu','Orelsan','SCH']); // Sondage artiste de la semaine
$top10Poll = new Poll('Vote pour le Top 10', ['Song1','Song2','Song3']); // Sondage Top 10
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Sondages</title>
<!-- Lien vers le fichier CSS pour le style -->
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <!-- Barre de navigation principale -->
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
<!-- Section du sondage pour l'artiste de la semaine -->
<section class="poll">
    <!-- Affiche la question du sondage -->
    <h1><?= $artistPoll->question ?></h1>

    <!-- Formulaire pour voter -->
    <form>
        <?php foreach($artistPoll->options as $option): ?> <!-- Boucle sur chaque option -->
            <label>
                <input type="radio" name="artist"> <!-- Bouton radio pour sélectionner une option -->
                <?= $option ?> <!-- Affiche le nom de l'artiste -->
            </label><br>
        <?php endforeach; ?>
        <button>Voter</button> <!-- Bouton pour soumettre le vote -->
    </form>
</section>

<!-- Section du sondage Top 10 -->
<section class="poll">
    <h1><?= $top10Poll->question ?></h1>
    <form>
        <?php foreach($top10Poll->options as $option): ?> <!-- Boucle sur chaque option -->
            <label>
                <input type="checkbox" name="top10[]"> <!-- Case à cocher pour sélectionner plusieurs options -->
                <?= $option ?> <!-- Affiche le nom de la chanson -->
            </label><br>
        <?php endforeach; ?>
        <button>Voter</button> <!-- Bouton pour soumettre le vote -->
    </form>
</section>
</main>
</body>
</html>
