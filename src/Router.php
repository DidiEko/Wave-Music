<?php
// Définition de la classe Router pour gérer la navigation entre les pages
class Router {
    // Méthode pour inclure la page correspondante
    public function route($page) {
        // Pages accessibles à tous les utilisateurs (publiques)
        $publicPages = ['home','spotlight','login'];

        // Pages accessibles uniquement aux utilisateurs connectés (privées)
        $privatePages = ['find_name','top10','calendar','chipies'];

        // Vérifie si la page demandée est publique
        if(in_array($page, $publicPages)) {
            // Inclut le fichier PHP correspondant à la page publique
            include __DIR__ . "/../views/$page.php";

        // Vérifie si la page demandée est privée
        } elseif(in_array($page, $privatePages)) {
            // Si l'utilisateur n'est pas connecté, redirige vers la page de login
            if(!isset($_SESSION['user_id'])) {
                header('Location: index.php?p=login'); // Redirection HTTP
                exit(); // Arrête l'exécution du script
            }
            // Inclut le fichier PHP correspondant à la page privée
            include __DIR__ . "/../views/$page.php";

        // Si la page demandée n'existe pas
        } else {
            echo "Page non trouvée"; // Affiche un message d'erreur
        }
    }
}
