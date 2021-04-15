<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="creer.css">
  <script type="text/javascript" src="tdb.js"></script>
  <title>Tableau de bord</title>
</head>
  <body>
    <a href="creer.php">Creer un sondage?</a>
   <img src="Saclay-.png" class="saclay-">
    <?php
    $newJsonStringInfo = file_get_contents("../INFO.json");
    $newJsonStringMiage = file_get_contents("../MIAGE.json");
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
    echo "<h3>Bienvenue " .$rem_user[0]. " " .$rem_user[1].  " </h3>";

    $newJsonStringPOL = file_get_contents("POL.json");
    $polJson = json_decode($newJsonStringPOL,true);

    $sondages = array();
    $sondages_clos = array();
    $votes = array();
    $votes_clos = array();

    foreach ($polJson as $pol) //Trie et récupère les sondages qui nous correspondent
    {
      if ($pol['createur'] == $rem_user[2] && !$pol['clos']) //Vos sondages en cours
      {
        $sondages[] = $pol;
      }
      elseif ($pol['createur'] == $rem_user[2]) // Vos sondages passés
      {
        $sondages_clos[] = $pol;
      }
      elseif (($rem_user[3] === "INFO" && $pol['info'] || $rem_user[3] === "MIAGE" && $pol['miage']) && !$pol['clos']) // Vos votes possibles
      {
        $votes[] = $pol;
      }
      elseif ($rem_user[3] === "INFO" && $pol['info'] || $rem_user[3] === "MIAGE" && $pol['miage']) // Vos votes passés
      {
        $votes_clos[] = $pol;
      }
    }

    echo "<h4>Vos sondages en cours : </h4>";
    foreach ($sondages as $pol)
    {
      echo "<div>" .$pol['question']. "";
      echo '<input type=button onclick=clore("'.$pol['id'].'","'.$rem_user[2].'",true) value=Clore>';
      echo "<input type='button' value='Détails'>";
      $i = 0;
      foreach ($pol['reponses'] as $rep)
      {
        echo"<br /><span>--".$rep[0]."-- Votes pour ce choix : ".$rep[1]."</span>";
        $i++;
      }
      echo "</div>";
    }
    echo "<h4>Vos sondages passés : </h4>";
    foreach ($sondages_clos as $pol)
    {
      echo "<div>" .$pol['question']. "";
      echo '<input type=button onclick=clore("'.$pol['id'].'","'.$rem_user[2].'",false) value=Rouvrire>';
      echo "<input type='button' value='Détails'>";
      $i = 0;
      foreach ($pol['reponses'] as $rep)
      {
        echo"<br /><span>--".$rep[0]."-- Votes pour ce choix : ".$rep[1]."</span>";
        $i++;
      }
      echo "</div>";
    }
    echo "<h4>Les votes vous concernant : </h4>";
    foreach ($votes as $pol)
    {
      echo "<div>" .$pol['question']. "";
      echo "<input type='button' value='Détails'>";
      $i = 0;
      foreach ($pol['reponses'] as $rep)
      {
        echo "<br /><span>--".$rep[0]."-- Votes pour ce choix : ".$rep[1]."</span>";
        echo '<input type=button onclick=voter("'.$pol['id'].'","'.$i.'","'.$rem_user[2].'") value=Voter>';
        $i++;
      }
      echo "</div>";
    }
    echo "<h4>Les votes passés vous concernant : </h4>";
    foreach ($votes_clos as $pol)
    {
      echo "<div>" .$pol['question']. "";
      echo "<input type='button' value='Détails'>";
      $i = 0;
      foreach ($pol['reponses'] as $rep)
      {
        echo"<br /><span>--".$rep[0]."-- Votes pour ce choix : ".$rep[1]."</span>";
        $i++;
      }
      echo "</div>";
    }
    ?>
  </body>
</html>
