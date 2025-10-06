<?php
// process_login.php : traitement du formulaire de connexion

// Démarre la session pour stocker les informations de l'utilisateur
session_start();

// Inclut le fichier de configuration (connexion PDO à la base de données)
require_once __DIR__ . '/../src/config.php'; // contient $db (connexion PDO)

// Vérifie si les champs 'username' et 'password' sont remplis
if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['login_error'] = "Veuillez remplir tous les champs."; // Message d'erreur si champs vides
    header("Location: login.php"); // Redirection vers la page de connexion
    exit;
}

// Récupération et nettoyage des données du formulaire
$username = trim($_POST['username']); // Supprime les espaces superflus
$password = $_POST['password'];       // Mot de passe tel quel pour vérification

try {
    // Prépare la requête pour rechercher l'utilisateur dans la base (protection contre les injections SQL)
    $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = :username LIMIT 1");
    $stmt->bindValue(':username', $username, PDO::PARAM_STR); // Liaison sécurisée de la variable
    $stmt->execute(); // Exécute la requête
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère l'utilisateur si trouvé

    // Vérifie si l'utilisateur existe et si le mot de passe correspond
    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie : stocke les infos dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: index.php?p=home"); // Redirection vers l'accueil
        exit;
    } else {
        // Identifiants incorrects
        $_SESSION['login_error'] = "Nom d’utilisateur ou mot de passe incorrect.";
        header("Location: login.php"); // Retour au formulaire de connexion
        exit;
    }
} catch (PDOException $e) {
    // Gestion d'erreur serveur / base de données
    $_SESSION['login_error'] = "Erreur interne, réessayez plus tard.";
    header("Location: login.php"); // Redirection avec message d'erreur
    exit;
}
