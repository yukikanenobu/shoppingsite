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
    <title></title>
  </head>
  <body>

    <?php

try
{

$pro_code = $_POST['code'];
$pro_image_name=$_POST['image_name'];

$dsn = 'mysql:dbname=shop;host =localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql = 'DELETE FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $pro_code;
$stmt->execute($data);

$dbh = null;

if($pro_image_name!='')
{
  unlink('./image/'.$pro_image_name);
}
}
catch(Exception $e)
{
print 'ただいま障害により大変ご迷惑をお掛けしております。/ Something wrong happened.';
  exit();
}

?>

削除しました。<br/>
<br/>
<a href="pro_list.php">back</a>

  </body>
</html>
