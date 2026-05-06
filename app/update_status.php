<?php
require_once('boot.php');

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user['role'] !== 'admin')
    die("У вас недостаточно прав");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE get_order SET status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'status' => $_POST["new_status"],
        'id' => $_POST["order_id"],
    ]);
}

header('Location: ../admin.php');