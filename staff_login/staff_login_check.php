<?php

try
{

  require_once('../common/common.php');

$post = sanitize($_POST);
$staff_code = $post['code'];
$staff_pass = $post['pass'];

$staff_pass = md5($staff_pass);

$dsn = 'mysql:dbname=shop;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh ->query('SET NAMES utf8');

$sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
$stmt = $dbh ->prepare($sql);
$data[] = $staff_code;
$data[] = $staff_pass;
$stmt ->execute($data);

$dbh = null;

$rec = $stmt ->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
  print 'スタッフコードかパスワードが間違っています。<br/>';
  print '<a href="staff_login.html">戻る</a>';
}


session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false)
{
print 'ログインされていません。<br/>';
print '<a href ="../staff_login/staff_login.html>ログイン画面へ</a>';
exit();
}
else
{
  session_start();
  $_SESSION['login']=1;
  $_SESSION['staff_code']=$staff_code;
  $_SESSION['staff_name']=$rec['name'];
  header('Location: staff_top.php');
}

}
catch (Exception $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>
