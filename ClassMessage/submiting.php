<?php
session_start();
$name=$_SESSION["name"];
// 禁止非 POST 方式访问
if(!isset($_POST['submit'])){
    exit('非法访问!');
}
// 表单信息处理
if(get_magic_quotes_gpc()){
	$content = htmlspecialchars(trim($_POST['content']));
} else {
	$content = addslashes(htmlspecialchars(trim($_POST['content'])));
}

require('conn.php');

// 数据写入库表
$sql = "INSERT INTO message (name, mess,face)
VALUES ('".$name."','".$content."',".$_POST['face'].")";
if($link->query($sql) === TRUE){
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<? if($name=='admin'){ ?>
	<meta http-equiv="Refresh" content="2;url=admin.php">
<? }else{ ?>
	<meta http-equiv="Refresh" content="2;url=Message.php">
<? } ?>
<link rel="stylesheet" href="css/style.css" />
<title>留言成功</title>
</head>
<body>
<div class="refresh">
<p>留言成功！非常感谢您的留言。<br />请稍后，页面正在返回...</p>
</div>
</body>
</html>
<?php
} else {
	echo '留言失败：',"Error: " . $sql . "<br>" . $link->error,'[ <a href="javascript:history.back()">返 回</a> ]';
}
?>
?>