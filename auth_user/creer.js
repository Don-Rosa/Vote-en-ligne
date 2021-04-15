let i = 2

function plus_rep()
{
  $( "#plusplus" ).append(`<div id="reponse${i}"> Réponse ${i}: <br/> <input type="text" name="reponse${i}" class="f_texte"><br/></div>`);
  if(i==2) {  $(`#bouton_moins`).show(); }
  i++;
}

function moins_rep()
{
  i--;
  if(i==2) {  $(`#bouton_moins`).hide(); }
  $(`#reponse${i}`).empty().remove();
}

function IsFormValid(event)
{
  let valid = true;
  $(".f_texte").each(function(index,element)
  {
    if(!$( element ).val()) //Si la zone de texte est Valider
    {
      if(index === 0)
      {
        $("#invalid_form").html("Erreur dans le formulaire, il faut une question");
      }
      else
      {
        let question = index -1;
        $("#invalid_form").html(`Erreur dans le formulaire, la réponse ${question} est vide. Remplissez ou supprimez la.`);
      }
      valid = false;
      return false;
    }
  })
  return valid;
}

function procu(checked,jname,cible)
{
  if(!checked)
  {
    cible.html('');
  }
  else
  {
    $.ajax({
          method: "POST",
          dataType: "json",
          url: "ajax.php",
          data: {"jname": jname}
        }).done(function(e) {
            cible.html(
              e.map(votant => `
                <div> ${votant.firstname}   ${votant.lastname}  ${votant.email} Nombres de voix:
                <input type= "radio" name="${votant.email}" value="0"> 0
                <input type= "radio" name="${votant.email}" value="1" checked="checked"> 1
                <input type= "radio" name="${votant.email}" value="2"> 2
                <input type= "radio" name="${votant.email}" value="3"> 3
                </div>
                `).join('')
              )
        }).fail(function(e) {
          alert("Problème avec la requête");
        });
  }
}

$(document).ready(function() {
  $("#info").click(function(){
  procu($("#info").is(':checked'),"../INFO.json",$("#votants_info"))
  });
  $("#miage").click(function(){
  procu($("#miage").is(':checked'),"../MIAGE.json",$("#votants_miage"))
  });
});
