<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>save</title>
</head>

<body>
		<?php
		require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
		require_once $_SERVER["DOCUMENT_ROOT"] . './inc/common.php'; 
        session_start();
        $user_name=$_SESSION["username"];    
		$title=$_POST['title'];  
        $body=$_POST['body']; 
        $created_at = date('Y-m-d H:i:s');
        if($title==""||$body==""){  
            echo "<script>alert('请输入反馈内容！'); history.go(-1);</script>";  
        }  
        else{
			$sql="insert into feedback(title,body,user_name,created_at) values(:title,:body,:user_name,:created_at)" ;
			$result=$db->prepare($sql);
			$result->bindValue(':title',$title,PDO::PARAM_STR);
			$result->bindValue(':body',$body,PDO::PARAM_STR);
			$result->bindValue(':user_name',$user_name,PDO::PARAM_STR);
			$result->bindParam(':created_at',$created_at,PDO::PARAM_STR);
			if (!$result->execute()){ 
			  echo $result->errorInfo();
			}else{
			   echo "<script>alert('反馈成功');</script>"; 	
			  redirect_to("../users/index.php");
			};
		}
		?>
</body>
</html>

