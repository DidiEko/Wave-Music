<?php
// Inclut le fichier contenant la classe Chipie
require_once __DIR__ . '/../src/Models/Chipie.php';

// Création d'un tableau de Chipies (actus ou petites infos)
$chipies = [
    new Chipie('Nouvelle sortie', 'Le dernier album de Nekfeu est sorti !'), // Première info
    new Chipie('Interview', 'Orelsan parle de son inspiration.'),           // Deuxième info
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Les Chipies</title>
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
<!-- Titre principal de la page -->
<h1>Les Chipies</h1>

<!-- Boucle pour afficher chaque Chipie -->
<?php foreach($chipies as $c): ?>
    <article>
        <!-- Titre de la Chipie -->
        <h2><?= $c->title ?></h2>
        <!-- Contenu ou description de la Chipie -->
        <p><?= $c->body ?></p>
    </article>
<?php endforeach; ?>
</main>
</body>
</html>
