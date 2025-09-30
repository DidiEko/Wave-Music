<?php
require_once __DIR__ . '/../src/Models/Chipie.php';
$chipies = [
    new Chipie('Nouvelle sortie', 'Le dernier album de Nekfeu est sorti !'),
    new Chipie('Interview', 'Orelsan parle de son inspiration.'),
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Les Chipies</title>
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
<h1>Les Chipies</h1>
<?php foreach($chipies as $c): ?>
    <article>
        <h2><?= $c->title ?></h2>
        <p><?= $c->body ?></p>
    </article>
<?php endforeach; ?>
</main>
</body>
</html>
