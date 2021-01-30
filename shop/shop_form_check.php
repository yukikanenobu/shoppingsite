<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php

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
$pass2 = $post['pass2'];
$danjyo = $post['danjyo'];
$birth = $post['birth'];

$okflg = true;

if($name=='')
{
  print 'お名前が入力されていません。<br/><br/>';
  $okflg = false;
}
else
{
  print 'お名前<br/>';
  print $name;
  print '<br/><br/>';
}

if(preg_match('/^[\w\\.]+\@[\w\\.]+\.([a-z]+)$/',$email)==0)
{
  print 'メールアドレスを正確に入力してください。<br/><br/>';
  $okflg = false;
}
else
{
  print 'メールアドレス<br/>';
  print $email;
  print '<br/><br/>';
}

if(preg_match('/^[0-9]+$/', $postal1)==0)
{
  print '郵便番号は半角数字で入力してください。<br/><br/>';
  $okflg = false;
}
else
{
  print '郵便番号<br/>';
  print $postal1;
  print '-';
  print $postal2;
  print '<br/><br/>';
}

if(preg_match('/^[0-9]+$/',$postal2)==0)
{
  print '郵便番号は半角数字で入力してください。<br/><br/>';
  $okflg = false;
}

if($address=='')
{
  print '住所が入力されていません。<br/><br/>';
  $okflg = false;
}
else
{
  print '住所<br/>';
  print $address;
  print '<br/><br/>';
}

if(preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/',$tel)==0)
{
  print '電話番号を正確に入力してください。<br/><br/>';
  $okflg = false;
}
else
{
  print '電話番号<br/>';
  print $tel;
  print '<br/><br/>';
}

if($chumon=='chumontouroku')
{
  if($pass=='')
  {
    print 'パスワードが入力されていません。<br/><br/>';
    $okflg = false;
  }

  if($pass!=$pass2)
  {
    print 'パスワードが一致しません。<br/><br/>';
    $okflg = false;
  }

  print '性別<br/>';
  if($danjyo=='dan')
  {
    print '男性';
  }
  else
  {
    print '女性';
  }
  print '<br/><br/>';

  print '生まれた年<br/>';
  print $birth;
  print '年代';
  print '<br/><br/>';

}

if($okflg==true)
{
print '<form method="post" action="shop_form_done.php">';
print '<input type="hidden" name="name" value="'.$name.'">';
print '<input type="hidden" name="email" value="'.$email.'">';
print '<input type="hidden" name="postal1" value="'.$postal1.'">';
print '<input type="hidden" name="postal2" value="'.$postal2.'">';
print '<input type="hidden" name="address" value="'.$address.'">';
print '<input type="hidden" name="tel" value="'.$tel.'">';
print '<input type="hidden" name="chumon" value="'.$chumon.'">';
print '<input type="hidden" name="pass" value="'.$pass.'">';
print '<input type="hidden" name="danjyo" value="'.$danjyo.'">';
print '<input type="hidden" name="birth" value="'.$birth.'">';
print '<input type="button" onclick="history.back()" value="back">';
print '<input type="submit" value="OK"><br/>';
print '</form>';
}
else
{
  print '<form>';
  print '<input type="button" onclick="history.back()" value="back">';
  print '</form>';
}
    ?>
  </body>
</html>
