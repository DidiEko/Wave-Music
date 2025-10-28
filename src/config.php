<?php

// Define the path to your database configuration file.
// This assumes 'database.ini' is in the root 'Wave-Music' folder,
// one level above the 'src' directory.
$configPath = __DIR__ . '/../database.ini';

// Check if the file exists before trying to parse it
if (!file_exists($configPath)) {
    die("Configuration file not found. Please check the path.");
}

// Parse the configuration file
$config = parse_ini_file($configPath);

if ($config === false) {
    die("Error parsing configuration file.");
}

// 1. Create the Data Source Name (DSN)
$dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";

// 2. Set PDO options for error handling and fetching
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// 3. Create the PDO connection object
try {
    // This is the line that was throwing the "could not find driver" error.
    // Now that you've enabled pdo_mysql, it should work.
    $pdo = new PDO($dsn, $config['username'], $config['password'], $options);

} catch (\PDOException $e) {
    // Handle connection error
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// The $pdo variable is now ready to be used by other parts of your application.
// You might want to 'return $pdo;' if this file is being included.

?>