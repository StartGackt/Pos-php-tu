<?php
$dsn = 'mysql:host=localhost;dbname=inventory;charset=utf8mb4';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $db = new PDO($dsn, 'root', '', $options);
} catch (PDOException $e) {
    error_log('Connection failed: ' . $e->getMessage());
    echo 'Connection failed. Please try again later.';
    exit; // Added exit to stop further execution on failure
}
