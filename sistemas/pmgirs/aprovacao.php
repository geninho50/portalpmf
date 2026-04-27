<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aprovar</title>
    <link type="image/x-icon" rel="shortcut icon" href="img/brasao.gif">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <img class ='logo' src="img/logo.png" />
        </div>

        <h2>Produto 1: Diagnóstico Ambiental Simplificado</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select1.php";
                  echo $aprovado;
                ?>
            </table>
        </div>

                <h2>Produto 2: Estudo de Territorialidade</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select2.php";
                  echo $aprovado;
                ?>
            </table>
        </div>

        <h2>Produto 3: Estudo de Impacto Simplificado</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select3.php";
                  echo $aprovado;
                ?>
            </table>
        </div>

        <h2>Produto 4: Aspectos Legais</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select4.php";
                  echo $aprovado;
                ?>
            </table>
        </div>

        <h2>Produto 5: Estudo Preliminar Arquitetônico e Urbanístico</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select5.php";
                  echo $aprovado;
                ?>
            </table>
        </div>
        
        <h2>Produto 6: Estudo de Viabilidade Econômico-Financeiro</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select6.php";
                  echo $aprovado;
                ?>
            </table>
        </div>

        <h2>Considerações Gerias:</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select0.php";
                  echo $aprovado;
                ?>
            </table>
        </div>

        <h2>Termo de Referência da Concessão</h2>
        <div class="tabela">
            <table class="table table-striped table-bordered table-hover">
                <th width="20">ID</th>
                <th width="180">Nome</th>
                <th>Sugestão</th>
                <th width="50">Excluir</th>
                <?php
                  include "select7.php";
                  echo $aprovado;
                ?>
            </table>
        </div>

    </div>

</body>

<script>
    function excluir(id){
        var confirmacao = confirm('Você deseja excluir?');
        if(confirmacao){
            var err = '';
            var obj = {
                id : id
            };

            $.post( "delete.php", obj).done(function( data ) {  
                var retorno = jQuery.parseJSON(data);
                if(retorno.success != 1){
                    $('#error').text(retorno.error).removeClass('hide');
                } else{
                    location.href = '';
                }   
            }); 
        }
    }

</script>

</html>