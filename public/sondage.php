<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

// Import de la connexion unique
require_once __DIR__ . '/../src/config/db_connect.php'; 

$message = '';

// Enregistrer le vote
if (isset($_POST['classement'])) {
    $classement = json_decode($_POST['classement'], true);
    
    // Supprimer anciens votes
    $pdo->prepare("DELETE FROM votes WHERE user_id = ?")->execute([$_SESSION['user_id']]);
    
    // Sauvegarder nouveau classement
    $stmt = $pdo->prepare("INSERT INTO votes (user_id, musique_id, position) VALUES (?, ?, ?)");
    foreach ($classement as $musiqueId => $position) {
        $stmt->execute([$_SESSION['user_id'], $musiqueId, $position]);
    }
    
    $message = "✅ Classement enregistré !";
}

// Récupérer les musiques
$musiques = $pdo->query("
    SELECT m.id, m.titre, a.nom as artiste 
    FROM musique m 
    JOIN artiste a ON m.artiste_id = a.id 
    LIMIT 10
")->fetchAll();

// Récupérer le classement de l'utilisateur
$votes = $pdo->prepare("SELECT musique_id, position FROM votes WHERE user_id = ? ORDER BY position");
$votes->execute([$_SESSION['user_id']]);
$classementUser = $votes->fetchAll(PDO::FETCH_KEY_PAIR);
// Réorganiser si déjà voté
if ($classementUser) {
    $temp = [];
    foreach ($classementUser as $id => $pos) {
        foreach ($musiques as $m) {
            if ($m['id'] == $id) $temp[] = $m;
        }
    }
    $musiques = $temp;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>WAVE - Vote Musical</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        nav { background: #2c5364; padding: 15px; color: white; }
        nav a { color: white; text-decoration: none; margin: 0 15px; }
        .container { max-width: 800px; margin: 30px auto; padding: 20px; background: white; border-radius: 10px; }
        h1 { text-align: center; color: #2c5364; margin-bottom: 10px; }
        .message { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; text-align: center; }
        #sortable-list { list-style: none; padding: 0; }
        .musique-item { 
            background: #fff; 
            padding: 15px; 
            margin-bottom: 10px; 
            border: 2px solid #ddd; 
            border-radius: 8px; 
            display: flex; 
            align-items: center; 
            cursor: move;
        }
        .musique-item:hover { background: #f9f9f9; border-color: #2c5364; }
        .position { 
            background: #2c5364; 
            color: white; 
            width: 35px; 
            height: 35px; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: bold; 
            margin-right: 15px;
        }
        .info { flex: 1; }
        .titre { font-weight: 600; color: #333; }
        .artiste { color: #666; font-size: 0.9rem; }
        button { 
            width: 100%; 
            padding: 15px; 
            background: #2c5364; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-size: 1.1rem; 
            cursor: pointer; 
            margin-top: 20px;
        }
        button:hover { background: #1a2e35; }
    </style>
</head>
<body>

<nav>
    <span style="font-weight: bold; font-size: 1.2rem;">WAVE</span>
    <a href="index.php">Accueil</a>
    <a href="sondage.php">Vote</a>
    <a href="logout.php">Déconnexion</a>
</nav>

<div class="container">
    <h1>🎵 Classez vos 10 musiques préférées</h1>
    <p style="text-align: center; color: #666; margin-bottom: 20px;">Glissez-déposez pour réorganiser</p>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="classement" id="classement">
        
        <ul id="sortable-list">
            <?php foreach ($musiques as $i => $m): ?>
                <li class="musique-item" data-id="<?= $m['id'] ?>" draggable="true">
                    <div class="position"><?= $i + 1 ?></div>
                    <div class="info">
                        <div class="titre"><?= htmlspecialchars($m['titre']) ?></div>
                        <div class="artiste"><?= htmlspecialchars($m['artiste']) ?></div>
                    </div>
                    <span style="color: #999; font-size: 1.3rem;">⋮⋮</span>
                </li>
            <?php endforeach; ?>
        </ul>

        <button type="submit">💾 Enregistrer mon classement</button>
    </form>
</div>

<script>
const list = document.getElementById('sortable-list');
let dragged;

list.addEventListener('dragstart', e => dragged = e.target);
list.addEventListener('dragover', e => {
    e.preventDefault();
    const after = [...list.querySelectorAll('.musique-item:not(.dragging)')].find(item => 
        e.clientY < item.getBoundingClientRect().top + item.offsetHeight / 2
    );
    list.insertBefore(dragged, after);
    updatePositions();
});

function updatePositions() {
    [...list.querySelectorAll('.musique-item')].forEach((item, i) => 
        item.querySelector('.position').textContent = i + 1
    );
}

document.querySelector('form').addEventListener('submit', () => {
    const classement = {};
    [...list.querySelectorAll('.musique-item')].forEach((item, i) => 
        classement[item.dataset.id] = i + 1
    );
    document.getElementById('classement').value = JSON.stringify(classement);
});
</script>

</body>
</html>