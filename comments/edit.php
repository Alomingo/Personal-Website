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
		$id = $_GET['id'];//echo $id;
		$result=$db->prepare('select * from comments where id = :id' );
		$result->bindValue(':id',$id,PDO::PARAM_STR);
		$result->execute();
    	$post =$result->fetchObject();
    	$i=$post->book_id;
	?>
	<h1>edit comments information: </h1>
	<br>

	<form action="update.php" method="post">
		<input type="hidden" name="id" value = "<?php echo $id ?>"/>
		<label for="title">title</label>
		<input type="text" name="title" value="<?php echo $post->title ?>" />
		<br>
		<label for="body">body</label>
		<textarea name="body">
			<?php echo $post->body; ?>
		</textarea>
		<br>
		评论等级<select name="ranking">
        <?php 
        require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/db.php';
        $result=$db->prepare("select * from ranking");
        $result->execute();
        while($post=$result->fetchObject()){
          ?>
          <option value="<?php echo $post->id ?>"><?php echo $post->ranking ?></option>
        <?php }?>
        </select> 
        <br>
		<input type="submit" value="提交" />
	</form>
	<a href="../admin/games/show.php?id=<?php echo $i ?>">返回</a>
	</div>
</body>
</html>