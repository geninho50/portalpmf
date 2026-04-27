<?php
session_name('re');
session_start();

if (isset($_SESSION['autenticado_rematricula']))
    
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" CONTENT="NO-CACHE">
        <title>SGE &middot; Opções</title>
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
<br>
                        <h2>Bem vindo Aluno!</h2>
                        <img src="img/lapis.png" style="
                             width: 470px; position:relative; top: -60px; left: -25px;">
                    </div>
                </div>
<br><br>
                <div class='row-fluid' style='text-align: center;'>

                    <div>
                        <a class="botaoGrande" href='identificacaoRematricula.php?curso=1&ano=2014&periodo=1&tipoMatricula=1'>Realizar Rematrícula</a>
                    </div>
                    <br>
                    <br>                    
                    <?php 
                    include 'fnc/verificaRematricula.php';
                    if(verificaRematricula($_SESSION['id'])){ ?>
                    <div>
                        <a class="botaoGrande" href='relatorios/emitir2.php'>Emitir Comprovante</a>
                    </div>
                    <?php } ?>
<!--                    <div>
                        <a class="botaoGrande" href='' style="display: none;">Alterar Intenção de Matrícula</a>
                    </div>-->
                    <br>
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
