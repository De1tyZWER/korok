<?php

session_start();

require_once('boot.php');

if (!isset($_SESSION['user_id'])) {
    die("Ошибка: вы неавторизованы");
}

$sql = "INSERT INTO get_order (username, course, date, pay) VALUES (:uid, :course, :date, :pay)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'uid' => $_SESSION['user_id'],
    'course' => $_POST["course"],
    'date' => $_POST["date"],
    'pay' => $_POST["pay"],
]);

header("location: ../myorder.php");