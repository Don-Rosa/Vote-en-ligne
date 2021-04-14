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
