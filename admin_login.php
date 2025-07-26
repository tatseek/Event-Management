<?php

session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'db_config.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? AND password = SHA2(?, 256)");
    $stmt->execute([$username, $password]);
    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body { font-family: Arial; background: #ececec; padding-top: 60px; }
    form { background: #fff; padding: 20px; max-width: 400px; margin: auto; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
    input, button { width: 100%; padding: 10px; margin-bottom: 15px; }
    h2 { text-align: center; }
    .error { color: red; text-align: center; }
  </style>
</head>
<body>
  <form method="POST">
    <h2>Admin Login</h2>
    <?php if ($error) echo "<div class='error'>$error</div>"; ?>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</body>
</html>

