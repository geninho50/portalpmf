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

if (!isset($_GET['idEscola'])) {
    header('Location: manutencaoEscolas.php');
} else {
    include 'fnc/buscaEndereco.php';
    $endereco = buscaEndereco($_GET['idEscola']);
    if ($endereco != FALSE) {
        $end['cep'] = substr($endereco[1][11], 0, 2) . '.' . substr($endereco[1][11], 2, 3) . '-' . substr($endereco[1][11], 5, 3);
        $end['logradouro'] = $endereco[1][6];
        $end['complemento'] = $endereco[1][8];
        $end['numero'] = $endereco[1][7];
        $end['bairro'] = $endereco[1][3];
    }

    include 'fnc/buscaEscola.php';
    $escola = buscaEscola($_GET['idEscola']);
}
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
                    <h2 style='font-size:30px;'>Editar Escola</h2>
                    <h4><?php echo ($escola[1][1]); ?></h4>
                </div>
                <hr>
                <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <div>
                            <div class="tab-pane" id="tabEndereco">
                                <div id='endereco' style='display: inherit;'>
                                    <h4>Endereço</h4>
                                    <?php
                                    if (isset($_GET['sucessoEnd'])) {
                                        if ($_GET['sucessoEnd'] == true) {
                                            ?>
                                            <div class='sucesso'>
                                                <strong>Sucesso!</strong> Endereço alterado com sucesso. 
                                                <a class='btn btn-success' href='visualizarEscola.php?idEscola=<?php echo $_GET["idEscola"]; ?>'>Visualizar</a>
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
                                    <form class='form-horizontal' method='post' action="insereEnderecoEscola.php">
                                        <input type='hidden' value='<?php echo $_GET['idEscola']; ?>' name='id'>
                                        <div class="control-group highlight" style="padding-top: 5px;">
                                            <label class="control-label" for="inputCep">CEP</label>
                                            <div class="controls">               
                                                <input id='inputCep' name='cep' required data-mask='99.999-999' type='text' 
                                                       value='<?php
                                    if ($endereco != FALSE) {
                                        echo $end['cep'];
                                    }
                                    ?>'>
                                            </div>
                                        </div>
                                        <div class="control-group highlight" style="padding-top: 5px;">
                                            <label class="control-label" for="inputCep">Logradouro</label>
                                            <div class="controls">               
                                                <input id='inputLogradouro' name='logradouro' maxlength="100" required type='text'
                                                       value='<?php
                                                       if ($endereco != FALSE) {
                                                           echo $end['logradouro'];
                                                       }
                                    ?>'>
                                            </div>
                                        </div>
                                        <div class="control-group highlight" style="padding-top: 5px;">
                                            <label class="control-label" for="inputCep">Número</label>
                                            <div class="controls">               
                                                <input id='inputNumero' name='numero' maxlength="11" required type='text' type='number'
                                                       value='<?php
                                                       if ($endereco != FALSE) {
                                                           echo $end['numero'];
                                                       }
                                    ?>'>
                                            </div>
                                        </div>
                                        <div class="control-group highlight" style="padding-top: 5px;">
                                            <label class="control-label" for="inputCep">Complemento</label>
                                            <div class="controls">               
                                                <input id='inputComplemento' name='complemento' maxlength="50" type='text'
                                                       value='<?php
                                                       if ($endereco != FALSE) {
                                                           echo $end['complemento'];
                                                       }
                                    ?>'>
                                            </div>
                                        </div>
                                        <div class="control-group highlight" style="padding-top: 5px;">
                                            <label class="control-label" for="inputBairro">Bairro</label>
                                            <div class="controls">
                                                <select name='bairro' id="inputBairro" required>
                                                    <option></option>
                                                    <?php
                                                    include 'fnc/listaDeBairros.php';
                                                    $bairros = listaDeBairros(8452);
                                                    foreach ($bairros as $key => $value) {
                                                        if ($endereco != FALSE) {
                                                            if ($key == $end['bairro']) {
                                                                echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div> 
                                        <button class='btn btn-primary pull-right' style="margin-left: 5px;">Salvar</button>
                                        <a href="editarEscola.php?idEscola=<?php echo $_GET["idEscola"]; ?>" class="btn pull-right">Voltar</a>  
                                    </form>
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
