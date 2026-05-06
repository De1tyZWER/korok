<?php
session_start();

require_once __DIR__ . '/../app/boot.php';

$user = null;

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
}
?>
<style>
    div {
        width: 30%;
        display: flex;
        justify-content: space-around;
        gap: 10px;
    }
</style>
<div>
    <?php if (isset($_SESSION['user_id'])): ?>

        <?php if ($user && $user['role'] === 'admin'): ?>
            <a href="admin.php">Админ-панель</a>
        <?php endif; ?>
        <a href="myorder.php">Мои заявки</a>
        <a href="getorder.php">Отправить заявку</a>
        <a href="app/logout.php">Выйти</a>
    <?php else: ?>
        <a href="register.php">Зарегистрироваться</a>
        <a href="auth.php">Войти</a>
    <?php endif; ?>
</div>