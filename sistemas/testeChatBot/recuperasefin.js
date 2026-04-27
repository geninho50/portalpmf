
function changeStatus(status) {
                switch (status) {
                    case "0":
                        document.getElementById("email").style = "display: block";
                        document.getElementById("verificaCodigo").style = "display: none";
                        document.getElementById("novaSenha").style = "display: none";
                        break;
                    case "1":
                        document.getElementById("email").style = "display: none";
                        document.getElementById("verificaCodigo").style = "display: block";
                        document.getElementById("novaSenha").style = "display: none";
                        break;
                    case "2":
                        document.getElementById("email").style = "display: none";
                        document.getElementById("verificaCodigo").style = "display: none";
                        document.getElementById("novaSenha").style = "display: block";
                        break;
                    default:
     					document.getElementById("email").style = "display: block";
                        document.getElementById("verificaCodigo").style = "display: none";
                        document.getElementById("novaSenha").style = "display: none";
                        break;
                }
}

var codigo =  Math.random().toString(36).slice(8); 
var email = "testmcface@teste.com";
var emailrecuperacao = document.getElementById("emailrecuperacao");

function geraCodigo(){

        document.getElementById("codigoDebug").innerText = codigo;
}

function pegaEmail(){

    var tamanhoCensura, splitted, parte1email, parte2email, censura;
    censura="";
    splitted = email.split("@");
    parte1email = splitted[0];
    tamanhoCensura = parte1email.length / 2;
    parte1email = parte1email.substring(0, (parte1email.length - tamanhoCensura));
    parte2email = splitted[1];

    for(var i =0;i<tamanhoCensura; i++){
        censura +="*";
    }

    email = parte1email +censura+"@" + parte2email;
    emailrecuperacao.innerText = email;
}

function validaCodigo(){
    var codigoVerificacao = document.getElementById("codigoVerificacao").value;
    if(codigoVerificacao!=codigo){
        alert("Código Inválido!");
    }else{
        changeStatus('2');
    }
}

function scorePassword(pass) {
        var score = 0;
        if (!pass)
        return score;

        // award every unique letter until 5 repetitions
         var letters = new Object();
        for (var i=0; i<pass.length; i++) {
            letters[pass[i]] = (letters[pass[i]] || 0) + 1;
            score += 5.0 / letters[pass[i]];
        }

        // bonus points for mixing it up
        var variations = {
            digits: /\d/.test(pass),
            lower: /[a-z]/.test(pass),
            upper: /[A-Z]/.test(pass),
            nonWords: /\W/.test(pass),
        }

        variationCount = 0;
        for (var check in variations) {
            variationCount += (variations[check] == true) ? 1 : 0;
        }
        score += (variationCount - 1) * 12;

        return parseInt(score);
}

    var pass = document.getElementById("senha");
    var passConfirmacao = document.getElementById("confirma-senha");
    var forca = document.getElementById("forca");

function checkForcaSenha() {
        var score = scorePassword(pass.value);
        forca.innerText = "(para debug) Força senha: " + score;
        var barra = document.getElementById("barra");

        if(score<=100){
            barra.style.width = score +"%";
        }else if(score>100){
            barra.style.width = "100%";
        }

        if(score <25){
            barra.style.background = "red";
        }else if(score>=25 && score <50){
            barra.style.background= "yellow";
        }else if(score>=50 && score < 70){
            barra.style.background = "#c6ff1a";
        }else if(score>=70){
            barra.style.background = "#66ff66";
        }

        if(pass.value.length >=6){
            document.getElementById("tamanho").style.textDecoration = "line-through";
        }else{
            document.getElementById("tamanho").style.textDecoration= "none";
        }

        var reg1 = new RegExp(/^(?=.*[A-Z])/);
        if(reg1.test(pass.value)){
            document.getElementById("maius").style.textDecoration = "line-through";
        }else{
            document.getElementById("maius").style.textDecoration = "none";
        }

        var reg2 = new RegExp(/^(?=.*\d)/);
        if(reg2.test(pass.value)){
            document.getElementById("numero").style.textDecoration = "line-through";
        }else{
            document.getElementById("numero").style.textDecoration = "none";
        }

}


function validaSenha(){
            if(pass.value==passConfirmacao.value){
                var term = pass.value;
                var re = new RegExp(/^(?=.*\d)(?=.*[A-Z])[0-9a-zA-Z!@#\$%\^\&*\)\(+=._-]{6,}$/);
                if (re.test(term)) {
                    forca.innerText = "senha válida!"
                } else {
                    forca.innerText = "SENHA INVALIDA"
                }
            }else{
                 forca.innerText = "SENHAS NÃO DERAM MATCH";
            }
    }