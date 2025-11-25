<?php
// Include language tool
require_once __DIR__ . '/../../src/outils/gestion_langue.php';

session_start();

const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../../src/config/database.ini';


// Vérifie si l’utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

$config = parse_ini_file(DATABASE_CONFIGURATION_FILE, true);

if (!$config) {
    throw new Exception("Erreur lors de la lecture du fichier de configuration : " . DATABASE_CONFIGURATION_FILE);
}

$db = $config['database'];
$host = $db['host'];
$port = $db['port'];
$dbname = $db['dbname'];
$username = $db['username'];
$password = $db['password'];

// Connexion à la DB
$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);

// Récupère les informations de l’utilisateur connecté
$userId = $_SESSION['user_id'];

$sql = "SELECT email, nom_utilisateur, age, mot_de_passe 
        FROM utilisateurs_wave 
        WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $userId);
$stmt->execute();

$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="<?= $langue ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="../css/compte.css">
    <title><?= $textes['account_title'] ?></title>
</head>

<body>
    <?php include '../nav/nav.php'; ?>

    <main class="container">
        <h1><?= $textes['account_title'] ?></h1>

        <?php if ($user): ?>
            <table>
                <thead>
                    <tr>
                        <th><?= $textes['th_email'] ?></th>
                        <th><?= $textes['th_user'] ?></th>
                        <th><?= $textes['th_age'] ?></th>
                        <th><?= $textes['th_pass'] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['nom_utilisateur']) ?></td>
                        <td><?= htmlspecialchars($user['age']) ?></td>
                        <td><?= htmlspecialchars($user['mot_de_passe']) ?></td>
                    </tr>
                </tbody>
            </table>

        <?php else: ?>
            <p><?= $textes['msg_no_data'] ?></p>
        <?php endif; ?>

        <p><a href="modifier_mdp.php"><button><?= $textes['btn_mod_pass'] ?></button></a></p>

        <p><a href="../auth/deconnexion.php"><button><?= $textes['btn_logout_acc'] ?></button></a></p>
    </main>
</body>

</html>