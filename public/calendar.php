<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est authentifié
$userId = $_SESSION['user_id'] ?? null;

// L'utilisateur n'est pas authentifié
if (!$userId) {
    header('Location: ./auth/connexion.php');
    exit();
}

// Sinon, récupère les autres informations de l'utilisateur
$username = $_SESSION['nom_utilisateur'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>WAVE - Calendrier des prochains concerts</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php include './nav/nav.php'; ?>

<main class="page-calendrier">

    <h1>Agenda des concerts</h1>
    <p class="calendrier-intro">
        Retrouvez toutes les dates des concerts rap en Suisse : Genève, Lausanne,
        Fribourg, Zürich et plus encore.
    </p>

    <table class="calendrier-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Artiste</th>
                <th>Salle</th>
                <th>Ville</th>
                <th>Canton</th>
                <th>Heure</th>
            </tr>
        </thead>

        <tbody>
            
            <tr>
                <td>24.01.2026</td>
                <td>Sofiane Pamart</td>
                <td>ONU</td>
                <td>Genève</td>
                <td>GE</td>
                <td>20:00</td>
            </tr>

            <tr>
                <td>11.02.2026</td>
                <td>Sofiane Pamart</td>
                <td>TonHall</td>
                <td>Zurich</td>
                <td>ZH</td>
                <td>19:00</td>
            </tr>

            <tr>
                <td>12.02.2026</td>
                <td>Sopico</td>
                <td>Le Romandie</td>
                <td>Lausanne</td>
                <td>VD</td>
                <td>20:00</td>
            </tr>

            <tr>
                <td>20.02.2026</td>
                <td>L2B</td>
                <td>Alhambra</td>
                <td>Genève</td>
                <td>GE</td>
                <td>19:30</td>
            </tr>

            <tr>
                <td>21.02.2026</td>
                <td>L2B</td>
                <td>Fri-Son</td>
                <td>Fribourg</td>
                <td>FR</td>
                <td>20:00</td>
            </tr>

            <tr>
                <td>28.03.2026</td>
                <td>Josman</td>
                <td>Arena</td>
                <td>Genève</td>
                <td>GE</td>
                <td>18:30</td>
            </tr>

            <tr>
                <td>02.04.2026</td>
                <td>La Mano 1.9</td>
                <td>Alhambra</td>
                <td>Genève</td>
                <td>GE</td>
                <td>19:00</td>
            </tr>

            <tr>
                <td>11.04.2026</td>
                <td>Damso</td>
                <td>Arena</td>
                <td>Genève</td>
                <td>GE</td>
                <td>18:00</td>
            </tr>

            <tr>
                <td>02.05.2026</td>
                <td>Lujipeka</td>
                <td>DOCKS</td>
                <td>Lausanne</td>
                <td>VD</td>
                <td>19:30</td>
            </tr>

            <tr>
                <td>08.05.2026</td>
                <td>Damso</td>
                <td>Vaudoise Arena</td>
                <td>Lausanne</td>
                <td>VD</td>
                <td>18:30</td>
            </tr>

            <tr>
                <td>29.07.2026</td>
                <td>Gims</td>
                <td>Estivale Open Air</td>
                <td>Estavayer-le-Lac</td>
                <td>FR</td>
                <td>17:00</td>
            </tr>

            <tr>
                <td>31.10.2026</td>
                <td>Djadja & Dinaz</td>
                <td>Arena</td>
                <td>Genève</td>
                <td>GE</td>
                <td>À confirmer</td>
            </tr>

            <tr>
                <td>11.12.2026</td>
                <td>PLK</td>
                <td>Arena</td>
                <td>Genève</td>
                <td>GE</td>
                <td>18:30</td>
            </tr>

            <tr>
                <td>30.01.2027</td>
                <td>Menace Santana</td>
                <td>DOCKS</td>
                <td>Lausanne</td>
                <td>VD</td>
                <td>À confirmer</td>
            </tr>

            <tr>
                <td>13.03.2027</td>
                <td>YVNNIS</td>
                <td>DOCKS</td>
                <td>Lausanne</td>
                <td>VD</td>
                <td>À confirmer</td>
            </tr>

            <tr>
                <td>25.04.2027</td>
                <td>Ridsa</td>
                <td>Le Groove</td>
                <td>Genève</td>
                <td>GE</td>
                <td>20:00</td>
            </tr>

            <tr>
                <td>22.03.2027</td>
                <td>Orelsan</td>
                <td>Arena</td>
                <td>Genève</td>
                <td>GE</td>
                <td>17:30</td>
            </tr>
        </tbody>
    </table>

</main>

<footer>
    &copy; 2025 WAVE - Tous droits réservés
</footer>

</body>
</html>

 