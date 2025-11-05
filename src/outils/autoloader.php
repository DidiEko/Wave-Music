<?php
// Ce bout de code on l'a vu en classe dans le cours "2.1 - 02.01-bases-de-donnees-et-pdo-avance"

// Charge les classes automatiquement
spl_autoload_register(function ($class) {
    // Convertit les séparateurs de namespace en séparateurs de répertoires
    $relativePath = str_replace('\\', '/', $class);

    // Dossiers où chercher les classes
    $folders = [
        __DIR__ . '/../config/',          
        __DIR__ . '/../utilisateurs_wave/', 
        __DIR__ . '/../outils/',          
    ];

    // Recherche du fichier correspondant
    foreach ($folders as $folder) {
        $file = $folder . $relativePath . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
