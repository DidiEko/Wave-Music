<?php
// public/lang_switcher.php - Bouton de changement de langue
?>
<div class="lang-switcher">
    <a href="?lang=fr" class="lang-btn <?= current_lang() === 'fr' ? 'active' : '' ?>">🇫🇷 FR</a>
    <a href="?lang=en" class="lang-btn <?= current_lang() === 'en' ? 'active' : '' ?>">🇬🇧 EN</a>
</div>

<style>
.lang-switcher {
    display: flex;
    gap: 10px;
    align-items: center;
}
.lang-btn {
    padding: 8px 15px;
    background: #fff;
    border: 2px solid #ddd;
    border-radius: 6px;
    text-decoration: none;
    color: #333;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.2s;
}
.lang-btn:hover {
    border-color: #2c5364;
    background: #f5f5f5;
}
.lang-btn.active {
    background: #2c5364;
    color: white;
    border-color: #2c5364;
}
</style>