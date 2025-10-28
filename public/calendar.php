<?php
// public/calendar.php

// --- SÉCURITÉ : Garde d'accès ---
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// 1. Inclusion du Modèle
// Le chemin est corrigé pour remonter et trouver 'src/Event.php'
require_once __DIR__ . '/../src/Event.php';

// 2. Création des données (comme dans l'original)
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
<link rel="stylesheet" href="style.css"> </head>
<body>

<?php include 'navbar.php'; ?>

<main>
    <h1>Agenda des concerts</h1>
    <ul>
        <?php foreach($events as $e): ?>
            <li>
                <?= $e->date ?> - <?= $e->title ?> (<?= $e->location ?>)
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php include 'footer.php'; ?>

</body>
</html>