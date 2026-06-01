<?php
require_once('app/boot.php');
?>

<h1>РЕГИСТРАЦИЯ</h1>

<?php if (isset($_SESSION['errors'])): ?>
    <div style="color: red; border: 1px solid red; padding: 10px;">
        <?php foreach ($_SESSION['errors'] as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<form method="post" action="app/do_register.php">
    <input type="text" name="username" minlength="6" required>
    <input type="password" name="password" minlength="8" required>
    <input type="text" name="fio" required>
    <input type="text" name="email" required>
    <input type="phone" name="phone" required>

    <button type="submit">Зарегистрироваться</button>
</form>

<p>Есть аккаунт? <a href="auth.php">Авторизация</a></p>