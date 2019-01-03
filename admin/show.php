<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>独游居</title>
</head>
<body>
  <div align="center">
    <link href="../../assets/css/bkshow.css" rel="Stylesheet"/> 
    <a class=back href="index.php">首页</a>
  <?php
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';
    
    $id=$_GET['id'];
    $querygame=$db->prepare('select * from games where id=:id');
    $querygame->bindValue(':id',$id,PDO::PARAM_STR);
    $querygame->execute();
    $postgame=$querygame->fetchObject();

      $querycat=$db->prepare('select name from catalog where id =:id');
      $querycat->bindValue(':id',$postgame->catalog,PDO::PARAM_STR);
      $querycat->execute();
      $postcatalog=$querycat->fetchObject();

    $querytaggm=$db->prepare('select * from tags_games where game_id =:id');
    $querytaggm->bindValue(':id',$id,PDO::PARAM_STR);
    $querytaggm->execute();
    $posttaggm=$querytaggm->fetchObject();
    $tagid=$posttaggm->tag_id;

      $querytag=$db->prepare('select name from tags where id = :id' );
      $querytag->bindValue(':id',$tagid,PDO::PARAM_STR);
      $querytag->execute();
      $posttag=$querytag->fetchObject();  
  ?>

  <img src="<?php echo $postgame->封面?>"  class=pos_abs  />
      <p class=p1>游戏名:<?php echo $postgame->游戏名;?></p>
      <p class=p2>当前分类：<?php echo $postcatalog->name; ?></p>
      <p class=p3>标签:<?php echo $posttag->name; ?></p>
      <p class=p4>出版商：<?php echo $postgame->出版商;?></p>
      <p class=p5>上架时间：<?php echo $postgame->created_at;?></p>
      <p class=cont>简介：<?php echo $postgame->简介;?></p>

  <br><br><br><br><br><br><br>我来说几句
  <form action="../../comments/save.php" method="post">
      <input type="hidden" name='game_id' value='<?php echo $_GET['id']; ?>'/>
      <label for="title">标题</label>
      <input type="text" name="title"required="required"value="" />
      <br><br>
      <label for="body">内容</label>
      <textarea name="body"required="required"></textarea>
      <br><br>
      评论等级<select name="ranking">
          <?php 
          require_once $_SERVER["DOCUMENT_ROOT"] .'./inc/db.php';
          $result=$db->prepare("select * from ranking");
          $result->execute();
          while($post=$result->fetchObject()){
            ?>
            <option value="<?php echo $post->id ?>"><?php echo $post->ranking ?></option>
          <?php }?>
          </select> 
          <br>
      <input type="submit" value="提交" />
  </form>
    <p class=c6>评论:</p>
    <?php
        require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
        require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';

        $id = $_GET['id'] ;
        $s="select count(game_id) as amount from comments where game_id=:id ";
        $q=$db->prepare($s);
        $q->bindValue(':id',$id,PDO::PARAM_STR);
        $q->execute();
        $po=$q->fetchObject();
        if($po->amount!=0){
        echo "评论总数为："."$po->amount" ; 
        $querycomments=$db->prepare("select * from comments where game_id=:id");
        $querycomments->bindValue(':id',$id,PDO::PARAM_STR);
        $querycomments->execute();
        while ($postcomments=$querycomments->fetchObject()){
        ?>
          <?php
            $ranking_id=$postcomments->ranking;
            $queryranking=$db->prepare("select * from ranking where id=:ranking_id");
            $queryranking->bindValue(':ranking_id',$ranking_id,PDO::PARAM_STR);
            $queryranking->execute();
            $postranking=$queryranking->fetchObject()
             ?>
            <p class=c1>提交者：<?php echo $postcomments->username ?></p>
            <p class=c2>评分等级：<?php echo $postranking->ranking ?>
            <p class=c3>title：<?php echo $postcomments->title ?></p>
            <p class=c4>body：<?php echo $postcomments->body ?></p>
            <p class=c5>created_at：<?php echo $postcomments->created_at ?></p>
            <a class=c7 href="../../comments/edit.php?id=<?php  echo $postcomments->id ?>">修改</a>
            <a class=c8 href="../../comments/delete.php?id=<?php  echo $postcomments->id ?>">删除</a>
          <?php } 
       } 
       else{
        echo "暂无评论";
       }
?>

</body>
</html>