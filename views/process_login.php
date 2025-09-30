```php
<?php
// process_login.php
session_start();
require_once __DIR__ . '/../src/config.php'; // contient $db (connexion PDO)

// Vérifier si les champs sont remplis
if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['login_error'] = "Veuillez remplir tous les champs.";
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username']);
$password = $_POST['password'];

try {
    // Préparer la requête (sécurité contre les injections SQL)
    $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = :username LIMIT 1");
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php?p=home");
        exit;
    } else {
        // Mauvais identifiants
        $_SESSION['login_error'] = "Nom d’utilisateur ou mot de passe incorrect.";
        header("Location: login.php");
        exit;
    }
} catch (PDOException $e) {
    // Erreur serveur
    $_SESSION['login_error'] = "Erreur interne, réessayez plus tard.";
    header("Location: login.php");
    exit;
}
```
