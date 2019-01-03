<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>delete | </title>
</head>
<body>
		<div align="center">
	    <?php
	    require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
	    require_once $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';

	    $id = $_GET['id'] ;
 
	    $result=$db->prepare('select * from comments where id = :id');
	    $result->bindValue(':id',$id,PDO::PARAM_STR);
		$result->execute();
        $post =$result->fetchObject();
	    ?>
		<form action="destory.php" method="post">
		<input type="hidden" name="id" value = "<?php echo $id; ?>"/>
		<p>确定删除评论吗？</p>
         <br>
		<input type="submit" value="确定">
	</form>
	<br>
	<br>
	<a href="../admin/books/index.php">返回</a>
    </div>
</body>
</html>