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
        <title>SGE &middot; Editar Escola</title>
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
        <style>
            .controls {
                text-align: left;
                padding-left: 40px;
            }
            .control-group {
                padding-left: 120px;
            }
        </style>
    </head>

    <body>

        <div class="container">
            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Adicionar Usuário</h2>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <div>
                            <div class="tab-pane" id="tabEndereco">
                                <div style='display: inherit;'>
                                    <?php
                                    if (isset($_GET['sucesso'])) {
                                        if ($_GET['sucesso'] == 'true') {
                                            ?>
                                            <div class='sucesso'>
                                                <strong>Sucesso!</strong> Usuário adicionado com sucesso. 
                                            </div>
                                            <?php
                                        } else {
                                            if ($_GET['sucesso'] == 'lim') {
                                                ?>
                                                <div class='erro'>
                                                    <strong>Erro!</strong> Limite máximo de executores para esta UE já foi atingido.
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class='erro'>
                                                    <strong>Erro!</strong> Este CPF já está em uso.
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                    <?php if ($_SESSION['usuario']['permissoes'][6][1] == 1) { ?>
                                        <h4>Adicionar Diretor</h4>
                                        <form class='form-horizontal' method='post' action="insereDiretor.php">

                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputEscolas">Escola</label>
                                                <div class="controls">
                                                    <select name='escola' id="inputEscolas" required>
                                                        <?php
                                                        foreach ($escolas as $key => $value) {
                                                            ?>

                                                            <option value="<?php echo $value[0]; ?>"><?php echo ($value[1]); ?></option>

                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputPerfil">Curso</label>
                                                <div class="controls">
                                                    <select name='perfil' id="inputPerfil" required>
                                                        <option value="4">Infantil</option>
                                                        <option value="5">Fundamental</option>
                                                        <option value="7">Infantil/Fundamental</option>
                                                        <option value="6">EJA</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputNomeDiretor">Nome</label>
                                                <div class="controls">
                                                    <input type="text" name="nomeDiretor" id="inputNomeDiretor" required maxlength="70">
                                                </div>
                                            </div>
                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputCPF">CPF</label>
                                                <div class="controls">
                                                    <input type="text" name="cpf" id="inputCPF" required data-mask="999.999.999-99">
                                                </div>
                                            </div>
                                            <button class='btn btn-primary pull-right' style="margin-left: 5px;">Adicionar</button>
                                            <a href="manutencaoUsuarios.php" class="btn pull-right">Voltar</a>  
                                        </form>
                                    <?php } ?>
                                    <br>
                                    <?php if ($_SESSION['usuario']['permissoes'][7][1] == 1) { ?>
                                        <h4>Adicionar Executor</h4>
                                        <form class='form-horizontal' method='post' action="insereExecutor.php">

                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputEscolasE">Escola</label>
                                                <div class="controls">
                                                    <select name='escolaE' id="inputEscolasE" required>
                                                        <?php
                                                        foreach ($escolas as $key => $value) {
                                                            if (isset($_SESSION['usuario']['id_escola'])) {
                                                                if ($key == $_SESSION['usuario']['id_escola']) {
                                                                    ?>
                                                                    <option value="<?php echo $value[0]; ?>"><?php echo ($value[1]); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputPerfilE">Curso</label>
                                                <div class="controls">
                                                    <select name='perfilE' id="inputPerfilE" required>
                                                        <option value="8">Infantil</option>
                                                        <option value="9">Fundamental</option>
                                                        <option value="10">Infantil/Fundamental</option>
                                                        <option value="12">EJA</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputNomeE">Nome</label>
                                                <div class="controls">
                                                    <input type="text" name="nomeE" id="inputNomeE" required maxlength="70">
                                                </div>
                                            </div>
                                            <div class="control-group highlight" style="padding-top: 5px;">
                                                <label class="control-label" for="inputCPFE">CPF</label>
                                                <div class="controls">
                                                    <input type="text" name="cpfE" id="inputCPFE" required data-mask="999.999.999-99">
                                                </div>
                                            </div>
                                            <button class='btn btn-primary pull-right' style="margin-left: 5px;">Adicionar</button>
                                            <a href="manutencaoUsuarios.php" class="btn pull-right">Voltar</a>  
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>   
            </div>
        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>       

    </body>
</html>
