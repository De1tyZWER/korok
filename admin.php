<?php
require_once('template/header.php');
require_once('app/boot.php');

if (!isset($_SESSION['user_id'])) {
    die("Ошибка: вы неавторизованы");
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user['role'] !== 'admin')
    die("У вас недостаточно прав");

$sql = "SELECT get_order.*, users.fio, users.phone
        FROM get_order 
        JOIN users ON get_order.username = users.id 
        ORDER BY get_order.id DESC";
$orders = $pdo->query($sql)->fetchAll();

?>
<h1>Админ панель</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>ФИО и номер</th>
        <th>Курс</th>
        <th>Дата</th>
        <th>Статус</th>
        <th>Действие</th>
    </tr>
    <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['fio']) ?> (<?= $order['phone'] ?>)</td>
            <td><?= htmlspecialchars($order['course']) ?></td>
            <td><?= $order['date'] ?></td>
            <td><b><?= $order['status'] ?></b></td>
            <td>
                <form method="post" action="app/update_status.php">
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <select name="new_status">
                        <option value="Идет обучение">Начать обучение</option>
                        <option value="Обучение завершено">Завершить</option>
                    </select>
                    <button type="submit">Ок</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>