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

$sql = "SELECT * FROM cources";
$stmt = $pdo->prepare($sql);
$stmt->execute([]);
$cources = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>СОЗДАТЬ КУРС</h2>

<form method="post" action="app/add_cource.php">
    <input type="text" name="cource" required>
    <input type="text" name="description" required>

    <button type="submit">Создать заявку</button>
</form>

<h2>Заявки</h2>

<?php if (empty($cources)): ?>
    <p>Курсов пока нет</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <td>ID Курса</td>
                <td>Название курса</td>
                <td>Описание</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cources as $cource): ?>
                <tr>
                    <td><input type="text" name="cource" value="<?= $cource['id'] ?>"></td>
                    <td><?= htmlspecialchars($cource['cource']) ?></td>
                    <td><input type="text" name="description" value="<?= $cource['description'] ?>"></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>