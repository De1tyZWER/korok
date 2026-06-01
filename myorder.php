<?php
require_once('app/boot.php');

if (!isset($_SESSION['user_id'])) {
    die('Ошибка, вы не авторизованы');
};

// $date = date('d.m.y', strtotime($_POST['']));

$sql = "SELECT get_order.*, cources.cource
        FROM get_order
        JOIN cources ON get_order.cource = cources.id
        WHERE username = :uid
        ORDER BY get_order.id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'uid' => $_SESSION['user_id']
]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    @media (max-width: 390px) {

        form,
        table,
        div {
            width: 95% !important;
        }

        td,
        th,
        input,
        select,
        button {
            font-size: 14px;
            padding: 6px;
        }

        table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<?php require_once('template/header.php'); ?>

<h1>МОИ ЗАЯВКИ</h1>

<?php if (empty($orders)): ?>
    <p>У вас пока нет заявок, но никогда не поздно сделать это прямо сейчас</p>
    <a href="get_order.php">Сделать заявку</a>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <td>Номер заявки</td>
                <td>Курс</td>
                <td>Дата начала</td>
                <td>Тип оплаты</td>
                <td>Статус</td>
                <td>Отзыв</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['cource']) ?></td>
                    <td><?= $order['date'] ?></td>
                    <td><?= htmlspecialchars($order['pay']) ?></td>
                    <td><?= htmlspecialchars($order['status']) ?></td>
                    <td>
                        <?php if ($order['status'] === 'Обучение завершено'): ?>
                            <form method="post" action="app/add_review.php">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <textarea name="review" required placeholder="Ваш отзыв"></textarea>
                                <button type="submit">Отправить отзыв</button>
                            </form>
                        <?php else: ?>
                            <p style="color:gray">Отзыв доступен после завершения курса</p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>