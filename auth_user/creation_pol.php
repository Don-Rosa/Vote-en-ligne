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
      $reponses[] =  [htmlspecialchars($_GET["reponse$i"]),0];
      $i++;
    }
    $pol["reponses"] = $reponses;
    $votes_restants = array();
    $votes_max = 0;
    if($info)
    {
      $infoJsonString = file_get_contents('../INFO.json');
      $data_info = json_decode($infoJsonString);
      foreach ($data_info as $inf)
      { // str replace car le méthode php get a remplacé les . par _
        $nb_votes = (int)htmlspecialchars($_GET[str_replace('.','_',$inf->email)]);
        $votes_max += $nb_votes;
        $votes_restants[$inf->email] = $nb_votes;
      }
    }
    if($miage)
    {
      $miageJsonString = file_get_contents('../MIAGE.json');
      $data_miage = json_decode($miageJsonString);
      foreach ($data_miage as $mia)
      {
        $nb_votes = (int)htmlspecialchars($_GET[str_replace('.','_',$mia->email)]);
        $votes_max += $nb_votes;
        $votes_restants[$mia->email] = $nb_votes;
      }
    }
    $pol["votes_restants"] = $votes_restants;
    $pol["votes_recu"] = 0; //Pas de ç dans le doute à cause de l'encodeage
    $pol["votes_attendus"] = $votes_max;
    // Les deux dernières lignes n'ajoute pas d'information mais permettent de ne pas avoir à traverser tout
    //  $pol["reponses"] et de faire la somme à chaque fois que la page ce met à jour
    array_push($data,$pol);
    $newJsonString = json_encode($data,JSON_PRETTY_PRINT);
    file_put_contents('POL.json', $newJsonString);
    ?>
    Merci d'avoir crée le sondage
    <a href="tdb.php"> Retour à la maison</a>

  </body>
</html>
