<?php
// Include language tool
require_once __DIR__ . '/../../src/outils/gestion_langue.php';

session_start();

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    header('Location: connexion.php');
    exit();
}

session_destroy();
?>
<!DOCTYPE html>
<html lang="<?= $langue ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/auth.css">
    <title><?= $textes['logout_title'] ?> | Gestion des sessions</title>
</head>

<body>

    <?php include '../nav/nav.php'; ?>
    <main class="container">
        <h1><?= $textes['logout_title'] ?></h1>

        <p><?= $textes['logout_msg'] ?></p>

        <p><a href="../index.php"><?= $textes['link_home'] ?></a> | <a href="connexion.php"><?= $textes['link_login_again'] ?></a></p>
    </main>
</body>

</html>