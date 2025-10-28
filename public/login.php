<?php
// public/login.php
// Page 2-en-1 : Affiche le formulaire de connexion ET traite la soumission

session_start(); // Démarre la session

// --- SÉCURITÉ 1 : Rediriger si déjà connecté ---
// Si l'utilisateur est déjà connecté, on le renvoie vers la page d'accueil
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit;
}

// --- LOGIQUE DE TRAITEMENT (Ancien process_login.php) ---

// 1. Inclut la configuration de la base de données (crée la variable $db)
// On utilise __DIR__ . '/../src/' pour remonter d'un dossier et trouver src/
require_once __DIR__ . '/../src/config.php';

$error = ''; // Variable pour stocker les messages d'erreur

// 2. Vérifie si le formulaire a été soumis (méthode POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. Vérifie si les champs sont vides
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        // 4. Récupère les données
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        try {
            // 5. Recherche l'utilisateur dans la BDD
            // ATTENTION: Votre BDD 'schema.sql' utilise une table 'admins', pas 'users'
            // J'utilise 'admins' comme dans votre schéma.
            $stmt = $db->prepare("SELECT id, username, password FROM admins WHERE username = :username LIMIT 1");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // 6. Vérifie le mot de passe
            // password_verify compare le mot de passe entré avec le hash dans la BDD
            if ($user && password_verify($password, $user['password'])) {
                
                // 7. Connexion réussie !
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: home.php"); // Redirection vers l'accueil
                exit;
                
            } else {
                // Mauvais identifiants
                $error = "Nom d’utilisateur ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            // Erreur de connexion à la BDD
            $error = "Erreur interne, réessayez plus tard.";
        }
    }
}
// Si ce n'est pas un POST, le script continue et affiche le HTML ci-dessous
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Wave Music</title>
    
    <link rel="stylesheet" href="style.css">
    
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); height: 100vh; display: flex; align-items: center; justify-content: center; color: #333; }
        .login-container { background: #fff; padding: 40px 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); max-width: 400px; width: 100%; text-align: center; }
        .login-container h2 { margin-bottom: 20px; font-size: 1.8rem; color: #203a43; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { font-size: 0.9rem; display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; outline: none; transition: border-color 0.2s; }
        .form-group input:focus { border-color: #2c5364; }
        .btn { width: 100%; padding: 12px; background: #2c5364; border: none; border-radius: 8px; color: #fff; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        .btn:hover { background: #1a2e35; }
        .message { padding: 10px; border-radius: 6px; font-size: 0.9rem; margin-bottom: 15px; }
        .error { background: #ffeaea; color: #d63031; border: 1px solid #fab1a0; }
        .register-link { margin-top: 15px; display: block; font-size: 0.9rem; color: #2c5364; text-decoration: none; transition: color 0.2s; }
        .register-link:hover { color: #1a2e35; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion</h2>

        <?php if ($error): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="login.php" method="post">
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