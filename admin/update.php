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
		$title=$_POST['游戏名'];
		$author=$_POST['出版商'];
		$body=$_POST['简介'];
		$catalog=$_POST['catalog'];

		if($_FILES["pic"]["size"]>0){ 
			var_export($_FILES);
			$dest_path="/uploads/book-".rand().".jpg";
			$dest=$_SERVER["DOCUMENT_ROOT"].$dest_path;
			$dest_temp="../..".$dest_path;
			var_export($dest);
			move_uploaded_file($_FILES["pic"]["tmp_name"],$dest);
			$sql = "update games set 游戏名=:title,封面=:dest_temp, 出版商 =:author, 简介 =:body,catalog=:catalog where id =:id" ;
			$query=$db->prepare($sql);
			$query->bindValue(':id',$id,PDO::PARAM_STR);
			$query->bindValue(':title',$title,PDO::PARAM_STR);
			$query->bindValue(':dest_temp',$dest_temp,PDO::PARAM_STR);
			$query->bindValue(':author',$author,PDO::PARAM_STR);
			$query->bindValue(':body',$body,PDO::PARAM_STR);
			$query->bindValue(':catalog',$catalog,PDO::PARAM_STR);
		}else{
			$sql = "update books set 游戏名=:title,出版商 =:author, 简介 =:body,catalog=:catalog where id =:id" ;
			$query=$db->prepare($sql);
			$query->bindValue(':id',$id,PDO::PARAM_STR);
			$query->bindValue(':title',$title,PDO::PARAM_STR);
			$query->bindValue(':author',$author,PDO::PARAM_STR);
			$query->bindValue(':body',$body,PDO::PARAM_STR);
			$query->bindValue(':catalog',$catalog,PDO::PARAM_STR);
	
		}
		
		if (!$query->execute()) {
		  echo mysql_error();
		  echo '<br>' .  $sql;
		}else{
			redirect_to("./show.php?id={$id}");
		};
		?>
		<div>

</body>
</html>
