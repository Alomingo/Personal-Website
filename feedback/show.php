<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>用户建议</title>
</head>
<body>
  <?php 
  error_reporting(E_ALL || ~E_NOTICE);
  require_once $_SERVER["DOCUMENT_ROOT"] . './inc/session.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . './inc/pager.php';
  $sql="select * from feedback";
        session_start(); 
        $_SESSION["i"];
        $query = pager_query($sql,$nav_html,$_GET['page']);
?>
    <div align="center"><br><br>
    <h1>用户建议</h1>
    <link href="../../assets/css/books.css" rel="Stylesheet"/> 
    <br>
    <table id="customers">
    <thead>
      <tr>
        <th>id</th>
        <th>标题</th>
        <th>建议时间</th>
        <th>建议者</th>
      </tr>
    </thead>
    <tbody>   
        <?php
        $_SESSION["i"]=$_SESSION["i"]+'1';  
        while ($post=$query->fetchObject()){
        ?>
            <tr>
            <td><?php echo $_SESSION["i"] ?></td>
            <td><a href="body.php?id=<?php echo $post->id ?>">
                <?php echo $post->title ?>
            </a></td>
            <td>
                <?php echo $post->created_at ?></td>
            <td>
                <?php echo $post->user_name ?></td>
          </tr>
      <?php 
      $_SESSION["i"]=$_SESSION["i"]+'1';
    }  ?>
      <tr>
    </tbody>
    </table>
    <br>
    <?php echo $nav_html; ?>
    <br>
    <a href="../admin/games/index.php">返回首页</a>
</body>
</html>
