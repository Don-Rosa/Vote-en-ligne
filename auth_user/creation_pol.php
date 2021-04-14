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
    $newJsonString = file_get_contents('pol.json');
    $data = json_decode($newJsonString);

    $question = htmlspecialchars($_GET["question"]);
    $info = isset($_GET["info"]);
    $miage = isset($_GET["miage"]);

    $pol = array("id" => uniqid(rand(),true),"createur" => $_SERVER['REMOTE_USER'],"clos" => false,"vote" => [],"question" => $question,"info" => $info,"miage" => $miage);
    $i = 0;
    while (isset($_GET["reponse$i"]))
    {
      $pol["reponse$i"] = $_GET["reponse$i"];
      $pol["nb_reponse$i"] = 0;
      $i++;
    }

    array_push($data,$pol);
    $newJsonString = json_encode($data,JSON_PRETTY_PRINT);
    file_put_contents('pol.json', $newJsonString);
    ?>
    Merci d'avoir crée le sondage
    <a href="tdb.php"> Retour à la maison</a>

  </body>
</html>
