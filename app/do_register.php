<?php
require_once('boot.php');

$errors[] = '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    die("лох");

$sql = "SELECT * FROM users WHERE username = :username OR email = :email OR phone = :phone";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone']
]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION['errors'] = $errors;
    header("Location: /register.php");
    exit();
}

$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';
$hash = password_hash($password, PASSWORD_DEFAULT);

if (!preg_match('/^8\(\d{3}\)\d{3}-\d{2}-\d{2}$/', $phone))
    $errors = "неверный формат";

if (strlen($_POST['username']) < 8)
    $errors = "Логин должен быть 8 или более символов";

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: /register.php');
    exit();
}

$sql = "INSERT INTO users (username, password, fio, email, phone, role) VALUES (:username, :password, :fio, :email, :phone, :role )";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $_POST['username'],
    'password' => $hash,
    'fio' => $_POST['fio'],
    'email' => $_POST['email'],
    'phone' => $phone,
    'role' => '0'
]);

header('Location: /auth.php');
exit();
