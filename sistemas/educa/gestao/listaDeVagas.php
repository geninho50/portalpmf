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
include 'fnc/buscaFases.php';
$fases = buscaFases(1);

include 'fnc/buscaPeriodos.php';
$anos = buscaPeriodos();

include 'fnc/buscaVagasFundamental.php';
if (isset($_GET['ano'])) {
    $vagas = buscaVagasFundamental($_GET['ano']);
} else {
    $vagas = buscaVagasFundamental(date('Y'));
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Lista de Vagas</title>
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
                    <h2 style='font-size:30px;'>Lista de Vagas</h1>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <form>
                            <label style='display: inline;'> Ano:
                                <select name='ano' style='margin-bottom: 0px;'>
                                    <?php
                                    foreach ($anos as $key => $value) {
                                        if (isset($_GET['ano'])) {
                                            if ($_GET['ano'] == $value[0]) {
                                                echo '<option selected>' . $value[0] . '</option>';
                                            } else {
                                                echo '<option>' . $value[0] . '</option>';
                                            }
                                        } else {
                                            echo '<option>' . $value[0] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </label>

                            <button class='btn btn-primary' style='display: inline;'>Avançar</button>
                        </form>

                        <?php if (isset($vagas)) { ?>
                            <div id='vagas' style='display: inherit;'>
                                <h4>Vagas</h4>
                                <table class='table table-striped table-bordered' id='tabela'>
                                    <thead>
                                        <tr>
                                            <td style='width: 50px;'>#</td>
                                            <td>Nome</td>
                                            <td style='width: 50px;'>Fase</td>
                                            <td style='width: 50px;'>Tipo Vaga</td>
                                            <td title='Quantidade'>Qtd</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aspa = "'";
                                        foreach ($vagas as $key => $value) {
                                            if ($value[2] == 1) {
                                                $tipo = 'Novo Aluno';
                                            } else {
                                                if ($value[2] == 2) {
                                                    $tipo = 'Rematrícula';
                                                } else {
                                                    $tipo = 'Reserva';
                                                }
                                            }
                                            echo '<tr>';
                                            echo '<td>';
                                            echo $value[0];
                                            echo '</td>';
                                            echo '<td>';
                                            echo ($value[1]);
                                            echo '</td>';
                                            echo '<td>';
                                            echo $fases[$value[3]][1];
                                            echo '</td>';
                                            echo '<td>';
                                            echo $tipo;
                                            echo '</td>';
                                            echo '<td>';
                                            echo $value[4];
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        <?php
                        }
                        if (count($vagas) == 0) {
                            echo '<h3>Não existem registros para os filtros selecionados.</h4>';
                        }
                        ?>
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
