<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>今日推荐</title>
</head>
<body>
<?php 
  error_reporting(E_ALL || ~E_NOTICE);	
  require_once $_SERVER["DOCUMENT_ROOT"] . './inc/session.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . './inc/pager.php';
  if(isset($_GET['catalog'])){
          $filter=$_GET['catalog'];
      		$sql="select * from games where catalog=$filter";
        }else{
          $filter="";
          $sql="select * from games ";
        }
        session_start(); 
        $_SESSION["i"];
        $query = pager_query($sql,$nav_html,$_GET['page']);
        ?>
  	<div align="center">
  	<h1>独游居</h1>
    <link href="../assets/css/books.css" rel="Stylesheet"/>  
    <ul>
    <li><a class="lei" href="./">all</a></li>   
    <li><a class="lei" href="index.php?catalog=1">FTG</a></li>
    <li><a class="lei" href="index.php?catalog=2">AVG</a></li>
    <li><a class="lei" href="index.php?catalog=3">RPG</a></li>
    <li><a class="lei" href="index.php?catalog=4">SLG</a></li>
    </ul>
    <?php 
    if(isset($_GET['catalog'])){
        $querycat=$db->prepare("select * from catalog where id=:filter");
        $querycat->bindValue(':filter',$filter,PDO::PARAM_STR);
        $querycat->execute();
        $postcat=$querycat->fetchObject();
        echo "当前位置->".$postcat->name;
        }else{
          echo "当前位置->主页";
        }
        ?>
  <table id="customers">
      <tr>
        <th>序号</th>
        <th>游戏名</th>
        <th>出版商</th>
        <th>时间</th>
      </tr> 
        <?php
        $_SESSION["i"]=$_SESSION["i"]+'1';
        while ($post=$query->fetchObject()){
        ?>
    
          <tr>
            <td><?php echo $_SESSION["i"] ?></td>
            <td><a href="show.php?id=<?php echo $post->id ?>">
                <?php echo $post->游戏名 ?>
            </a></td>
            <td>
                <?php echo $post->出版商 ?></td>
            <td><?php echo $post->created_at ?></td>
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
    <a class="lei" href="../users/index.php">返回首页</a>
  <div>
</body>
</html>