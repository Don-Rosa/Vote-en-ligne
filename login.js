function signup(email,pwd){
    $.ajax({
    method: "GET",
    url: "sign.php",
    data: {"AUTH_USER": email ,
                "AUTH_PW" : pwd },
    }).done(function(e) {
        $('span').remove();
        if(e !== "False"){
        $ladiv =  "<span> Compte Creé </span> <br><br>";
        redir();
        }else{
        $ladiv =  "<span id='wrong'> Compte Existe Déja </span>"
        }
        $('#nameEM').append($ladiv);
    }).fail(function(e) {
    console.log(e);
    });
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
        matchList.innerHTML = 'Unfound Username, Pleas Try again !';
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


