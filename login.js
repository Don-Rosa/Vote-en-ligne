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
          $('#result').text("Le compte existe déja !");
        }
        else if(e === "Inconnu"){
          $('#result').text("L'email n'est pas dans la whitelist !");
        }
        else{
          $('#result').text("Compte Creé");
        }
    }).fail(function(e) {
    console.log(e);
    });
  }
}

// search json and filter it
async function searchUsername(searchText)
{
    const res = await fetch('auth_user/INFO.json');
    const emails = await res.json();

    //Get matches to current text input
    let matches = emails.filter(email => {
        const regex = new RegExp(`^${searchText}`,'gi');
        return email.email.match(regex);
    });
    if (searchText.length === 0){
        matches = [];
        $('#match-list').html('');
    }else{
        $('#match-list').html('Email introuvable !');
    }
    outputHtml(matches);
};

function outputHtml(matches)
{
    if(matches.length > 0){
        const html = matches.map(match => `
            <div class="card card-body mb-1">
                <h4>${match.email}</h4>
            </div>
        `).join('');
        $('#match-list').html(html);
    }
};
