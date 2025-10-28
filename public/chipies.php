<?php
// public/chipies.php

// --- SÉCURITÉ : Garde d'accès ---
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// 1. Inclusion du Modèle
// Chemin corrigé pour trouver 'src/Chipie.php'
require_once __DIR__ . '/../src/Chipie.php';

// 2. Création des données (comme dans l'original)
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
<link rel="stylesheet" href="style.css"> </head>
<body>

<?php include 'navbar.php'; ?>

<main>
    <h1>Les Chipies</h1>
    <?php foreach($chipies as $c): ?>
        <article>
            <h2><?= $c->title ?></h2>
            <p><?= $c->body ?></p>
        </article>
    <?php endforeach; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>