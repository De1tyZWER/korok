<?php

require_once('boot.php');
session_destroy();
header("Location: /index.php");
exit();