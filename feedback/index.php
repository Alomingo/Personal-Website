<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>独游居</title>
</head>
<body>
    <div align="center">
	 <link href="../assets/css/photo.css" rel="Stylesheet"/> 
     </br></br></br></br></br></br></br>
     <form action="save.php" method="post">
        <input type="hidden" name='game_id' value='<?php echo $_GET['id']; ?>'/>
        <label for="title">标题</label>
        <input type="text" name="title"required="required"value="" />
        <br/></br>
        <label for="body">内容</label>
        <textarea name="body"required="required"></textarea>
        <br/></br>
        <input type="submit" value="提交" />
      </form><br>
     <a href="../users/index.php">返回首页</a>
      </div>
<body>
</body>
</html>