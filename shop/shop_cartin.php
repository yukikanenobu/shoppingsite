<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
  print 'ようこそゲスト様';
  print '<a href ="member_login.html">会員ログイン</a><br/>';
  print '<br/>';
}
else
{
  print 'ようこそ';
  print $_SESSION['member_name'];
  print '様';
  print '<a href = "member_logout.php">ログアウト</a><br/>';
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

$pro_code=$_GET['procode'];

if(isset($_SESSION['cart'])==true)
{
$cart = $_SESSION['cart'];
$number = $_SESSION['number'];
if(in_array($pro_code, $cart)==true)
{
  print 'その商品はすでにカートに入っています。<br/>';
  print '<a href ="shop_list.php">商品一覧に戻る</a>';
  exit();
}
}
$cart[]=$pro_code;
$number[] = 1;
$_SESSION['cart']=$cart;
$_SESSION['number']=$number;

}
catch(Exception $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>

カートに追加しました。<br/>
<br/>
<a href="shop_list.php">商品一覧に戻る</a>

  </body>
</html>
