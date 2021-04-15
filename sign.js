function signup(){
  let email = $('#email').val();
  let pwd = $('#pwd').val();
  let pwdC = $('#pwdC').val();
  if(pwd != pwdC)
  {
      $('#result').text("Les deux mots de passe ne correspondent pas !");
  }
  else
  {
    $.ajax({
    method: "GET",
    url: "sign.php",
    data: {"AUTH_USER": email ,
                "AUTH_PW" : pwd },
    }).done(function(e) {
        if(e === "False"){
          $('#result').text("Email ou mot de passe incorrect !");
          }
        else if(e === "Existe"){
          $('#result').text("Le compte existe déjà !");
        }
        else if(e === "Inconnu"){
          $('#result').text("L'e-mail n'est pas dans la whitelist !");
        }
        else{
          $('#result').text("Compte Creé");
        }
    }).fail(function(e) {
    console.log(e);
    });
  }
}
