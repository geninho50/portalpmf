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

if (!isset($_GET['idAluno'])) {
    header("Location: opcoes.php");
}

if($_SESSION['usuario']['permissoes'][12][1] != 1){
    header('Location: opcoes.php');
}

include 'fnc/buscaAluno.php';
$aluno = buscaAluno($_GET['idAluno']);

$data = explode('-', $aluno[1]);
$data = $data[2] . '-' . $data[1] . '-' . $data[0];

$birthday = new DateTime($data);
$diff = $birthday->diff(new DateTime("2014-03-31"));
$months = $diff->format('%m') + 12 * $diff->format('%y');
$years = floor($months / 12);
$resto = $months % 12;

if ($years == 0) {
    if ($resto < 4) {
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
if (count($_POST) > 0) {

    if (isset($_POST['escolaPrimeira'])) {
        if ($_POST['escolaPrimeira'] == '') {
            $erro['escolaPrimeira'] = true;
        }
    } else {
        $erro['escolaPrimeira'] = true;
    }
    if (isset($_POST['escolaSegunda'])) {
        if ($_POST['escolaSegunda'] == '') {
            $erro['escolaSegunda'] = true;
        }
    } else {
        $erro['escolaSegunda'] = true;
    }
    if (isset($_POST['escolaPrimeira'])) {
        if (isset($_POST['escolaSegunda'])) {
            if ($_POST['escolaPrimeira'] == $_POST['escolaSegunda']) {
                $erro['escolaIgual'] = true;
            }
        }
    }
    

    if (!isset($erro)) {
        $dados['escola']['primeira_opcao'] = $_POST['escolaPrimeira'];
        if(isset($_POST['escolaSegunda'])){
            if($_POST['escolaSegunda'] == 'Nenhuma'){
                unset($dados['escola']['segunda_opcao']);
            } else {
                $dados['escola']['segunda_opcao'] = $_POST['escolaSegunda'];
            }
        }
        $dados['escola']['grupo'] = $grupo;

        include 'fnc/atualizarIntencaoInfantil.php';
        if(isset($dados['escola']['primeira_opcao'])){
            $resultado1 = atualizarIntencaoInfantil($_GET['idAluno'], 1, $dados['escola']['primeira_opcao']);
        }        
        if(isset($dados['escola']['segunda_opcao'])){
            $resultado2 = atualizarIntencaoInfantil($_GET['idAluno'], 2, $dados['escola']['segunda_opcao']);
        }

        $sucesso = true;
    }
}


include 'fnc/buscaEscolhas.php';
$escolhas = buscaEscolhas($_GET['idAluno']);
$temp = (count($escolhas));

if($escolhas != false){
    if($temp > 0){
        $_POST['escolaPrimeira'] = $escolhas[0][0];
    }
    if($temp > 1){
        $_POST['escolaSegunda'] = $escolhas[1][0];
    }
}

if (isset($dados['escola']['primeira_opcao'])) {
    $_POST['escolaPrimeira'] = $dados['escola']['primeira_opcao'];
}
if (isset($dados['escola']['segunda_opcao'])) {
    $_POST['escolaSegunda'] = $dados['escola']['segunda_opcao'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SGE &middot; Dados Pessoais do Aluno</title>
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
            <?php
            include 'shared/barraTopo.php';
            ?>
            <div class='conteudo' style='min-height: 500px;'>
                <div class='row-fluid' style='text-align: center; padding-top: 20px;'>
                    <h2 style='font-size:30px;'>Editar Aluno</h1>
                        <h4><?php echo $aluno[2] . ' &middot ' . ($aluno[0]); ?></h4>
                    </div>
                    <hr>
                    <div class="row-fluid">
                        <div class="span12" style=' padding-top: 0px; text-align: center;'>
                            <h3 style=''>Dados Escolares</h3>
                            <?php
                            if(isset($sucesso)){
                                if($sucesso){
                                    ?>
                                    <div class="sucesso" style='padding-right: 50px; margin-right: 150px; margin-left: 150px;'>
                                        <strong>Sucesso!</strong> Dados escolares atualizados!
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="erro">
                                        <strong>Erro!</strong> Um erro ocorreu, tente novamente!
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <form class="form-horizontal" method="post" id='form1'>
                                <h4><?php echo $textoGrupo; ?></h4>
                                <h4><?php echo 'Idade: ' . $years . ' anos e ' . $resto . ' meses.'; ?></h4>
                                <?php if ($grupo > 0) { ?>
                                <h5>Dados da 1&ordf; Opção</h5>                        
                                <label class="control-label" for="inputEscolaPrimeira" style='margin-left:160px; margin-right:20px;'>Escola</label>
                                <div class="controls">
                                    <select name='escolaPrimeira' id="inputEscolaPrimeira" required 
                                    onchange=''>
                                    <option></option>
                                    <?php
                                    include 'fnc/listaDeEscolas.php';
                                    $escolas = listaDeEscolas(2, 1, 2014);
                                    foreach ($escolas as $key => $value) {
                                        if ($key == $_POST['escolaPrimeira']) {
                                            echo '<option value=' . $value[0] . ' selected>' . ($value[1]) . '</option>';
                                        } else {
                                            echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <h5>Dados da 2&ordf; Opção</h5>                        
                            <label class="control-label" for="inputEscolaSegunda" style='margin-left:160px; margin-right:20px;'>Escola</label>
                            <div class="controls">
                                <select name='escolaSegunda' id="inputEscolaSegunda" required 
                                <?php 
                                if($_SESSION['dados_pessoais']['jaFrequenta'] == 'sim'){
                                    echo 'disabled';
                                }
                                ?>
                                onchange=''>
                                <option>Nenhuma</option>
                                <?php
                                $escolas = listaDeEscolas(2, 1, 2014);
                                foreach ($escolas as $key => $value) {
                                    if ($key == $_POST['escolaSegunda']) {
                                        echo '<option value=' . $value[0] . ' selected>' . ($value[1]) . '</option>';
                                    } else {
                                        echo '<option value=' . $value[0] . '>' . ($value[1]) . '</option>';
                                    }
                                }
                                ?>
                            </select>
<!--                                    <label 
                                        onchange="if ($('#sem2Opcao').attr('checked') == 'checked') {
                                            alert($('#sem2Opcao').attr('checked'));
                                        }">
                                        <input id='sem2Opcao' type="checkbox" checked='checked'>
                                        <font style='position: relative; top: 3px; left: 0px; display: inline;'>
                                        Sem 2&ordf; Opção
                                        </font>
                                    </label>-->
                                </div>
                                <?php if (isset($erro['escolaPrimeira'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Escolha uma opção.
                                </div>
                                <?php } ?>
                                <?php if (isset($erro['escolaSegunda'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> Escolha uma opção.
                                </div>
                                <?php } ?>
                                <?php if (isset($erro['escolaIgual'])) { ?>
                                <div class="erro">
                                    <strong>Erro!</strong> As opções não podem ser as mesmas.
                                </div>
                                <?php } ?>
                                <br>
                                <?php } ?>
                            </form>
                            
                            <div style='margin-right: 20px;'>
                                <a class='btn btn-primary pull-right' onclick='$("#form1").submit();'>Salvar</a>
                                <a class='btn pull-right' style='margin-right: 5px;' href='editarAlunoInfantil.php?idAluno=<?php echo $_GET["idAluno"];?>'>Voltar</a>;
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
        <script type="text/javascript">
          function verificaMaiusculo(elemento) {
              var string = $(elemento).val();
              var caracter = string.substr(string.length - 1, string.length);
              var letra = caracter.toUpperCase();
              if (letra < "A" || letra > "Z") {

              } else {
                  $(elemento).val(string.substr(0, string.length - 1) + letra);
              }
          }
          function isNumber(n) {
              return !isNaN(parseFloat(n)) && isFinite(n);
          }
          function verificaDigitos(elemento) {
              var string = $(elemento).val();
              var caracter = string.substr(string.length - 1, string.length);
              if (!isNumber(caracter)) {
                  $(elemento).val(string.substr(0, string.length - 1));
              }
          }
      </script>
      <script type="text/javascript">

        $('.dica').tooltip();
        $('#conteudo').css('display', 'inherit');
    </script>

</body>
</html>
