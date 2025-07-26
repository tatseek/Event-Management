<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $reason = $_POST['reason'];

    $stmt = $pdo->prepare("INSERT INTO visitors (name, email, visit_reason) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $reason]);
    $visitor_id = $pdo->lastInsertId();
    echo "<script>alert('Visitor registered successfully! Your ID: $visitor_id'); window.location.href='visitor_login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visitor Registration</title>
    <style>
        body { font-family: Arial; background: #f1f8e9; padding-top: 50px; }
        form { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        input, textarea, button { width: 100%; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Visitor Registration</h2>
        <input name="name" placeholder="Full Name" required>
        <input name="email" placeholder="Email">
        <textarea name="reason" placeholder="Reason for Visit" required></textarea>
        <button type="submit">Register</button>
    </form>
</body>
</html>
