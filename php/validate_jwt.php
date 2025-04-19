<?php
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

$headers = getallheaders();

if (!isset($headers['Authorization'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No token provided']);
    exit();
}

list($jwt) = sscanf($headers['Authorization'], 'Bearer %s');

if (!$jwt) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid token format']);
    exit();
}

try {
    $secretKey = "my_super_secret_key";
    $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));    

} catch (Exception $e) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid or expired token']);
    exit();
}
