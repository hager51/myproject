<?php
session_start();

// تأكد إن المستخدم عامل لوجين
if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <p>This is the protected area of your project. Only logged in users can access this page.</p>
        <a href="php/logout.php" class="btn btn-danger mt-3">Logout</a>
    </div>
</body>
</html>
