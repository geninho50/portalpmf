function validaemaildb() {
    var operador_email = operadorform.operador_email.value;
    $.ajax({
        url: './src/operador_analisa.php',
        type: 'POST',
        data: {
            "operador_email": operador_email
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (data.operador_email) {
                $("#msg-error-operador1").html('<div class="alert alert-danger" role="alert"><b>email</b> já em uso!</div>');
                document.getElementById("operador_email").select();
                document.getElementById('operador_email').value = "";
                document.getElementById('operador_email_rep').value = "";
                operadorform.operador_email.focus();

            } else {
                $("#msg-error-operador1").html('');
            }
        }
    })
}


function validaroperador() {

    //   somente aceita se tiver id unico mesmo que esteja algum invisivel .none

    const operador_pais = operadorform.operador_pais.value;
    const operador_nome = operadorform.operador_nome.value;

    const operador_tipo_documento = operadorform.operador_tipo_documento.value;
    const operador_documento = operadorform.operador_documento.value;
    const operador_cep = operadorform.operador_cep.value;
    const operador_logradouro = operadorform.operador_logradouro.value;
    const operador_endereco_numero = operadorform.operador_endereco_numero.value;
    const operador_complemento = operadorform.operador_complemento.value;
    const operador_bairro = operadorform.operador_bairro.value;
    const operador_cidade = operadorform.operador_cidade.value;
    const operador_estado = operadorform.operador_estado.value;

    const operador_email = operadorform.operador_email.value;
    const operador_email_rep = operadorform.operador_email_rep.value;

    const operador_telefone_ddi = operadorform.operador_ddi.value;
    const operador_telefone_ddd = operadorform.operador_ddd.value;
    const operador_telefone_numero = operadorform.operador_numero.value;

    const operador_senha = operadorform.operador_senha.value;
    const operador_rep_senha = operadorform.operador_rep_senha.value;

    if (operador_pais == "") {
        document.getElementById("operador_pais_msg").innerHTML = "É obrigatório indicar o pais do operador! <br> <i>¡Es obligatorio indicar el país del operador! </b>";
        operadorform.operador_pais.focus();
        return false;
    }
    document.getElementById("operador_pais_msg").innerHTML = "";

    if (operador_nome == "") {
        document.getElementById("operador_nome_msg").innerHTML = "<b>É obrigatório preencher o nome do operador turístico!  <br> <i >¡Es obligatorio completar el nombre del operador turístico!</i>  </b>";
        operadorform.operador_nome.focus();
        return false;
    }
    document.getElementById("operador_nome_msg").innerHTML = "";

    if (operador_tipo_documento == "") {
        document.getElementById("operador_tipo_documento_msg").innerHTML = "* É obrigatório escolher o tipo de documento!<br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_tipo_documento.focus();
        return false;
    }
    document.getElementById("operador_tipo_documento_msg").innerHTML = "";

    if (operador_documento == "") {
        document.getElementById("operador_documento_msg").innerHTML = "* Preencha o número do documento! <br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_documento.focus();
        return false;
    }
    document.getElementById("operador_documento_msg").innerHTML = "";


    if (operador_cep == "") {
        document.getElementById("operador_cep_msg").innerHTML = "* É obrigatório preencher código postal! <br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_cep.focus();
        return false;
    }
    document.getElementById("operador_cep_msg").innerHTML = "";


    if (operador_logradouro == "") {
        document.getElementById("operador_logradouro_msg").innerHTML = "* Preencha o nome do logradouro<br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_logradouro.focus();
        return false;
    }
    document.getElementById("operador_logradouro_msg").innerHTML = "";

    if (operador_endereco_numero == "") {
        document.getElementById("operador_endereco_numero_msg").innerHTML = "* Preencha o número! <br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_endereco_numero.focus();
        return false;
    }
    document.getElementById("operador_endereco_numero_msg").innerHTML = "";

    if (operador_complemento == "") {
        document.getElementById("operador_complemento_msg").innerHTML="* Preencha um complemento para seu endereço! <br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_complemento.focus();
        return false;
    }
    document.getElementById("operador_complemento_msg").innerHTML="";

    if (operador_bairro == "") {
        document.getElementById("operador_bairro_msg").innerHTML="Preencha o Bairro <br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_bairro.focus();
        return false;
    }
    document.getElementById("operador_bairro_msg").innerHTML="";

    if (operador_cidade == "") {
        document.getElementById("operador_cidade_msg").innerHTML="Preencha nome da Cidade<br><i>¡Mensagem em espanhol!</i>";
        operadorform.operador_cidade.focus();
        return false;
    }
    document.getElementById("operador_cidade_msg").innerHTML="";

    if (operador_estado == "") {
        document.getElementById("operador_estado_msg").innerHTML="Preencher nome do Estado<br><i>¡Mensagem em espanhol!</i>"
        operadorform.operador_estado.focus();
        return false;
    }
    document.getElementById("operador_estado_msg").innerHTML="";

    if (operador_email == "" || operador_email.indexOf('@') == -1 || operador_email.indexOf('.') == -1) {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>E-mail</strong></div>');
        operadorform.operador_email.focus();
        return false;
    }

    if (operador_email_rep == "" || operador_email_rep.indexOf('@') == -1 || operador_email_rep.indexOf('.') == -1) {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Confirmar o <strong>E-mail</strong></div>');
        operadorform.operador_email_rep.focus();
        return false;
    }

    if (operador_email != operador_email_rep) {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Os <strong>E-mails</strong> devem ser iguais E-mail</div>');
        operadorform.operador_email.focus();
        return false;
    }    

    if (operador_telefone_ddi == "") {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>DDI</strong></div>');
        operadorform.operador_ddi.focus();
        return false;
    }   

    if (operador_telefone_ddd == "") {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>DDD</strong></div>');
        operadorform.operador_ddd.focus();
        return false;
    }   

    if (operador_telefone_numero == "") {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Numero</strong></div>');
        operadorform.operador_numero.focus();
        return false;
    }   

    if (operador_senha == "" || operador_senha.length <= 5) {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">A <b>senha</b> deve conter no mínimio 6 caracteres!</div>');
        operadorform.operador_senha.focus();
        return false;
    }

    if (operador_rep_senha == "" || operador_rep_senha.length <= 5) {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">A <b>senha</b> deve conter no mínimio 6 caracteres 2!</div>');
        operadorform.operador_rep_senha.focus();
        return false;
    }

    if (operador_senha != operador_rep_senha) {
        $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">As <b>senhas</b> devem ser iguais!</div>');
        operadorform.operador_rep_senha.focus();
        return false;
    }

};

