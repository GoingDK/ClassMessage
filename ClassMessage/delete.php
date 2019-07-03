<?php
//包含数据库连接文件
include('conn.php');
//删除留言
if($_GET['action']== 'delete'){
	$idd=$_GET['idd'];
//  print_r($idd);

	mysqli_query($link,"DELETE FROM message WHERE mid=".$idd."");
	echo "<script>alert('Delete success')</script>";
    echo "<meta http-equiv='Refresh' content='0;URL=admin.php'>"; 
    exit;
}
?>