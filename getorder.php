<?php
require_once('template/header.php');
?>
<style>
    form {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        width: 30%;
    }
</style>

<h2>Отправить заявку на обучение</h2>

<form method="post" action="app/do_order.php">
    <label for="course">Наименование курса:</label>
    <input type="text" name="course" placeholder="Например: PHP разработчик" required>

    <label for="date">Желаемая дата начала обучения:</label>
    <input type="date" name="date" required>

    <label for="pay">Способ оплаты:</label>
    <select name="pay" required>
        <option value="">-- Выберите способ --</option>
        <option value="cash">Наличными</option>
        <option value="transfer">Переводом по номеру телефона</option>
    </select>

    <button type="submit">Отправить заявку</button>
</form>

<a href="myorder.php">Посмотреть мои заявки</a>