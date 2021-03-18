function ajoute_rep(i)
{
  $.ajax({
     type: "POST",
     url: "creer.php",
     dataType: "text",
     data: { action: i+1}
   }).done(function(e) {
        console.log(e);
   }).fail(function(e) {
        console.log("ALEDEDEDEEDEDED");
        console.log(e);
      });
}
