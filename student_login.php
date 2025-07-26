
<?php
session_start();
require 'db_config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll = $_POST['roll'];
    $name = $_POST['name'];

    $stmt = $pdo->prepare("SELECT * FROM students WHERE roll_number = ? AND name = ?");
    $stmt->execute([$roll, $name]);
    $student = $stmt->fetch();

    if ($student) {
        $_SESSION['student_id'] = $student['id'];
        header("Location: student_dashboard.php");
        exit;
    } else {
        $error = 'Invalid credentials or student not found.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body { font-family: Arial; padding-top: 60px; background: #e0f7fa; }
        form { background: #fff; max-width: 400px; margin: auto; padding: 20px; border-radius: 8px; }
        input, button { width: 100%; padding: 10px; margin-bottom: 15px; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Student Login</h2>
        <?php if ($error) echo "<div class='error'>$error</div>"; ?>
        <input type="text" name="roll" placeholder="Roll Number" required>
        <input type="text" name="name" placeholder="Name" required>
        <button type="submit">Login</button>
        <a href="student_register.php">Create New ID</a>
    </form>
</body>
</html>
