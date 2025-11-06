<?php
const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../src/config/database.ini';

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

$sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
$stmt = $pdo->prepare($sql);
$stmt->execute();

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

// Gère la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $email = $_POST["email"];
    $nom_utilisateur = $_POST["nom_utilisateur"];
    $age = $_POST["age"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $errors = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Un email valide est requis.";
    }

    if (empty($nom_utilisateur) || strlen($nom_utilisateur) < 2) {
        $errors[] = "Le nom d'utilisateur doit contenir au moins 2 caractères.";
    }

    if ($age < 0) {
        $errors[] = "L'âge doit être un nombre positif.";
    }

    if (strlen($mot_de_passe) > 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO utilisateurs_wave (email,nom_utilisateur,age,mot_de_passe) VALUES (:email,:nom_utilisateur,:age,:mot_de_passe)";

        // Définition de la requête SQL pour ajouter un utilisateur
        $sql = "INSERT INTO utilisateurs_wave (
            email,
            nom_utilisateur,
            age,
            mot_de_passe
        ) VALUES (
            :email,
            :nom_utilisateur,
            :age,
            :mot_de_passe
        )";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindValue(':age', $age);
        $stmt->bindValue(':mot_de_passe', $mot_de_passe);

        $stmt->execute();

        header("Location: monCompte.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">

    <title>Connexion</title>
</head>

<body>
    <main class="container">
        <h1>Veuillez vous connecter:</h1>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST") { ?>
            <?php if (empty($errors)) { ?>
                <p style="color: green;">Le formulaire a été soumis avec succès !</p>
            <?php } else { ?>
                <p style="color: red;">Le formulaire contient des erreurs :</p>
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>

        <form action="connexion.php" method="POST">

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>

            <label for="nom_utilisateur">Nom d'utilisateur</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?= htmlspecialchars($nom_utilisateur ?? '') ?>" required minlength="2">

            <label for="age">Âge</label>
            <input type="number" id="age" name="age" value="<?= htmlspecialchars($age ?? '') ?>" required min="0">

            <label for="first-name">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="first-name" value="<?= htmlspecialchars($firstName ?? '') ?>" required minlength="8">

            <button type="submit">Créer</button>
        </form>
    </main>
</body>

</html>