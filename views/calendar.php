<?php
require_once __DIR__ . '/../src/Models/Event.php';
$events = [
    new Event('Concert Nekfeu', 'Paris', '2025-10-10'),
    new Event('Festival Orelsan', 'Lyon', '2025-11-05'),
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Concerts</title>
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
<h1>Agenda des concerts</h1>
<ul>
    <?php foreach($events as $e): ?>
        <li><?= $e->date ?> - <?= $e->title ?> (<?= $e->location ?>)</li>
    <?php endforeach; ?>
</ul>
</main>
</body>
</html>
