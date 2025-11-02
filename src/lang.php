<?php
// src/lang.php - Gestion des langues

// Démarrer la session si pas déjà fait
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Langues disponibles
$available_languages = ['fr', 'en'];

// Détecter la langue
if (isset($_GET['lang']) && in_array($_GET['lang'], $available_languages)) {
    // Changement de langue via URL
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + (365 * 24 * 60 * 60), '/'); // Cookie valable 1 an
    $_SESSION['lang'] = $lang;
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $available_languages)) {
    // Langue depuis le cookie
    $lang = $_COOKIE['lang'];
    $_SESSION['lang'] = $lang;
} elseif (isset($_SESSION['lang'])) {
    // Langue depuis la session
    $lang = $_SESSION['lang'];
} else {
    // Langue par défaut
    $lang = 'fr';
    $_SESSION['lang'] = $lang;
}

// Charger les traductions
$translations = [
    'fr' => [
        // Navigation
        'home' => 'Accueil',
        'concerts' => 'Concerts',
        'artists' => 'Artistes',
        'poll' => 'Sondage',
        'logout' => 'Déconnexion',
        
        // Page de connexion
        'login_title' => 'Connexion',
        'username' => 'Nom d\'utilisateur',
        'password' => 'Mot de passe',
        'login_btn' => 'Se connecter',
        'no_account' => 'Pas encore de compte ?',
        'register_link' => 'Inscrivez-vous',
        
        // Page d'inscription
        'register_title' => 'Créer un compte',
        'firstname' => 'Prénom',
        'lastname' => 'Nom de famille',
        'email' => 'Email',
        'confirm_password' => 'Confirmer le mot de passe',
        'register_btn' => 'S\'inscrire',
        'already_account' => 'Déjà un compte ?',
        'login_link' => 'Connectez-vous',
        
        // Sondage
        'poll_title' => 'Classement Musical - Top 10',
        'poll_subtitle' => 'Glissez-déposez les musiques pour les classer de 1 à 10',
        'instructions' => 'Instructions :',
        'instructions_text' => 'Faites glisser les musiques pour les réorganiser. La musique en haut sera votre n°1, celle en bas votre n°10.',
        'save_ranking' => 'Enregistrer mon classement',
        'reset_order' => 'Réinitialiser l\'ordre',
        'ranking_saved' => 'Votre classement a été enregistré avec succès !',
        'ranking_error' => 'Erreur lors de l\'enregistrement du classement.',
        
        // Messages
        'all_fields_required' => 'Tous les champs sont obligatoires.',
        'invalid_email' => 'Email invalide.',
        'passwords_not_match' => 'Les mots de passe ne correspondent pas.',
        'account_created' => 'Compte créé ! Vous pouvez vous connecter.',
        'username_exists' => 'Nom d\'utilisateur ou email déjà utilisé.',
        'server_error' => 'Erreur serveur.',
        'invalid_credentials' => 'Identifiants incorrects.',
        
        // Général
        'welcome' => 'Bienvenue',
        'language' => 'Langue',
    ],
    'en' => [
        // Navigation
        'home' => 'Home',
        'concerts' => 'Concerts',
        'artists' => 'Artists',
        'poll' => 'Poll',
        'logout' => 'Logout',
        
        // Login page
        'login_title' => 'Login',
        'username' => 'Username',
        'password' => 'Password',
        'login_btn' => 'Login',
        'no_account' => 'No account yet?',
        'register_link' => 'Sign up',
        
        // Register page
        'register_title' => 'Create an account',
        'firstname' => 'First name',
        'lastname' => 'Last name',
        'email' => 'Email',
        'confirm_password' => 'Confirm password',
        'register_btn' => 'Sign up',
        'already_account' => 'Already have an account?',
        'login_link' => 'Log in',
        
        // Poll
        'poll_title' => 'Music Ranking - Top 10',
        'poll_subtitle' => 'Drag and drop songs to rank them from 1 to 10',
        'instructions' => 'Instructions:',
        'instructions_text' => 'Drag songs to reorder them. The song at the top will be your #1, the one at the bottom your #10.',
        'save_ranking' => 'Save my ranking',
        'reset_order' => 'Reset order',
        'ranking_saved' => 'Your ranking has been saved successfully!',
        'ranking_error' => 'Error saving the ranking.',
        
        // Messages
        'all_fields_required' => 'All fields are required.',
        'invalid_email' => 'Invalid email.',
        'passwords_not_match' => 'Passwords do not match.',
        'account_created' => 'Account created! You can now log in.',
        'username_exists' => 'Username or email already in use.',
        'server_error' => 'Server error.',
        'invalid_credentials' => 'Invalid credentials.',
        
        // General
        'welcome' => 'Welcome',
        'language' => 'Language',
    ]
];

// Fonction pour obtenir une traduction
function t($key) {
    global $translations, $lang;
    return $translations[$lang][$key] ?? $key;
}

// Fonction pour obtenir la langue actuelle
function current_lang() {
    global $lang;
    return $lang;
}
?>