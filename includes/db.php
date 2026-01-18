<?php
// Database connection parameters
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'it';

// Create connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Ensure UTF-8 encoding
$conn->set_charset('utf8mb4');
?>
