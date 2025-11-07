<?php
// Constantes
const DATABASE_CONFIGURATION_FILE = __DIR__ . '/../src/config/database.ini';

// Démarre la session
session_start();

// Initialise les variables
$error = '';
$success = '';

// Traiter le formulaire d'inscription
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

    if (strlen($mot_de_passe) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    } else {
        try {
            // Connexion à la base de données
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);

            // Vérifier si l'utilisateur existe déjà
            $stmt = $pdo->prepare('SELECT * FROM utilisateurs_wave WHERE nom_utilisateur = :nom_utilisateur');
            $stmt->execute(['nom_utilisateur' => $nom_utilisateur]);
            $user = $stmt->fetch();

            if ($user) {
                $error = 'Ce nom d\'utilisateur est déjà pris.';
            } else {
                // Hacher le mot de passe
                $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                // Insérer le nouvel utilisateur
                $stmt = $pdo->prepare('INSERT INTO utilisateurs_wave (nom_utilisateur, mot_de_passe) VALUES (:nom_utilisateur, :mot_de_passe)');
                $stmt->execute([
                    'nom_utilisateur' => $nom_utilisateur,
                    'password' => $mot_de_passe,
                ]);

                $success = 'Compte créé avec succès ! Vous pouvez maintenant vous connecter.';
            }
        } catch (PDOException $e) {
            $error = 'Erreur lors de la création du compte : ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <title>Créer un compte | Gestion des sessions</title>
</head>

<body>
    <main class="container">
        <h1>Créer un compte</h1>

        <?php if ($error) { ?>
            <p><strong>Erreur :</strong> <?= htmlspecialchars($error) ?></p>
        <?php } ?>

        <?php if ($success) { ?>
            <p><strong>Succès :</strong> <?= htmlspecialchars($success) ?></p>
            <p><a href="login.php">Se connecter maintenant</a></p>
        <?php } ?>

        <form method="post">
            <form action="connexion.php" method="POST">

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>

                <label for="nom_utilisateur">Nom d'utilisateur</label>
                <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?= htmlspecialchars($nom_utilisateur ?? '') ?>" required minlength="2">

                <label for="age">Âge</label>
                <input type="number" id="age" name="age" value="<?= htmlspecialchars($age ?? '') ?>" required min="0">

                <label for="first-name">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?= htmlspecialchars($firstName ?? '') ?>" required minlength="8">

                <button type="submit">Créer mon compte</button>
            </form>

            <p>Vous avez déjà un compte ? <a href="connexion.php">Se connecter</a></p>

            <p><a href="index.php">Retour à l'accueil</a></p>
    </main>
</body>

</html>