<?php

session_start();

$config = include __DIR__ . '/config.php';

$pdo = new PDO(
    'mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'],
    $config['db_user'],
    $config['db_pass']
);

// $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);