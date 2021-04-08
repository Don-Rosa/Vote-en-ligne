function signup(email,pwd,pwdc){
  if(pwd != pwdc)
  {
      $('#result').text("Les deux mots de passe ne correspondent pas !");
  }
  else {
    $.ajax({
    method: "GET",
    url: "sign.php",
    data: {"AUTH_USER": email ,
                "AUTH_PW" : pwd },
    }).done(function(e) {
        if(e === "False"){
          $('#result').text("Mauvais email ou mot de passe !");
          }
        else if(e === "Existe"){
          $('#result').text("Le compte existe déja !");
        }
        else if(e === "Inconnu"){
          $('#result').text("L'email n'est pas dans la whitelist !");
        }
        else{
          $('#result').text("Compte Creé");
          redir();
        }
    }).fail(function(e) {
    console.log(e);
    });
  }
}

function redir(){
document.querySelector('#nameEM')
    .addEventListener('click',()=> {
        window.location.href = 'index.html';
    });
}



const search = document.getElementById('search');
const matchList = document.getElementById('match-list');

// search json and filter it
const searchUsername = async searchText => {
    const res = await fetch('INFO.json');
    const emails = await res.json();

    //console.log(email);

    //Get matches to current text input
    let matches = emails.filter(email => {
        const regex = new RegExp(`^${searchText}`,'gi');
        return email.email.match(regex);
    });

    if (searchText.length === 0){
        matches = [];
        matchList.innerHTML = '';
    }else{
        matchList.innerHTML = 'Email introuvable !';
    }

    outputHtml(matches);
};

const outputHtml = matches => {
    if(matches.length > 0){
        const html = matches.map(match => `
            <div class="card card-body mb-1">
                <h4>${match.email}</h4>
            </div>
        `).join('');

        matchList.innerHTML = html;
    }

};

email.addEventListener('input', () => searchUsername(email.value));
