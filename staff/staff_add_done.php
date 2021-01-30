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

$staff_name = $_POST['name'];
$staff_pass = $_POST['pass'];

$staff_name = htmlspecialchars($staff_name);
$staff_pass = htmlspecialchars($staff_pass);

$dsn = 'mysql:dbname=shop;host =localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->query('SET NAMES utf8');

$sql = 'INSERT INTO mst_staff(name, password) VALUES (?,?)';
$stmt = $dbh->prepare($sql);
$data[] = $staff_name;
$data[] = $staff_pass;
$stmt->execute($data);

$dbh = null;

print $staff_name;
print 'さんを追加しました。<br/>';

}
catch(Exception $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。/ Something wrong happened.';
  exit();
}

?>

<a href="staff_list.php">back</a>
  </body>
</html>
