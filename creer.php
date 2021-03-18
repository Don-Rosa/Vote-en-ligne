<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="test.js"></script>
  <title>Creer un vote</title>
</head>
  <body>
    <form method="GET" action="creation_pol.php">
      <label for="question">La question à poser est:</label><br/>
      <input type="text" id="question" name="question" class="g_texte"><br/>
      <label for="reponse0">Réponse 0:</label><br/>
      <input type="text" id="reponse0" name="reponse0" class="g_texte"><br/>
      <label for="reponse2">Réponse 1:</label><br/>
      <input type="text" id="reponse1" name="reponse1" class="g_texte"><br/>

      <?php
      function ajoute($nb_reponses)
      {
        for ($i =2; $i < $nb_reponses; $i++)
        {
          echo '<label for="reponse'.$i.'">Réponse '.$i.':</label><br/>';
          echo '<input type="text" id="reponse'.$i.'" name="reponse'.$i.'" class="g_texte"><br/>';
        }
      }
      $nb_reponses = 2;
      print_r($_POST);
      if(isset($_POST['action']))
      {
        $nb_reponses = $_POST['action'];
        ajoute($nb_reponses);
      }
      echo "<input type='button' value='+' onclick='ajoute_rep($nb_reponses)'/><br/>";
      ?>
      Groupe concernés:
      <label for="info">Groupe Info</label>
      <input type="checkbox" id="info" name="info">
      <label for="miage">Groupe Miage</label>
      <input type="checkbox" id="miage" name="miage"> <br/>
      <input type="submit" value="Valider">

    </form>
  </body>
</html>
