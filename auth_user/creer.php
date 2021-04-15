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
    <img src="Saclay-.png" class="saclay-">
    <a href="tdb.php"> Retour à la maison</a>
    <form method="GET" onsubmit="return IsFormValid(event)" action="creation_pol.php">
      <p id="invalid_form"></p>
      <div>La question à poser est:<br/><input type="text" name="question" class="f_texte"><br/></div>
      <div> Réponse 0: <br/> <input type="text" name="reponse0" class="f_texte"><br/></div>
      <div> Réponse 1: <br/> <input type="text" name="reponse1" class="f_texte"><br/></div>
      <div id="plusplus"></div>
      <input type="button" value="+" onclick="plus_rep()"/> <input id="bouton_moins" class ="hidden" type="button" value="-" onclick="moins_rep()"/><br/>

      Groupes concernés:<br>
      <label for="info">Groupe Info</label>
      <input type="checkbox" id="info" name="info"> <br>
      <label for="miage">Groupe Miage</label>
      <input type="checkbox" id="miage" name="miage"> <br/>
      <input type="submit" value="Valider"><br/>
      <div id="votants_info"></div>
      <div id="votants_miage"></div>
    </form>
  </body>
</html>
