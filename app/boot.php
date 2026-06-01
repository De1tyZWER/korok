<?php

session_start();
$cfg = include __DIR__ . '/config.php';

$pdo = new PDO(
    'mysql:host=' . $cfg['db_host'] . ';dbname=' . $cfg['db_name'],
    $cfg['db_user'],
    $cfg['db_pass']
);

$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);