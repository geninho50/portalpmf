<?php
session_name('ma');
session_start();
if (!isset($_SESSION['escola']['novaEscola']['vaga'])) {
    header('Location: dadosEscolares.php');
}

include 'fnc/buscaInscricao.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" CONTENT="NO-CACHE">
        <title>SGE &middot; Escolha de Intenção</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="ico/favicon.png">
    </head>

    <body>

        <div class="container">
<?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo'>
                <div class='row-fluid' style='text-align: center; height: 90px;'>
                    <div style='text-align: center; padding-top: 15px;'>
                        <h3>Escolha de Intenção</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <div class="span3" style="padding-left: 10px;">
                        <div class='itemLaranja ativo'>
                            Dados de Identificação  
                        </div>
                        <div class='itemRoxo ativo'>
                            Outros Dados
                        </div>
                        <div class='itemAzul ativo'>
                            Dados de Saúde
                        </div>
                        <div class='itemMarrom ativo'>
                            Dados de Localização
                        </div>
                        <div class='itemAmarelo ativo'>
                            Dados Escolares
                        </div>
                        <div class='itemCinza verde'>
                            Dados Pessoais  
                        </div>
                        <div class='itemCinza oliva'>
                            Dados dos Pais
                        </div>
                        <div class='itemCinza t'>
                            Dados de Renda
                        </div>
                        <div class='itemCinza verde-azulado'>
                            Confirmação
                        </div>
                    </div>

                    <div class="span8 folha">
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <!-- TODO - Atenção: Diferenças entre Infantil e Básica -->
                        <!-- TODO - Atenção: Validação -->
                        <!-- TODO - Atenção: Confirmação -->
                        <?php if ($_SESSION['escola']['novaEscola']['vaga']) { 
                            header("Location: escolhaIntencao.php");
                        } else {
                            ?>
                        <form action="intencao.php">
                            <h4>Por favor, anote o seu número de inscrição: <?php echo buscaInscricao($_SESSION['aluno']['id'])[0]; ?> </h4>
                            <p>Guarde este número. Ele é de extrema importância.</p>
                            <p>Se você deseja registrar intenção na unidade escolhida<br> clique no botão <strong>Registrar Intenção</strong></p>
                            <button class='btn btn-primary'>Registrar Intenção</button>
                            <hr>
                            <a class='btn btn-primary' href='limpaSessao.php'>Finalizar</a>
                        <?php } ?>
                        </form>
                    </div>   
                </div>
            </div>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>

    </body>
</html>
