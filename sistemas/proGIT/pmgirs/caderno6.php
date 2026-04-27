<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMGIRS Caderno 6: Plano Municipal de Coleta Seletiva</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/brasao.gif">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
</head>

<body>
   
    <div class="jumbotron">
        <div>
            <img class ='logo' src="img/logo.png" />
        </div>
    </div>       

   <div class="menu pull-left esquerda">
        <a href="decreto.php" class="btn btn-default menu"><b>Decreto <br>Decreto N.17.910, de 22 de agosto de 2017</b></a>
        <a href="caderno1.php" class="btn btn-default menu"><b> Caderno 1:<br> CAPA e Apresenta&ccedil;&atilde;o Introdu&ccedil;&atilde;o</b></a>
        <a href="caderno2.php" class="btn btn-default menu"><b> Caderno 2:<br> Diagnostico PMGIRS Florian&oacute;polis</b></a>
        <a href="caderno3.php" class="btn btn-default menu"><b> Caderno 3:<br> Prognostico PMGIRS Florian&oacute;polis</b></a>
        <a href="caderno4.php" class="btn btn-default menu"><b> Caderno 4:<br> Aspectos Gerais do Planejamento das Acoes</b></a>
        <a href="caderno5.php" class="btn btn-default menu"><b> Caderno 5:<br> Programas, Metas e A&ccedil;&otilde;es PMGIRS</b></a>
        <a href="caderno6.php" class="btn btn-default menu"><b> Caderno 6:<br> Plano Municipal de Coleta Seletiva.</b></a>
        <a href="caderno7.php" class="btn btn-default menu"><b> Caderno 7:<br> Minuta de Projeto de Lei da Pol&iacute;tica Municipal <br>de Gest&atilde;o dos Res&iacute;duos Sólidos Domiciliares </b></a>
        <a href="caderno8.php" class="btn btn-default menu"><b> Caderno 8:<br> Minuta de Projeto de Lei da Pol&iacute;tica Municipal <br> de Gest&atilde;o dos Res&iacute;duos da Constru&ccedil;&atilde;o Civil, <br>Vegetais e Volumosos</b></a>
    </div>          

    <div class="container">

        <h2 class="text-center">PMGIRS Caderno 6: Plano Municipal de Coleta Seletiva</h2>

        <br>

        <div class="pdf">
            <iframe src="arquivos/PMGIRS_CADERNO_6_Versao Final Plano de Coleta Seletiva.pdf" width="100%" height="100%" style="border: 1px solid;"></iframe>
        </div>
         <div class="alert alert-danger" id="error"></div>

                <form>
            <div class="row">
                <div class="col-md-6 pull-left">
                    <input type="button" name="submit" id="voltar" class="btn btn-primary botao " value="Voltar" />
                </div>
        </form>
        
    </div>

<script type="text/javascript">
    $('#cpf').mask("999.999.999-99");
     $('#error').addClass('hide');
    $('#voltar').bind('click', function(){
        window.location.href = "index.php";
    });

    $('#submit').bind('click',function(){
        $('#error').addClass('hide');
        var err = '';
        var obj = {
            nome          : $('#nome').val(),
            email         : $('#email').val(),
            cpf           : $('#cpf').val(),
            sugestao      : $('#sugestao').val(),
            projeto       : 1
        };


        $.post( "inserir.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
                location.href = "confirmado.php";
            }else{  
                $('#error').html(retorno.erro).removeClass('hide');
                $('.error').removeClass('error');
                $('#' + retorno.idErro).addClass('error');
                //window.scrollTo(0, 0);
            }
        });
    });
</script>

</body>
</html>