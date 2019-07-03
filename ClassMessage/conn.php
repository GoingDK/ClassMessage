<?php
/*数据库连接*/

$serve = 'localhost';
$db = 'root';
$psd = '123qwe';
$dbname = 'classmessage';
$link = mysqli_connect($serve,$db,$psd,$dbname);
if ($link->connect_error) {
    die("连接失败: " . $link->connect_error);
} 
mysqli_set_charset($link,'UTF-8'); // 设置数据库字符集
$link->query("set names utf8");

?>