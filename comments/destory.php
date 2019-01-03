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
			$sql="delete from comments where id=:id";
			$result=$db->prepare($sql);
			$result->bindValue(':id',$id,PDO::PARAM_STR);
			if (!$result->execute()){ 
			  echo $result->errorInfo();
			}else{
			  echo "<script>alert('删除成功！');history.go(-2);</script>";  

			};
		?>
	<div>
</body>
</html>