<h2>Регистрация</h2>
<form method="post" action="app/do_register.php">
    <label for="username">Логин:</label>
    <input type="text" name="username" required minwidth="6"><br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" required minwidth="8"><br>
    <label for="fio">ФИО:</label>
    <input type="text" name="fio" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <label for="phone">Телефон:</label>
    <input type="text" name="phone" required><br>
    <button type="submit">Зарегистрироваться</button>
</form>
<a href="auth.php">Уже есть аккаунт?</a>