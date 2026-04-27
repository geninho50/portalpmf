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

if($_SESSION['usuario']['permissoes'][5][1] != 1){
    header('Location: index.php');
}


if(isset($_GET['nome']) || isset($_GET['inscricao'])){
    include 'fnc/consultaAluno.php';
    $alunos = consultaAlunoDesistenteIntencao($_GET['nome'], $_GET['inscricao']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Consulta de Alunos Desistentes de Intenção</title>
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
                    <h2 style='font-size:30px;'>Consulta de Alunos Desistentes de Intenção</h2>
                    <h3>Educação Infantil</h3>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <form>
                            <div style='display: inline;'>
                                    <label for='nome' style='display: inline;'>Nome</label>
                                    <input id='nome' style='display: inline;' type='text' name='nome'>
                                    <h4 style='display: inline; padding:10px;'>e/ou</h4>
                                    <label for='inscricao' style='display: inline;'># Matrícula</label>
                                    <input id='inscricao' style='display: inline;' type='number' name='inscricao'>
                                </div>
                                <button class='btn btn-primary' style="margin-top: -10px;">Pesquisar</button>
                            </form>
                            <div id='matriculados' style='display: inherit;'>
                                <h4>Alunos</h4>
                                <table class='table table-striped table-bordered' id='tabela'>
                                    <thead>
                                        <tr>
                                            <td style='font-size:10px;'># Matrícula</td>
                                            <td style='font-size:10px;'>Nome</td>
                                            <td style='font-size:10px;'>Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aspa = "'";
                                        if (isset($alunos)) {
                                            if ($alunos != false) {
                                                foreach ($alunos as $key => $value) {
                                                    echo '<tr>';
                                                    echo '<td style="font-size:12px;">';
                                                    echo $value[1];
                                                    echo '</td>';
                                                    echo '<td style="font-size:12px;">';
                                                    echo $value[2];
                                                    echo '</td>';
                                                    echo '<td style="font-size:12px; width: 42px;">';
                                                    echo '<a href="visualizarSituacao.php?idPessoa='.$value[0].'"><i class="iconic-magnifying-glass" style="color: blue"></i></a>';
                                                    echo '&nbsp;';
                                                    echo '<a href="relatorios/emitirFormCadastroInfantil.php?idAluno='.$value[0].'"><i class="iconic-document-alt-stroke" style="color: green"></i></a>';
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
