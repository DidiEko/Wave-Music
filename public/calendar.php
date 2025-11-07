<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est authentifié
$userId = $_SESSION['user_id'] ?? null;

// L'utilisateur n'est pas authentifié
if (!$userId) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
    header('Location: connexion.php');
    exit();
}

// Sinon, récupère les autres informations de l'utilisateur
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Calendrier Concerts</title>
<link rel="stylesheet" href="style.css"> </head>
<body>
 
<?php include './nav/nav.php'; ?>

 
<main>
    <h1>Agenda des concerts</h1>
    <ul>
    </ul>
</main>
 
<footer>
    &copy; 2025 WAVE - Tous droits réservés
</footer>
 
</body>
</html>
 