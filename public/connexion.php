<?php
session_start();

require_once __DIR__ . '/../src/config/db_connect.php'; 

echo "<pre>";
var_dump($pdo);
echo "</pre>";
exit;
