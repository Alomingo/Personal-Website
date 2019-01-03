<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>update</title>
</head>

<body>
		<div align="center"><?php
		require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
		require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/common.php';

		$id = $_POST['id'];
		
		$title=$_POST['title'];  
        $body=$_POST['body'];
        $ranking=$_POST['ranking']; 
        $result=$db->prepare("update comments set title =:title,body=:body,ranking=:ranking where id =:id;");
		$result->bindValue(':title',$title,PDO::PARAM_STR);
		$result->bindValue(':body',$body,PDO::PARAM_STR);
		$result->bindValue(':id',$id,PDO::PARAM_STR);
		$result->bindValue(':ranking',$ranking,PDO::PARAM_STR);
		if (!$result->execute()){ 
			  echo $result->errorInfo();
		}else{
			echo "<script>alert('修改成功！');history.go(-2);</script>";  

		};
		?>
		<div>

</body>
</html>