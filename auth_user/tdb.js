function voter(sondage,reponse,votant)
{
  $.ajax({
        method: "POST",
        dataType: "text",
        url: "ajax.php",
        data: {"id": sondage , "numero" : reponse , "votant" : votant}
      }).done(function(e) {
        window.location.reload(false);
        console.log(e);
      }).fail(function(e) {
        alert("Problème avec le vote");
      });
}

function clore(sondage,createur,fermer)
{
  $.ajax({
        method: "POST",
        dataType: "text",
        url: "ajax.php",
        data: {"id": sondage , "createur" : createur , "fermer" : fermer}
      }).done(function(e) {
        window.location.reload(false);
        console.log(e);
      }).fail(function(e) {
        alert("Problème avec la cloture");
      });
}
