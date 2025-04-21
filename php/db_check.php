<?php
require 'db.php';

header('Content-Type: application/json');

try {
    $check = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($check->rowCount() > 0) {
        echo json_encode(['ready' => true]);
    } else {
        echo json_encode(['ready' => false]);
    }
} catch (Exception $e) {
    echo json_encode(['ready' => false, 'error' => $e->getMessage()]);
}
