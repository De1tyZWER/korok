<?php
require_once('boot.php');

$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $_POST["username"],
    'password' => $_POST["password"],
]);

$user = $stmt->fetch();

if ($user) {
    $_SESSION['user_id'] = $user['id'];
    header('Location: ../index.php');
} else {
    echo "Неверный логин или пароль! <a href='../auth.php'>Назад</a>";
}