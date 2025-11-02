<?php
// public/register.php
session_start();

// Redirection si déjà connecté
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit;
}

require_once __DIR__ . '/../src/config.php';

$message = '';
$messageType = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $data = [
        'username' => trim($_POST['username']),
        'nom' => trim($_POST['nom']),
        'prenom' => trim($_POST['prenom']),
        'email' => trim($_POST['email']),
        'password' => $_POST['password'],
        'password_confirm' => $_POST['password_confirm']
    ];

    // Validation
    if (empty($data['username']) || empty($data['nom']) || empty($data['prenom']) || 
        empty($data['email']) || empty($data['password']) || empty($data['password_confirm'])) {
        $message = "Tous les champs sont obligatoires.";
        $messageType = 'error';
    } 
    elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $message = "Email invalide.";
        $messageType = 'error';
    } 
    elseif ($data['password'] !== $data['password_confirm']) {
        $message = "Les mots de passe ne correspondent pas.";
        $messageType = 'error';
    } 
    else {
        try {
            // Vérifier si username ou email existe
            $stmt = $db->prepare("SELECT id FROM admins WHERE username = ? OR email = ?");
            $stmt->execute([$data['username'], $data['email']]);
            
            if ($stmt->fetch()) {
                $message = "Nom d'utilisateur ou email déjà utilisé.";
                $messageType = 'error';
            } else {
                // Créer le compte
                $stmt = $db->prepare("INSERT INTO admins (username, nom, prenom, email, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([
                    $data['username'],
                    $data['nom'],
                    $data['prenom'],
                    $data['email'],
                    password_hash($data['password'], PASSWORD_DEFAULT)
                ]);
                
                $message = "Compte créé ! Vous pouvez vous connecter.";
                $messageType = 'success';
            }
        } catch (PDOException $e) {
            $message = "Erreur serveur.";
            $messageType = 'error';
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
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #0f2027, #203a43, #2c5364); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.2); width: 100%; max-width: 400px; }
        h2 { margin-bottom: 25px; color: #203a43; text-align: center; }
        .message { padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 0.9rem; }
        .error { background: #ffeaea; color: #d63031; border: 1px solid #fab1a0; }
        .success { background: #e0f7ea; color: #2d7a46; border: 1px solid #b7e4c7; }
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
    <h2>Créer un compte</h2>

    <?php if ($message): ?>
        <div class="message <?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="text" name="nom" placeholder="Nom de famille" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    
    <div class="link">
        <a href="login.php">Déjà un compte ? Connectez-vous</a>
    </div>
</div>
</body>
</html>