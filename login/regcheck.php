<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>regcheck | </title>
</head>
<body>
   <?php 
   require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/db.php'; 
   error_reporting(E_ALL ^ E_WARNING);    
    if(isset($_POST["submit"]) && $_POST["submit"] == "注册"){  
        $name = htmlentities(addslashes($_POST["username"]));  
        $psw = htmlentities(addslashes($_POST["password"]));  
        $psw_confirm = htmlentities(addslashes($_POST["confirm"])); 
        $created_at = date('Y-m-d H:i:s'); 
        if($name == "" || $psw == "" || $psw_confirm == ""){  
            echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";  
        }  
        else{  
            if($psw==$psw_confirm){                  
                $result=$db->prepare("select name from users where name =:name");
                $result->bindValue(':name',$name,PDO::PARAM_STR);
                $result->execute();
                if($post=$result->fetchObject()){  
                    echo "<script>alert('用户名已存在'); history.go(-1);</script>";  
                }  
                else{  
                    $hashpsw=password_hash($psw, PASSWORD_DEFAULT);
                    $insert= $db->prepare("insert into users (name,password,created_at) values(:name,:hashpsw,:created_at)"); 
                    $insert->bindValue(':name',$name,PDO::PARAM_STR);
                    $insert->bindValue(':hashpsw',$hashpsw,PDO::PARAM_STR);
                    $insert->bindParam(':created_at',$created_at,PDO::PARAM_STR);
                    if($insert->execute()){  
                         echo "<script>alert('注册成功！');</script>"; 
                         echo "<script>window.location ='../index.php'</script>";                       
                    } 
                    else{  
                        echo "<script>alert('请稍候！'); history.go(-1);</script>";  
                    }  
                }  
            }  
            else{  
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";  
            }  
        }  
    }  
    else{  
        echo "<script>alert('提交失败！'); history.go(-1);</script>";  
    }  
    ?>
</body>
</html>
