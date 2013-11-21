<?php
define('DSN', 'mysql:host=localhost;dbname=cdd-design;charset=utf8');
define('DB_USER', 'root');
define('DB_PASS', '');

$db = new Classes\Model\Adapters\Pdo(DSN, DB_USER, DB_PASS);