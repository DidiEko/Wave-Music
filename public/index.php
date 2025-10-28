<?php
// Démarre une session PHP ou récupère la session existante
session_start();

// Inclut le fichier de configuration principal du projet
require_once __DIR__ . '/../src/config.php';

// Inclut le fichier contenant la classe Router pour gérer les routes
require_once __DIR__ . '/../src/Router.php';

// Récupère la page demandée dans l'URL via le paramètre 'p'
// Si aucune page n'est spécifiée, la page par défaut sera 'home'
$page = $_GET['p'] ?? 'home';

// Crée une instance de la classe Router
$router = new Router();

// Appelle la méthode route() du routeur pour afficher la page demandée
$router->route($page);

//coucou