<?php
header('Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents("php://input"));

if (!$data->username || !$data->email || !$data->password) {
    echo json_encode(['error' => 'All fields are required']);
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
