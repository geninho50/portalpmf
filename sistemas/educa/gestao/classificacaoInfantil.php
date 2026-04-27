<?php
session_name('ga');
session_start();

//EXPIRA A SESSAO SE NAO HOUVE ATIVIDADE NOS ULTIMOS 30 MINUTOS
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['aut_gm'])) {
    if ($_SESSION['aut_gm'] != true) {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
include 'fnc/buscaEscolasComLista.php';
$escolas = buscaEscolasComListaInfantil();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Classificação - Infantil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/dt_bootstrap.css" rel="stylesheet">
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
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Classificação - Infantil</h1>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <?php if ($_SESSION['usuario']['nome_usuario'] != '00871781921') { ?>
                            <h3>Classificação Intenção Completa</h3>
                            <form action="relatorios/gerarClassificacaoListaIntencaoInfantil.php">
                                <label>Unidade Escolar: </span>
                                    <select name='idEscola'>
                                    <option value='0'>Todas Unidades</option>
                                        <?php 
                                        if(isset($_SESSION['usuario']['id_escola'])){
                                            include_once 'fnc/buscaEscola.php';
                                            $escola = buscaEscola($_SESSION['usuario']['id_escola']);
                                            ?>
                                            <option value='<?php echo $escola[1][0]; ?>'><?php echo $escola[1][1]; ?></option>
                                            <?php
                                        } else {
                                            foreach ($escolas as $key => $value) {
                                                ?>
                                                <option value='<?php echo $value[0]; ?>'><?php echo $value[1]; ?></option>
                                                <?php
                                            } 
                                        }
                                        ?>

                                    </select>
                                    <button class='btn btn-primary' style='margin-bottom: 10px;'>Gerar</button>
                                </label>
                            </form>
                            <?php } ?>
                            <h3>Classificação Intenção Simples (Sem dados sigilosos)</h3>
                            <form action="relatorios/gerarClassificacaoListaIntencaoInfantilSimples.php">
                                <label>Unidade Escolar: </span>
                                    <select name='idEscola'>
                                        <?php 
                                        if(isset($_SESSION['usuario']['id_escola'])){
                                            include_once 'fnc/buscaEscola.php';
                                            $escola = buscaEscola($_SESSION['usuario']['id_escola']);
                                            ?>
                                            <option value='<?php echo $escola[1][0]; ?>'><?php echo $escola[1][1]; ?></option>
                                            <?php
                                        } else {
                                            foreach ($escolas as $key => $value) {
                                                ?>
                                                <option value='<?php echo $value[0]; ?>'><?php echo $value[1]; ?></option>
                                                <?php
                                            } 
                                        }
                                        ?>

                                    </select>
                                    <button class='btn btn-primary' style='margin-bottom: 10px;'>Gerar</button>
                                </label>
                            </form>

                            <h3>Lista de atendidos</h3>
                            <form action="relatorios/gerarRelatorioAlunosAtendidosInfantil.php">
                                <label>Unidade Escolar: </span>
                                    <select name='idEscola'>
                                    <option value='0'>Todas Unidades</option>
                                        <?php 
                                        if(isset($_SESSION['usuario']['id_escola'])){
                                            include_once 'fnc/buscaEscola.php';
                                            $escola = buscaEscola($_SESSION['usuario']['id_escola']);
                                            ?>
                                            <option value='<?php echo $escola[1][0]; ?>'><?php echo $escola[1][1]; ?></option>
                                            <?php
                                        } else {
                                            foreach ($escolas as $key => $value) {
                                                ?>
                                                <option value='<?php echo $value[0]; ?>'><?php echo $value[1]; ?></option>
                                                <?php
                                            } 
                                        }
                                        ?>

                                    </select>
                                    <button class='btn btn-primary' style='margin-bottom: 10px;'>Gerar</button>
                                </label>
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
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
        
    </body>
    </html>
