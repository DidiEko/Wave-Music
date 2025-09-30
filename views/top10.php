<?php
$top10 = [
    ['artist'=>'Nekfeu','song'=>'On Verra'],
    ['artist'=>'Orelsan','song'=>'Basique'],
    ['artist'=>'SCH','song'=>'Otto'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Top 10</title>
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
<h1>Top 10 des sons</h1>
<ol>
    <?php foreach($top10 as $entry): ?>
        <li><?= $entry['artist'] ?> - <?= $entry['song'] ?></li>
    <?php endforeach; ?>
</ol>
</main>
</body>
</html>
