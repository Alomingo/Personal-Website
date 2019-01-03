<!doctype html>
<html>
<head>
  <meta charset="UTF-8"> 
  <title>login  |  </title>
</head>
<body>
    <div align="center">   
    <?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
    require_once $_SERVER["DOCUMENT_ROOT"] . './inc/common.php'; 
        $name = $_POST["username"];  
        $psw = $_POST["password"]; 
        session_start();         
        $_SESSION["username"]=$name;
        if($name == "" || $psw == ""){  
           echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else{  
            if($_POST["submit"] == "用户登陆") {
                $sql="select name,password from users where name = :name";                
            }      
            else{               
                $sql="select name,password from admin where name = :name";
            }
            $result=$db->prepare($sql); 
            $result->bindValue(':name',$name,PDO::PARAM_STR);
            $result->execute();            
            if(!$post=$result->fetchObject()){
                echo "<script>alert('账号不存在');</script>"; 
                echo "<script>history.back(-1);</script>";
            }else{
                $hash=$post->password;
                if(password_verify($psw,$hash)){  
                    echo "<script>alert('欢迎进入独游居');</script>";
	                    if($_POST["submit"] == "用户登陆"){
	                    		echo "<script>window.location ='../users/index.php'</script>";
	                    }
                        else{
	                    	echo "<script>window.location ='../admin/games/index.php'</script>";
	                    }

                }
                else{   
                     "<script>alert('密码不正确！');</script>";  
                }
            }  
        }  
?>
<div>
    
</body>
</html>