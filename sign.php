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
    $newJsonStringInfo = file_get_contents("INFO.json");
    $newJsonStringMiage = file_get_contents("MIAGE.json");
    $infoJson = json_decode($newJsonStringInfo);
    $miageJson = json_decode($newJsonStringMiage);

    $whiteListed = False;
    foreach ($infoJson as $known)
    {
      if ($known->email == $email) $whiteListed = True;
    }
    foreach ($miageJson as $known)
    {
      if ($known->email == $email) $whiteListed = True;
    }


    if($whiteListed === False)
    {
      echo "Inconnu";
    }
    else
    {
      fwrite($file, "$email:$pwd\n");
    }
  }
  fclose($file);
}
?>
