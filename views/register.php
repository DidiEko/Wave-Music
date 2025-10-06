<?php
// register.php : page d'inscription

// Démarre la session si elle n'existe pas déjà
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclut le fichier de configuration (connexion PDO)
require_once __DIR__ . '/../src/config.php';

// Variables pour stocker les messages
$success = '';
$error = '';

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupère et nettoie les données du formulaire
    $username = trim($_POST['username']); // Supprime les espaces superflus
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Vérification des champs
    if (empty($username) || empty($password) || empty($password_confirm)) {
        $error = "Veuillez remplir tous les champs."; // Tous les champs doivent être remplis
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas."; // Les mots de passe doivent correspondre
    } else {
        try {
            // Vérifie si le nom d'utilisateur existe déjà
            $stmt = $db->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->fetch()) {
                $error = "Ce nom d'utilisateur existe déjà."; // Nom d'utilisateur déjà pris
            } else {
                // Hash du mot de passe pour sécuriser le stockage
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Insertion du nouvel utilisateur dans la base de données
                $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                $stmt->bindValue(':password', $passwordHash, PDO::PARAM_STR);
                $stmt->execute();

                $success = "Compte créé avec succès. Vous pouvez maintenant vous connecter."; // Message de succès
            }
        } catch (PDOException $e) {
            $error = "Erreur serveur, réessayez plus tard."; // Erreur PDO
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Wave Music</title>
    <link rel="stylesheet" href="style.css">

    <!-- Styles spécifiques à la page d'inscription -->
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
        .register-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .register-container h2 {
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
        .success {
            background: #e0f7ea;
            color: #2d7a46;
            border: 1px solid #b7e4c7;
        }
    </style>
</head>
<body>

<!-- Conteneur principal du formulaire d'inscription -->
<div class="register-container">
    <h2>Créer un compte</h2>

    <!-- Affiche les messages d'erreur ou de succès -->
    <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <!-- Formulaire d'inscription -->
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="username">Nom d’utilisateur</label>
            <input type="text" id="username" name="username" placeholder="Votre nom..." required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe..." required>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmer le mot de passe</label>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirmez..." required>
        </div>
        <button type="submit" class="btn">S’inscrire</button>
    </form>

    <!-- Lien vers la page de connexion -->
    <a href="login.php" class="register-link">Déjà un compte ? Connectez-vous</a>
</div>

</body>
</html>
