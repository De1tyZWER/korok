<?php
require_once('boot.php');

$sql = "INSERT INTO users (username, password, fio, email, phone) VALUES (:username, :password, :fio, :email, :phone)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $_POST["username"],
    'password' => $_POST["password"],
    'fio' => $_POST["fio"],
    'email' => $_POST["email"],
    'phone' => $_POST["phone"],
]);

header("location: ../index.php");