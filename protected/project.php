<?php
require '../php/validate_jwt.php';

if (!isset($_COOKIE['token']) || !validateJWT($_COOKIE['token'])) {
    header("Location: ../index.html");
    exit;
}

$decoded = validateJWT($_COOKIE['token']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Project Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Welcome, <?php echo htmlspecialchars($decoded['username']); ?>!</h2>
    <p>This is a protected page.</p>
    <a href="../php/logout.php" class="btn btn-danger">Logout</a>
</body>
</html>
