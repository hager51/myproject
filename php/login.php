<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

if (strpos($_SERVER["CONTENT_TYPE"] ?? '', 'application/json') !== 0) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid content type"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"));

// Make sure the users table exists.
$check = $pdo->query("SHOW TABLES LIKE 'users'");
if ($check->rowCount() == 0) {
    http_response_code(500);
    echo json_encode(['error' => '⚠️ The database is not configured. Please run install.php first.']);
    exit;
}

if (!isset($data->email) || !isset($data->password)) {
    echo json_encode(['error' => 'Email and password are required']);
    exit;
}

$email = $data->email;
$password = $data->password;

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
if (!$stmt) {
    echo json_encode(['error' => 'Query failed']);
    exit;
}
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $secretKey = "my_super_secret_key"; 
    $payload = [
        "iss" => "http://localhost",
        "aud" => "http://localhost",
        "iat" => time(),
        "exp" => time() + 3600, // 1 ساعة
        "data" => [
            "id" => $user['id'],
            "email" => $user['email']
        ]
    ];

    $jwt = JWT::encode($payload, $secretKey, 'HS256');

    // Debug output:
    file_put_contents('../php/debug.txt', print_r($user, true));
    echo json_encode(["token" => $jwt]);
} else {
    echo json_encode(["error" => "Incorrect email or password."]);
}
