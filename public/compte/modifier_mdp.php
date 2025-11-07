<?php
session_start();

// Si l’utilisateur n’est pas connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

require_once __DIR__ . '/../../src/config/database.ini';
require_once __DIR__ . '/../../src/utilisateurs_wave/utilisateurs_waveManager.php';

// Initialisation du manager
$manager = new utilisateurs_waveManager();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveau = $_POST['nouveau_mdp'] ?? '';
    $confirm = $_POST['confirm_mdp'] ?? '';

    if ($nouveau !== $confirm) {
        $message = "<p style='color:red;'>Les mots de passe ne correspondent pas.</p>";
    } elseif (strlen($nouveau) < 8) {
        $message = "<p style='color:red;'>Le mot de passe doit contenir au moins 8 caractères.</p>";
    } else {
        // Appelle la méthode du manager
        $ok = $manager->updatePassword($_SESSION['user_id'], $nouveau);
        $message = $ok
            ? "<p style='color:green;'>Mot de passe mis à jour avec succès ✅</p>"
            : "<p style='color:red;'>Erreur lors de la mise à jour du mot de passe.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier mon mot de passe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1>Modifier mon mot de passe</h1>

        <?= $message ?>

        <form method="POST">
            <label for="nouveau_mdp">Nouveau mot de passe</label>
            <input type="password" id="nouveau_mdp" name="nouveau_mdp" required minlength="8">

            <label for="confirm_mdp">Confirmer le mot de passe</label>
            <input type="password" id="confirm_mdp" name="confirm_mdp" required minlength="8">

            <button type="submit">Mettre à jour</button>
        </form>

        <p><a href="../index.php">⬅ Retour à mon compte</a></p>
    </main>
</body>
</html>
