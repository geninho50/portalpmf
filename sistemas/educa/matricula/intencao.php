<?php
session_name('ma');
session_start();
if (!isset($_SESSION['escola']['novaEscola']['vaga'])) {
    header('Location: dadosEscolares.php');
}

if (!isset($_SESSION['intencao'])) {
    include 'fnc/registrarIntencao.php';
    $resultado = registrarIntencao($_SESSION['aluno']['id'], $_SESSION['escola']['novaEscola']['id_escola'], $_SESSION['curso'], $_SESSION['escola']['novaEscola']['ano'], $_SESSION['periodo_ano'], $_SESSION['id_periodo'], $_SESSION['escola']['novaEscola']['motivo']);

    if ($resultado) {
        $_SESSION['intencao'] = true;
    }
}

include 'fnc/buscaEscola.php';
$escola = buscaEscola($_SESSION['escola']['novaEscola']['id_escola'])[$_SESSION['escola']['novaEscola']['id_escola']][1];
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
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha">
                        <img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
                        <!-- TODO - Atenção: Diferenças entre Infantil e Básica -->
                        <!-- TODO - Atenção: Validação -->
                        <!-- TODO - Atenção: Confirmação -->
                        <div id = "vagaAlocada">
                            <h5>Sua intenção foi registrada com sucesso na Unidade:<br> <?php echo ($escola); ?></h5>
                            <a class = 'btn btn-info' onclick="window.open('relatorios/emitirFormIntencao.php');"><i class='icon-print icon-white'></i> Emitir Comprovante</a>
                            <div <?php
                    if (isset($_SESSION['intencao'])) {
                        
                    }
                    ?>>
                                <hr>
                                <?php if ($_SESSION['escola']['novaEscola']['vaga']) { ?>
                                    <a class = 'btn btn-primary' href ='dadosMae.php'>Continuar Cadastro</a>
                                <?php } ?>
                                <?php if (!$_SESSION['escola']['novaEscola']['vaga']) { ?>
                                    <a class = 'btn btn-primary' href ='limpaSessao.php'>Finalizar</a>
                                <?php } ?>
                            </div>
                            <br>
                        </div>
                    </div>   
                </div>
            </div>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>
        <script>
                                $('#bl1').addClass('itemLaranja');
                                $('#bl1').addClass('ativo');
                                $('#bl1').removeClass('item');
                                $('#bl2').addClass('itemVerde');
                                $('#bl2').addClass('ativo');
                                $('#bl2').removeClass('item');
                                $('#bl3').addClass('itemRoxo');
                                $('#bl3').addClass('ativo');
                                $('#bl3').removeClass('item');
                                $('#bl4').addClass('itemAzul');
                                $('#bl4').addClass('ativo');
                                $('#bl4').removeClass('item');
                                $('#bl5').addClass('itemCinza');
                                $('#bl5').addClass('marrom');
                                $('#bl5').removeClass('item');
                                $('#bl6').addClass('itemCinza');
                                $('#bl6').addClass('amarelo');
                                $('#bl6').removeClass('item');
                                $('#bl7').addClass('itemCinza');
                                $('#bl7').addClass('oliva');
                                $('#bl7').removeClass('item');
                                $('#bl8').addClass('itemCinza');
                                $('#bl8').addClass('t');
                                $('#bl8').removeClass('item');
                                $('#bl9').addClass('itemCinza');
                                $('#bl9').addClass('verde-azulado');
                                $('#bl9').removeClass('item');
        </script>
    </body>
</html>
