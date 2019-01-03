<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>update</title>
</head>
<body>
	<div align="center">
		<?php
			require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
			require_once $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';
			$id = $_POST['id'] ;
			$sql="delete from games where id=:id;";
			$result=$db->prepare($sql);
		    $result->bindValue(':id',$id,PDO::PARAM_STR);
		    $result->execute();
	    	$post =$result->fetchObject();
			if (!$result->execute()) {
			  echo mysql_error();
			  echo '<br>' .  $sql;
			}else{
			  redirect_to("./");
			};
		?>
	<div>
</body>
</html>