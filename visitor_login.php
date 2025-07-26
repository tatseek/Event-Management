<?php
require 'db_config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['visitor_id'];
    $stmt = $pdo->prepare("SELECT * FROM visitors WHERE id = ?");
    $stmt->execute([$id]);
    $visitor = $stmt->fetch();

    if ($visitor) {
        $message = "Hello, {$visitor['name']}! Your registration status is: <strong>{$visitor['status']}</strong>";
    } else {
        $message = "Visitor ID not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visitor Login</title>
    <style>
        body { font-family: Arial; background: #e0f2f1; padding-top: 50px; }
        form { max-width: 400px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        input, button { width: 100%; padding: 10px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Check Visitor Status</h2>
        <input name="visitor_id" placeholder="Enter Visitor ID" required>
        <button type="submit">Check Status</button>
        <a href="visitor_register.php">Create New Visitor ID</a>
        <div style="margin-top: 20px; text-align: center; color: green;">
            <?= $message ?>
        </div>
    </form>
</body>
</html>
