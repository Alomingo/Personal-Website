<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>update</title>
</head>

<body>
		<?php
		    error_reporting(E_ALL ^ E_NOTICE);
			require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
			require_once $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';

			$tag_name=$_POST['tag'];
			$sql="select * from tags where name=:name";
			$r=$db->prepare($sql); 
            $r->bindValue(':name',$tag_name,PDO::PARAM_STR);
            $r->execute();            
            if(!$p=$r->fetchObject()){
            	$querytag=$db->prepare("insert into tags(name) values(:tag_name)");
				$querytag->bindValue(':tag_name',$tag_name,PDO::PARAM_STR);
				$querytag->execute();
            }
			
			var_export($_FILES);
			$dest_path="/uploads/book-".rand().".jpg";
			$dest=$_SERVER["DOCUMENT_ROOT"].$dest_path;
			$dest_temp="../..".$dest_path;
			var_export($dest);
			move_uploaded_file($_FILES["pic"]["tmp_name"],$dest);

			$name=$_POST['游戏名'];
			$author=$_POST['出版商'];
			$body=$_POST['简介'];
			$catalog=$_POST['catalog'];
			$created_at = date('Y-m-d H:i:s');
			$sql =  "insert into games(游戏名,封面,出版商,简介,created_at,catalog) values(:name, :dest_temp,:author,:body,:created_at,:catalog)";
			$querybooks=$db->prepare($sql);
			$querybooks->bindValue(':name',$name,PDO::PARAM_STR);
			$querybooks->bindValue(':dest_temp',$dest_temp,PDO::PARAM_STR);
			$querybooks->bindValue(':author',$author,PDO::PARAM_STR);
			$querybooks->bindValue(':body',$body,PDO::PARAM_STR);
			$querybooks->bindValue(':catalog',$catalog,PDO::PARAM_STR);
			$querybooks->bindParam(':created_at',$created_at,PDO::PARAM_STR);
			$querybooks->execute();
			
			$queryt=$db->prepare("select * from tags where name=:name");
			$queryt->bindValue('name',$tag_name,PDO::PARAM_STR);
			$queryt->execute();
			$postt=$queryt->fetchObject();
			$tag_id=$postt->id;
			

			$queryb=$db->prepare("select * from games where 游戏名=:gamename"); 
			$queryb->bindValue(':gamename',$name,PDO::PARAM_STR);
			$queryb->execute();
			$postb=$queryb->fetchObject();
			$book_id=$postb->id;
			

			$result=$db->prepare("insert into tags_books(tag_id,book_id)values(:tag_id,:game_id);");
			$result->bindValue(':tag_id',$tag_id,PDO::PARAM_STR);
			$result->bindValue(':game_id',$book_id,PDO::PARAM_STR);
			$result->execute();

			redirect_to("./");
			?>
            }
</body>
</html> 