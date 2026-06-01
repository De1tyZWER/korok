<?php
require_once('boot.php');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    die("лох");

$sql = "SELECT * FROM users WHERE username = :username";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $username
]);

$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header('Location: /index.php');
    exit();
} else {
    echo "Неправильно набран логин или пароль";
}
