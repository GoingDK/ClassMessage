<?php
session_start();
$id=$_SESSION["id"];

$ypwd = $_POST['ypwd'];
$pw = $_POST['pw1'];

//包含数据库连接文件
include('conn.php');

//检测原密码是否正确
$strSql ="select * from user where id=".$id." and password=".$ypwd."";
$result = $link->query($strSql);
$row=$result->num_rows;
if($row > 0){//原密码正确
    mysqli_query($link,"UPDATE user SET password=".$pw."
WHERE id=".$id."");

  echo "<script>alert('Change password success')</script>";
 echo "<meta http-equiv='Refresh' content='0;URL=Message.php'>"; 
    exit;
}else{
	var_dump($link->error_list);
    exit('原密码错误！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
?>