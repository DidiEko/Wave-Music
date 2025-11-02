<?php
// public/find_name.php (Sondages)
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../src/config.php';

$message = '';
$messageType = '';

// Traitement du vote
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['musiques'])) {
    $userId = $_SESSION['user_id'];
    $musiquesVotees = $_POST['musiques']; // Array des IDs des musiques votées
    
    try {
        // Supprimer les anciens votes de cet utilisateur
        $stmt = $db->prepare("DELETE FROM votes WHERE user_id = ?");
        $stmt->execute([$userId]);
        
        // Enregistrer les nouveaux votes
        $stmt = $db->prepare("INSERT INTO votes (user_id, musique_id) VALUES (?, ?)");
        foreach ($musiquesVotees as $musiqueId) {
            $stmt->execute([$userId, $musiqueId]);
        }
        
        $message = "Votre vote a été enregistré avec succès !";
        $messageType = 'success';
    } catch (PDOException $e) {
        $message = "Erreur lors de l'enregistrement du vote.";
        $messageType = 'error';
    }
}

// Récupérer les 10 musiques actives
$stmt = $db->query("SELECT id, titre, artiste FROM musiques_sondage WHERE active = TRUE ORDER BY id LIMIT 10");
$musiques = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les votes existants de l'utilisateur
$stmt = $db->prepare("SELECT musique_id FROM votes WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$votesUtilisateur = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Récupérer le nombre de votes par musique
$stmt = $db->query("SELECT musique_id, COUNT(*) as nb_votes FROM votes GROUP BY musique_id");
$stats = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAVE - Sondage Musical</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * { box-sizing: border-box; }
        .poll-container { max-width: 800px; margin: 40px auto; padding: 20px; }
        .poll-header { text-align: center; margin-bottom: 30px; }
        .poll-header h1 { color: #203a43; margin-bottom: 10px; }
        .poll-header p { color: #666; font-size: 0.9rem; }
        .message { padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .success { background: #e0f7ea; color: #2d7a46; border: 1px solid #b7e4c7; }
        .error { background: #ffeaea; color: #d63031; border: 1px solid #fab1a0; }
        .musique-item { background: #f8f9fa; padding: 15px; margin-bottom: 12px; border-radius: 8px; border-left: 4px solid #2c5364; display: flex; align-items: center; transition: background 0.2s; }
        .musique-item:hover { background: #e9ecef; }
        .musique-item.voted { border-left-color: #2d7a46; background: #e0f7ea; }
        .musique-item input[type="checkbox"] { width: 20px; height: 20px; margin-right: 15px; cursor: pointer; }
        .musique-info { flex: 1; }
        .musique-titre { font-weight: 600; color: #203a43; font-size: 1.1rem; }
        .musique-artiste { color: #666; font-size: 0.9rem; margin-top: 3px; }
        .musique-stats { color: #2c5364; font-size: 0.85rem; font-weight: 600; }
        .submit-btn { width: 100%; padding: 15px; background: #2c5364; color: white; border: none; border-radius: 8px; font-size: 1.1rem; font-weight: 600; cursor: pointer; margin-top: 20px; }
        .submit-btn:hover { background: #1a2e35; }
        .submit-btn:disabled { background: #ccc; cursor: not-allowed; }
        .vote-info { text-align: center; color: #666; font-size: 0.9rem; margin-top: 10px; }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<main>
    <div class="poll-container">
        <div class="poll-header">
            <h1>🎵 Sondage Musical - Top 10</h1>
            <p>Votez pour vos musiques préférées (plusieurs choix possibles)</p>
        </div>

        <?php if ($message): ?>
            <div class="message <?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post" id="pollForm">
            <?php foreach ($musiques as $musique): ?>
                <?php 
                    $isVoted = in_array($musique['id'], $votesUtilisateur);
                    $nbVotes = $stats[$musique['id']] ?? 0;
                ?>
                <div class="musique-item <?= $isVoted ? 'voted' : '' ?>">
                    <input 
                        type="checkbox" 
                        name="musiques[]" 
                        value="<?= $musique['id'] ?>"
                        id="musique_<?= $musique['id'] ?>"
                        <?= $isVoted ? 'checked' : '' ?>
                    >
                    <label for="musique_<?= $musique['id'] ?>" class="musique-info">
                        <div class="musique-titre"><?= htmlspecialchars($musique['titre']) ?></div>
                        <div class="musique-artiste"><?= htmlspecialchars($musique['artiste']) ?></div>
                    </label>
                    <div class="musique-stats"><?= $nbVotes ?> vote(s)</div>
                </div>
            <?php endforeach; ?>

            <button type="submit" class="submit-btn">Enregistrer mon vote</button>
            <div class="vote-info" id="voteCount">Aucune musique sélectionnée</div>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

<script>
// Compteur de sélections
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
const voteCount = document.getElementById('voteCount');

function updateCount() {
    const count = document.querySelectorAll('input[type="checkbox"]:checked').length;
    if (count === 0) {
        voteCount.textContent = 'Aucune musique sélectionnée';
    } else if (count === 1) {
        voteCount.textContent = '1 musique sélectionnée';
    } else {
        voteCount.textContent = count + ' musiques sélectionnées';
    }
}

checkboxes.forEach(cb => cb.addEventListener('change', updateCount));
updateCount();
</script>

</body>
</html>