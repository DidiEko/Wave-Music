<?php
// Include language tool
require_once __DIR__ . '/../../src/outils/gestion_langue.php';

require_once __DIR__ . '/../../src/outils/autoloader.php';

require_once __DIR__ . '/../../src/config/database.php';
require_once __DIR__ . '/../../src/classes/Users/UserManager.php';


use Users\User;
use Users\UserManager;

session_start();

// Si l’utilisateur n’est pas connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/connexion.php');
    exit();
}

$manager = new UserManager();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveau = $_POST['nouveau_mdp'] ?? '';
    $confirm = $_POST['confirm_mdp'] ?? '';

    if ($nouveau !== $confirm) {
        $message = "<p style='color:red;'>" . $textes['err_pass_match'] . "</p>";
    } elseif (strlen($nouveau) < 8) {
        $message = "<p style='color:red;'>" . $textes['err_pass_len'] . "</p>";
    } else {
        // Appelle la méthode du manager
        $ok = $manager->updatePassword($_SESSION['user_id'], $nouveau);
        $message = $ok
            ? "<p style='color:green;'>" . $textes['msg_pass_ok'] . "</p>"
            : "<p style='color:red;'>" . $textes['err_pass_fail'] . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="<?= $langue ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $textes['mod_pass_title'] ?></title>
    <link rel="stylesheet" href="../css/compte.css">
</head>
<body>
    <?php include '../nav/nav.php'; ?>
    <main class="container">
        <h1><?= $textes['mod_pass_title'] ?></h1>

        <?= $message ?>

        <form method="POST">
            <label for="nouveau_mdp"><?= $textes['label_new_pass'] ?></label>
            <input type="password" id="nouveau_mdp" name="nouveau_mdp" required minlength="8">

            <label for="confirm_mdp"><?= $textes['label_conf_pass'] ?></label>
            <input type="password" id="confirm_mdp" name="confirm_mdp" required minlength="8">

            <button type="submit"><?= $textes['btn_update'] ?></button>
        </form>

        <p><a href="../index.php"><?= $textes['link_back_acc'] ?></a></p>
    </main>
</body>
</html>