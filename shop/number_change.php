<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$post = sanitize($_POST);

$max = $post['max'];
for($i=0; $i<$max; $i++)
{
  if(preg_match("/^[0-9]+$/",$post['number'.$i])==0)
  {
    print '数量に誤りがあります。';
    print '<a href="shop_cartlook.php">カートに戻る</a>';
    exit();
  }
  if($post['number'.$i]<1 || 10<$post['number'.$i])
  {
    print '数量は必ず1個以上、10個までです。';
    print '<a href=shop_cartlook.php">カートに戻る<a/>';
    exit();
  }
  $number[] = $post['number.$i'];
}

$cart = $_SESSION['cart'];

for($i=$max; 0<=$i; $i--)
{
  if(isset($_POST['delete'.$i])==true)
  {
        array_splice($cart, $i, 1);
        array_splice($number, $i, 1);
      }
    }

$_SESSION['cart']=$cart;
$_SESSION['number']=$number;

header('Location:shop_cartlook.php');
?>
