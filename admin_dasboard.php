<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f4f4f4;
      padding-top: 60px;
      text-align: center;
    }
    h2 {
      color: #333;
    }
    .action-buttons {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 30px;
      gap: 15px;
    }
    .action-buttons a {
      text-decoration: none;
      background-color: #2ebf91;
      color: white;
      padding: 12px 30px;
      border-radius: 6px;
      font-size: 16px;
      width: 300px;
      display: block;
    }
    .action-buttons a:hover {
      background-color: #249b76;
    }
  </style>
</head>
<body>
  <h2>Admin Dashboard</h2>
  <p>What do you want to do?</p>
  <div class="action-buttons">
    <a href="manage_students.php">Manage Students</a>
    <a href="manage_visitors.php">Manage Visitors</a>
    <a href="admin_logout.php">Logout</a>
  </div>
</body>
</html>

