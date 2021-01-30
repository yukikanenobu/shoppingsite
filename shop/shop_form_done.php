<?php
session_start();
session_regenerate_id(true);
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
$chumon = $post['chumon'];
$pass = $post['pass'];
$danjyo = $post['danjyo'];
$birth = $post['birth'];

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

$lastmembercode = 0;
if($chumon=='chumontouroku')
{
$sql = 'INSERT INTO dat_member(password, name, email, postal1, postal2, address, tel, danjyo, born)VALUES(?,?,?,?,?,?,?,?,?)';
$stmt = $dbh ->prepare($sql);
$data = array();
$data[] = md5($pass);
$data[] = $name;
$data[] = $email;
$data[] = $postal1;
$data[] = $postal2;
$data[] = $address;
$data[] = $tel;
if($danjyo=='dan')
{
  $data[]=1;
}
else
{
  $data[]=2;
}
$data[]=$birth;
$stmt -> execute($data);

$sql = 'SELECT LAST_INSERT_ID()';
$stmt = $dbh ->prepare($sql);
$stmt ->execute();
$rec = $stmt ->fetch(PDO::FETCH_ASSOC);
$lastmembercode = $rec['LAST_INSERT_ID()'];
}

$sql = 'INSERT INTO dat_sales(codes_member, name, email, postal1, postal2, address, tel) VALUES (?,?,?,?,?,?,?)';
$stmt = $dbh ->prepare($sql);
$data = array();
$data = $lastmembercode;
$data[] = $name;
$data[] = $email;
$data[] = $postal1;
$data[] = $postal2;
$data[] = $address;
$data[] = $tel;
$stmt ->execute($data);

$sql = 'SELECT LAST_INSERT_ID()';
$stmt = $dbh ->prepare($sql);
$stmt ->execute();
$rec = $stmt ->fetch(PDO::FETCH_ASSOC);
$lastcode = $rec['LAST_INSERT_ID()'];

for($i=0; $i<$max; $i++)
{
  $sql = 'INSERT INTO dat_sales_product(code_sales, code_product, price, quantity) VALUES(?,?,?,?)';
  $stmt = $dbh ->prepare($sql);
  $data = array();
  $data[] = $lastcode;
  $data[] = $cart[$i];
  $data[] = $kakaku[$i];
  $data[] = $number[$i];
  $stmt ->execute($data);
}

$sql = 'UNLOCK TABLES';
$stmt = $dbh ->prepare($sql);
$stmt ->execute();

$dbh = null;

if($chumon=='chumontouroku')
{
  print '会員登録が完了致しました。<br/>';
  print '次回からメールアドレスとパスワードでログインください。<br/>';
  print 'ご注文が簡単に出来る様になります。<br/>';
  print '<br/>';
}

$statement.= "送料は無料です。\n";
$statement.= "---------\n";
$statement.= "\n";
$statement.= "代金は以下の口座にお振込ください。\n";
$statement.= "ろくまる銀行やさい支店　普通口座 1234\n";
$statement.= "入金確認が取れ次第、梱包、発送させていただきます。\n";
$statement.= "\n";

if($chumon=='chumontouroku')
{
  $statement.= "会員登録が完了致しました。\n";
  $statement.= "次回からメールアドレスとパスワードでログインください。\n";
  $statement.= "ご注文が簡単に出来る様になります。\n";
  $statement.= "\n";
}

$statement.= "□□□□□□□□□□\n";
$statement.= "〜安心野菜のろくまる農園〜\n";
$statement.= "\n";
$statement.= "◯◯県六丸郡123-4\n";
$statement.= "電話 080-6248-8670\n";
$statement.= "メール info@rokumae.co.jp\n";
$statement.= "□□□□□□□□□□\n";
print '<br/>';
print nl2br($statement);

$title = 'ご注文ありがとうございます。';
$header = 'Form: info@rokumarunouen.co.jp';
$statement = html_entity_decode($statement, ENT_QUOTES, 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail($email, $title, $statement, $header);

$title = 'お客様からご注文がありました。';
$header = 'Form: $email';
$statement = html_entity_decode($statement, ENT_QUOTES, 'UTF-8');
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_send_mail('info@rokumarunouen.co.jp', $title, $statement, $header);

}
catch(Exception $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

  ?>

  <br/>
  <a href="shop_list.php">商品画面へ</a>

  </body>
</html>
