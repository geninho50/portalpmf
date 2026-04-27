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
// if(($_SESSION['usuario']['id'] != 1) || (!$_SESSION['permissoes']['geral']['perfil'])){
//    header('Location: opcoes.php');
// }

if (isset($_GET['idPessoa'])) {
    include 'fnc/buscaSituacaoVaga.php';
    $fundVaga = buscaSituacaoVaga($_GET['idPessoa'], 1);
    $infantilVaga = buscaSituacaoVaga($_GET['idPessoa'], 2);
    $ejaVaga = buscaSituacaoVaga($_GET['idPessoa'], 3);

    include 'fnc/buscaEscola.php';
    include 'fnc/buscaSituacaoLista.php';
    $fundLista = buscaSituacaoLista($_GET['idPessoa'], 1);
    $infantilLista = buscaSituacaoLista($_GET['idPessoa'], 2);
    $ejaLista = buscaSituacaoLista($_GET['idPessoa'], 3);

} else {
    header("Location: opcoes.php");
}

include 'fnc/buscaAluno.php';
$aluno = buscaAluno($_GET['idPessoa']);
$aluno[1] = explode('-', $aluno[1]);
$aluno[1] = $aluno[1][2].'/'.$aluno[1][1].'/'.$aluno[1][0];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Visualizar Situação</title>
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
                    <h2 style='font-size:30px;'>Visualizar Situação</h1>
                    </div>
                    <div class="row-fluid" style="padding-left: 10px;">
                     <h4>Nome: <?php echo $aluno[0]; ?></h4>
                     <h4>Dt. de Nasc.: <?php echo $aluno[1]; ?></h4>
                     <h4># de Matrícula:  <?php echo $aluno[2]; ?></h4>
                 </div>
                 <hr>
                 <div class="row-fluid">
                    <div class="span12" style='padding: 20px; padding-top: 0px;'>
                        <h2>Vagas</h2>
                        <?php

                        if($infantilVaga != false){

                            foreach ($infantilVaga as $key => $value) {
                                if($value[0] == 1){
                                    $tipoF = 'Novo Aluno';
                                } else {
                                    if ($value[0] == 2){
                                        $tipoF = 'Rematrícula';
                                    } else {
                                        if ($value[0] == 3){
                                            $tipoF = 'Reserva';
                                        }
                                    }
                                }

                                if($value[4] == 1){
                                    $rematricula = 'Sim';
                                } else {
                                    $rematricula = 'Não';
                                }

                                unset($grupo);
                                $grupo = $value[1] - 9;

                                $escola = buscaEscola($value[2]);
                                ?>
                                <h3>Educação Infantil</h3>
                                <h4>Tipo: <?php echo $tipoF;?></h4>
                                <h4>Unidade Escolar: <?php echo $escola[1][1];?></h4>
                                <h4>Etapa: <?php echo 'Grupo '.$grupo; ?></h4>

                                <?php
                            }
                        }

                        ?>
                        <?php

                        if($fundVaga != false){

                            foreach ($fundVaga as $key => $value) {
                                if($value[0] == 1){
                                    $tipoF = 'Novo Aluno';
                                } else {
                                    if ($value[0] == 2){
                                        $tipoF = 'Rematrícula';
                                    } else {
                                        if ($value[0] == 3){
                                            $tipoF = 'Reserva';
                                        }
                                    }
                                }

                                if($value[3] == 1){
                                    $efetivado = 'Sim';
                                } else {
                                    $efetivado = 'Não';
                                }

                                if($value[4] == 1){
                                    $rematricula = 'Sim';
                                } else {
                                    $rematricula = 'Não';
                                }

                                $escola = buscaEscola($value[2]);
                                ?>
                                <h3>Educação Fundamental</h3>
                                <h4>Tipo: <?php echo $tipoF;?></h4>
                                <h4>Unidade Escolar: <?php echo $escola[1][1];?></h4>
                                <h4>Etapa: <?php echo $value[1].'&ordm;'.' Ano'; ?></h4>

                                <?php
                            }
                        }

                        if($ejaVaga != false){
                            foreach ($ejaVaga as $key => $value) {
                                if($value[0] == 1){
                                    $tipoF = 'Novo Aluno';
                                } else {
                                    if ($value[0] == 2){
                                        $tipoF = 'Rematrícula';
                                    } else {
                                        if ($value[0] == 3){
                                            $tipoF = 'Reserva';
                                        }
                                    }
                                }

                                if($value[4] == 1){
                                    $rematricula = 'Sim';
                                } else {
                                    $rematricula = 'Não';
                                }


                                unset($grupo);
                                $grupo = $value[1] - 15;

                                $escola = buscaEscola($value[2]);
                                ?>
                                <h3>Educação de Jovens e Adultos</h3>
                                <h4>Tipo: <?php echo $tipoF;?></h4>
                                <h4>Unidade Escolar: <?php echo $escola[1][1];?></h4>
                                <h4>Etapa: <?php echo $grupo.'&ordm;'.' Segmento'; ?></h4>

                                <?php
                            }
                        }


                        if(($fundVaga == false) && ($infantilVaga == false) && ($ejaVaga == false)){
                            ?>
                            <h4>Aluno não possui vaga.</h4>
                            <?php
                        }

                        ?>
                        <hr>

                        <h2>Intenções</h2>
                        <?php

                        if($infantilLista != false){
                            ?>
                            <h3>Educação Infantil</h3>
                            <?php
                            foreach ($infantilLista as $key => $value) {

                                unset($grupo);
                                $grupo = $value[0] - 9;

                                $escola = buscaEscola($value[1]);
                                ?>
                                <h4>Opção: <?php echo $value[2].'&ordf;';?></h4>
                                <h4>Unidade Escolar: <?php echo $escola[1][1];?></h4>
                                <h4>Etapa: <?php echo 'Grupo '.$grupo; ?></h4>

                                <?php
                            }
                        }

                        if($fundLista != false){
                            ?>
                            <h3>Educação Fundamental</h3>
                            <?php
                            foreach ($fundLista as $key => $value) {

                                unset($grupo);
                                $grupo = $value[0];

                                $escola = buscaEscola($value[1]);
                                ?>
                                <h4>Opção: <?php echo $value[2].'&ordf;';?></h4>
                                <h4>Unidade Escolar: <?php echo $escola[1][1];?></h4>
                                <h4>Etapa: <?php echo $grupo.'&ordm; Ano'; ?></h4>

                                <?php
                            }
                        }

                        if(($fundLista == false) && ($infantilLista == false) && ($ejaLista == false)){
                            ?>
                            <h4>Aluno não possui intenção.</h4>
                            <?php
                        }

                        ?>

                        <hr>
                        <a class='btn pull-right' onclick='history.go(-1);'>Voltar</a>
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
