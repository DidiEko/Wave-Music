<?php
session_start();
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/Router.php';

// récupérer la page demandée
$page = $_GET['p'] ?? 'home';

// initialiser le routeur
$router = new Router();
$router->route($page);
