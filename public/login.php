<?php
// public/login.php
session_start();

// Redirection si déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit;
}

require_once __DIR__ . '/../src/config.php';

$message = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Tous les champs sont obligatoires.";
    } else {
        try {
            // Récupérer l'utilisateur avec tous ses infos
            $stmt = $db->prepare("SELECT id, username, nom, prenom, email, password FROM admins WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Stocker les infos en session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['email'] = $user['email'];
                
                header('Location: home.php');
                exit;
            } else {
                $message = "Identifiants incorrects.";
            }
        } catch (PDOException $e) {
            $message = "Erreur serveur.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Wave Music</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        h2 { margin-bottom: 25px; color: #203a43; text-align: center; }
        .message { padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; background: #ffeaea; color: #d63031; border: 1px solid #fab1a0; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; }
        input:focus { outline: none; border-color: #2c5364; }
        button { width: 100%; padding: 12px; background: #2c5364; border: none; border-radius: 8px; color: #fff; font-size: 1rem; font-weight: 600; cursor: pointer; }
        button:hover { background: #1a2e35; }
        .link { text-align: center; margin-top: 15px; }
        .link a { color: #2c5364; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
<div class="container">
    <h2>Connexion</h2>

    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    
    <div class="link">
        <a href="register.php">Pas encore de compte ? Inscrivez-vous</a>
    </div>
</div>
</body>
</html>