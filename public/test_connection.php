<?php
require_once '../config.php';

try {
    // This will attempt to connect to the database using the $pdo variable from config.php
    $pdo->query('SELECT 1');

    echo 'Database connection successful!';
} catch (PDOException $e) {
    echo 'Database connection failed: ' . $e->getMessage();
}
