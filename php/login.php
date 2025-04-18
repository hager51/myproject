<?php
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    echo "<span class='text-success'>Login successful! Welcome, {$user['username']}.</span>";
} else {
    echo "<span class='text-danger'>Invalid credentials</span>";
}
?>
