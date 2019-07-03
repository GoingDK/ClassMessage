<?php
	
//注销登录
if($_GET['act']== 'logout'){
	session_start();
    unset($_SESSION['name']);
    echo '退出登录成功！点击此处 <a href="index.html">登录</a>';
    exit;
}
?>