<?php
//Receptions des appels ajax

if (isset($_POST['id']) && isset($_POST['numero']) && isset($_POST['votant'])) //ici on vote à un sondage
{
  $newJsonStringPOL = file_get_contents("POL.json");
  $polJson = json_decode($newJsonStringPOL,true);
  $out = "Sondage pas trouvé";
  foreach ($polJson as $key => $pol)
  {
    if($pol['id'] == $_POST['id'])
    {
      if($pol['votes_restants'][$_POST['votant']] == 0 )
      {
          $out = "Erreur, déja voté";
      }
      else
      {
        $polJson[$key]["reponses"][$_POST['numero']][1]++;
        $polJson[$key]["votes_restants"][$_POST['votant']]--;//Pour une chercher plus simple, je fais un tableau associatif
        $out = "A VOTÉ!";
      }
    }
  }
  $newPolJson = json_encode($polJson,JSON_PRETTY_PRINT);
  file_put_contents('POL.json', $newPolJson);
  print($out);
}
elseif(isset($_POST['id']) && isset($_POST['createur']) && isset($_POST['fermer']) ) //ici on vote à un sondage
{
  $newJsonStringPOL = file_get_contents("POL.json");
  $polJson = json_decode($newJsonStringPOL,true);
  $out = "Sondage pas trouvé";
  $fermer = filter_var ($_POST['fermer'], FILTER_VALIDATE_BOOLEAN);
  foreach ($polJson as $key => $pol)
  {
    if($pol['id'] == $_POST['id'])
    {
      if($pol['createur'] === $_POST['createur'])
      {
        $polJson[$key]["clos"] = $fermer;
        $out = $fermer ? "FIN DES VOTES!" : "REPRISE DES VOTES!";
      }
      else
      {
        $out = "Erreur, ce n'est pas votre sondage";
      }
    }
  }
  $newPolJson = json_encode($polJson,JSON_PRETTY_PRINT);
  file_put_contents('POL.json', $newPolJson);
  print($out);
}
elseif (isset($_POST['jname']))
{
  $JsonVotant = file_get_contents($_POST['jname']);
  print($JsonVotant);
}
 ?>
