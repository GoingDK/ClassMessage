<?php
	header("Content-Type:text/html;charset=UTF-8");

//登录
if(isset($_POST['submit'])==1){
    exit('非法访问!');
}
$username = htmlspecialchars($_POST['username']);
//$password = MD5($_POST['password']);
$password = $_POST['password'];

//包含数据库连接文件
include('conn.php');
if($username=="admin"&&$password=="admin"){//判断是不是管理员
	session_start();
    $_SESSION["name"]='admin';
    header('Location:admin.php');
    exit;
}else{
$strSql ="select * from user where id=".$username." and password=".$password."";
$result = $link->query($strSql);
$row=$result->num_rows;
if($row > 0){
    //登录成功
    $rrow = $result->fetch_assoc();
    session_start();
    $_SESSION["name"]=$rrow["name"];
    $_SESSION["id"]=$rrow["id"];
    header('Location:Message.php');
    exit;
}else{
	var_dump($link->error_list);
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
}
//检测用户名及密码是否正确

?>