<?php

require_once('app/boot.php');

if (!isset($_SESSION['user_id']))
    die('Ошибка: вы неавторизованы');

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if ($user['role'] !== '1')
    die("Недостаточно прав");

$sql = "SELECT get_order.*, users.fio, users.phone
        FROM get_order
        JOIN users ON get_order.username = users.id
        ORDER BY get_order.id DESC";
$orders = $pdo->query($sql)->fetchALL();
?>

<?php require_once('template/header.php') ?>

<h1>АДМИН ПАНЕЛЬ</h1>
<h2>ЗАЯВКИ</h2>

<?php if (empty($orders)): ?>
    <p>Заявок пока нет</p>
<?php else: ?>
    <div>
        <?php foreach ($orders as $order): ?>
            <p><b>ЗАЯВКА № </b> <?= $order['id'] ?></p>
            <p><b>ФИО (номер): </b> <?= htmlspecialchars($order['fio']) ?> (<?= htmlspecialchars($order['phone']) ?>)</p>
            <p><b>Название курса: </b> <?= htmlspecialchars($order['cource']) ?></p>
            <p><b>ДАТА НАЧАЛА: </b> <?= $order['date'] ?></p>
            <p><b>ТИП ОПЛАТЫ: </b> <?= $order['pay'] ?></p>
            <p><b>СТАТУС: </b> <?= $order['status'] ?></p>
            <div>
                <form method="POST" action="app/update_status.php">
                    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                    <select name="new_status">
                        <option value="">--- ВЫБЕРЕТЕ ДЕЙСТВИЕ ---</option>
                        <option value="В процессе">Начать обучение</option>
                        <option value="Обучение завершено">Завершить</option>
                    </select>
                    <button type="submit">Изменить</button>
                </form>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>



<h2><a href="create_cource.php">СОЗДАТЬ КУРС</a></h2>