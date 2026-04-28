
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

            } else {   $("#msg-error-operador1").html('');
        }
        }
    })
}


function validaroperador() {

  //   somente aceita se tiver id unico mesmo que esteja algum invisivel .none




  var operador_pais = operadorform.operador_pais.value;

         var operador_nome = operadorform.operador_nome.value;
         var operador_logradouro = operadorform.operador_logradouro.value;
         var operador_bairro = operadorform.operador_bairro.value;
         var operador_cidade = operadorform.operador_cidade.value;
         var operador_estado = operadorform.operador_estado.value;
         var operador_documento = operadorform.operador_documento.value;
         var operador_email = operadorform.operador_email.value;
         var operador_email_rep = operadorform.operador_email_rep.value;
         var operador_telefone_ddi = operadorform.operador_ddi.value;
         var operador_telefone_ddd = operadorform.operador_ddd.value;
         var operador_telefone_numero = operadorform.operador_numero.value;
         var operador_senha = operadorform.operador_senha.value;
         var operador_rep_senha = operadorform.operador_rep_senha.value;

         if (operador_pais == "") {
            $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Escolha o <strong>Pais</strong></div>');
            operadorform.operador_pais.focus();
            return false;
        }
         if (operador_nome == "") {
             $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Nome</strong></div>');
             operadorform.operador_nome.focus();
            return false;
         }
         if (operador_logradouro == "") {
             $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Logradouro</strong></div>');
             operadorform.operador_logradouro.focus();
             return false;
         }
         if (operador_bairro == "") {
             $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Bairro</strong></div>');
             operadorform.operador_bairro.focus();
             return false;
         }
         if (operador_cidade == "") {
             $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Cidade</strong></div>');
             operadorform.operador_cidade.focus();
             return false;
         }
         if (operador_estado == "") {
             $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Estado</strong></div>');
             operadorform.operador_estado.focus();
             return false;
         }
       
         if (operador_documento == "") {
             $("#msg-error-operador").html('<div class="alert alert-danger" role="alert">Preencher o campo <strong>Documentos</strong></div>');
             operadorform.operador_documento.focus();
             return false;
         }

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

