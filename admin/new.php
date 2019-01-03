<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>new | 独游居</title>
</head>
<body>
	<div align="center">
		<br>
		<form action="save.php" method="post" enctype="multipart/form-data">
			<label for="游戏名">游戏名</label>
			<input type="text" name="游戏名" required="required" value="" />
			<br/>
			<label for="pic">封面</label>
			<input type="file" name="pic">
			<br/>
			<label for="出版商">出版商</label>
			<input type="text" name="出版商" required="required" value="" />
			<br>
			<label for "catalog">分类</label>
			<select name="catalog">
		    <?php 
		    require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/db.php';
		    $result=$db->prepare("select * from catalog");
		    $result->execute();
		    while($post=$result->fetchObject()){
		    	?>
		    	<option value="<?php echo $post->id ?>"><?php echo $post->name ?></option>
		    <?php }?>
		    </select>	
			<br>
			<label for="tag">标签:</label>
			<input type="text" required="required" name="tag"/>
		    </br>
			<br>
			<label for="简介">简介</label>
			<textarea name="简介" required="required"></textarea>
			<br>			
			<input type="submit" value="提交" /><br>
			<a href="./">返回</a>
		</form>
	<div>
</body>
</html>