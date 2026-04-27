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


//if(($_SESSION['usuario']['id'] != 1) || (!$_SESSION['permissoes']['gera']['perfil'])){
//    header('Location: opcoes.php');
//}

include 'fnc/buscaPerfis.php';
$perfis = buscaPerfis();

if (isset($_GET['nomePerfil'])) {
    if ($_GET['nomePerfil'] > 0) {
        include 'fnc/existeNomePerfil.php';
        if (!existeNomePerfil($_GET['nomePerfil'], $perfis)) {
            include 'fnc/criaNovoPerfil.php';
            $resultado = criaNovoPerfil($_GET['nomePerfil']);
        } else {
            $erro['novoPerfilJaExiste'] = true;
        }
    }
}

if (isset($_GET['idPerfilExcluir'])) {
    include 'fnc/excluirPerfil.php';
    $resultado = excluirPerfil($_GET['idPerfilExcluir']);
}

$perfis = buscaPerfis();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SGE &middot; Manutenção de Perfis</title>
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
    </head>

    <body>

        <div class="container">
<?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Manutenção de Perfis</h1>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span3 bs-docs-sidebar" style='padding-left: 10px; padding-right: 10px;'>
                        <ul class="nav nav-list bs-docs-sidenav">
                            <li><a onclick="habilitarDiv('#perfis');"><i class="icon-chevron-right"></i> Perfis</a></li>
                            <li><a onclick="habilitarDiv('#novoPerfil');"><i class="icon-chevron-right"></i> Novo Perfil</a></li>
                            <li style='text-align: right;'><a href="opcoes.php"></i> Voltar</a></li>
                        </ul>
                    </div>
                    <div class="span10" style='padding: 20px; padding-top: 0px;'>
                        <?php if (isset($perfis)) { ?>
                            <div id='perfis'>
                                <h4>Perfis</h4>
                                <table class='table'>
                                    <thead>
                                        <tr>
                                            <td style='width: 50px;'>#</td>
                                            <td>Nome</td>
                                            <td style='width: 50px;'>Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $aspa = "'";
                                        foreach ($perfis as $key => $value) {
                                            echo '<tr>';
                                            echo '<td>';
                                            echo $value[0];
                                            echo '</td>';
                                            echo '<td>';
                                            echo $value[1];
                                            echo '</td>';
                                            echo '<td>';
                                            if ($key != 1) {
                                                echo '<a title="Editar Perfil" href="editarPerfil.php?idPerfil=' . $value[0] . '"><i class="iconic-pen-alt2"></i></a>';
                                                echo '&nbsp;';
                                                echo '<a onclick="passarInfoPerfil(' . $value[0] . ',  ' . $aspa . $value[1] . $aspa . ');" href="#modalExcluir" data-toggle="modal" title="Excluir Perfil" href=""><i class="iconic-x"></i></a>';
                                            }
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>

                        <div id='novoPerfil' style='display: none;'>
                            <h4>Novo Perfil</h4>
                            <form>
                                <label>Nome do Novo Perfil:
                                    <input name='nomePerfil' type='text' maxlength="45" placeholder='Máximo de 45 caracteres' required=""/>
                                </label>
                                <?php if (isset($erro['novoPerfilJaExiste'])) { ?>
                                    <div class='erro' style='text-align: center; width: 300px;'>
                                        <strong>Erro!</strong> Nome de perfil já está sendo utilizado.
                                    </div>
                                <?php } ?>
                                <button class='btn btn-primary'>Criar</button>
                            </form>
                        </div>

                    </div>
                </div>   
            </div>

            <div id="modalExcluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="labelModalExcluir"><strong>Perfil:</strong> <font id='numeroPerfil'></font> &middot; <font id='nomePerfil'></font></h3>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que você deseja excluir este perfil?</p>
                </div>
                <div class="modal-footer">
                    <form>
                        <input name='idPerfilExcluir' type='hidden' id='inputIdPerfil'>
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
        <script>
                                function passarInfoPerfil(id, nome) {
                                    $('#numeroPerfil').html(id);
                                    $('#nomePerfil').html(nome);
                                    $('#inputIdPerfil').val(id);
                                }
                                function habilitarDiv(elemento) {
                                    $('#perfis').css('display', 'none');
                                    $('#novoPerfil').css('display', 'none');

                                    $(elemento).css('display', 'inherit');
                                }
        </script>

        <?php if (isset($erro['novoPerfilJaExiste'])) { ?>
            <script>
                habilitarDiv('#novoPerfil');
            </script>
        <?php } ?>
    </body>
</html>
