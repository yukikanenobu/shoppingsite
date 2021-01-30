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

スタッフ追加/Adding staff<br/>
<br/>
<form action="staff_add_check.php" method="post">
  スタッフ名を入力してください。/Add your staff.<br/>
  <input type="text" name="name" style= "width:200px" value=""><br/>
  パスワードを入力してください。/Enter your password.<br/>
  <input type="password" name="pass" style= "width:100px" value=""><br/>
  パスワードをもう一度入力してください。/Enter your password again.<br/>
  <input type="password" name="pass2" style= "width:100px" value=""><br/>
  <br/>
  <input type="button" onclick="history.back()" value="back">
  <input type="submit" value="OK">
  </form>
  </body>
</html>
