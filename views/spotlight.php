<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WAVE - Spotlight</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation principale -->
<nav>
    <div class="logo">WAVE</div>
    <div class="nav-links">
        <a href="?p=home">Accueil</a>
        <a href="?p=spotlight" class="active">Spotlight</a> <!-- Page active -->
        <a href="?p=top10">Top 10</a>
        <a href="?p=calendar">Concerts</a>
        <a href="?p=chipies">Les Chipies</a>
        <a href="?p=login">Admin</a>
    </div>
</nav>

<!-- En-tête Spotlight -->
<header class="hero">
    <h1>🎤 Spotlight</h1>
    <p>Découvrez l’artiste de la semaine</p>
</header>

<main>
    <!-- Bloc Artiste en avant -->
    <section class="block">
        <h2>Artiste en avant</h2>
        <div class="card-grid">
            <div class="card">
                <div class="card-img"></div> <!-- Image de l'artiste -->
                <h3>Nom de l’artiste</h3>
                <p>Biographie courte ici (remplaçable par la BDD).</p>
                <a href="#" class="btn">Écouter maintenant</a> <!-- Lien vers musique / streaming -->
            </div>
        </div>
    </section>

    <!-- Bloc Top chansons -->
    <section class="block">
        <h2>🔥 Top chansons</h2>
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

    <!-- Bloc Actualités de l'artiste -->
    <section class="block">
        <h2>📰 Dernières actualités</h2>
        <div class="card-grid">
            <div class="card">
                <h3>Article 1</h3>
                <p>Petit extrait de l’actualité de l’artiste.</p>
                <a href="#" class="btn">Lire</a>
            </div>
            <div class="card">
                <h3>Article 2</h3>
                <p>Petit extrait de l’actualité de l’artiste.</p>
                <a href="#" class="btn">Lire</a>
            </div>
        </div>
    </section>

    <!-- Bloc Concerts à venir -->
    <section class="block">
        <h2>🎶 Concerts à venir</h2>
        <div class="card-grid">
            <div class="card">
                <h3>Ville A</h3>
                <p>Date – Lieu</p> <!-- Informations du concert -->
            </div>
            <div class="card">
                <h3>Ville B</h3>
                <p>Date – Lieu</p>
            </div>
        </div>
    </section>
</main>

<!-- Pied de page -->
<footer>
    &copy; 2025 WAVE - Tous droits réservés
</footer>

</body>
</html>
