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

  require_once('../common/common.php');

$post = sanitize($_POST);
$pro_name = $post['name'];
$pro_price = $post['price'];
$pro_image = $post['image_name'];

$dsn = 'mysql:dbname=shop;host =localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql = 'INSERT INTO mst_product(name, price, image) VALUES (?,?, ?)';
$stmt = $dbh->prepare($sql);
$data[] = $pro_name;
$data[] = $pro_price;
$data[] = $pro_image_name;
$stmt->execute($data);

$dbh = null;

print $pro_name;
print 'を追加しました。<br/>';

}
catch(Exception $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。/ Something wrong happened.';
  exit();
}

?>

<a href="pro_list.php">back</a>
  </body>
</html>
