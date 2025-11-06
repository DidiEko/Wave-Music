<?php
session_start();

const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../src/config/database.ini';

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $email = $_POST['email'] ?? '';
//     $mot_de_passe = $_POST['mot_de_passe'] ?? '';

//     // On cherche l'utilisateur
//     $stmt = $pdo->prepare("SELECT * FROM utilisateurs_wave WHERE email = :email");
//     $stmt->bindValue(':email', $email);
//     $stmt->execute();
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     // Vérifie si trouvé et si mot de passe correspond
//     if ($user && $mot_de_passe === $user['mot_de_passe']) { // ⚠️ pour tests uniquement, à remplacer par password_verify()
//         $_SESSION['user_id'] = $user['id'];
//         header("Location: monCompte.php");
//         exit();
//     } else {
//         $error = "Email ou mot de passe incorrect.";
//     }
// }

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


$pdo = new PDO("mysql:host=$host;port=$port;charset=utf8mb4", $username, $password);

// Création de la base de données si elle n'existe pas
$sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Sélection de la base de données
$sql = "USE `$dbname`;";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Création de la table `users` si elle n'existe pas
$sql = "CREATE TABLE IF NOT EXISTS utilisateurs_wave (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    nom_utilisateur VARCHAR(100) NOT NULL UNIQUE,
    age INT NOT NULL,
    mot_de_passe VARCHAR(100),
    date_creation DATETIME
);";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$sql = "SELECT * FROM users";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <title>Mon compte</title>
</head>

<body>
    <main class="container">
        <h1>Gestion du compte</h1>

        <h2>Liste des utilisateur.trices</h2>

        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nom d'utilisateur</th>
                    <th>Âge</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['nom_utilisateur']) ?></td>
                        <td><?= htmlspecialchars($user['age']) ?></td>
                        <td><?= htmlspecialchars($user['mot_de_passe']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>