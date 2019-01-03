<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Book Cookie</title>
</head>
<body>
	<div align="center">
	<h1>edit user information: </h1><br>
	<?php 
	require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/db.php';

	$name=$_GET['name'];
    $result=$db->prepare('select * from users where name=:name');
    $result->bindValue(':name',$name,PDO::PARAM_STR);
    $result->execute();
    $post=$result->fetchObject();
	?>	
	<form action="update.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="name" value = "<?php echo $name; ?>"/>
		头像：<img src="<?php echo $post->头像?>" widht="100" height="25"/>
		<br>
		<label for="pic">更换头像:</label>
		<input type="file" name="pic">
		<br><br><br>
		账号名称: <?php echo $post->name ; ?><?php echo " "."(此内容不可修改)" ?>
		<br><br><br>
		<label for="age">年龄:</label>
		<input type="text" name="age" value="<?php echo $post->age ?>" />
		<br><br><br>
		<label for="sex">性别:</label>
		<input type="text" name="sex" value="<?php echo $post->sex ?>" />
		<br><br><br>
		<label for="character">个人介绍:</label>
		<textarea name="character"><?php echo $post->charact; ?></textarea>
		<br><br><br>
		<label for="adress">家庭住址:</label>
		<textarea name="adress"><?php echo $post->adress; ?></textarea>
		<br><br><br>
		<input type="submit" value="提交" />
		<br><br><br>
	</form>
	<a href="show.php?name=<?php echo $name ?>">返回上一页</a>
	</div>
</body>
</html>