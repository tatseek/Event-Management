<!-- student_register.php -->
<?php
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $stmt = $pdo->prepare("INSERT INTO students (roll_number, name, email, phone, course) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$roll, $name, $email, $phone, $course]);
    echo "<script>alert('Student ID created successfully!'); window.location.href='student_login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body { font-family: Arial; background: #f0f8ff; padding-top: 50px; }
        form { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Create Student ID</h2>
        <input name="roll" placeholder="Roll Number" required>
        <input name="name" placeholder="Full Name" required>
        <input name="email" placeholder="Email">
        <input name="phone" placeholder="Phone">
        <input name="course" placeholder="Course">
        <button type="submit">Register</button>
    </form>
</body>
</html>
