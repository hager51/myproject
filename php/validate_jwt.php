<?php
require '../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function validateJWT($token) {
    try {
        $decoded = JWT::decode($token, new Key('secret_key', 'HS256'));
        return (array)$decoded;
    } catch (Exception $e) {
        return false;
    }
}
?>
