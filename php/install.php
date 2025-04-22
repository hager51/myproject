<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';

try {
    // Create the database if it doesn't exist and use it
    $pdo->exec("CREATE DATABASE IF NOT EXISTS myproject_db");
    $pdo->exec("USE myproject_db");

    // Create users table if not exists
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Example: Add a new column if not exists
    $columnCheck = $pdo->query("SHOW COLUMNS FROM users LIKE 'role'");
    if ($columnCheck->rowCount() == 0) {
        $pdo->exec("ALTER TABLE users ADD role VARCHAR(50) DEFAULT 'user'");
    }

    // Optional: Insert a test user
    $checkUser = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $checkUser->execute(['admin@example.com']);
    if ($checkUser->rowCount() == 0) {
        $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)")
            ->execute(['Admin', 'admin@example.com', $hashedPassword, 'admin']);
    }

    echo "<h3 style='color:green;'>Database setup complete ✅</h3>";

} catch (PDOException $e) {
    echo "<h3 style='color:red;'>Error: " . $e->getMessage() . "</h3>";
}
?>
