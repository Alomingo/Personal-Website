<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>User</title>
</head>
<body>
  <div align="center">
    <br>
    <br><h1>个人信息</h1>
  <?php
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';

    $name=$_GET['name'];
    $result=$db->prepare('select * from users where name=:name');
    $result->bindValue(':name',$name,PDO::PARAM_STR);
    $result->execute();
    $post=$result->fetchObject();

  ?>
  <br><br><br>
  <link href="../assets/css/user.css"  rel="Stylesheet"/>
  <img class=pos_abs src="<?php echo $post->头像?>"  />
  <p class=p1>账号名称: <?php echo $post->name ; ?></p>
  <p class=p2>年龄:<?php echo $post->age ; ?></p>
  <p class=p3>性别:<?php echo $post->sex ; ?></p>
  <p class=p4>个人介绍:<?php echo $post->charact ; ?></p>
  <p class=p5>家庭地址:<?php echo $post->adress ; ?></p>
  <a class=p6 href="edit.php?name=<?php echo $name ?>">修改信息</a>
  <a class=p7 href="./">返回首页</a>

</body>
</html>