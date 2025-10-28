<?php
// public/index.php
// Point d'entrée principal du site

// Démarre la session pour vérifier le statut de connexion
session_start();

// Vérifie si l'utilisateur est déjà connecté (si la variable de session 'user_id' existe)
if (isset($_SESSION['user_id'])) {
    // Si oui, redirige vers la page d'accueil principale
    header('Location: home.php');
    exit;
} else {
    // Si non (visiteur), redirige vers la page de connexion
    header('Location: login.php');
    exit;
}
?>