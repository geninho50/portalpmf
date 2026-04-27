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
include 'fnc/buscaInscritosInfantil.php';
if (isset($_GET['escola'])) {
    if (isset($_GET['ano'])) {
        if (isset($_GET['fase'])) {
            if (($_GET['escola'] == 0) && ($_GET['ano'] == 0) && ($_GET['fase'] == 0)) {
                $matriculados = buscaInscritosInfantil(2);
            } else {
                if (($_GET['escola'] == 0) && ($_GET['ano'] != 0) && ($_GET['fase'] != 0)) {
                    $matriculados = buscaInscritosInfantilAF($_GET['ano'], $_GET['fase'], 2);
                } else {
                    if (($_GET['escola'] != 0) && ($_GET['ano'] == 0) && ($_GET['fase'] != 0)) {
                        $matriculados = buscaInscritosInfantilIF($_GET['escola'], $_GET['fase'], 2);
                    } else {
                        if (($_GET['escola'] != 0) && ($_GET['ano'] != 0) && ($_GET['fase'] == 0)) {
                            $matriculados = buscaInscritosInfantilIA($_GET['escola'], $_GET['ano'], 2);
                        } else {
                            if (($_GET['escola'] != 0) && ($_GET['ano'] == 0) && ($_GET['fase'] == 0)) {
                                $matriculados = buscaInscritosInfantilI($_GET['escola'], 2);
                            } else {
                                if (($_GET['escola'] == 0) && ($_GET['ano'] != 0) && ($_GET['fase'] == 0)) {
                                    $matriculados = buscaInscritosInfantilA($_GET['ano'], 2);
                                } else {
                                    if (($_GET['escola'] == 0) && ($_GET['ano'] == 0) && ($_GET['fase'] != 0)) {
                                        $matriculados = buscaInscritosInfantilF($_GET['fase'], 2);
                                    } else {
                                        if (($_GET['escola'] != 0) && ($_GET['ano'] != 0) && ($_GET['fase'] != 0)) {
                                            $matriculados = buscaInscritosInfantilIAF($_GET['escola'], $_GET['ano'], $_GET['fase'], 2);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

include 'fnc/buscaEscolas.php';
$escolas = buscaEscolasInfantil();

include 'fnc/buscaPeriodos.php';
$anos = buscaPeriodos();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Pesquisar Alunos</title>
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
                    <h2 style='font-size:30px;'>Lista de Inscritos em Intenção (Ordem Alfabética)</h2>
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
                        <form>
                            <label style='display: inline;'> Escola:
                                <select id='inputEscola' name='escola' style='margin-bottom: 0px;' required>
                                    <option id='opt1'></option>
                                    <option value='0' <?php
                                    if (isset($_GET['escola'])) {
                                        if ($_GET['escola'] == 0) {
                                            echo 'selected';
                                        }
                                    } else {
                                        echo 'selected';
                                    }
                                    ?>>Todas</option>
                                    <?php
                                    foreach ($escolas as $key => $value) {
                                        if (isset($_GET['escola'])) {
                                            if ($_GET['escola'] == $value[0]) {
                                                echo '<option value="' . $value[0] . '" selected>' . ($value[1]) . '</option>';
                                            } else {
                                                echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                                            }
                                        } else {
                                            echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </label>
                            <label style='display: inline;'> Ano:
                                <select id='inputAno' name='ano' style='margin-bottom: 0px; width: 150px;' required>
                                    <option id='opt2'></option>
                                    <option value='0' <?php
                                    if (isset($_GET['ano'])) {
                                        if ($_GET['ano'] == 0) {
                                            echo 'selected';
                                        }
                                    } else {
                                        echo 'selected';
                                    }
                                    ?>>Todos</option>
                                    <?php
                                    foreach ($anos as $key => $value) {
                                        if (isset($_GET['ano'])) {
                                            if ($_GET['ano'] == $value[0]) {
                                                echo '<option value="' . $value[0] . '" selected>' . $value[0] . '</option>';
                                            } else {
                                                echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="' . $value[0] . '">' . $value[0] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </label>
                            <label style='display: inline;'> Etapa:
                                <select id='inputFases' name='fase' style='margin-bottom: 0px;' required>
                                    <option id='opt3'></option>
                                    <option value='0' <?php
                                    if (isset($_GET['fase'])) {
                                        if ($_GET['fase'] == 0) {
                                            echo 'selected';
                                        }
                                    } else {
                                        echo 'selected';
                                    }
                                    ?>>Todos</option>
                                    <?php
                                    foreach ($fasesF as $key => $value) {
                                        if (isset($_GET['fase'])) {
                                            if ($_GET['fase'] == $value[0]) {
                                                echo '<option value="' . $value[0] . '" selected>' . ($value[1]) . '</option>';
                                            } else {
                                                echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                                            }
                                        } else {
                                            echo '<option value="' . $value[0] . '">' . ($value[1]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </label>
                            <h5 id='semFase' style='display: none;'>Escola não possui fases no ano escolhido.</h5>

                            <button class='btn btn-primary'>Avançar</button>
                        </form>
                        <div id='matriculados' style='display: inherit;'>
                            <h4>Alunos Inscritos em Intenção</h4>
                            <table class='table table-striped table-bordered' id='tabela'>
                                <thead>
                                    <tr>
                                        <td style='width: 50px;'># Matrícula</td>
                                        <td>Nome</td>
                                        <td>Dt. Nasc.</td>
                                        <td>Fase</td>
                                        <td>Opção</td>
                                        <td style='width: 50px;'>Ações</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $aspa = "'";
                                    if (isset($matriculados)) {
                                        if ($matriculados != false) {
                                            foreach ($matriculados as $key => $value) {
                                                echo '<tr>';
                                                echo '<td style="width: 70px;">';
                                                echo $value[5];
                                                echo '</td>';
                                                echo '<td>';
                                                echo ($value[4]);
                                                echo '</td>';
                                                echo '<td>';
                                                $data = explode('-', $value[6]);
                                                echo $data[2].'/'.$data[1].'/'.$data[0];
                                                echo '</td>';
                                                echo '<td style="width: 100px;">';
                                                echo ($fasesF[$value[3]][1]);
                                                echo '</td>';
                                                echo '<td style="width: 50px;">';
                                                if($value[1] == 1){
                                                    echo 'Primeira';
                                                } else {
                                                    echo 'Segunda';
                                                }
                                                echo '</td>';
                                                echo '<td style="width: 60px;">';
                                                echo '<a href="visualizarAlunoInfantil.php?idAluno='.$value[0].'"><i style="color: blue;" class="iconic-magnifying-glass"></i></a>';
                                                //if(($value[2] == $_SESSION['usuario']['id_escola']) || ($_SESSION['usuario']['id_escola'] == null)){
                                                
                                                if($_SESSION['usuario']['perfil'] != 14) {
                                                    if($_SESSION['usuario']['perfil'] != 13) {
                                                        if ($_SESSION['usuario']['nome_usuario'] != '01902288859') { 
                                                            echo '&nbsp;';
                                                            echo '<a href="editarAlunoInfantil.php?idAluno='.$value[0].'"><i style="color: blue;" class="iconic-pen-alt2"></i></a>';
                                                        }
                                                    }
                                                }
                                                //}
                                                echo '&nbsp;'; 
                                                echo '<a title="Ocorrências" href="ocorrencias.php?idAluno=' . $value[0] . '"><i class="iconic-book" style="color: orange"></i></a>';
                                                echo '</td>';
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
                "aaSorting": [[ 1, "asc" ]],
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
