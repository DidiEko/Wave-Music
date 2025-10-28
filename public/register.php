<?php
// public/register.php
// Page 2-en-1 : Affiche le formulaire d'inscription ET traite la soumission

session_start();

// --- SÉCURITÉ 1 : Rediriger si déjà connecté ---
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit;
}

// --- LOGIQUE DE TRAITEMENT ---

// 1. Inclut la configuration de la base de données
require_once __DIR__ . '/../src/config.php';

$success = '';
$error = '';

// 2. Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // 3. Vérifications
    if (empty($username) || empty($password) || empty($password_confirm)) {
        $error = "Veuillez remplir tous les champs.";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        try {
            // 4. Vérifie si l'utilisateur existe déjà (table 'admins')
            $stmt = $db->prepare("SELECT id FROM admins WHERE username = :username LIMIT 1");
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->fetch()) {
                $error = "Ce nom d'utilisateur existe déjà.";
            } else {
                // 5. Hash du mot de passe (TRÈS IMPORTANT)
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // 6. Insertion dans la BDD (table 'admins')
                $stmt = $db->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
                $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                $stmt->bindValue(':password', $passwordHash, PDO::PARAM_STR);
                $stmt->execute();

                $success = "Compte créé avec succès. Vous pouvez maintenant vous connecter.";
            }
        } catch (PDOException $e) {
            $error = "Erreur serveur, réessayez plus tard.";
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
    <link rel="stylesheet" href="style.css"> <style>
        body { font-family: Arial, sans-serif; margin: 0; background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); height: 100vh; display: flex; align-items: center; justify-content: center; color: #333; }
        .register-container { background: #fff; padding: 40px 30px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); max-width: 400px; width: 100%; text-align: center; }
        .register-container h2 { margin-bottom: 20px; font-size: 1.8rem; color: #203a43; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { font-size: 0.9rem; display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; outline: none; transition: border-color 0.2s; }
        .form-group input:focus { border-color: #2c5364; }
        .btn { width: 100%; padding: 12px; background: #2c5364; border: none; border-radius: 8px; color: #fff; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        .btn:hover { background: #1a2e35; }
        .message { padding: 10px; border-radius: 6px; font-size: 0.9rem; margin-bottom: 15px; }
        .error { background: #ffeaea; color: #d63031; border: 1px solid #fab1a0; }
        .success { background: #e0f7ea; color: #2d7a46; border: 1px solid #b7e4c7; }
        .register-link { margin-top: 15px; display: block; font-size: 0.9rem; color: #2c5364; text-decoration: none; transition: color 0.2s; }
    </style>
</head>
<body>
<div class="register-container">
    <h2>Créer un compte</h2>

    <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

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
    
    <a href="login.php" class="register-link">Déjà un compte ? Connectez-vous</a>
</div>
</body>
</html>