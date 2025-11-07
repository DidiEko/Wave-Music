<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est authentifié
$userId = $_SESSION['user_id'] ?? null;

// L'utilisateur n'est pas authentifié
if (!$userId) {
    // Redirige vers la page de connexion si l'utilisateur n'est pas authentifié
    header('Location: auth/login.php');
    exit();
}

// Sinon, récupère les autres informations de l'utilisateur
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>WAVE - Vote Musical</title>
    <link rel="stylesheet" href="style.css">
</head>

</head>

<body>

    <nav>
        <div class="logo">WAVE</div>
        <div class="nav-links">
            <a href="index.php">Spotlight</a>
            <a href="lastTop10.php">Top 10</a>
            <a href="sondage.php">Vote musique</a>
            <a href="calendar.php">Calendrier Concerts</a>
            <a href="blog.php">Blog</a>
            <a href="connexion.php">Connexion</a>
        </div>
    </nav>

    <div class="container">
        <h1>🎵 Classez vos 10 musiques préférées</h1>
        <p style="text-align: center; color: #666; margin-bottom: 20px;">Glissez-déposez pour réorganiser</p>


        <form method="post">
            <input type="hidden" name="classement" id="classement">

            <ul id="sortable-list">
                <li class="musique-item" data-id="" draggable="true">
                    <div class="position"></div>
                    <div class="info">
                        <div class="titre"></div>
                        <div class="artiste"></div>
                    </div>
                    <span style="color: #999; font-size: 1.3rem;">⋮⋮</span>
                </li>
            </ul>
            <button type="submit">💾 Enregistrer mon classement</button>
        </form>
    </div>

    <footer>
        &copy; 2025 WAVE - Tous droits réservés
    </footer>

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