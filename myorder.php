<?php
require_once('template/header.php');

require_once('app/boot.php');

if (!isset($_SESSION['user_id'])) {
    die("Ошибка: вы неавторизованы");
}

$sql = "SELECT * FROM get_order WHERE username = :uid ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'uid' => $_SESSION['user_id'],
]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>Мои курсы</h1>
<?php if (empty($orders)): ?>
    <p>Вы еще не отправили ни одной заявки.</p>
    <a href="getorder.php">Отправить заявку</a>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Номер курса</th>
                <th>Курс</th>
                <th>Дата начала</th>
                <th>Оплата</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['course']) ?></td>
                    <td><?= $order['date'] ?></td>
                    <td><?= htmlspecialchars($order['pay']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>