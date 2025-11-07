<?php
// Démarre la session (si pas déjà fait)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
$estConnecté = isset($_SESSION['user_id']);
$nom_utilisateur = $_SESSION['nom_utilisateur'] ?? '';
?>

<nav>
    <div class="logo">WAVE</div>
    <div class="nav-links">
        <a href="index.php">Spotlight</a>
        <a href="lastTop10.php">Top 10</a>
        <a href="sondage.php">Vote musique</a>
        <a href="calendar.php">Calendrier Concerts</a>
        <a href="blog.php">Blog</a>

        <?php if ($estConnecté): ?>
            <a href="compte/monCompte.php">Mon compte (<?= htmlspecialchars($nom_utilisateur) ?>)</a>
            <a href="auth/deconnexion.php" style="color: red;">Déconnexion</a>
        <?php else: ?>
            <!-- Si l'utilisateur n'est PAS connecté -->
            <a href="auth/connexion.php">Connexion</a>
        <?php endif; ?>
    </div>
</nav>