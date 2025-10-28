<?php
// public/logout.php
// Script simple pour détruire la session

session_start(); // Récupère la session
session_destroy(); // Détruit toutes les données de session

// Redirige vers la page de connexion
header('Location: login.php');
exit;
?>