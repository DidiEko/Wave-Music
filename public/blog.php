<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est authentifié
$userId = $_SESSION['user_id'] ?? null;

// L'utilisateur n'est pas authentifié
if (!$userId) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
    header('Location: auth/connexion.php');
    exit();
}

// Sinon, récupère les autres informations de l'utilisateur
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - BLOG</title>
<link rel="stylesheet" href="style.css"> </head>
<body>
 
<nav>
    <div class="logo">WAVE</div>
    <div class="nav-links">
        <a href="index.php">Spotlight</a>
        <a href="lastTop10.php">Top 10</a>
        <a href="sondage.php">Vote musique</a>
        <a href="calendar.php">Futurs evénements</a>
        <a href="blog.php">Blog</a>
        <a href="connexion.php">Connexion</a>
    </div>
</nav>
 
<main>

</main>

<footer>
    &copy; 2025 WAVE - Tous droits réservés
</footer>
 
</body>
</html>