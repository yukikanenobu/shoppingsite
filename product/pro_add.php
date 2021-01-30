<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
  print 'ログインされていません。<br/>';
  print '<a href ="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
}
else
{
  print $_SESSION['staff_name'];
  print 'さんがログイン中<br/>';
  print '<br/>';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>田中果樹園</title>
  </head>
  <body>

商品追加/Adding products<br/>
<br/>
<form action="pro_add_check.php" method="post" enctype="multipart/form-data">
  商品名を入力してください。/Add your product.<br/>
  <input type="text" name='name' style= "width:200px" value=""><br/>
  価格を入力してください。/Enter your password.<br/>
  <input type="text" name='price' style= "width:50px" value=""><br/>
  画像を選んでください。<br/>
  <input type="file" name="image" style="width:400px"><br/>
  <br/>
  <input type="button" onclick="history.back()" value="back">
  <input type="submit" value="OK">
  </form>
  </body>
</html>
