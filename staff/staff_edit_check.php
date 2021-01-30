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

<?php

require_once('../common/common.php');

$post = sanitize($_POST);
$staff_code=$post['code'];
$staff_name=$post['name'];
$staff_pass=$post['pass'];
$staff_pass2=$post['pass2'];

if($staff_name=='')
{
  print 'スタッフ名が入力されていません。/Add your staff.';
}
else
{
  print 'スタッフ名:';
  print $staff_name;
  print'<br/>';
}

If($staff_pass=='')
{
  print 'パスワードが入力されていません。<br/>';
}

if($staff_pass!=$staff_pass2)
{
  print 'パスワードが一致しません。/The passwords you entered didnt match.<br/>';
}

if($staff_name==''|| $staff_pass==''|| $staff_pass != $staff_pass2)
{
  print '<form>';
  print '<input type="button" onclick="history.back()" value="back">';
  print '</form>';
}
else
{
  $staff_pass=md5($staff_pass);
  print '<form method="post" action="staff_edit_done.php">';
  print '<input type="hidden" name="code" value="'.$staff_code.'">';
  print '<input type="hidden" name="name" value="'.$staff_name.'">';
  print '<input type="hidden" name="pass" value="'.$staff_pass.'">';
  print '<br/>';
  print '<input type="button" onclick="history.back()" value="back">';
  print '<input type="submit" value="OK">';
  print '</form>';
}

?>
  </body>
</html>
