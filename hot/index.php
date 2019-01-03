<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Users |独游居</title>
</head>
<body>
    <div align="center">
      <link href="../../assets/css/photo.css" rel="Stylesheet"/>
     <img src="../../assets/img/BClogo.jpg" class="img1"/>
     <br> <br><br><br><br><br>
    <h1>今日推荐</h1>
    <?php
        require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
        require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';
        
        $query=$db->prepare("select * from games where  to_days(now())-to_days(created_at)<1;");
        $query->execute();
        if(null==$query->fetchObject()){
          echo "<script>alert('今天还没有推荐哦！'); history.go(-1);</script>";
        }
        ?>
  <link href="../assets/css/books.css" rel="Stylesheet"/>
   <table id="customers">
      <tr>
        <th>id</th>
        <th>游戏名</th>
        <th>作者</th>
        <th>时间</th>
      </tr>  
        <?php while ($post=$query->fetchObject()){ ?>
          <tr>
            <td><?php echo $post->id ?></td>
            <td><a href="show.php?id=<?php echo $post->id ?>">
                <?php echo $post->游戏名 ?>
            </a></td>
            <td>
                <?php echo $post->出版商 ?></td>
            <td><?php echo $post->created_at ?></td>
          </tr>
    <?php
        }  ?>
      <tr>
    </tbody>
    </table>
    <br>
    <a href="../users/index.php">返回首页</a>
  <div>
</body>
</html>

