<!doctype html>
<html lang='pt-BR'>
    <head>
    <meta charset="UTF-8">
    <title>Solicitação de e-mail da Prefeitura M. de Florianópolis</title>
    <link rel="stylesheet" href="css/normalize.css">
    <script src="js/prefixfree.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/estilo2.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
  </head>
  
  <?php
     require_once("../../scripts/php/config.php");
     require_once("../../scripts/php/funcoes_bd.php");
     require_once("../../scripts/php/funcoes.php");     

     if( !$drive->ipLiberado() ){						
        print "<h3>Acesso não está autorizado !<br><br></h3>IP :  <b>".$_SERVER['REMOTE_ADDR']."</b>";
     }else{ ?>    

        <body>
                <div class="container">
                <div class="alert alert-danger hide" id="error"></div>

                <form id="frm1" name="frm1" method="post" action="backend/sendEmail.php" enctype="multipart/form-data">
                <!--<p><strong>Dúvidas e informações: E-mail dgov@pmf.sc.gov.br / Telefone (48) 3251-6032</strong></p>--><br>

                <div id='cadastro'>
                    <div class="row">
                            <div class="col-md-12"><label>Nome Completo</label><input value="" id="nome" name="nome" class="form-control" type="text"/></div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-6"><label>Setor :</label><input value="" id="setor" name="setor" class="form-control" type="text"/></div>
                        <div class="col-md-6"><label>Secretaria :</label><input value="" id="secretaria" name="secretaria" class="form-control" type="text"/></div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-6"><label>E-mail pessoal para retorno :</label><input value="" id="emailPessoal" name="emailPessoal" class="form-control" type="text"/></div>
                        <div class="col-md-6"><label>Telefone :</label><input value="" id="telefone" name="telefone" class="form-control" type="text"/></div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-6"><label>Matricula :</label><input value="" id="matricula" name="matricula" class="form-control" type="text"/></div>
                        <div class="col-md-6"><label>E-mail a ser criado :</label><input value="" placeholder="nome+sobrenome.secretaria@pmf.sc.gov.br" id="email" name="email" class="form-control" type="text"/></div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Tipo Email : </label>
                            <label class="radio-inline">
                                <input type="radio" name="tipo" value="0"> Setor
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="tipo" value="1"> Pessoal
                            </label>
                        </div>
                    </div><br>

                    <div><input id="id1" name="id1" type="hidden"/></div>
                    <input type="button" name="btnSubmit" id="btnSubmit" class="btn btn-primary botao" onclick="capExec()" value="Enviar" />
            <div class="g-recaptcha"
                data-sitekey="6LdMh58UAAAAAC9GhzFs2nGXFqq8f67_WsChBHbF"
                data-callback="validaForm"
                data-size="invisible">
            </div>
                </div><br>

            </div>
            </form>    
            <div class="overlay"></div>    
            </div>
            </body>
    <?php  }   ?>
   
   <script type="text/javascript" src="js/validacao.js"></script>
   <script>
    $('#telefone').mask("(99) 9999-9999");

    function capExec() {
        grecaptcha.reset();
        grecaptcha.execute();
    }

    function CaptchaCallback() {
        grecaptcha.render('recaptcha', {'sitekey': '6LdMh58UAAAAAC9GhzFs2nGXFqq8f67_WsChBHbF', 'size': 'invisible', 'callback': 'validaForm'});
    }

    function validaForm(response) {
        var nome = $("#nome").val();
        var setor = $("#setor").val();
        var secretaria = $("#secretaria").val();
        var emailPessoal = $("#emailPessoal").val();
        var telefone = $("#telefone").val();
        var matricula = $("#matricula").val();
        var email = $("#email").val();
        var tipo = $('input[name=tipo]:checked').val();

        if (nome == "") {
            alert('Preencha o campo com seu nome');
            frm1.nome.focus();
            return false;
        } else if (setor == "") {
            alert('Preencha o campo com seu setor');
            frm1.setor.focus();
            return false;
        } else if (secretaria == "") {
            alert('Preencha o campo com sua secretaria');
            frm1.secretaria.focus();
            return false;
        } else if (emailPessoal == "") {
            alert('Preencha o campo com seu email pessoal');
            frm1.emailPessoal.focus();
            return false;
        } else if (telefone == "") {
            alert('Preencha o campo com seu telefone');
            frm1.telefone.focus();
            return false;
        } else if (matricula == "") {
            alert('Preencha o campo com sua matricula');
            frm1.matricula.focus();
            return false;
        } else if (email == "") {
            alert('Preencha o campo com seu novo email');
            frm1.email.focus();
            return false;
        } else if (tipo != 0 && tipo != 1) {
            alert('Selecione o campo com tipo de email');
            return false;
        }

        if(tipo == 0) {
            tipo = "Setor";
        } else {
            tipo = "Pessoal";
        }

        var obj = {
            nome           : nome,
            setor          : setor,
            secretaria     : secretaria,
            emailPessoal   : emailPessoal,
            telefone       : telefone,
            matricula      : matricula,
            email          : email,
            tipo           : tipo,
            "g-recaptcha-response" : response 
        };

        $.post("backend/sendEmail.php", obj).done(function( data ) {
            
            console.log(data);
            alert("Sua solicitação entrou na nossa fila de trabalho, entraremos em contato logo.");
            // location.href = "https://www.pmf.sc.gov.br/entidades/casacivil/";

        }).fail(function () {
            alert("Ocorreu algum problema com sua solicitação.");
        });
    }
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</html>