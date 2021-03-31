function signup(email,pwd){
    $.ajax({
    method: "GET",
    url: "sign.php",
    data: {"AUTH_USER": email ,
                "AUTH_PW" : pwd },
    }).done(function(e) {
        $('span').remove();
        if(e !== "False"){
        $ladiv =  "<span> account created </span> <br><br>";
        countDown();
        }else{
        $ladiv =  "<span id='wrong'> Please choose a Correct Email/password </span>"
        }
        $('#nameEM').append($ladiv);
    }).fail(function(e) {
    console.log(e);
    });
}

var count = 6;

var redirect = "Index.html";


function countDown(){
    var timer = document.getElementById("timer");
        if(count > 0 ){
            count--;
            timer.innerHTML = "This page will redirect in "+count+" seconds.";
            setTimeout("countDown()", 1000);
        }else{
        window.location.href = redirect;
    }
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


