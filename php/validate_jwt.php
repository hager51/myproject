<?php
// Prevent PHP warnings or HTML from breaking JSON
ob_start();

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

    // Optional: Validate issuer and audience
    if ($decoded->iss !== "http://localhost" || $decoded->aud !== "http://localhost") {
        throw new Exception("Invalid token issuer or audience");
    }
    // Token is valid
    //echo json_encode(["message" => "Token is valid", "user" => $decoded->data]); 
    
    ob_end_clean(); // clear any accidental output
    header('Content-Type: application/json'); // make sure JSON header is still set

} catch (Exception $e) {
    ob_end_clean();
    http_response_code(401);
    echo json_encode(['error' => 'Invalid or expired token']);
    exit();
}
?>
