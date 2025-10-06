<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WAVE - Accueil</title>
    <!-- Lien vers le fichier CSS pour le style -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation principale -->
<nav>
    <div class="logo">WAVE</div> <!-- Logo du site -->
    <div class="nav-links">
        <a href="?p=home">Accueil</a>
        <a href="?p=spotlight">Spotlight</a>
        <a href="?p=top10">Top 10</a>
        <a href="?p=calendar">Concerts</a>
        <a href="?p=chipies">Les Chipies</a>
        <a href="?p=login">Admin</a>
    </div>
</nav>

<!-- Section Hero (bannière principale) -->
<header class="hero">
    <h1>Plongez dans le rap français</h1>
    <p>Découvertes, tops, concerts et plus encore.</p>
    <a href="?p=spotlight" class="btn big">Découvrir l’artiste du moment</a> <!-- Bouton principal -->
</header>

<main>
    <!-- Spotlight block : mise en avant de l’artiste de la semaine -->
    <section class="block">
        <h2>🎤 Spotlight</h2>
        <p>L’artiste mis en avant chaque semaine.</p>
        <div class="card-grid">
            <div class="card">
                <div class="card-img"></div> <!-- Image de l’artiste -->
                <h3>Nom de l'artiste</h3>
                <p>Court texte descriptif (remplaçable par la BDD).</p>
                <a href="?p=spotlight" class="btn">Voir plus</a>
            </div>
        </div>
    </section>

    <!-- Top 10 block : les sons les plus écoutés -->
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
        <a href="?p=top10" class="btn">Voir le classement complet</a>
    </section>

    <!-- Concerts block : prochains concerts -->
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
        <a href="?p=calendar" class="btn">Voir le calendrier</a>
    </section>

    <!-- Chipies block : petites actus ou news -->
    <section class="block">
        <h2>💎 Les Chipies</h2>
        <div class="card-grid">
            <div class="card">
                <h3>Titre article</h3>
                <p>Petit extrait de l’actu.</p>
                <a href="?p=chipies" class="btn">Lire</a>
            </div>
        </div>
    </section>

    <!-- Newsletter block : formulaire d’abonnement -->
    <section class="block newsletter">
        <h2>📩 Newsletter</h2>
        <p>Recevez chaque semaine les actus et tops directement par email.</p>
        <form>
            <input type="email" placeholder="Votre email" required> <!-- Champ email obligatoire -->
            <button type="submit" class="btn">S’abonner</button> <!-- Bouton d’envoi -->
        </form>
    </section>
</main>

<!-- Pied de page -->
<footer>
    &copy; 2025 WAVE - Tous droits réservés
</footer>

</body>
</html>
