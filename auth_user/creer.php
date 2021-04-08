<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="creer.js"></script>
  <link rel="stylesheet" href="creer.css">
  <title>Creer un vote</title>
</head>
  <body>
    <?php echo $_SERVER['REMOTE_USER'] ?>
    <form method="GET" action="creation_pol.php">
      <div>La question à poser est:<br/><input type="text" name="question" class="g_texte"><br/></div>
      <div> Réponse 0: <br/> <input type="text" name="reponse0" class="g_texte"><br/></div>
      <div> Réponse 1: <br/> <input type="text" name="reponse1" class="g_texte"><br/></div>
      <div id="plusplus"></div>
      <input type="button" value="+" onclick="plus_rep()"/> <input id="bouton_moins" class ="hidden" type="button" value="-" onclick="moins_rep()"/><br/>

      Groupe concernés:
      <label for="info">Groupe Info</label>
      <input type="checkbox" id="info" name="info">
      <label for="miage">Groupe Miage</label>
      <input type="checkbox" id="miage" name="miage"> <br/>
      <input type="submit" value="Valider">

    </form>
  </body>
</html>
