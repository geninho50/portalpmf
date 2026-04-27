$(document).ready(function () {

    limpa1
});

function limpa1() {
    $("input#razao_social").val("");
    $("input#cnpj").val("");
    $("input#cnh").val("");
    $("input#data_nascimento").val("");
    $("input#cep").val("");
    $("input#rua").val("");
    $("input#complemento").val("");
    $("input#bairro").val("");
    $("input#cidade").val("");
    $("input#uf").val("");
    $("input#telefone01").val("");
    $("input#email").val("");
    $("#msg-error").html('');


}


function valida_CNPJ_db() {
    var cnpj = formuser.cnpj.value;
    $.ajax({
        url: 'cadastro_analisa.php',
        type: 'POST',
        data: {
            "cnpj": cnpj
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (data.cnpj) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CNPJ</b> já em uso!</div>');
                formuser.cnpj.focus();
                document.getElementById("cnpj").select();
                document.getElementById('cnpj').value = "";
            }
        }
    })
}

function validar() {
    var razao_social = formuser.razao_social.value;
    var razao_social = razao_social.trim();
    var cnpj = formuser.cnpj.value;
    var cep = formuser.cep.value;
    var data_abertura = formuser.data_abertura.value;
    var strCNPJ = formuser.cnpj.value;


    strCNPJ = strCNPJ.replace(/[_\W]+/g, "");

    if (razao_social == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert"> Necessário o campo <b>Razão Social da Empresa!</b></div>');
        formuser.razao_social.focus();
        return false;
    }

    if (cnpj == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>CNPJ!</b></div>');
        formuser.cnpj.focus();
        return false;
    }


    //chama funcao javscript externa /bas/js validaCNPJ.js
    if (validaCNPJ(strCNPJ) === false) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CNPJ INVÁLIDO!</b></div>');
        document.getElementById('cnpj').value = "";
        formuser.cnpj.focus();
        return false;
    }

    if (data_abertura == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Indicada a <b>DATA DE ABERTURA</b></div>');
        formuser.data_abertura.focus();
        return false;
    }
  


    if (cep == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>CEP</b></div>');
        formuser.cep.focus();
        return false;
    }

    return;
};



//testa validade de CNH

