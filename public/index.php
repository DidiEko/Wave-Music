<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WAVE - Accueil</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>

<?//php include 'navbar.php'; ?>

<header class="hero">
    <h1>Plongez dans le rap français</h1>
    <p>Découvertes, tops, concerts et plus encore.</p>
    <a href="spotlight.php" class="btn big">Découvrir l’artiste du moment</a>
</header>

<nav>
    <div class="logo">WAVE</div>
    <div class="nav-links">
        <a href="index.php">Accueil</a>
        <a href="spotlight.php">Spotlight</a>
        <a href="lastTop10.php">Top 10</a>
        <a href="sondage.php">Vote musique</a>
        <a href="calendar.php">Futurs evénements</a>
        <a href="blog.php">Blog</a>
        <a href="connexion.php">connexion</a>
    </div>
</nav>

<main>
    <section class="block">
        <h2>🎤 Spotlight</h2>
        <p ><a href="spotlight.php" class="btn">Découvrez l'artiste du mois de Janvier! ❄️</a></p>
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

<footer>
    &copy; 2025 WAVE - Tous droits réservés
</footer>

<?//php include 'footer.php'; ?>

</body>
</html>