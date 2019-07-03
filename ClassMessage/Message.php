<?php
session_start();
$name=$_SESSION["name"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>留言板</title>
		<link rel="stylesheet" href="css/message.css" />
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body bgcolor="black" class="aa">
		<div class="one">
		<nav><ul>
			<li><a href="person.html">密码修改</a></li>
			<li><a href="Message.php">留言板</a></li>
			<? $act="logout"; ?>
			<li><a href="<?php echo "Logout.php?act=".$act ?>">退出</a></li>
		</ul></nav>
		<a><? echo $name ?>同学欢迎您！</a>
		<h1>16计算机3班留言板</h1>
		
		<div id="guestbook"><!--留言列表-->
		<h3>留言列表</h3>
<?php
// 引用相关文件
require('conn.php');
require('config.php');

// 确定当前页数 $p 参数
$p = isset($_GET['p'])?$_GET['p']:1;

// 数据指针
$offset = ($p-1)*$pagesize;

$query_sql = "SELECT * FROM message ORDER BY mid DESC LIMIT ".$offset." , ".$pagesize."";
$result = $link->query($query_sql);
$row=$result->num_rows;
// 如果出现错误并退出
if($row<0) exit('查询数据错误：'.mysql_error());
// 循环输出
while($gb_array = $result->fetch_assoc()){
?>
		<div class="guestbook-list">
		<p class="guestbook-head">
		<img src="images/<?=$gb_array['face']?>.gif" />
		<span class="bold"><?=$gb_array['name']?></span> 
		<span class="guestbook-time">[<?=date("Y-m-d h:i:s", strtotime($gb_array['date']))?>]</span></p>
		<p class="guestbook-content"><?=nl2br($gb_array['mess'])?></p>
		</div>
<?php
}	//while循环结束
?>
		<div class="guestbook-list guestbook-page">
		<p>
<?php
//计算留言页数
$count_re ="SELECT * FROM message";
$count_result = $link->query($count_re);
$count_row=$count_result->num_rows;

$pagenum = ceil($count_row/$pagesize);
echo '共 ',$count_row,' 条留言';
if ($pagenum > 1) {
	for($i=1;$i<=$pagenum;$i++) {
		if($i==$p) {
			echo '&nbsp;[',$i,']';
		} else {
		echo '&nbsp;<a href="Message.php?p=',$i,'">'.$i.'</a>';
		}
	}
}
?>
		</p>
		</div>
		</div><!--留言列表结束-->
		<div id="guestbook-form">
		<h3>发表留言</h3>
		<form id="form1" name="form1" method="post" action="submiting.php">
		<p>
		<label for="face">头&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;像:</label>
		<input type="radio" name="face" value="1" checked>
		<img src="images/1.gif" /> 
		<input type="radio" name="face" value="2">
		<img src="images/2.gif" />
		<input type="radio" name="face" value="3">
		<img src="images/3.gif" /> 
		<input type="radio" name="face" value="4">
		<img src="images/4.gif" /> 
		<input type="radio" name="face" value="5">
		<img src="images/5.gif" /> 
		<input type="radio" name="face" value="6">
		<img src="images/6.gif" /> 
		<input type="radio" name="face" value="7">
		<img src="images/7.gif" />
		</p>
		<p class="leftmargin">
		<input type="radio" name="face" value="8">
		<img src="images/8.gif" /> 
		<input type="radio" name="face" value="9">
		<img src="images/9.gif" /> 
		<input type="radio" name="face" value="10">
		<img src="images/10.gif" /> 
		<input type="radio" name="face" value="11">
		<img src="images/11.gif" /> 
		<input type="radio" name="face" value="12">
		<img src="images/12.gif" /> 
		<input type="radio" name="face" value="13">
		<img src="images/13.gif" /> 
		<input type="radio" name="face" value="14">
		<img src="images/14.gif" />
		</p>
		<p>
		<p>
		<label for="title">留言内容:</label>
		<textarea name="content" required></textarea>
		</p>
		<input type="submit" name="submit" class="submit" value="确 定 " />
		<a>(请自觉遵守互联网相关政策法规，严禁发布色情、暴力、反动言论) </a>
		</form>
		</div>
		</div><!--container-->
		</div>
	</body>
</html>
