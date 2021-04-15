<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Sondage crée</title>
  <link rel="stylesheet" type="text/css" href="creer.css">
</head>
  <body>
    <img src="Saclay-.png" class="saclay-">
    <?php
    $newJsonString = file_get_contents('POL.json');
    $data = json_decode($newJsonString);

    $question = htmlspecialchars($_GET["question"]);
    $info = isset($_GET["info"]);
    $miage = isset($_GET["miage"]);

    $pol = array("id" => uniqid(rand(),true),"createur" => $_SERVER['REMOTE_USER'],"clos" => false,"question" => $question,"info" => $info,"miage" => $miage);
    $i = 0;
    $reponses = array();
    while (isset($_GET["reponse$i"])) //Stocke un nombre variable de réponses
    {
      $reponses[] =  [$_GET["reponse$i"],0];
      $i++;
    }
    $pol["reponses"] = $reponses;

    $votes_restants = array();
    if($info)
    {
      $infoJsonString = file_get_contents('../INFO.json');
      $data_info = json_decode($infoJsonString);
      foreach ($data_info as $inf)
      {
        $votes_restants[$inf->email] = (int)$_GET[str_replace('.','_',$inf->email)]  + 1;
      }
    }
    if($miage)
    {
      $miageJsonString = file_get_contents('../MIAGE.json');
      $data_miage = json_decode($miageJsonString);
      foreach ($data_miage as $mia)
      {
        $votes_restants[$mia->email] = (int)$_GET[str_replace('.','_',$mia->email)] + 1;
      }
    }
    $pol["votes_restants"] = $votes_restants;

    array_push($data,$pol);
    $newJsonString = json_encode($data,JSON_PRETTY_PRINT);
    file_put_contents('POL.json', $newJsonString);
    ?>
    Merci d'avoir crée le sondage
    <a href="tdb.php"> Retour à la maison</a>

  </body>
</html>
