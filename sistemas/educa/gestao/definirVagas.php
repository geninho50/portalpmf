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

if($_SESSION['usuario']['nome_usuario'] != '00008822913' && $_SESSION['usuario']['nome_usuario'] != '03292781930' && $_SESSION['usuario']['id'] != '2'){
    header('Location: opcoes.php');
}

include 'fnc/buscaEscolas.php';
$escolas = buscaEscolasFundamental();

include 'fnc/buscaPeriodos.php';
$anos = buscaPeriodos();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(1);

if (isset($_GET['escola'])) {
    if (isset($_GET['ano'])) {
        if (isset($_GET['fase'])) {
            $quadro = true;
            include 'fnc/buscaQtdRematricula.php';
            $qtd = buscaQtdRematricula(1, $_GET['ano'], $_GET['fase'], $_GET['escola']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Quadro de Vagas</title>
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
                    <h2 style='font-size:30px;'>Definir Novas Vagas</h1>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <?php
                        if (isset($_GET['sucesso'])) {
                            if ($_GET['sucesso'] == true) {
                                ?>
                                <div class='sucesso'>
                                    <strong>Sucesso!</strong> Vagas criadas com sucesso. 
                                    <a class='btn btn-success' href='listaDeVagas.php'>Visualizar</a>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class='erro'>
                                    <strong>Erro!</strong> Um erro ocorreu, tente novamente.
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <form style="width: 360px;">
                            <label> Escola:
                                <select id='inputEscola' name='escola' style='margin-bottom: 0px;' required 
                                        onchange="if ($(this).val() != '') {
                                                    $('#opt1').remove();
                                                    $('#inputAno').removeAttr('disabled');
                                                    $('#opt2').attr('selected', '');
                                                    $('#inputFase').attr('disabled', '');
                                                }">
                                    <option id='opt1'></option>
                                    <?php
                                    foreach ($escolas as $key => $value) {
                                        echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                            <label> Ano:
                                <select id='inputAno' disabled name='ano' style='margin-bottom: 0px;' required
                                        onchange='$.get("ajax/fasesCAE.php", {curso: 1, ano: $(this).val(), escola: $("#inputEscola").val()})
                                                        .done(function(data) {
                                                    $("#inputFases").html(data);
                                                    $("#inputFases").removeAttr("disabled");
                                                });'>
                                    <option id='opt2'></option>
                                    <?php
                                    foreach ($anos as $key => $value) {
                                        echo '<option>' . $value[0] . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                            <label> Etapa:
                                <select id='inputFases' disabled name='fase' style='margin-bottom: 0px;' required>
                                    <?php
                                    foreach ($fases as $key => $value) {
                                        echo '<option>' . ($value[1]) . '</option>';
                                    }
                                    ?>
                                </select>
                            </label>
                            <h5 id='semFase' style='display: none;'>Escola não possui fases no ano escolhido.</h5>

                            <button class='btn btn-primary'>Avançar</button>
                        </form>

                        <?php if (isset($quadro)) {
                            if ($quadro) {
                                ?>

                                <hr>
                                <h5><strong style='font-size: 16px;'>Escola:</strong> <?php if (isset($_GET['escola'])) {
                            echo ($escolas[$_GET['escola']][1]);
                        } ?></h5>
                                <h5><strong style='font-size: 16px;'>Ano:</strong> <?php if (isset($_GET['ano'])) {
                            echo ($anos[$_GET['ano']][0]);
                        } ?></h5>
                                <h5><strong style='font-size: 16px;'>Etapa:</strong> <?php if (isset($_GET['fase'])) {
                            echo ($fasesF[$_GET['fase']][1]);
                        } ?></h5>
                                <form id='form' action="criarVagas.php" method="post" onsubmit="$('#inputAlunosNovos').removeAttr('disabled');">
                                    <input type='hidden' value="<?php if (isset($_GET['escola'])) {
                            echo $_GET['escola'];
                        } ?>" name="escola">
                                    <input type='hidden' value="<?php if (isset($_GET['ano'])) {
                            echo $_GET['ano'];
                        } ?>" name="ano">
                                    <input type='hidden' value="<?php if (isset($_GET['fase'])) {
                            echo $_GET['fase'];
                        } ?>" name="fase">
                                    <label>Número de turmas:
                                        <input type='number' id='inputTurmas' min='1' required
                                               onchange="$('#inputTotal').val($('#inputTurmas').val() * $('#inputVagasTurma').val());
                                               $('#inputAlunosNovos').val($('#inputTotal').val() - $('#inputRematricula').val());">
                                    </label>
                                    <label>Vagas por turma:
                                        <input type='number' id='inputVagasTurma' min='1' required 
                                               onchange="$('#inputTotal').val($('#inputTurmas').val() * $('#inputVagasTurma').val());
                                                        $('#inputAlunosNovos').val($('#inputTotal').val() - $('#inputRematricula').val());">
                                    </label>
                                    <label>Total de Vagas:
                                        <input type='number' id='inputTotal' min='1' disabled required>
                                    </label>
                                    <label>Vagas de Rematrícula:
                                        <input type='number' id='inputRematricula' name='rematricula' min='1' required disabled
                                               value='<?php
                        if (isset($qtd)) {
                            echo $qtd;
                        }
                        ?>'
                                               >
                                    </label>
                                    <label>Vagas Alunos Novos:
                                        <input type='number' id='inputAlunosNovos' name='matricula' min='1' disabled required>
                                    </label>
                                    <a class='btn btn-primary' href="#confirmaCriarVagas" role="button" data-toggle="modal">Criar Vagas</a>
                                </form>

                                <div id="confirmaCriarVagas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3 id="myModalLabel">Criar Vagas</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p>Se estiver entrando um valor menor de vagas do que a quantidade já existente de vagas, as vagas NÃO PREENCHIDAS excedentes serão removidas.</p>
                                        <p>Você tem certeza que deseja criar estas vagas?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Voltar</button>
                                        <button class="btn btn-primary" onclick="$('#form').submit();">Criar Vagas</button>
                                    </div>
                                </div>

    <?php }
}
?>
                        <hr>
                        <a class='btn pull-right' href='quadroDeVagas.php'>Voltar</a>

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
        <script src="js/dt_bootstrap.js"></script>
        <script>

                                            $('#tabela').dataTable({
                                                "oLanguage": {
                                                    "sSearch": "Buscar:",
                                                    "oPaginate": {
                                                        "sNext": "Próxima",
                                                        "sPrevious": "Anterior"
                                                    },
                                                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                                                    "sZeroRecords": "Nenhum registro encontrado...",
                                                    "sInfo": "Mostrando _START_ até _END_ de _TOTAL_ registros",
                                                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                                                    "sInfoFiltered": "(filtrado de _MAX_ registros)"
                                                }
                                            });
        </script>
    </body>
</html>
