<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../Style.css">
  <title>Tableau de bord</title>
</head>
  <body>
    <?php
    $newJsonStringInfo = file_get_contents("INFO.json");
    $newJsonStringMiage = file_get_contents("MIAGE.json");
    $infoJson = json_decode($newJsonStringInfo);  #Va chercher des information sur l'utilisateur connecté
    $miageJson = json_decode($newJsonStringMiage);

    $findByMail = function($mail) use ($infoJson,$miageJson) { #Va chercher des information sur un utilisateur
      foreach ($infoJson as $user)
      {
        if ($user->email == $mail) return [$user->firstname, $user->lastname, $user->email,'INFO'];
      }
      foreach ($miageJson as $user)
      {
        if ($user->email == $mail) return [$user->firstname, $user->lastname, $user->email,'MIAGE'];
      }
    return false;};

    $rem_user = $findByMail($_SERVER['REMOTE_USER']); # Ici sur l'utilisateur connecté
                  # [0] == firstname ,[1] == lastname ,[2] == email ,[3] == INFO/MIAGE ,
    echo "<h3>Bienvenue " .$rem_user[0]. " " .$rem_user[1]. " </h3>";
    echo "<h3>Vos sondages: </h3>";

    $newJsonStringPOL = file_get_contents("POL.json");
    $polJson = json_decode($newJsonStringPOL);
    foreach ($polJson as $pol)
    {
      if ($pol->createur == $rem_user[2]) echo '<pre>'; print_r($pol); echo '</pre>';
    }
    ?>
  </body>
</html>
