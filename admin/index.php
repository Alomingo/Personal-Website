<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Users | 独游居</title>
</head>
<body>
  <?php 
	error_reporting(E_ALL || ~E_NOTICE);
	require_once $_SERVER["DOCUMENT_ROOT"] . './inc/session.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"] . './inc/pager.php';
      $sql="select * from users";
      session_start(); 
		  $_SESSION["i"];
      $query = pager_query($sql,$nav_html,$_GET['page']);
  ?>
  <div align="center">

    <br><br><br><br><br><br> 
    <h1>用户信息列表</h1>
    <table id="customers">
    <thead>
      <tr>
        <th>序号</th>
        <th>用户名</th>
        <th>注册时间</th>
        <th>修改</th>
      </tr>
    </thead>
  <tbody>   
        <?php
        $_SESSION["i"]=$_SESSION["i"]+'1';
        while ($post=$query->fetchObject()){
        ?>   
          <tr>
            <td><?php echo $_SESSION["i"] ?></td>
            <td><a href="../../users/show.php?name=<?php echo $post->name ?>">
                <?php echo $post->name ?>
            </a></td>
            <td><?php echo $post->created_at ?></td>
            <td>
              <a href="../../edit.php?name=<?php echo $post->name ?>">改</a>
              <a href="../../delete.php?name=<?php echo $post->name ?>">删</a>
            </td>
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
    <a href="../games/index.php">返回首页</a>
  <div>
</body>
</html>

