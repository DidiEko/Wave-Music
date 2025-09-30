<?php
require_once __DIR__ . '/../src/Auth.php';
$auth = new Auth();
$message = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($auth->login($username, $password)){
        header('Location: index.php?p=find_name');
        exit();
    } else {
        $message = 'Identifiants incorrects';
    }
}
?>

<div class="login-container">
    <h2>Connexion Administrateur</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <p><?= $message ?></p>
</div>
