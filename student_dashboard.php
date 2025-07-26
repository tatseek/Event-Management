<?php
session_start();
require 'db_config.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit;
}

$id = $_SESSION['student_id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student['email'] = $_POST['email'];
    $student['phone'] = $_POST['phone'];
    $student['course'] = $_POST['course'];

    $pdo->prepare("UPDATE students SET email = ?, phone = ?, course = ? WHERE id = ?")
        ->execute([$student['email'], $student['phone'], $student['course'], $id]);

    echo "<script>alert('Details updated!');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial; background: #fafafa; padding: 30px; }
        form { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Welcome, <?= htmlspecialchars($student['name']) ?></h2>
        <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" placeholder="Email">
        <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>" placeholder="Phone">
        <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>" placeholder="Course">
        <button type="submit">Update Details</button>
    </form>
</body>
</html>
