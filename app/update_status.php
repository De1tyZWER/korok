<?php
require_once('boot.php');

if (!isset($_SESSION['user_id']))
    die('Ошибка: вы неавторизованы');

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user['role'] !== '1')
    die("Недостаточно прав");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE get_order SET status = :status WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id' => $_POST["order_id"],
        'status' => $_POST["new_status"],
    ]);
}

header("Location: /admin.php");
exit();