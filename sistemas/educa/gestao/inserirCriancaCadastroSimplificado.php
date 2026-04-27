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
$escolas = buscaEscolasInfantil();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(2);

if(!isset($_POST['nome'])){
    header("Location: cadastroSimplificadoInfantil.php");
}

include 'fnc/buscaEscola.php';
include 'fnc/buscaBairro.php';
include 'fnc/verificaAlunoJaPossuiVaga.php';

$data = explode('/', $_POST['dataNascimento']);
$data = $data[2] . '-' . $data[1] . '-' . $data[0];

$birthday = new DateTime($data);
$diff = $birthday->diff(new DateTime("2014-03-31"));
$months = $diff->format('%m') + 12 * $diff->format('%y');
$years = floor($months / 12);
$resto = $months % 12;
if ($years == 0) {
    if ($resto < 1) {
        $grupo = 0;
        $textoGrupo = 'Idade Mínina não atingida.';
    } else {
        $grupo = 10;
        $textoGrupo = 'Grupo: 1';
    }
} else {
    if ($years >= 1 && $years < 2) {
        $grupo = 11;
        $textoGrupo = 'Grupo: 2';
    } else {
        if ($years >= 2 && $years < 3) {
            $grupo = 12;
            $textoGrupo = 'Grupo: 3';
        } else {
            if ($years >= 3 && $years < 4) {
                $grupo = 13;
                $textoGrupo = 'Grupo: 4';
            } else {
                if ($years >= 4 && $years < 5) {
                    $grupo = 14;
                    $textoGrupo = 'Grupo: 5';
                } else {
                    if ($years >= 5 && $years < 6) {
                        $grupo = 15;
                        $textoGrupo = 'Grupo: 6';
                    } else {
                        $grupo = -1;
                        $textoGrupo = 'Idade Máxima Atingida.';
                    }
                }
            }
        }
    }
}

if($grupo < 0){
    $erro['idadeMaxima'] = true;
}
if($grupo == 0){
    $erro['idadeMinima'] = true;
}

if(verificaAlunoJaPossuiVaga($_POST['nome'], $_POST['dataNascimento'], null) != false){
    $erro['jaPossuiVaga'] = true;
}

if($_POST['nomeMae'] == '' && $_POST['nomePai'] == ''){
    $erro['nenhumNome'] = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Cadastro Simplificado - Infantil</title>
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
                    <h2 style='font-size:30px;'>Cadastro Simplificado - Infantil</h1>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style='padding: 20px; padding-top: 0px;'>
                            <h3>Confirmação</h3>
                            <form style='text-align: center;' action="inserirCriancaCadastroSimplificadoConfirmado.php" method='POST'>
                                <input type='hidden' name='nome' value="<?php echo $_POST['nome']; ?>">
                                <input type='hidden' name='dataNascimento' value="<?php echo $_POST['dataNascimento']; ?>">
                                <input type='hidden' name='nomeMae' value="<?php echo $_POST['nomeMae']; ?>">
                                <input type='hidden' name='nomePai' value="<?php echo $_POST['nomePai']; ?>">
                                <input type='hidden' name='idEscola' value="<?php echo $_POST['idEscola']; ?>">
                                <input type='hidden' name='grupo' value="<?php echo $grupo; ?>">
                                <input type='hidden' name='logradouro' value="<?php echo $_POST['logradouro']; ?>">
                                <input type='hidden' name='numero' value="<?php echo $_POST['numero']; ?>">
                                <input type='hidden' name='complemento' value="<?php echo $_POST['complemento']; ?>">
                                <?php if(isset($_POST['bairro'])) { 
                                    if($_POST['bairro'] != '') {?>
                                    <input type='hidden' name='bairro' value="<?php echo $_POST['bairro']; ?>">
                                    <?php }
                                } ?>

                                <h4>Nome: <?php echo $_POST['nome']; ?></h4>
                                <h4>Data de Nascimento: <?php echo $_POST['dataNascimento']; ?></h4>
                                <h4>Nome da Mãe: <?php echo $_POST['nomeMae']; ?></h4>
                                <h4>Nome do Pai: <?php echo $_POST['nomePai']; ?></h4>
                                <?php $escola = buscaEscola($_POST['idEscola']); ?>
                                <h4>Unidade: <?php echo $escola[1][1]; ?></h4>
                                <h4>Grupo: <?php echo $textoGrupo; ?></h4>
                                <h4>Logradouro: <?php echo $_POST['logradouro']; ?></h4>
                                <h4>Número: <?php echo $_POST['numero']; ?></h4>
                                <h4>Complemento: <?php echo $_POST['complemento']; ?></h4>
                                <?php if(isset($_POST['bairro'])) { 
                                    if($_POST['bairro'] != '') {?>
                                    	<?php $bairro = buscaBairro($_POST['bairro']); ?>
                                <h4>Bairro: <?php echo $bairro[$_POST['bairro']][1]; ?></h4>
                                <?php }
                                } ?>

                                <?php 

                                if(isset($erro)){

                                    if (isset($erro['idadeMaxima'])) {
                                        ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Idade máxima atingida.
                                        </div>
                                        <?php
                                    }
                                    if (isset($erro['idadeMinima'])) {
                                        ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Idade mínima não alcançada.
                                        </div>
                                        <?php
                                    }
                                    if (isset($erro['jaPossuiVaga'])) {
                                        ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Aluno já possui vaga na rede.
                                        </div>
                                        <?php
                                    }
                                    if (isset($erro['nenhumNome'])) {
                                        ?>
                                        <div class="erro">
                                            <strong>Erro!</strong> Nenhum nome de pai ou mãe informado.
                                        </div>
                                        <?php
                                    }

                                    ?><a class='btn' href="cadastroSimplificadoInfantil.php">Cancelar</a><?php
                                } else {
                                    ?>
                                    <a class='btn' href="cadastroSimplificadoInfantil.php">Cancelar</a>
                                    <button class='btn btn-primary'>Confirmar</button>
                                    <?php
                                }
                                ?>

                            </form>
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
        

    </body>
    </html>
