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

// if($_SESSION['usuario']['permissoes'][14][1] != 1){
//     header('Location: index.php');
// }

include 'fnc/buscaMatriculados.php';

$matriculados = buscaMatriculadosEJA();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Lista de Rematriculas Realizadas - EJA</title>
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
                    <h2 style='font-size:30px;'>Lista de Rematriculas Realizadas - EJA</h1>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <?php
                            if (isset($_GET['efetivacao'])) {
                                if ($_GET['efetivacao'] == true) {
                                    ?>
                                    <div class='sucesso'>
                                        <strong>Sucesso!</strong> Efetivação realizada com sucesso.
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
                            <div id='matriculados' style='display: inherit;'>
                                <h4>Alunos Matriculados</h4>
                                <table class='table table-striped table-bordered' id='tabela'>
                                    <thead>
                                        <tr>
                                            <td style='width: 50px;'># Matrícula</td>
                                            <td>Nome</td>
                                            <td>Núcleo</td>
                                            <td>Dt. Nasc.</td>
                                            <td style='width: 50px;'>Efetivado</td>
                                            <td style='width: 50px;'>Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aspa = "'";
                                        if (isset($matriculados)) {
                                            if ($matriculados != false) {
                                                foreach ($matriculados as $key => $value) {

                                                    $nucleo = '';

                                                    if($value[9] == 1){
                                                        $nucleo = 'Centro 1';
                                                    } else {
                                                        if($value[9] == 2){
                                                            $nucleo = 'Centro 2';
                                                        } else {
                                                            if($value[9] == 3){
                                                                $nucleo = 'Sul 1';
                                                            } else {
                                                                if($value[9] == 4){
                                                                    $nucleo = 'Sul 2';
                                                                } else {
                                                                    if($value[9] == 5){
                                                                        $nucleo = 'Norte 1';
                                                                    } else {
                                                                        if($value[9] == 6){
                                                                            $nucleo = 'Norte 2';
                                                                        } else {
                                                                            if($value[9] == 7){
                                                                                $nucleo = 'Leste 1';
                                                                            } else {
                                                                                if($value[9] == 8){
                                                                                    $nucleo = 'Leste 2';
                                                                                } else {
                                                                                    if($value[9] == 9){
                                                                                    $nucleo = 'Continente 1';
                                                                                }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }

                                                    echo '<tr>';
                                                    echo '<td style="width: 70px;">';
                                                    echo $value[0];
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo ($value[1]);
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo ($nucleo);
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo ($value[2]);
                                                    echo '</td>';
                                                    echo '<td style="width: 50px;">';
                                                    if ($value[5] == 1) {
                                                        echo "Sim";
                                                    } else {
                                                        echo "Não";
                                                    }
                                                    echo '</td>';
                                                    echo '<td style="width: 70px;">';
                                                    if ($value[5] != 1) {
//                                                    echo '<a title="Efetivar Matrícula" href="#modalEfetivar" role="button" data-toggle="modal"
//                                    onclick="passarInfo(' . $value[0] . ', ' . $aspa . strtoupper(($value[1])) . $aspa . ',' . ($value[6]) . ');"
//                                    ><i class="iconic-check" style="color: green"></i></a>';
//                                                    echo '&nbsp;';
//                                                    echo '<a title="Ocorrências" href="ocorrencias.php?idAluno=' . $value[4] . '&idVaga='
//                                                    . $value[6] . '"><i class="iconic-plus" style="color: blue"></i></a>';
//                                                    echo '&nbsp;';
//                                                    echo '<a title="Desistir Aluno" href="#modalDesistir" role="button" data-toggle="modal"
//                                    onclick="passarInfoD(' . $value[0] . ', ' . $aspa . strtoupper(($value[1])) . $aspa . ',' . ($value[6]) . ');"
//                                    ><i class="iconic-x" style="color: red"></i></a>';
//                                                    echo '&nbsp;';
                                                    }
//                                                echo '<a title="Editar Aluno" href="editarAluno.php?idAluno=' .
//                                                $value[4] . '"><i class="iconic-pen-alt2"></i></a>';
//                                                echo '</td>';
                                                    echo '</tr>';
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <a class='btn' href='opcoes.php'>Voltar</a>
                        </div>
                    </div>   
                </div>

                <div id="modalEfetivar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="labelModalEfetivar"><strong># Matrícula:</strong> <font id='numeroMatriculaM'></font> &middot; <font id='nomeAlunoM'></font></h3>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que você deseja efetivar esta matrícula?</p>
                    </div>
                    <div class="modal-footer">
                        <form action='efetivarAluno.php'>
                            <input name='id' type='hidden' id='inputIdVagaM'>
                            <a class="btn" data-dismiss="modal" aria-hidden="true">Não</a>
                            <button class="btn btn-primary">Sim</button>
                        </form>
                    </div>
                </div>

                <div id="modalDesistir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="labelModalEfetivar"><strong># Matrícula:</strong> <font id='numeroMatriculaD'></font> &middot; <font id='nomeAlunoD'></font></h3>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que você deseja desistir o aluno desta matrícula?</p>
                    </div>
                    <div class="modal-footer">
                        <form action='desistirAluno.php'>
                            <input name='id' type='hidden' id='inputIdVagaD'>
                            <label>Motivo:
                                <select name="motivo" required>
                                    <option></option>
                                    <option value='1'>Aluno não compareceu na unidade até a data limite.</option>
                                    <option value='2'>Após 3 tentativas não foi possível contatar o aluno ou a família.</option>
                                </select>
                            </label>
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
            function passarInfo(matricula, nome, id_vaga) {
                $('#numeroMatriculaM').html(matricula);
                $('#nomeAlunoM').html(nome);
                $('#inputIdVagaM').val(id_vaga);
            }
            function passarInfoD(matricula, nome, id_vaga) {
                $('#numeroMatriculaD').html(matricula);
                $('#nomeAlunoD').html(nome);
                $('#inputIdVagaD').val(id_vaga);
            }
        </script>
    </body>
    </html>
