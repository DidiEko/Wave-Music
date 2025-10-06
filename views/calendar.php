<?php
// Inclut le fichier contenant la classe Event
require_once __DIR__ . '/../src/Models/Event.php';

// Création d'un tableau d'événements avec des objets Event
$events = [
    new Event('Concert Nekfeu', 'Paris', '2025-10-10'),    // Premier événement
    new Event('Festival Orelsan', 'Lyon', '2025-11-05'),   // Deuxième événement
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Concerts</title>
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
<h1>Agenda des concerts</h1>

<!-- Liste des événements -->
<ul>
    <?php foreach($events as $e): ?> <!-- Boucle sur chaque événement -->
        <li>
            <?= $e->date ?> - <?= $e->title ?> (<?= $e->location ?>)
            <!-- Affiche la date, le titre et le lieu de l'événement -->
        </li>
    <?php endforeach; ?>
</ul>
</main>
</body>
</html>
