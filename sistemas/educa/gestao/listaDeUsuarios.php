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

if($_SESSION['usuario']['permissoes'][10][1] != 1){
    header('Location: index.php');
}

include 'fnc/buscaUsuarios.php';
$usuarios = buscaUsuarios();
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
          <?php include 'shared/barraTopo.php';?>
          <div class='conteudo' style='min-height: 500px;'>
            <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                <h2 style='font-size:30px;'>Lista de Usuários</h2>
                <?php
                if (isset($_GET['ativado'])) {
                    if ($_GET['ativado'] == 'true') {
                        ?>
                        <div class='sucesso'>
                            <strong>Sucesso!</strong> Usuário ativado com sucesso. 
                        </div>
                        <?php
                    } else {
                        if ($_GET['ativado'] == 'lim') {
                            ?>
                            <div class='erro'>
                                <strong>Erro!</strong> Limite máximo de executores para esta UE já foi atingido.
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class='erro'>
                                <strong>Erro!</strong> Usuário não pode ser ativado.
                            </div>
                            <?php
                        }
                    }
                }
                ?>
                <?php
                if (isset($_GET['desativado'])) {
                    if ($_GET['desativado'] == 'true') {
                        ?>
                        <div class='sucesso'>
                            <strong>Sucesso!</strong> Usuário desativado com sucesso. 
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class='erro'>
                            <strong>Erro!</strong> Usuário não pode ser desativado.
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <hr>
            <div class="row-fluid">
                <div class="span12" style='padding: 20px; padding-top: 0px;'>
                    <?php if(isset($_GET['alterado'])){ ?>
                    <div class='sucesso'>
                        <strong>Sucesso!</strong> Senha alterada para 'pmf' com sucesso para o usuário #<?php echo $_GET['alterado'];?>.
                    </div>
                    <?php } ?>

                    <?php if (isset($usuarios)) { ?>
                    <div id='escolas' style='display: inherit;'>
                        <h4>Usuários</h4>
                        <table class='table table-striped table-bordered' id='tabelaEscolas'>
                            <thead>
                                <tr>
                                    <td style='width: 50px;'>#</td>
                                    <td>Nome</td>
                                    <td>Escola Vinculada</td>
                                    <td style='width: 90px;'>Usuário</td>
                                    <td style='width: 110px;'>Tipo</td>
                                    <td style='width: 40px;'>Ativo</td>
                                    <td>Ações</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $aspa = "'";
                                foreach ($usuarios as $key => $value) {
                                    echo '<tr>';
                                    echo '<td style="width: 50px;">';
                                    echo $value[0];
                                    echo '</td>';
                                    echo '<td>';
                                    echo ($value[2]);
                                    echo '</td>';
                                    echo '<td>';
                                    echo ($value[6]);
                                    echo '</td>';
                                    echo '<td style="width: 90px;">';
                                    echo ($value[1]);
                                    echo '</td>';
                                    echo '<td style="width: 110px;">';
                                    echo ($value[3]);
                                    echo '</td>';
                                    echo '<td style="width: 110px;">';
                                    if($value[7] == 1){
                                        echo 'Sim';
                                    } else {
                                        echo 'Não   ';
                                    };
                                    echo '</td>';
                                    echo '<td style="width: 50px;">';
                                    if($value[7] == 1){
                                        echo '<a href="desativarUsuario.php?idPessoa='.$value[0].'"><i class="icon-remove" title="Desativar"></i></a>';
                                    } else {
                                        echo '<a href="ativarUsuario.php?idPessoa='.$value[0].'"><i class="icon-ok" title="Ativar"></i></a>';
                                    };
                                    echo '&nbsp;';
                                    echo '<a href="resetarSenha.php?idUsuario='.$value[0].'"><i class="icon-refresh" title="Reiniciar Senha"></i></a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <hr>
                        <a class='btn pull-right' href='manutencaoUsuarios.php'>Voltar</a>
                    </div>
                    <?php } ?>

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
