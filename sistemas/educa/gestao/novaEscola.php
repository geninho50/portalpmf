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

include 'fnc/buscaTiposEscolas.php';
$tiposEscola = buscaTiposEscolas();

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
                    <h2 style='font-size:30px;'>Manutenção de Escolas</h1>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <div id='novaEscola'>
                                <h4>Nova Escola</h4>
                                <?php
                                            if (isset($_GET['sucesso'])) {
                                                if ($_GET['sucesso'] == true) {
                                                    ?>
                                                    <div class='sucesso'>
                                                        <strong>Sucesso!</strong> Escola criada com sucesso. <a class='btn btn-success' href='listaDeEscolas.php'>Visualizar</a>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class='erro'>
                                                        <strong>Erro!</strong> Um erro ocorreu, tente novamente. <a class='btn btn-success' href='listaDeEscolas.php'>Visualizar</a>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                <form action='criarEscola.php' method="post">
                                    <label>Nome da Nova Escola:
                                        <input style='width: 400px;' name='nomeEscola' type='text' maxlength="100" placeholder='Máximo de 100 caracteres' required=""/>
                                    </label>
                                    <label>Tipo da Nova Escola:
                                        <select name='tipoEscola'>
                                            <?php foreach ($tiposEscola as $key => $value) { ?>
                                            <option value='<?php echo ($value[0]); ?>'><?php echo ($value[1]); ?></option>
                                            <?php } ?>
                                        </select>
                                    </label>
                                    <?php if (isset($erro['novaEscolaJaExiste'])) { ?>
                                    <div class='erro' style='text-align: center; width: 300px;'>
                                        <strong>Erro!</strong> Nome de escola já está sendo utilizado.
                                    </div>
                                    <?php } ?>
                                    <button class='btn btn-primary pull-right'>Criar</button>
                                    <a class='btn pull-right' href='manutencaoEscolas.php' style='margin-right: 5px;'>Voltar</a>
                                </form>
                            </div>

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
                            <input name='idEscolaExcluir' type='hidden' id='inputIdPerfil'>
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
            function passarInfoPerfil(id, nome) {
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
