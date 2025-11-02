<nav>
    <div class="logo">WAVE</div>
    <div class="nav-links">
        <a href="home.php">Accueil</a>
        <a href="spotlight.php">Spotlight</a>
        <a href="top10.php">Top 10</a>
        <a href="Sondages.php"><?= t('Poll') ?></a>
        <a href="calendar.php"><?= t('Concerts') ?></a>
        <a href="chipies.php"><?= t('The Chipies') ?></a>

         <?php include 'lang_switcher.php'; ?>
    
    <a href="logout.php"><?= t('logout') ?></a>
        
        <a href="logout.php" style="color: #ff4757;">Déconnexion</a>
    </div>
</nav>