<?php
session_name('ma');
session_start();
if (!isset($_SESSION['escola']['novaEscola']['vaga'])) {
    header('Location: dadosEscolares.php');
} else {

}

include 'fnc/buscaInscricao.php';

if (count($_POST)) {
    $_SESSION['escola']['novaEscola']['id_escola'] = $_POST['escola'];
    $_SESSION['escola']['novaEscola']['ano'] = $_POST['anoNova'];
    $_SESSION['escola']['novaEscola']['motivo'] = $_POST['motivo'];
    header("Location: intencao.php");
}

include_once 'fnc/buscaEscolasComVaga.php';
if ($_SESSION['escola']['novaEscola']['vaga'] == false){
    $escolasComVaga = buscaEscolasComVaga($_SESSION['periodo_ano'], $_SESSION['id_periodo'], $_SESSION['escola']['novaEscola']['ano']);
    if($escolasComVaga == false){
        header("Location: confirmacaoIntencao.php");
    }
}

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
          <style>
            .controls {
                text-align: left;
                padding-left: 40px;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo'>
                <div class='row-fluid' style='text-align: center; height: 90px;'>
                    <div style='text-align: center; padding-top: 15px;'>
                        <h3>Confirmação de Matrícula</h3>
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
                        <?php if ($_SESSION['escola']['novaEscola']['vaga'] == true) { ?>
                        <div id = "vagaAlocada">
                            <h5><strong>Parabéns!</strong> Você conseguiu uma vaga na unidade escolhida.</h5>
                            <h4>Anote o seu número de inscrição: <?php echo buscaInscricao($_SESSION['aluno']['id'])[0]; ?> </h4>
                            <p>Guarde este número. Ele é de extrema importância.</p>
                            <bold>Não esqueça de que, para efetivar essa matrícula, a documentação do aluno deverá ser 
                                apresentada na Unidade Educativa pleiteada até o dia 12/02/2014, conforme estabelecido 
                                na Portaria nº 160/2013.</bold>
                                <p><strong>Importante! </strong>A vaga só será confirmada ao término de todo o preenchimento do cadastro do aluno.</p>
                                <a class = 'btn btn-primary' href = 'outrosDados.php'>Continuar Cadastro</a>
                            </div>
                            <form class="form-horizontal" method="post">
                            </div>                           
                            <br>
                            <?php
                        } else {
                            ?>
                            <h4>Por favor, anote o seu número de inscrição: <?php echo buscaInscricao($_SESSION['aluno']['id'])[0]; ?> </h4>
                            <p>Guarde este número. Ele é de extrema importância.</p>
                            <h5>As vagas para a escola pretendida estão esgotadas. Você poderá solicitar uma vaga numa das escolas abaixo relacionadas.</h5>
                            <?php include_once 'fnc/buscaEscolasComVaga.php';
                            $escolasComVaga = buscaEscolasComVaga($_SESSION['periodo_ano'], $_SESSION['id_periodo'], $_SESSION['escola']['novaEscola']['ano']);
                            if($escolasComVaga != false){
                                ?>
                                <form action='outraEscola.php' method='post'>
                                    <select name='novaEscola' size='5'>
                                        <?php
                                        foreach ($escolasComVaga as $key => $value) {
                                            ?>
                                            <option value='<?php echo $value[0]; ?>'><?php echo ($value[1]); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <?php ?>
                                    <a class='btn' href="confirmacaoIntencao.php">Nenhuma</a>
                                    <button class='btn btn-primary' href="outraEscola.php">Selecionar Escola</button>
                                </form>
                                <hr>
                                <a class='btn btn-primary' href='limpaSessao.php'>Finalizar</a>
                                <?php } else {
                                }
                            } ?>
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
    <script type="text/javascript">
        function setCaretPosition(elemId, caretPos) {
            var elem = document.getElementById(elemId);

            if (elem != null) {
                if (elem.createTextRange) {
                    var range = elem.createTextRange();
                    range.move('character', caretPos);
                    range.select();
                }
                else {
                    if (elem.selectionStart) {
                        elem.focus();
                        elem.setSelectionRange(caretPos, caretPos);
                    }
                    else
                        elem.focus();
                }
            }
        }
    </script>
    <script type="text/javascript">
        function buscaMunicipio(id_estado, id_elemento) {
            id_elemento = '#' + id_elemento.toString();
            if (id_estado != '') {
                $.get("ajax/municipios.php", {id_estado: id_estado})
                .done(function(data) {
                    $(id_elemento).html(data);
                    $(id_elemento).removeAttr('disabled');
                });
            } else {
                $(id_elemento).html("<select></select>");
                $(id_elemento).attr('disabled', '');
            }
        }

    </script>
    <script type="text/javascript">
        function buscaFases(curso, escola, id_periodo, periodo_ano, id_elemento) {
            id_elemento = '#' + id_elemento.toString();
            if (curso != '' && escola != '' && id_periodo != '' && periodo_ano != '') {
                $.get("ajax/fases.php", {curso: curso, escola: escola, id_periodo: id_periodo, periodo_ano: periodo_ano})
                .done(function(data) {
                    $(id_elemento).html(data);
                    $(id_elemento).removeAttr('disabled');
                });
            } else {
                $(id_elemento).html("");
                $(id_elemento).attr('disabled', '');
            }
        }

    </script>

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
