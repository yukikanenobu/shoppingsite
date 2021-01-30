<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print 'ログインされていません。<br/>';
  print '<a href="shop_list.php">商品一覧へ</a>';
  exit();
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

$name = $post['name'];
$email = $post['email'];
$postal1 = $post['postal1'];
$postal2 = $post['postal2'];
$address = $post['address'];
$tel = $post['tel'];

print $name.'様<br/>';
print 'ご注文ありがとうございました。<br/>';
print $email.'にメールをお送りましたのでご確認ください。<br/>';
print '商品は以下の住所に発送させて頂きます。<br/>';
print $postal1.'-'.$postal2.'<br/>';
print $address.'<br/>';
print $tel.'<br/>';

$statement = '';
$statement.= $name."様\n\nこのたびはご注文ありがとうございました。\n";
$statement.= "\n";
$statement.= "ご注文商品\n";
$statement.= "-----------\n";

$cart = $_SESSION['cart'];
$number = $_SESSION['number'];
$max = count($cart);

$dsn = 'mysql:dbname=shop;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh ->query('SET NAMES utf8');

for($$i=0; $i<$max; $i++)
{
  $sql = 'SELECT name, price FROM mst_product WHERE code=?';
  $stmt = $dbh ->prepare($sql);
  $data[0] = $cart[$i];
  $stmt ->execute($data);

  $rec = $stmt ->fetch(PDO::FETCH_ASSOC);

  $name = $rec['name'];
  $price = $rec['price'];
  $kakaku[] =$price;
  $suryo = $number[$i];
  $shokei = $price * $suryo;

  $statement.= $name.'';
  $statement.= $price.'円x';
  $statement.= $suryo.'個=';
  $statement.= $shokei."円\n";
}

$sql = 'LOCK TABLEs dat_sales, dat_sales_product WRITE';
$stmt = $dbh ->prepare($sql);
$stmt ->execute();

$lastmembercode = $_SESSION['member_code'];

  ?>

  <br/>
  <a href="shop_list.php">商品画面へ</a>

  </body>
</html>
