<?php
require_once '../php/db.php';
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email) || !isset($data->password)) {
    echo json_encode(['error' => 'Email and password are required']);
    exit;
}

$email = $data->email;
$password = $data->password;

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $secretKey = "my_super_secret_key"; 
    $payload = [
        "iss" => "http://myproject.com",
        "aud" => "http://myproject.com",
        "iat" => time(),
        "exp" => time() + 3600, // 1 ساعة
        "data" => [
            "id" => $user['id'],
            "email" => $user['email']
        ]
    ];

    $jwt = JWT::encode($payload, $secretKey, 'HS256');

    echo json_encode(["token" => $jwt]);
} else {
    echo json_encode(["error" => "Incorrect email or password."]);
}
