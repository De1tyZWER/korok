<?php

require_once __DIR__ . '/boot.php';

session_destroy();
header("location: /");