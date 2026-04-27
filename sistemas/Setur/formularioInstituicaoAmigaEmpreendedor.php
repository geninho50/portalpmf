<!doctype html>
<html lang='pt-BR'>
<head>
    <meta charset="UTF-8">
    <title>Programa Institui&ccedil;&atilde;o Amioga do Empreendedor</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo2.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="container">
    <div class="alert alert-danger hide" id="error"></div>
    <div class="form" role="form">

        <div class="row">
            <div class="col-md-12" align="center">
                <img src="http://www.pmf.sc.gov.br/layout/imagens/marca-pmf.svg">
            </div>
        </div>
    </div>

    <br><br>

    <form id="frm1" name="frm1" method="post" action="backend/sendEmail.php"; enctype="multipart/form-data">

        <h1>Ficha de Inscri&ccedil;&atilde;o</h1><br>

        <div id='cadastro'>
            <div class="row">

                <div class="col-md-9"><label>Nome da IES :</label><input value="" id="nome" name="nome" class="form-control" type="text"/></div>
                <div class="col-md-3"><label>Sigla da IES :</label><input value="" id="sigla" name="sigla" class="form-control" type="text"/></div>

            </div><br>

            <div class="row">
                <div class="col-md-6"><label>Mantenedora :</label><input value="" id="mantenedora" name="mantenedora" class="form-control" type="text"/></div>
                <div class="col-md-6"><label>Endere&ccedil;o :</label><input value="" id="endereco" name="endereco" class="form-control" type="text"/></div>
            </div><br>

            <div class="row">
                <div class="col-md-8"><label>Respons&aacute;vel :</label><input value="" id="responsavel"  name="responsavel" class="form-control" type="text"/></div>
                <div class="col-md-4"><label>Telefone:</label><input value="" id="telefone"  name="telefone" class="form-control" type="text"/></div>
            </div><br>

            <div class="row">
                <div class="col-md-12"><label>E-mail :</label><input value="" id="email"  name="email" class="form-control" type="text"/></div>
            </div><br>

            <div><input id="id1" name="id1" type="hidden"/></div>
            <input type="button" name="btnSubmit" onclick="validaForm()" id="btnSubmit" class="btn btn-primary botao" value="Enviar" />
        </div><br>

</div>
</form>
<div class="overlay"></div>
</div>
</body>

<script type="text/javascript" src="js/validacao.js"></script>
<script>
    $('#telefone').mask("(99) 9999-9999");

    function validaForm() {
        var nome = $("#nome").val();
        var sigla = $("#sigla").val();
        var mantenedora = $("#mantenedora").val();
        var endereco = $("#endereco").val();
        var responsavel = $("#responsavel").val();
        var telefone = $("#telefone").val();
        var email = $("#email").val();

        if (nome == "") {
            alert('Preencha o campo com o nome');
            frm1.nome.focus();
            return false;
        } else if (sigla == "") {
            alert('Preencha o campo com a sigla');
            frm1.sigla.focus();
            return false;
        } else if (mantenedora == "") {
            alert('Preencha o campo com a mantenedora');
            frm1.mantenedora.focus();
            return false;
        } else if (endereco == "") {
            alert('Preencha o campo com o endereço');
            frm1.endereco.focus();
            return false;
        } else if (responsavel == "") {
            alert('Preencha o campo com o responsável');
            frm1.responsavel.focus();
            return false;
        } else if (telefone == "") {
            alert('Preencha o campo com o telefone');
            frm1.telefone.focus();
            return false;
        } else if (email == "") {
            alert('Preencha o campo com o email');
            frm1.email.focus();
            return false;
        }

        var obj = {
            nome           : nome,
            sigla          : sigla,
            mantenedora    : mantenedora,
            endereco       : endereco,
            responsavel    : responsavel,
            telefone       : telefone,
            email          : email
        };

        $.post("backend/sendEmail.php", obj).done(function( data ) {
            alert("Sua solicita&ccedil;&atilde;o entrou na nossa fila de trabalho, entraremos em contato logo.");
            location.href = "http://www.pmf.sc.gov.br/sites/ef/index.php?cms=programa+instituicao+amiga+do+empreendedor&menu=0";
        }).fail(function () {
            alert("Ocorreu algum problema com sua solicitação.");
        });

    }
</script>
</html>