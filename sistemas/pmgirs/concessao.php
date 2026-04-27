<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Termo de Referência da Concessão </title>
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

    <div class="container">

        <h2 class="text-center">Termo de Referência da Concessão</h2>

        <p>Os usuários devem estar cientes de que seus comentários se tornarão públicos e compartilhados neste mesmo espaço;</p>

        <p>Após o envio do comentário, ele será analisado pelo Grupo Técnico de Trabalho - GTT, que verificará o emprego adequado dos termos e pertinência do conteúdo;</p>

        <p>Os comentários deverão se restringir ao conteúdo e tema do projeto proposto: Parque Urbano e Marina Beira Mar;</p>

        <p>Os comentários devem se restringir ao conteúdo do documento sobre o qual se refere a página (exemplo: realizar comentários sobre o Produto 1, apenas na página dedicada ao Produto 1);</p>

        <p>Além do preenchimento do Nome, CPF e E-mail, o usuário deverá apresentar nome da empresa e CNPJ (se for o caso), endereço e telefone de contato – estes últimos no próprio corpo do comentário;)</p>

        <p>A não observância das regras supra poderá acarretar a inutilização do comentário.</p>

        <p>Duvidas, sugestões ou erros favor entrar em contato via: seturimprensa@gmail.com</p>

        <div class="pdf">
            <iframe src="http://www.pmf.sc.gov.br/sistemas/consulta/setur/arquivos/trconcessãoconsulta.pdf" width="100%" height="100%" style="border: 1px solid;"></iframe>
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
            projeto       : 7
        };


        $.post( "inserir.php", obj).done(function( data ) { 
            var retorno = jQuery.parseJSON(data);
            if(retorno.sucesso == 1){
                location.href = "confirmado.php";
            }else{  
                $('#error').text(retorno.erro).removeClass('hide');
                $('.error').removeClass('error');
                $('#' + retorno.idErro).addClass('error');
            }
        });
    });
</script>

</body>
</html>