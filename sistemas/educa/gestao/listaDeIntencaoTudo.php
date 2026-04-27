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

if($_SESSION['usuario']['permissoes'][13][1] != 1){
    header('Location: index.php');
}

include 'fnc/buscaEscolasComLista.php';
$escolas = buscaEscolasComLista();

include 'fnc/buscaPeriodos.php';
$anos = buscaPeriodos();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(1);

include 'fnc/buscaIntencao.php';
$intencao = buscaIntencaoTudo(1, 2014);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Lista de Intenção - Tudo</title>
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
                    <h2 style='font-size:30px;'>Lista de Intenção - Tudo</h1>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>

                            <?php if (isset($intencao)) { ?>
                            <div id='intencao' style='display: inherit;'>
                                <?php
                                if (isset($_GET['sucesso'])) {
                                    if ($_GET['sucesso'] == true) {
                                        ?>
                                        <div class='sucesso'>
                                            <strong>Sucesso!</strong> Aluno removido da lista de intenção com sucesso. 
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
                                ?><?php
                                if (isset($_GET['sucessoA'])) {
                                    if ($_GET['sucessoA'] == 'true') {
                                        ?>
                                        <div class='sucesso'>
                                            <strong>Sucesso!</strong> Aluno atendido com sucesso. 
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class='erro'>
                                            <strong>Erro!</strong> Não existem vagas disponíveis.
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <table class='table table-striped table-bordered' id='tabela'>
                                    <thead>
                                        <tr>
                                            <td style='width: 50px;'># Matrícula</td>
                                            <td>Nome</td>
                                            <td>Escola</td>
                                            <td>Etapa</td>
                                            <td>Pontuação</td>
                                            <td style='width: 50px;'>Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aspa = "'";
                                        if (isset($intencao)) {
                                            if ($intencao != false) {
                                                foreach ($intencao as $key => $value) {
                                                    echo '<tr>';
                                                    echo '<td style="width: 70px;">';
                                                    echo $value[3];
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo ($value[2]);
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo utf8_decode($value[5]);
                                                    echo '</td>';
                                                    echo '<td style="width: 90px;">';
                                                    echo utf8_decode($value[6]);
                                                    echo '</td>';
                                                    echo '<td style="width: 50px;">';
                                                    echo ($value[0]);
                                                    echo '</td>';
                                                    echo '<td style="width: 70px;">';
                                                    // echo '<a title="Atender" href="#modalAtender" role="button" data-toggle="modal"
                                                    // onclick="passarInfo(' . $value[3] . ', ' . $aspa . $value[2] . $aspa . ', ' . $value[1] . ');"
                                                    // ><i class="iconic-check" style="color: green"></i></a>';
                                                    // echo '&nbsp;';                                                    
                                                    // echo '<a title="Ocorrências" href="ocorrencias.php?idAluno=' . $value[4] . '&idVaga='
                                                    // . $value[4] . '"><i class="iconic-plus" style="color: blue"></i></a>';
                                                    // echo '&nbsp;';
                                                    // echo '<a title="Desistir Aluno" href="#modalDesistir" role="button" data-toggle="modal"
                                                    // onclick="passarInfoD(' . $value[3] . ', ' . $aspa . $value[2] . $aspa . ', ' . $value[1] . ');"
                                                    // ><i class="iconic-x" style="color: red"></i></a>';
                                                    // echo '&nbsp;';

                                                    // echo '<a title="Editar Aluno" href="editarAluno.php?idAluno=' .
                                                    // $value[1] . '"><i class="iconic-pen-alt2"></i></a>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <hr>
                                <a class='btn' href='opcoes.php'>Voltar</a>
                            </div>
                            <?php } ?>

                        </div>
                    </div>   
                </div>

                <div id="modalAtender" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="labelModalEfetivar"><strong># Matrícula:</strong> <font id='numeroMatriculaM'></font></h3>
                    </div>
                    <div class="modal-body">
                        <h5>Nome: <font id='nomeAlunoM'></font></h5>
                        <h5>Escola: <?php echo ($escolas[$_GET['escola']][1]); ?></h5>
                        <h5>Ano: <?php echo $anos[$_GET['ano']][0]; ?></h5>
                        <h5>Etapa: <?php echo $fasesF[$_GET['fase']][1]; ?></h5>
                        <p>Tem certeza que você deseja atender este aluno?</p>
                    </div>
                    <div class="modal-footer">
                        <form action='atenderAlunoIntencao.php' method="post">
                            <input name='id_aluno' type='hidden' id='inputIdAlunoM'>
                            <input name='escola' value="<?php echo $_GET['escola']; ?>" type='hidden' id='inputEscolaM'>
                            <input name='ano' value="<?php echo $_GET['ano']; ?>" type='hidden' id='inputAnoM'>
                            <input name='fase' value="<?php echo $_GET['fase']; ?>" type='hidden' id='inputFaseM'>
                            <a class="btn" data-dismiss="modal" aria-hidden="true">Não</a>
                            <button class="btn btn-primary">Sim</button>
                        </form>
                    </div>
                </div>

                <div id="modalDesistir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="labelModalEfetivar"><strong>#</strong> <font id='numeroMatriculaD'></font></h3>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que você deseja desistir o aluno desta matrícula?</p>
                    </div>
                    <div class="modal-footer">
                        <form action='desistirAlunoIntencao.php'>
                            <input name='id_aluno' type='hidden' id='inputIdAlunoD'>
                            <label>Motivo:
                                <select name="motivo" required>
                                    <option></option>
                                    <option value='1'>Aluno já Matriculado na Rede.</option>
                                    <option value='2'>Após 3 tentativas não foi possível contatar o aluno ou a família.</option>
                                    <option value='3'>Aluno/Família requisitou a desistência na unidade.</option>
                                </select>
                            </label>
                            <input name='escola' value="<?php echo $_GET['escola']; ?>" type='hidden' id='inputEscolaD'>
                            <input name='ano' value="<?php echo $_GET['ano']; ?>" type='hidden' id='inputAnoD'>
                            <input name='fase' value="<?php echo $_GET['fase']; ?>" type='hidden' id='inputFaseD'>
                            <a class="btn" data-dismiss="modal" aria-hidden="true">Não</a>
                            <button class="btn btn-primary">Sim</button>
                        </form>
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
                    "bSort": false,
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
        <script type="text/javascript">
            function passarInfo(matricula, nome, id_aluno) {
                $('#numeroMatriculaM').html(matricula);
                $('#nomeAlunoM').html(nome);
                $('#inputIdAlunoM').val(id_aluno);
            }
            function passarInfoD(matricula, nome, id_aluno) {
                $('#numeroMatriculaD').html(matricula);
                $('#nomeAlunoD').html(nome);
                $('#inputIdAlunoD').val(id_aluno);
            }
        </script>
    </body>
    </html>
