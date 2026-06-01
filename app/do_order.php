<?php
require_once('boot.php');

if (!$_SESSION['user_id'])
    die("Авторизуйся, позорник");

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    die("лох");

$sql = "INSERT INTO get_order (username, cource, date, pay, status) VALUES (:uid, :cource, :date, :pay, :status)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'uid' => $_SESSION['user_id'],
    'cource' => $_POST['cource'],
    'date' => $_POST['date'],
    'pay' => $_POST['pay'],
    'status' => 'Новая'
]);

header('Location: /myorder.php');
exit();
