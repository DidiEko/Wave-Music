<?php
// src/Database.php

function getDatabaseConnection() {
    // Lire le fichier INI
    $config = parse_ini_file(__DIR__ . '/Database.ini', true);

    // Récupérer les valeurs de la section [database]
    $db = $config['database'];

    $host = $db['host'];
    $port = $db['port'];
    $dbname = $db['dbname'];
    $username = $db['username'];
    $password = $db['password'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        return $pdo;
    } catch (PDOException $e) {
        die("❌ Erreur de connexion : " . $e->getMessage());
    }
}
