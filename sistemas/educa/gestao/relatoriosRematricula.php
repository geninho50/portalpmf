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

if($_SESSION['usuario']['permissoes'][12][1] != 1){
    header('Location: index.php');
}

include 'fnc/buscaEscolas.php';
$escolas = buscaEscolasFundamental();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Relatórios de Rematrícula</title>
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
                    <h2 style='font-size:30px;'>Relatórios de Rematrícula</h2>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <h4>Relatórios com Filtros (Escola/Etapa)</h4>
                        <h5>Relatório de Alunos Rematriculados e Efetivados (1&ordm; Ano, 5&ordm; Ano, 6&ordm; Ano)</h5>
                        <form action="relatorios/geraRelatorioAlunosEfetivados1-5-6Filtros.php">
                            <label style='display: inline;'> Escola:
                                <select id='inputEscola' name='escola' style='margin-bottom: 0px;' required 
                                onchange="if ($(this).val() != '') {
                                $('#opt1').remove();
                                $('#inputFases').removeAttr('disabled');
                            }">
                            <option id='opt1'></option>
                            <?php
                            foreach ($escolas as $key => $value) {
                                echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                            }
                            ?>
                        </select>
                    </label>
                    <label style='display: inline;'> Etapa:
                        <select id='inputFases' disabled name='fase' style='margin-bottom: 0px;' required>
                            <?php
                            foreach ($fasesF as $key => $value) {
                                if($key == 1 or $key == 5 or $key == 6)
                                    echo '<option value="'.$key.'">' . ($value[1]) . '</option>';
                            }
                            ?>
                        </select>
                    </label>

                    <button class='btn btn-primary'>Gerar</button>
                </form>
                <h5>Relatório de Alunos Rematriculados mas não Efetivados (1&ordm; Ano, 5&ordm; Ano, 6&ordm; Ano)</h5>
                <form action="relatorios/geraRelatorioAlunosNaoEfetivados1-5-6Filtros.php">
                    <label style='display: inline;'> Escola:
                        <select id='inputEscola' name='escola' style='margin-bottom: 0px;' required 
                        onchange="if ($(this).val() != '') {
                        $('#opt2').remove();
                        $('#inputFases2').removeAttr('disabled');
                    }">
                    <option id='opt2'></option>
                    <?php
                    foreach ($escolas as $key => $value) {
                        echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                    }
                    ?>
                </select>
            </label>
            <label style='display: inline;'> Etapa:
                <select id='inputFases2' disabled name='fase' style='margin-bottom: 0px;' required>
                    <?php
                    foreach ($fasesF as $key => $value) {
                        if($key == 1 or $key == 5 or $key == 6)
                            echo '<option value="'.$key.'">' . ($value[1]) . '</option>';
                    }
                    ?>
                </select>
            </label>

            <button class='btn btn-primary'>Gerar</button>
        </form>

        <h5>Relatório de Não Rematriculados (1&ordm; Ano, 5&ordm; Ano, 6&ordm; Ano)</h5>
        <form action="relatorios/geraRelatorioAlunosNaoRematriculadosFiltros.php">
            <label style='display: inline;'> Escola:
                <select id='inputEscola' name='escola' style='margin-bottom: 0px;' required 
                onchange="if ($(this).val() != '') {
                $('#opt3').remove();
                $('#inputFases3').removeAttr('disabled');
            }">
            <option id='opt3'></option>
            <?php
            foreach ($escolas as $key => $value) {
                echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
            }
            ?>
        </select>
    </label>
    <label style='display: inline;'> Etapa:
        <select id='inputFases3' disabled name='fase' style='margin-bottom: 0px;' required>
            <?php
            foreach ($fasesF as $key => $value) {
                if($key == 1 or $key == 5 or $key == 6)
                    echo '<option value="'.$key.'">' . ($value[1]) . '</option>';
            }
            ?>
        </select>
    </label>

    <button class='btn btn-primary'>Gerar</button>
</form>

<hr>

<h4>Relatórios sem Filtros (Totais)</h4>
<a class='btn btn-primary' style='line-height: 40px; margin-top:5px;' href="relatorios/geraRelatorioAlunosEfetivados1-5-6.php">Relatório de Alunos Rematriculados e Efetivados (1&ordm; Ano, 5&ordm; Ano, 6&ordm; Ano)</a>
<br>
<a class='btn btn-primary' style='line-height: 40px; margin-top:5px;' href="relatorios/geraRelatorioAlunosNaoEfetivados1-5-6.php">Relatório de Alunos Rematriculados mas não Efetivados (1&ordm; Ano, 5&ordm; Ano, 6&ordm; Ano)</a>
<br>
<a class='btn btn-primary' style='line-height: 40px; margin-top:5px;' href="relatorios/geraRelatorioAlunosNaoRematriculados.php">Relatório de Não Rematriculados (1&ordm; Ano, 5&ordm; Ano, 6&ordm; Ano)</a>
<hr>
<a class='btn pull-right' href='opcoes.php'>Voltar</a>



</div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
    </html>
