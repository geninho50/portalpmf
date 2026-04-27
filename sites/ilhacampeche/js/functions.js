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
               alert('Entrou !');
               form.action = "reservar.php";
               form.submit();
           }else{
               alert(this.responseText);
               alert("Login ou senha incorretamente informados !");
               //form.login.value = "";
               // form.senha.value = "";            
           }
        }
    };

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parametros);
}