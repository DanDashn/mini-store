<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'root');
define('DATABASE', 'velo-moto');
$lin_handler = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (!$lin_handler) {
    die('Не удается подключиться к базе данных!');
}
?>