<?php
// public/spotlight.php

// --- SÉCURITÉ : Garde d'accès ---
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WAVE - Spotlight</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>

<?php include 'navbar.php'; ?>

<header class="hero">
    <h1>🎤 Spotlight</h1>
    <p>Découvrez l’artiste de la semaine</p>
</header>

<main>
    <section class="block">
        <h2>Artiste en avant</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-img"></div>
                <h3>Nom de l’artiste</h3>
                <p>Biographie courte ici (remplaçable par la BDD).</p>
                <a href="#" class="btn">Écouter maintenant</a>
            </div>
        </div>
    </section>

    <section class="block">
        <h2>Nos 5 songs préférés de Gims</h2>
        <div class="list">
            <ul>
                <li>1. Chanson 1</li>
                <li>2. Chanson 2</li>
                <li>3. Chanson 3</li>
                <li>4. Chanson 4</li>
                <li>5. Chanson 5</li>
            </ul>
        </div>
    </section>

    </main>

<?php include 'footer.php'; ?>

</body>
</html>