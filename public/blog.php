<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est authentifié
$userId = $_SESSION['user_id'] ?? null;

// L'utilisateur n'est pas authentifié
if (!$userId) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
    header('Location: ./auth/connexion.php');
    exit();
}

// Sinon, récupère les autres informations de l'utilisateur
$username = $_SESSION['nom_utilisateur'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - BLOG</title>
<link rel="stylesheet" href="style.css"> </head>
<body>
 
<?php include './nav/nav.php'; ?>
 
<main>

</main>

<footer>
    &copy; 2025 WAVE - Tous droits réservés
</footer>
 
</body>
</html>