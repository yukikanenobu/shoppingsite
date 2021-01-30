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

$staff_code=$_GET['staffcode'];

$dsn = 'mysql:dbname=shop;host =localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh -> query('SET NAMES utf8');

$sql = 'SELECT name FROM mst_staff WHERE code=?';
$stmt = $dbh ->prepare($sql);
$data[]=$staff_code;
$stmt ->execute($data);

$rec = $stmt ->fetch(PDO::FETCH_ASSOC);
$staff_name = $rec['name'];

$dbh = null;

}
catch(Exception $e)
{
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

?>

スタッフ修正<br/>
<br/>
スタッフコード<br/>
<?php print $staff_code; ?>
<br/>
<br/>
<form method= "post" action = "staff_edit_check.php">
<input type="hidden" name= "code" value ="<?php print $staff_code;?>">
スタッフ名<br/>
<input type = "text" name="name" style="width:200px" value="<?php print $staff_name;?>"<br/>
パスワードを入力してください。<br/>
<input type="password" name="pass" style="width:100px"><br/>
パスワードをもう一度入力してください。<br/>
<input type="password" name="pass2" style="width:100px"><br/>
<br/>
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

  </body>
</html>
