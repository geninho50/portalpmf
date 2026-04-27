$(document).ready(function () {

    limpa1
});

function limpa1() {
    $("input#nome").val("");
    $("input#cpf").val("");
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


function validacpfdb() {
    var cpf = formuser.cpf.value;
    $.ajax({
        url: 'cadastro_analisa.php',
        type: 'POST',
        data: {
            "cpf": cpf
        },
        success: function(data) {
            data = $.parseJSON(data);
            if (data.cpf) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF</b> já em uso!</div>');
                formuser.cpf.focus();
                document.getElementById("cpf").select();
                document.getElementById('cpf').value = "";
            }
        }
    })
}

function validacnhdb() {
    var cnh = formuser.cnh.value;
    $.ajax({
        url: 'cadastro_analisa.php',
        type: 'POST',
        data: {
            "cnh": cnh
        },
        success: function(data) {
            data = $.parseJSON(data);
            if (data.cnh) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CNH</b> já em uso!</div>');
                formuser.cnh.focus();
                document.getElementById("cnh").select();
                document.getElementById('cnh').value = "";
            }
        }
    })
}

function validar() {
    var nome = formuser.nome.value;
    var nome = nome.trim();
    var cnh = formuser.cnh.value;
    var strCNH = formuser.cnh.value;
    var cpf = formuser.cpf.value;
    var cep = formuser.cep.value;
   var data_nascimento = formuser.data_nascimento.value;
    var strCPF = formuser.cpf.value;

    strCPF = strCPF.replace(/[_\W]+/g, "");

    if (nome == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert"> Necessário o campo <b>Nome!</b></div>');
        formuser.nome.focus();
        return false;
    }


    //teste cpf

    if (cpf == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Obrigatório informar <b>CPF!</b></div>');
        formuser.cpf.focus();
        return false;
    }

    if (valida(strCPF) === false) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF INVÁLIDO!</b></div>');
        document.getElementById('cpf').value = "";
        formuser.cpf.focus();
        return false;
    }

    //teste cnh
    if (cnh == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>CNH!</b></div>');
        formuser.cnh.focus();
        return false;
    }
    if (validaCNH(strCNH) === false) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CNH INVÁLIDA!</b></div>');
        document.getElementById('cnh').value = "";
        formuser.cnh.focus();
        return false;
    }

    if (data_nascimento == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Indicada a <b>DATA DE NASCIMENTO</b></div>');
        formuser.data_nascimento.focus();
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

