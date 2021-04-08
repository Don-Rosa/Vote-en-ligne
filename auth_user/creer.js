let i = 2

function plus_rep()
{
  $( "#plusplus" ).append(`<div id="reponse${i}"> Réponse ${i}: <br/> <input type="text" name="reponse${i}" class="g_texte"><br/></div>`);
  if(i==2) {  $(`#bouton_moins`).show(); }
  i++;
}

function moins_rep()
{
  i--;
  if(i==2) {  $(`#bouton_moins`).hide(); }
  $(`#reponse${i}`).empty().remove();
}
