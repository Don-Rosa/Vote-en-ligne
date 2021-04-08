<?php

$email = $_GET['AUTH_USER'];
$pwd = $_GET['AUTH_PW'];

if($pwd == '' || $email == '')
{
  echo "False";
}
else
{
  $file = fopen('auth_user/.htpasswd', 'r+');
  $exist = false;
  while (!$exist && ($buffer = fgets($file)) !== false)
  {
      $passwd_line = explode(":" , $buffer);
      $exist = $passwd_line[0] == $email;
  }
  if ($exist)
  {
    echo "Existe";
  }
  else
  {
    fwrite($file, "$email:$pwd\n");
  }
  
  fclose($file);
}
?>
