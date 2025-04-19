<?php
require_once '../php/validate_jwt.php';

header('Content-Type: application/json');

echo json_encode(["message" => "Welcome to the protected project page!"]);
