// Função para validar NOME

document.getElementById("nomeCadastro").addEventListener("blur", function() {
    var nome = this.value;
    if (validaNome(nome)) {

    } else {
        alert("Nome inválido! Por favor, insira um nome válido.");
        $('#nomeCadastro').val("");
    }
});

function validaNome(nome) {
    // Verifica se o nome possui pelo menos um espaço em branco, indicando que é composto
    if (nome.indexOf(' ') === -1) {
        return false; // Se não há espaço, não é um nome composto
    }

    // Verifica se o nome contém números ou caracteres especiais
    var re = /^[a-zA-ZÀ-ÿ\s]+$/;
    return re.test(nome);
}

// Função para validar TELEFONE 

document.getElementById("telefoneCadastro").addEventListener("blur", function() {
    var telefone = this.value;
    if (validaTelefone(telefone)) {
        
    } else {
        alert("Telefone inválido!");
        $('#telefoneCadastro').val("");
    }
});

function validaTelefone(telefone) {
    // Expressão regular para validar telefone no formato 48991439220
    var re = /^\d{11}$/;
    return re.test(telefone);
}


// Função para validar EMAIL

document.getElementById("emailCadastro").addEventListener("blur", function() {
    var email = this.value;
    if (validaEmail(email)) {
        
    } else {
        alert("E-mail inválido!");
        $('#emailCadastro').val("");
    }
});

function validaEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// Função para validar CPF

document.getElementById("cpfCadastro").addEventListener("blur", function() {
    var cpf = this.value;
    if (validaCPF(cpf)) {
        
    }
});

function validaCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') {
        alert("CPF inválido: CPF não pode estar em branco.");
        return false;
    }
    // Elimina CPFs invalidos conhecidos
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999") {
        alert("CPF inválido: CPF contém todos os dígitos iguais.");
        $('#cpfCadastro').val("");
        return false;
    }
    // Valida 1o digito
    var add = 0;
    for (var i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i);
    var rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(9))) {
        alert("CPF inválido: 1º dígito verificador não confere.");
        $('#cpfCadastro').val("");
        return false;
    }
    // Valida 2o digito
    add = 0;
    for (var i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i);
    rev = 11 - (add % 11);
    if (rev == 10 || rev == 11)
        rev = 0;
    if (rev != parseInt(cpf.charAt(10))) {
        alert("CPF inválido: 2º dígito verificador não confere.");
        $('#cpfCadastro').val("");
        return false;
    }
    return true;
}


function salvarCadastro() { 
    if ($('#nomeCadastro').val() == '') {
        alert('Informe o Nome!');
        $('#nomeCadastro').focus();
    } else if ($('#cpfCadastro').val() == '') {
        alert('Informe o CPF!');
        $('#cpfCadastro').focus();
    } else if ($('#dataNascimentoCadastro').val() == '') {
        alert('Informe a Data!');
        $('#dataNascimentoCadastro').focus();
    } else if ($('#emailCadastro').val() == '') {
        alert('Informe o E-mail!');
        $('#emailCadastro').focus();
    } else if ($('#telefoneCadastro').val() == '') {
        alert('Informe o Telefone!');
        $('#telefoneCadastro').focus();
    } else if ($('#cepCadastro').val() == '') {
        alert('Informe o CEP!');
        $('#cepCadastro').focus();
    } else if ($('#numeroResidencial').val() == '') {
        alert('Informe o Numero!');
        $('#numeroResidencial').focus();
    } else if ($('#complemento').val() == '') {
        alert('Informe o Complemento!');
        $('#complemento').focus();
    } else if ($('#senha').val() == '') {
        alert('Informe a senha!');
        $('#senha').focus();
    } else if ($('#senhaConf').val() !== $('#senha').val()) {
        alert('Informe o repedir a senha!');
        $('#senha').val("");
        $('#senhaConf').val("");
        $('#senhaConf').focus();
    } else {  

        var xhr3 = new XMLHttpRequest();
        
        var dados = {
            nome: document.getElementById("nomeCadastro").value,            
            cpf: document.getElementById("cpfCadastro").value,        
            data: document.getElementById("dataNascimentoCadastro").value,        
            email: document.getElementById("emailCadastro").value,  
            telefone: document.getElementById("telefoneCadastro").value,     
            cep: document.getElementById("cepCadastro").value,        
            municipio: document.getElementById("varMunicipio").value,        
            bairro: document.getElementById("varBairro").value,   
            endereco: document.getElementById("varEndereco").value,        
            numero: document.getElementById("numeroResidencial").value,
            complemento: document.getElementById("complemento").value,        
            senha: document.getElementById("senha").value            
        }

        var dadosJSON = JSON.stringify(dados);

        // Configure a chamada AJAX
        xhr3.open('POST', 'http://192.168.12.4/desenvolvimento/desenv1/IlhaCampeche/php/salvarCadastro.php', true);

        xhr3.onreadystatechange = function () {
            if (xhr3.readyState === 4 && xhr3.status === 200){                       
                string    = xhr3.responseText;
                if( string == '1'){
                    alert('Dados salvo com sucesso!');  
                    $('#nomeCadastro').val("");
                    $('#cpfCadastro').val("");
                    $('#dataNascimentoCadastro').val("");
                    $('#emailCadastro').val("");
                    $('#telefoneCadastro').val("");
                    $('#cepCadastro').val("");
                    $('#numeroResidencial').val("");
                    $('#complemento').val("");
                    $('#senha').val("");
                    $('#senhaConf').val("");                    
                }else{
                    alert(string);
                }
            }
        }

        xhr3.send(dadosJSON);


    }
}


function acessarSistema(){
    var url        = "loginAcesso.php";
    var login      = form.login.value;
    var senha      = form.senha.value;
    var parametros = "login="+ login +"&senha="+senha;         
    var xhttp = new XMLHttpRequest();
   
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
           // aqui voc� pode trabalhar com a resposta da consulta
           var dados = JSON.parse( this.responseText );
           if( dados.status == 1 ){
               form.action = "reservar.php";
               form.submit();
           }else{
               alert(this.responseText);
               alert("Login ou senha incorretamente informados !");
          
           }
        }
    };

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);
}