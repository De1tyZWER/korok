<?php

require_once __DIR__ . '/../app/boot.php';

$user = null;

if (isset($_SESSION['user_id'])) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
};

?>
<div>
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($user && $user['role'] === '1'): ?>
        <a href="/admin.php">Админ-панель</a>
        <?php endif ?>
        <a href="/myorder.php">Мои заявки</a>
        <a href="/get_order.php">Отправить заявку</a>
        <a href="/app/logout.php">Выйти</a>
    <?php else: ?>
        <a href="/auth.php">Авторизация</a>
        <a href="/register.php">Регистрация</a>
    <?php endif ?>
</div>