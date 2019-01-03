 <!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>update</title>
</head>

<body>
		<?php
		error_reporting(E_ALL ^ E_WARNING);
		require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/db.php';
		require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/common.php';

		$name=$_POST['name'];
		//echo "上传文件名: " . $_FILES["pic"]["name"] . "<br>";
    	//echo "文件类型: " . $_FILES["pic"]["type"] . "<br>";
    	//echo "文件大小: " . ($_FILES["pic"]["size"] / 1024) . " kB<br>";
    	//echo "文件临时存储的位置: " . $_FILES["pic"]["tmp_name"];		
		if($_FILES["pic"]["size"]>0){
			var_export($_FILES);
			$dest_path="/uploads/user-".rand().".jpg";
			$dest=$_SERVER["DOCUMENT_ROOT"].$dest_path;
			$dest_temp="..".$dest_path;
			var_export($dest);
			move_uploaded_file($_FILES["pic"]["tmp_name"],$dest);
			$sql = 'update users set 头像=:dest_temp,charact=:charact,sex=:sex,adress=:adress,age=:age  where name=:name';
			$query=$db->prepare($sql);
			$query->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
			$query->bindValue(':charact',$_POST['character'],PDO::PARAM_STR);
			$query->bindValue(':sex',$_POST['sex'],PDO::PARAM_STR);
			$query->bindValue(':adress',$_POST['adress'],PDO::PARAM_STR);
			$query->bindValue(':age',$_POST['age'],PDO::PARAM_STR);
			$query->bindValue(':dest_temp',$dest_temp,PDO::PARAM_STR);
		}
		else{
			$sql = 'update users set charact=:charact,sex=:sex,adress=:adress,age=:age  where name=:name';
			$query=$db->prepare($sql);
			$query->bindValue(':name',$_POST['name'],PDO::PARAM_STR);
			$query->bindValue(':charact',$_POST['character'],PDO::PARAM_STR);
			$query->bindValue(':sex',$_POST['sex'],PDO::PARAM_STR);
			$query->bindValue(':adress',$_POST['adress'],PDO::PARAM_STR);
			$query->bindValue(':age',$_POST['age'],PDO::PARAM_STR);
		}
		if (!$query->execute()) {
		  echo mysql_error();
		  echo '<br>' .  $sql;
		}else{
			redirect_to("show.php?name={$name}");
		};
		?>
</body>
</html>
