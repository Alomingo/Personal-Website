<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>独游居</title>
</head>
<body>
  <div align="center">
    <link href="../assets/css/bkshow.css" rel="Stylesheet"/> 
    <a class=back href="index.php">首页</a>
  <?php
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/db.php';
    require_once  $_SERVER["DOCUMENT_ROOT"] . './inc/common.php';
    
    $id=$_GET['id'];
    $querybook=$db->prepare('select * from games where id=:id');
    $querybook->bindValue(':id',$id,PDO::PARAM_STR);
    $querybook->execute();
    $postbook=$querybook->fetchObject();

      $querycat=$db->prepare('select name from catalog where id =:id');
      $querycat->bindValue(':id',$postbook->catalog,PDO::PARAM_STR);
      $querycat->execute();
      $postcatalog=$querycat->fetchObject();

    $querytagbk=$db->prepare('select * from tags_books where book_id =:id');
    $querytagbk->bindValue(':id',$id,PDO::PARAM_STR);
    $querytagbk->execute();
    $posttagbook=$querytagbk->fetchObject();
    $tagid=$posttagbook->tag_id;

      $querytag=$db->prepare('select name from tags where id = :id' );
      $querytag->bindValue(':id',$tagid,PDO::PARAM_STR);
      $querytag->execute();
      $posttag=$querytag->fetchObject();  
  ?>

  <img src="<?php echo $postbook->封面?>"  class=pos_abs  />
      <p class=p1>游戏名: <?php echo $postbook->游戏名; ?></p>
      <p class=p2>当前分类：<?php echo $postcatalog->name;?></p>
      <p class=p3>属性:<?php echo $posttag->name; ?></p>
      <p class=p4>出版商：<?php echo $postbook->出版商; ?></p>
      <p class=p5>上架时间：<?php echo $postbook->created_at; ?></p>
      <p class=cont>简介：<?php echo $postbook->简介; ?></p>

  <br><br><br><br><br><br><br>我要评论
  <form action="../comments/save.php" method="post">
      <input type="hidden" name='book_id' value='<?php echo $_GET['id']; ?>'/>
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

          <?php } 
       } 
       else{
        echo "暂无评论";
       }
?>

</body>
</html>