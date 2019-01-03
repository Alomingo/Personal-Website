<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>独游居</title>
</head>
<body>
	<?php  
    if(isset($_POST["submit"]) && $_POST["submit"] == "搜索"){  
        $lookup = $_POST["lookup"];   
            require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
            $result=$db->query("select * from games");
             while ($row = $result->fetch()){
             if($row[1]==$lookup){                
                    echo "<script>window.location ='show.php?id=$row[0]'</script>";
                }
            }  
        echo "<script>alert('查找不到此游戏');history.go(-1);</script>"; 
    }
    else{  
        echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
    }  
	?>
<div>
</body>
</html>