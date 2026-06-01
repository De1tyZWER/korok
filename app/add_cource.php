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
    $sql = "INSERT INTO cources (cource, description) VALUES (:cource, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'cource' => $_POST["cource"],
        'description' => $_POST["description"],
    ]);
}

header("Location: /admin.php");
exit();
