<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>独游居</title>
</head>
<body>
  <body background="空洞骑士.jpg">
	<div align="center">
<caption><h1>独游居 </h1></caption>
     <br>
      <img src="../assets/img/123.gif" class="img1"/>
      <br>
          <a class=in1 href="index.php">首页</a>
          <a class=in2 href="../feedback/index.php">建议</a>
           <?php 
            session_start();
            $name=$_SESSION["username"];
            ?>
           <a class=in3 href="show.php?name=<?php echo $name ?>"><?php echo $name ?></a>
           <a class=in4 href="../">注销</a>
           <br>
           <br>
           <br>
           <br>
           <br>
	</div>
   <div align="center">
          <a href="../daily_new/index.php">本周推荐</a>
          <br>
          <a href="../games/index.php?mark=hot">热门游戏</a>
     </div> <br>
      <div align="center">
          <a class=t1 href="../games/index.php?catalog=1">FTG</a>
          <a class=t2 href="../games/index.php?catalog=2">AVG</a>
          <a class=t3 href="../games/index.php?catalog=3">RPG</a>
          <a class=t4 href="../games/index.php?catalog=4">SLG</a>
     </div>
     <br>
     <br>
     <br>
    <div align="center">
      <div class="container" style="z-index: 999" id="searchDiv">
        <div class="keyword-search">
            <form action="../lookup/index.php" method="post">
            <input  type="text" name="lookup" style="width: 200px;" required="required" placeholder="请输入游戏名" />
             <input type="submit" name="submit" value="搜索" />
         </div>
      </div>
    </div><br><br><br>
   
   
</body>
</html>