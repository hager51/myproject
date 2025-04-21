<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"));

// Make sure the users table exists.
$check = $pdo->query("SHOW TABLES LIKE 'users'");
if ($check->rowCount() == 0) {
    http_response_code(500);
    echo json_encode(['error' => '⚠️ The database is not configured. Please run install.php first.']);
    exit;
}

if (empty($data->username) || empty($data->email) || empty($data->password)) {
    echo json_encode(['error' => 'Please fill in all fields.']);
    exit;
}

$username = htmlspecialchars(trim($data->username));
$email = htmlspecialchars(trim($data->email));
$password = password_hash($data->password, PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password]);
    echo json_encode(['success' => 'User registered successfully']);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Username or email already exists']);
}
?>
