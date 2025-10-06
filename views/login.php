<?php
// login.php

// Démarre la session uniquement si elle n'existe pas déjà
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclut le fichier de configuration (connexion à la base de données, constantes, etc.)
require_once __DIR__ . '/../src/config.php';

// Récupère le message d'erreur de connexion s'il existe dans la session
$error = $_SESSION['login_error'] ?? '';
// Supprime l'erreur de la session pour qu'elle ne s'affiche qu'une seule fois
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Wave Music</title>

    <!-- Lien vers le CSS principal -->
    <link rel="stylesheet" href="style.css">

    <!-- Styles spécifiques à la page de login -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); /* Fond dégradé */
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }
        .login-container {
            background: #fff; /* Fond blanc du formulaire */
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2); /* Ombre pour effet 3D */
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #203a43;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            font-size: 0.9rem;
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            border-color: #2c5364; /* Changement de couleur au focus */
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #2c5364;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #1a2e35; /* Couleur au survol */
        }
        .message {
            padding: 10px;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .error {
            background: #ffeaea; /* Fond rouge clair pour les erreurs */
            color: #d63031;       /* Texte rouge */
            border: 1px solid #fab1a0;
        }
        .register-link {
            margin-top: 15px;
            display: block;
            font-size: 0.9rem;
            color: #2c5364;
            text-decoration: none;
            transition: color 0.2s;
        }
        .register-link:hover {
            color: #1a2e35;
        }
    </style>
</head>
<body>

    <!-- Conteneur principal du formulaire de connexion -->
    <div class="login-container">
        <h2>Connexion</h2>

        <!-- Affiche le message d'erreur si une connexion a échoué -->
        <?php if ($error): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form action="process_login.php" method="post">
            <div class="form-group">
                <label for="username">Nom d’utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Votre nom..." required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe..." required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>

        <!-- Lien vers la page d'inscription -->
        <a href="register.php" class="register-link">Créer un nouveau compte</a>
    </div>

</body>
</html>
