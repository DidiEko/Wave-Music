<?php
// public/home.php

// --- SÉCURITÉ 1 : Garde d'accès ---
// On vérifie que l'utilisateur est bien connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    // Si non, on le renvoie à la page de connexion
    header('Location: login.php');
    exit;
}
// (Si vous avez besoin de données de la BDD, incluez config.php ici)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WAVE - Accueil</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>

<?php include 'navbar.php'; ?>

<header class="hero">
    <h1>Plongez dans le rap français</h1>
    <p>Découvertes, tops, concerts et plus encore.</p>
    <a href="spotlight.php" class="btn big">Découvrir l’artiste du moment</a>
</header>

<main>
    <section class="block">
        <h2>🎤 Spotlight</h2>
        <p>L’artiste mis en avant chaque semaine.</p>
        <div class="card-grid">
            <div class="card">
                <div class="card-img"></div>
                <h3>Nom de l'artiste</h3>
                <p>Court texte descriptif (remplaçable par la BDD).</p>
                <a href="spotlight.php" class="btn">Voir plus</a> </div>
        </div>
    </section>

    <section class="block">
        <h2>🔥 Top 10</h2>
        <p>Les sons les plus écoutés.</p>
        <div class="list">
            <ul>
                <li>1. Titre 1</li>
                <li>2. Titre 2</li>
                <li>3. Titre 3</li>
                <li>...</li>
            </ul>
        </div>
        <a href="top10.php" class="btn">Voir le classement complet</a> </section>

    <section class="block">
        <h2>🎶 Concerts à venir</h2>
        <div class="card-grid">
            <div class="card">
                <h3>Artiste X</h3>
                <p>Ville, Date</p>
            </div>
            <div class="card">
                <h3>Artiste Y</h3>
                <p>Ville, Date</p>
            </div>
        </div>
        <a href="calendar.php" class="btn">Voir le calendrier</a> </section>

    <section class="block">
        <h2>💎 Les Chipies</h2>
        <div class="card-grid">
            <div class="card">
                <h3>Titre article</h3>
                <p>Petit extrait de l’actu.</p>
                <a href="chipies.php" class="btn">Lire</a> </div>
        </div>
    </section>

    <section class="block newsletter">
        <h2>📩 Newsletter</h2>
        <p>Recevez chaque semaine les actus et tops directement par email.</p>
        <form>
            <input type="email" placeholder="Votre email" required>
            <button type="submit" class="btn">S’abonner</button>
        </form>
    </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>