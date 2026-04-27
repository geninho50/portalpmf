$(document).ready(function () {

    $("input.cpf").mask("999.999.999-99", {
        reverse: true
    });

    $("input.rg").mask("999999999", {
        reverse: true
    });
    $("input.cnpj").mask("22.222.222/2222-22", {
        reverse: true
    });
    $("input.cep").mask("99999-999", {
        reverse: true
    });
    $("input.telefone").mask("99-9999999999", {
        reverse: true
    });

    limpa1
});

function validar() {

    //somente aceita se tiver id unico mesmo que esteja algum invisivel .none
    var contratantes_nome = testform.contratantes_nome.value;
  

    if (contratantes_nome == "") {
        $("#msg-error-contratantes").html('<div class="alert alert-danger" role="alert">Preencher o campo <b>Nome</b></div>');
        formuser.usuario.focus();
        return false;
    }

   


    $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');

};




