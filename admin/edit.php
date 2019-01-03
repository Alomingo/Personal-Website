<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>独游居</title>
</head>
<body>
	<div align="center">
	<?php
		require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/db.php';
		$id = $_GET['id'];
		$result=$db->query('select * from games where id = ' . $id);
    	$post =$result->fetchObject();

    	$resultbook=$db->query('select * from games where id = ' . $id);
    	$postbook=$resultbook->fetchObject();
    	$resultcatalog=$db->query('select name from catalog where id = ' . $postbook->catalog);
    	$postcatalog=$resultcatalog->fetchObject();
	?>
	<h1>游戏信息: </h1><br>

	<form action="update.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value = "<?php echo $id; ?>"/>
		<label for="游戏名">游戏名</label>
		<input type="text" name="游戏名" value="<?php echo $post->游戏名 ?>" />
		<br>
		当前分类：<?php echo $postcatalog->name;?>
		<br>
		<label for "catalog">分类</label>
			<select name="catalog">
		    <?php 
		    require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/db.php';
		    $result=$db->query("select * from catalog");
		    while($row=$result->fetch()){
		    	?>
		    	<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
		    <?php }?>
		    </select>	
			<br>
		<img src="<?php echo $post->封面?>"  widht="1000" height="250" />
		<br>
		<label for="pic">封面</label>
		<input type="file" name="pic">
		<br>
		<label for="出版商">出版商</label>
		<input type="text" name="出版商" value="<?php echo $post->出版商 ?>" />
		<br>
		<label for="简介">简介</label>
		<textarea name="简介">
			<?php echo $post->简介; ?>
		</textarea>
		<br>
		<input type="submit" value="提交" />
	</form>
	<a href="./">返回列表</a>
	</div>
</body>
</html>