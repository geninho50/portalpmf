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
include 'fnc/buscaEscolas.php';
$escolas = buscaEscolas();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Manutenção de Escolas</title>
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
                    <h2 style='font-size:30px;'>Lista de Escolas</h1>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>

                        <?php if (isset($escolas)) { ?>
                            <div id='escolas' style='display: inherit;'>
                                <h4>Escolas</h4>
                                <table class='table table-striped table-bordered' id='tabelaEscolas'>
                                    <thead>
                                        <tr>
                                            <td style='width: 50px;'>#</td>
                                            <td>Nome</td>
                                            <td>Tipo</td>
                                            <td style='width: 50px;'>Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aspa = "'";
                                        foreach ($escolas as $key => $value) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo $value[0];
                                            echo '</td>';
                                            echo '<td>';
                                            echo ($value[1]);
                                            echo '</td>';
                                            echo '<td>';
                                            echo ($value[6]);
                                            echo '</td>';
                                            echo '<td>';
//                                            echo '<a title="Visualizar Escola" href="visualizarEscola.php?idEscola=' . $value[0] . '"><i class="iconic-magnifying-glass"></i></a>';
//                                            echo '&nbsp;';
                                            echo '<a title="Editar Escola" href="editarEscola.php?idEscola=' . $value[0] . '"><i class="iconic-pen-alt2"></i></a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <hr>
                                <a class='btn pull-right' href='manutencaoEscolas.php'>Voltar</a>
                            </div>
                        <?php } ?>

                    </div>
                </div>   
            </div>

            <div id="modalExcluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="labelModalExcluir"><strong>Escola:</strong> <font id='numeroEscola'></font> &middot; <font id='nomeEscola'></font></h3>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que você deseja excluir esta escola?</p>
                </div>
                <div class="modal-footer">
                    <form>
                        <input name='idEscolaExcluir' type='hidden' id='inputIdEscola'>
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
            function passarInfoEscola(id, nome) {
                $('#numeroPerfil').html(id);
                $('#nomePerfil').html(nome);
                $('#inputIdPerfil').val(id);
            }
            function habilitarDiv(elemento) {
                $('#escolas').css('display', 'none');
                $('#novaEscola').css('display', 'none');
                $('#opcoes').css('display', 'none');

                $(elemento).css('display', 'inherit');
            }

            $('#tabelaEscolas').dataTable({
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
