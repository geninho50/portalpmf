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

function validacpfdb() {
    var cpf = formuser.cpf.value;
    $.ajax({
        url: '/user/user_analisa.php',
        type: 'POST',
        data: {
            "cpf": cpf
        },
        success: function (data) {
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

function validaemaildb() {
    var email = formuser.email.value;
    $.ajax({
        url: '/user/user_analisa.php',
        type: 'POST',
        data: {
            "email": email
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (data.email) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>E-MAIL</b> já em uso!</div>');
                formuser.email.focus();
                document.getElementById("email").select();
                document.getElementById('email').value = "";
            }
        }
    })
}

function validausuariodb() {
    var usuario = formuser.usuario.value;
    $.ajax({
        url: '/user/user_analisa.php',
        type: 'POST',
        data: {
            "usuario": usuario
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (data.usuario) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>USUARIO</b> já em uso!</div>');
                formuser.usuario.focus();
                document.getElementById("usuario").select();
                document.getElementById('usuario').value = "";
            }
        }
    })
}

function validanomedb() {
    var nome = formuser.nome.value;
    $.ajax({
        url: '/user/user_analisa.php',
        type: 'POST',
        data: {
            "nome": nome
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (data.nome) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>NOME</b> já em uso!</div>');
                formuser.nome.focus();
                document.getElementById("nome").select();
                document.getElementById('nome').value = "";
            }
        }
    })
}

function validamatriculadb() {
    var matricula = formuser.matricula.value;
    $.ajax({
        url: '/user/user_analisa.php',
        type: 'POST',
        data: {
            "matricula": matricula
        },
        success: function (data) {
            data = $.parseJSON(data);
            if (data.matricula) {
                $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>matricula</b> já em uso!</div>');
                formuser.matricula.focus();
                document.getElementById("matricula").select();
                document.getElementById('matricula').value = "";
            }
        }
    })
}

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000" ||
        strCPF == "11111111111" ||
        strCPF == "22222222222" ||
        strCPF == "33333333333" ||
        strCPF == "44444444444" ||
        strCPF == "55555555555" ||
        strCPF == "66666666666" ||
        strCPF == "77777777777" ||
        strCPF == "88888888888" ||
        strCPF == "99999999999"

    ) return false;

    for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10))) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11)) Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11))) return false;
    return true;
}

function limpa1() {
    $("#msg-error").html('');
    $("input#nome").val("");
    $("input#usuario").val("");
    $("input#cpf").val("");
    $("input#cep").val("");
    $("input#email").val("");
    $("input#matricula").val("");
    $("input#senha").val("");
    $("input#rep_senha").val("");
    $("select#orgao").val("");
    $("select#categoria").val("");

    $("select#setor").val("");
    document.getElementById("div_form_setor_smpu").style.display = "none";
    document.getElementById("div_form_setor_ipuf").style.display = "none";
    document.getElementById("div_form_matricula").style.display = "none";
    document.getElementById("div_form_pmf").style.display = "none";
    //document.getElementById("div_form_entidade").style.display = "none";
    document.getElementById("div_form").style.display = "none";
    formuser.orgao.focus();
}

document.getElementById("orgao").addEventListener("change", form_type);

function form_type() {
    var x = document.getElementById("orgao").value;
    document.getElementById("div_form_setor_smpu").style.display = "none";
    document.getElementById("div_form_setor_ipuf").style.display = "none";
    document.getElementById("div_form_matricula").style.display = "none";
    document.getElementById("div_form_pmf").style.display = "none";
   // document.getElementById("div_form_entidade").style.display = "none";
    document.getElementById("div_form").style.display = "none";

    if (x == "") {
        document.getElementById("div_form_setor_smpu").style.display = "none";
        document.getElementById("div_form_setor_ipuf").style.display = "none";
        document.getElementById("div_form_matricula").style.display = "none";
        document.getElementById("div_form").style.display = "none";
        document.getElementById("div_form_pmf").style.display = "none";
      //  document.getElementById("div_form_entidade").style.display = "none";
    }

    if (x == "SMPU") {
        //habilita
        document.getElementById("div_form_setor_smpu").style.display = "block";
        document.getElementById("div_form_matricula").style.display = "block";
        document.getElementById("div_form_setor_ipuf").style.display = "none";
        document.getElementById("div_form_pmf").style.display = "none";
        document.getElementById("div_form").style.display = "block";
       // document.getElementById("div_form_entidade").style.display = "none";
    }

    if (x == "IPUF") {
        document.getElementById("div_form_setor_ipuf").style.display = "block";
        document.getElementById("div_form_matricula").style.display = "block";
        document.getElementById("div_form_setor_smpu").style.display = "none";
        document.getElementById("div_form_pmf").style.display = "none";
      //  document.getElementById("div_form_entidade").style.display = "none";
        document.getElementById("div_form").style.display = "block";
    }

    if (x == "PMF") {
        document.getElementById("div_form_setor_smpu").style.display = "none";
        document.getElementById("div_form_setor_ipuf").style.display = "none";
        document.getElementById("div_form_matricula").style.display = "block";
        document.getElementById("div_form_pmf").style.display = "block";
        //document.getElementById("div_form_entidade").style.display = "none";
        document.getElementById("div_form").style.display = "block";
    }

    if (x == "EXTERNO") {
        document.getElementById("div_form_setor_smpu").style.display = "none";
        document.getElementById("div_form_setor_ipuf").style.display = "none";
        document.getElementById("div_form_matricula").style.display = "none";
        document.getElementById("div_form_pmf").style.display = "none";
        document.getElementById("div_form_entidade").style.display = "none";
        document.getElementById("div_form").style.display = "none";
    }
}

function validar() {

    //somente aceita se tiver id unico mesmo que esteja algum invisivel .none
    var nome = formuser.nome.value;
    var nome = nome.trim();
    var usuario = formuser.usuario.value;
    var usuario = usuario.trim();
    var email = formuser.email.value;
    var email = email.trim();
    var matricula = formuser.matricula.value;
    var orgao = formuser.orgao.value;
    //var entidade = formuser.entidade.value;
    var cpf = formuser.cpf.value;
    var senha = formuser.senha.value;
    var rep_senha = formuser.rep_senha.value;
    var smpusetor = formuser.smpusetor.value;
    var ipufsetor = formuser.ipufsetor.value;
    var SECpmf = formuser.SECpmf.value;

    //VARIAVEIS TESTE CPF

    var strCPF = formuser.cpf.value;
    strCPF = strCPF.replace(/[_\W]+/g, "");

    //SOMENTE TESTA A categoria SE FOR DIFERENTE DE "Terceirizado" E "Colaborador Externo"

    if (orgao == "SMPU") {
        if (smpusetor == "") {
            $("#msg-error").html('<div class="alert alert-danger" role="alert">Definir setor na SMPU</div>');
            formuser.smpusetor.focus();
            return false;
        };

    };

    if (orgao == "SMPU") {
        if (matricula == "") {
            $("#msg-error").html('<div class="alert alert-danger" role="alert">Informar Matrícula</div>');
            formuser.matricula.focus();
            return false;
        };

    };

    if (orgao == "IPUF") {
        if (ipufsetor == "") {
            $("#msg-error").html('<div class="alert alert-danger" role="alert">Definir setor do IPUF</div>');
            formuser.ipufsetor.focus();
            return false;
        };
    };

    if (orgao == "IPUF") {
        if (matricula == "") {
            $("#msg-error").html('<div class="alert alert-danger" role="alert">Informar Matrícula</div>');
            formuser.matricula.focus();
            return false;
        };
    };

    if (orgao == "EXTERNO") {
        if (entidade == "") {
            $("#msg-error").html('<div class="alert alert-danger" role="alert">Selecionar entidade ou empresa</div>');
            formuser.entidade.focus();
            return false;
        };
    };  

    if (orgao == "PMF") {
        if (SECpmf == "") {
            $("#msg-error").html('<div class="alert alert-danger" role="alert">Selecionar Secretaria da PMF</div>');
            formuser.SECpmf.focus();
            return false;
        };
    };
    
    if (nome == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher o campo <b>Nome!</b></div>');
        formuser.nome.focus();
        return false;
    }

    if (usuario == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher o campo <b>Usuário</b></div>');
        formuser.usuario.focus();
        return false;
    }

    if (email == "" || email.indexOf('@') == -1 || email.indexOf('.') == -1) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Preencher corretamente o <b>E-mail<!/b></div>');
        formuser.email.focus();
        return false;
    }

    if (cpf == "") {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">Obrigatório informar <b>CPF!</b></div>');
        formuser.cpf.focus();
        return false;
    }

    if (TestaCPF(strCPF) === false) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert"><b>CPF INVÁLIDO!</b></div>');
        document.getElementById('cpf').value = "";
        formuser.cpf.focus();
        return false;
    }


    if (senha == "" || senha.length <= 5) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">A <b>senha</b> deve conter no mínimio 6 caracteres!</div>');
        formuser.senha.focus();
        return false;
    }

    if (rep_senha == "" || rep_senha.length <= 5) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">A <b>senha</b> deve conter no mínimio 6 caracteres 2!</div>');
        formuser.rep_senha.focus();
        return false;
    }

    if (senha != rep_senha) {
        $("#msg-error").html('<div class="alert alert-danger" role="alert">As <b>senhas</b> devem ser iguais!</div>');
        formuser.rep_senha.focus();
        return false;
    }

    $("#msg-error").html('<div class="alert alert-success" role="alert">Registro Válido</div>');

};




