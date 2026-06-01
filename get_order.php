<?php

require_once('app/boot.php');

$sql = "SELECT * FROM cources";
$stmt = $pdo->prepare($sql);
$stmt->execute([]);
$cources = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Оставить заявку</h1>

<form method="post" action="app/do_order.php">
    <select name="cource" id="">
        <option value="">--- ВЫБЕРЕТЕ КУРС ---</option>
        <?php foreach ($cources as $cource): ?>
            <option value="<?= htmlspecialchars($cource['id']) ?>"><?= htmlspecialchars($cource['cource']) ?></option>
        <?php endforeach ?>
    </select>
    <input type="date" name="date" required>
    <select name="pay" id="">
        <option value="">--- ВЫБЕРЕТЕ СПОСОБ ---</option>
        <option value="Наличные">Наличные</option>
        <option value="Перевод">Перевод</option>
    </select>

    <button type="submit">Отправить заявку</button>
</form>

<p>Есть аккаунт? <a href="auth.php">Авторизация</a></p>