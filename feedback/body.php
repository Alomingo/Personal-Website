<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>独游居</title>
</head>
<body>
  <div align="center"><br><br>
    <link href="../sets/css/photo.css" rel="Stylesheet"/>
    <img src="../assets/img/BClogo.jpg" class="img1"/>
  <?php
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';
    $id=$_GET['id'];
    $query=$db->prepare('select * from feedback where id=:id');
    $query->bindValue(':id',$id,PDO::PARAM_STR);
    $query->execute();
    $post=$query->fetchObject();
  ?>
    <br><br>
    <h2>标题: <?php echo $post->title; ?></h2>
    <br>
    <p>内容:<?php echo $post->body; ?></p>
    <br>
    <p>提交者：<?php echo $post->user_name; ?></p>
    <br>
    <p>时间：<?php echo $post->created_at; ?></p>
    <br>
    <a href="show.php">返回列表</a>
</body>
</html>