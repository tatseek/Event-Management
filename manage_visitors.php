<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}
require 'db_config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM visitors WHERE id = ?")->execute([$id]);
    header("Location: manage_visitors.php");
    exit;
}

if (isset($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $stmt = $pdo->prepare("SELECT status FROM visitors WHERE id = ?");
    $stmt->execute([$id]);
    $current = $stmt->fetchColumn();
    $new_status = $current === 'Pending' ? 'Successful' : 'Pending';
    $pdo->prepare("UPDATE visitors SET status = ? WHERE id = ?")->execute([$new_status, $id]);
    header("Location: manage_visitors.php");
    exit;
}

$visitors = $pdo->query("SELECT * FROM visitors")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Visitors</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f0f0f0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #2ebf91; color: white; }
        a.btn { padding: 5px 10px; background: #2ebf91; color: #fff; text-decoration: none; border-radius: 5px; }
        a.btn:hover { background: #249b76; }
    </style>
</head>
<body>
    <h2>Manage Visitors</h2>
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Reason</th><th>Status</th><th>Actions</th></tr>
        <?php foreach ($visitors as $v): ?>
        <tr>
            <td><?= $v['id'] ?></td>
            <td><?= $v['name'] ?></td>
            <td><?= $v['email'] ?></td>
            <td><?= $v['visit_reason'] ?></td>
            <td><?= $v['status'] ?></td>
            <td>
                <a class="btn" href="?toggle_status=<?= $v['id'] ?>">Toggle Status</a>
                <a class="btn" href="?delete=<?= $v['id'] ?>" onclick="return confirm('Delete visitor?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

