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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['classement'])) {
    $userId = $_SESSION['user_id'];
    $classement = json_decode($_POST['classement'], true);
    
    if (count($classement) === 10) {
        try {
            $db->beginTransaction();
            
            // Supprimer les anciens votes de cet utilisateur
            $stmt = $db->prepare("DELETE FROM votes WHERE user_id = ?");
            $stmt->execute([$userId]);
            
            // Enregistrer le nouveau classement
            $stmt = $db->prepare("INSERT INTO votes (user_id, musique_id, position) VALUES (?, ?, ?)");
            foreach ($classement as $musiqueId => $position) {
                $stmt->execute([$userId, $musiqueId, $position]);
            }
            
            $db->commit();
            $message = "Votre classement a été enregistré avec succès !";
            $messageType = 'success';
        } catch (PDOException $e) {
            $db->rollBack();
            $message = "Erreur lors de l'enregistrement du classement.";
            $messageType = 'error';
        }
    } else {
        $message = "Veuillez classer les 10 musiques.";
        $messageType = 'error';
    }
}

// Récupérer les 10 musiques avec les noms d'artistes
$stmt = $db->query("
    SELECT m.id, m.titre, a.nom as artiste 
    FROM musique m 
    JOIN artiste a ON m.artiste_id = a.id 
    ORDER BY m.id 
    LIMIT 10
");
$musiques = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le classement existant de l'utilisateur
$stmt = $db->prepare("SELECT musique_id, position FROM votes WHERE user_id = ? ORDER BY position");
$stmt->execute([$_SESSION['user_id']]);
$classementUtilisateur = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Réorganiser les musiques selon le classement existant
if (!empty($classementUtilisateur)) {
    $musiquesOrdered = [];
    foreach ($classementUtilisateur as $musiqueId => $position) {
        foreach ($musiques as $musique) {
            if ($musique['id'] == $musiqueId) {
                $musiquesOrdered[] = $musique;
                break;
            }
        }
    }
    $musiques = $musiquesOrdered;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAVE - Classement Musical</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * { box-sizing: border-box; }
        .poll-container { max-width: 800px; margin: 40px auto; padding: 20px; }
        .poll-header { text-align: center; margin-bottom: 30px; }
        .poll-header h1 { color: #203a43; margin-bottom: 10px; }
        .poll-header p { color: #666; font-size: 0.9rem; }
        .instructions { background: #e3f2fd; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #2196f3; }
        .instructions strong { color: #1976d2; }
        .message { padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .success { background: #e0f7ea; color: #2d7a46; border: 1px solid #b7e4c7; }
        .error { background: #ffeaea; color: #d63031; border: 1px solid #fab1a0; }
        
        #sortable-list { list-style: none; padding: 0; margin: 0; }
        .musique-item { 
            background: #fff; 
            padding: 15px 20px; 
            margin-bottom: 12px; 
            border-radius: 8px; 
            border: 2px solid #e0e0e0;
            display: flex; 
            align-items: center; 
            cursor: move;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .musique-item:hover { 
            background: #f5f5f5; 
            border-color: #2c5364;
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        .musique-item.dragging { 
            opacity: 0.5; 
            transform: scale(1.05);
        }
        .position-badge { 
            background: #2c5364; 
            color: white; 
            width: 40px; 
            height: 40px; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: bold; 
            font-size: 1.2rem;
            margin-right: 20px;
            flex-shrink: 0;
        }
        .musique-info { flex: 1; }
        .musique-titre { font-weight: 600; color: #203a43; font-size: 1.1rem; }
        .musique-artiste { color: #666; font-size: 0.9rem; margin-top: 3px; }
        .drag-handle { 
            color: #999; 
            font-size: 1.5rem; 
            cursor: grab;
            margin-left: 10px;
        }
        .drag-handle:active { cursor: grabbing; }
        
        .submit-btn { 
            width: 100%; 
            padding: 15px; 
            background: #2c5364; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            font-size: 1.1rem; 
            font-weight: 600; 
            cursor: pointer; 
            margin-top: 20px; 
        }
        .submit-btn:hover { background: #1a2e35; }
        .reset-btn { 
            width: 100%; 
            padding: 12px; 
            background: #fff; 
            color: #666; 
            border: 2px solid #ddd; 
            border-radius: 8px; 
            font-size: 1rem; 
            cursor: pointer; 
            margin-top: 10px; 
        }
        .reset-btn:hover { background: #f5f5f5; border-color: #999; }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<main>
    <div class="poll-container">
        <div class="poll-header">
            <h1>🎵 Classement Musical - Top 10</h1>
            <p>Glissez-déposez les musiques pour les classer de 1 à 10</p>
        </div>

        <div class="instructions">
            <strong>📋 Instructions :</strong> Faites glisser les musiques pour les réorganiser. 
            La musique en haut sera votre n°1, celle en bas votre n°10.
        </div>

        <?php if ($message): ?>
            <div class="message <?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post" id="pollForm">
            <input type="hidden" name="classement" id="classement">
            
            <ul id="sortable-list">
                <?php foreach ($musiques as $index => $musique): ?>
                    <li class="musique-item" data-id="<?= $musique['id'] ?>">
                        <div class="position-badge"><?= $index + 1 ?></div>
                        <div class="musique-info">
                            <div class="musique-titre"><?= htmlspecialchars($musique['titre']) ?></div>
                            <div class="musique-artiste"><?= htmlspecialchars($musique['artiste']) ?></div>
                        </div>
                        <span class="drag-handle">⋮⋮</span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <button type="submit" class="submit-btn">💾 Enregistrer mon classement</button>
            <button type="button" class="reset-btn" onclick="resetOrder()">🔄 Réinitialiser l'ordre</button>
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

<script>
// Système de drag & drop
const sortableList = document.getElementById('sortable-list');
let draggedElement = null;

// Événements de drag
sortableList.addEventListener('dragstart', (e) => {
    if (e.target.classList.contains('musique-item')) {
        draggedElement = e.target;
        e.target.classList.add('dragging');
    }
});

sortableList.addEventListener('dragend', (e) => {
    if (e.target.classList.contains('musique-item')) {
        e.target.classList.remove('dragging');
        updatePositions();
    }
});

sortableList.addEventListener('dragover', (e) => {
    e.preventDefault();
    const afterElement = getDragAfterElement(sortableList, e.clientY);
    if (afterElement == null) {
        sortableList.appendChild(draggedElement);
    } else {
        sortableList.insertBefore(draggedElement, afterElement);
    }
});

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.musique-item:not(.dragging)')];
    
    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

// Mettre à jour les numéros de position
function updatePositions() {
    const items = sortableList.querySelectorAll('.musique-item');
    items.forEach((item, index) => {
        const badge = item.querySelector('.position-badge');
        badge.textContent = index + 1;
    });
}

// Rendre les éléments draggables
document.querySelectorAll('.musique-item').forEach(item => {
    item.draggable = true;
});

// Réinitialiser l'ordre original
const originalOrder = [...document.querySelectorAll('.musique-item')];
function resetOrder() {
    originalOrder.forEach(item => sortableList.appendChild(item.cloneNode(true)));
    // Réactiver le drag & drop
    document.querySelectorAll('.musique-item').forEach(item => {
        item.draggable = true;
    });
    updatePositions();
}

// Soumettre le classement
document.getElementById('pollForm').addEventListener('submit', (e) => {
    const items = sortableList.querySelectorAll('.musique-item');
    const classement = {};
    
    items.forEach((item, index) => {
        const musiqueId = item.getAttribute('data-id');
        classement[musiqueId] = index + 1;
    });
    
    document.getElementById('classement').value = JSON.stringify(classement);
});
</script>

</body>
</html>