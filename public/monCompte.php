<?php
session_start();

const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../src/config/database.ini';

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
        <h1>Mon compte</h1>

        <?php if ($user): ?>
            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nom d'utilisateur</th>
                        <th>Âge</th>
                        <th>Mot de passe (haché)</th>
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
            <h2>Modifier mon mot de passe</h2>

            <form method="POST" action="">
                <label for="nouveau_mdp">Nouveau mot de passe</label>
                <input type="password" id="nouveau_mdp" name="nouveau_mdp" required minlength="8">

                <label for="confirm_mdp">Confirmer le mot de passe</label>
                <input type="password" id="confirm_mdp" name="confirm_mdp" required minlength="8">

                <button type="submit" name="changer_mdp">Mettre à jour</button>
            </form>
        <?php else: ?>
            <p>Aucune donnée trouvée pour cet utilisateur.</p>
        <?php endif; ?>

        <p><a href="modifier_mdp.php"><button>Modifier mon mot de passe</button></a></p>

        <p><a href="deconnexion.php"><button>Se déconnecter</button></a></p>
    </main>
</body>

</html>