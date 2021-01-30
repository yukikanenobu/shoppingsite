<?php
$_SESSION = array();
if(isset($_COOKIE[session_name()])==true)
{
  setcookie(session_name(), '', time()-4200, '/');
}
@session_destroy();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

   カートを空にしました。<br/>
    
  </body>
</html>
