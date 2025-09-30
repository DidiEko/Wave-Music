<?php
// login.php

// Démarre la session uniquement si elle n'existe pas déjà
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../src/config.php';

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Wave Music</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }
        .login-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
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
            border-color: #2c5364;
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
            background: #1a2e35;
        }
        .message {
            padding: 10px;
            border-radius: 6px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .error {
            background: #ffeaea;
            color: #d63031;
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

    <div class="login-container">
        <h2>Connexion</h2>

        <?php if ($error): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

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

        <a href="register.php" class="register-link">Créer un nouveau compte</a>
    </div>

</body>
</html>
