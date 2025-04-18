<?php
require 'db.php';
require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $payload = [
        'iss' => 'myproject',
        'aud' => 'myproject',
        'iat' => time(),
        'exp' => time() + (60 * 60),
        'uid' => $user['id'],
        'username' => $user['username']
    ];
    $jwt = JWT::encode($payload, 'secret_key', 'HS256');
    echo json_encode(['token' => $jwt]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid credentials']);
}
?>
