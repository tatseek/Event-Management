<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
require 'db_config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM students WHERE id = ?")->execute([$id]);
    header("Location: manage_students.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $pdo->prepare("INSERT INTO students (roll_number, name, email, phone, course) VALUES (?, ?, ?, ?, ?)")
        ->execute([$roll, $name, $email, $phone, $course]);
}

$students = $pdo->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f7f7f7; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        form { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h2>Manage Students</h2>
    <form method="POST">
        <input name="roll" placeholder="Roll Number" required>
        <input name="name" placeholder="Full Name" required>
        <input name="email" placeholder="Email">
        <input name="phone" placeholder="Phone">
        <input name="course" placeholder="Course">
        <button type="submit">Add Student</button>
    </form>
    <table>
        <tr><th>ID</th><th>Roll</th><th>Name</th><th>Email</th><th>Phone</th><th>Course</th><th>Action</th></tr>
        <?php foreach ($students as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= $s['roll_number'] ?></td>
                <td><?= $s['name'] ?></td>
                <td><?= $s['email'] ?></td>
                <td><?= $s['phone'] ?></td>
                <td><?= $s['course'] ?></td>
                <td><a href="?delete=<?= $s['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

