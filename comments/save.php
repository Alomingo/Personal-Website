  <!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>update</title>
</head>

<body>
		<?php

		require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
		require_once $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';
		$game_id=$_POST['game_id'];
		$title=$_POST['title'];  
        $body=$_POST['body'];
        $ranking=$_POST['ranking']; 
        $created_at = date('Y-m-d H:i:s');
        session_start();
        $username=$_SESSION["username"];
        if($title==""||$body=="")  
        {  
            echo "<script>alert('请评论！'); history.go(-1);</script>";  
        }  
        else{
			$sql="insert into comments(title,body,created_at,game_id,username,ranking) values(:title,:body,:created_at,:game_id,:username,:ranking)" ;
			$result=$db->prepare($sql);
			$result->bindValue(':title',$title,PDO::PARAM_STR);
			$result->bindValue(':body',$body,PDO::PARAM_STR);
			$result->bindValue(':game_id',$game_id,PDO::PARAM_STR);
			$result->bindValue(':username',$username,PDO::PARAM_STR);
			$result->bindValue(':ranking',$ranking,PDO::PARAM_STR);
			$result->bindParam(':created_at',$created_at,PDO::PARAM_STR);
			if (!$result->execute()){ 
			  echo $result->errorInfo();
			}else{
			   "<script>alert('成功');</script>"; 	
			  redirect_to("../admin/games/show.php?id={$game_id}");

			};
		}
		?>
</body>
</html>

