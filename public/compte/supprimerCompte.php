<?php
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

require_once __DIR__ . '/../src/outils/autoloader.php';

// Instancie ton manager
$manager = new utilisateurs_waveManager();

$userId = $_SESSION['user_id'];

// Supprime le compte de la base
$ok = $manager->removeUser($userId);

if ($ok) {
    // Détruit la session
    session_destroy();

    // Redirige vers la page d'accueil ou de confirmation
    header('Location: index.php?deleted=1');
    exit();
} else {
    echo "<p style='color:red;'>❌ Une erreur est survenue lors de la suppression du compte.</p>";
}
?>
