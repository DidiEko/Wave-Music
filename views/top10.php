<?php
// top10.php
// Plus tard : remplacer ce tableau par une requête SQL SELECT LIMIT 10
$topItems = [
    ["title" => "Film 1", "image" => "assets/img/film1.jpg", "rating" => "9.2"],
    ["title" => "Film 2", "image" => "assets/img/film2.jpg", "rating" => "9.0"],
    ["title" => "Film 3", "image" => "assets/img/film3.jpg", "rating" => "8.8"],
    ["title" => "Film 4", "image" => "assets/img/film4.jpg", "rating" => "8.7"],
    ["title" => "Film 5", "image" => "assets/img/film5.jpg", "rating" => "8.5"],
    ["title" => "Film 6", "image" => "assets/img/film6.jpg", "rating" => "8.4"],
    ["title" => "Film 7", "image" => "assets/img/film7.jpg", "rating" => "8.3"],
    ["title" => "Film 8", "image" => "assets/img/film8.jpg", "rating" => "8.2"],
    ["title" => "Film 9", "image" => "assets/img/film9.jpg", "rating" => "8.0"],
    ["title" => "Film 10", "image" => "assets/img/film10.jpg", "rating" => "7.9"],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 10 - Wave Music</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styles pour la section Top 10 */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
            color: #333;
        }

        .top10-section {
            padding: 60px 20px;
            background: #f9f9f9;
        }

        /* Titre de la section */
        .section-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #222;
        }

        /* Grille des cartes Top 10 */
        .top10-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Carte individuelle */
        .top10-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            transition: transform 0.2s ease;
        }

        /* Effet hover sur la carte */
        .top10-card:hover {
            transform: translateY(-5px);
        }

        /* Numéro de classement */
        .rank {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ff4757;
            color: #fff;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        /* Image de la carte */
        .top10-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        /* Informations sous l'image */
        .top10-info {
            padding: 15px;
            text-align: center;
        }

        .top10-title {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: #333;
        }

        /* Note / rating */
        .rating {
            display: inline-block;
            background: #ffeaa7;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Section Top 10 -->
    <section class="top10-section">
        <div class="container">
            <h2 class="section-title">Top 10 du moment</h2>
            <div class="top10-grid">
                <?php foreach ($topItems as $index => $item): ?>
                    <!-- Carte Top 10 individuelle -->
                    <div class="top10-card">
                        <!-- Affiche le rang -->
                        <div class="rank">#<?= $index + 1 ?></div>
                        <!-- Image du film / musique -->
                        <img src="<?= $item['image'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="top10-img">
                        <!-- Informations (titre + note) -->
                        <div class="top10-info">
                            <h3 class="top10-title"><?= htmlspecialchars($item['title']) ?></h3>
                            <span class="rating">⭐ <?= $item['rating'] ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</body>
</html>
