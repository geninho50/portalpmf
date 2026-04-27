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

if($_SESSION['usuario']['permissoes'][3][1] != 1){
    header('Location: index.php');
}

if (!$_SESSION['novo_aluno_infantil']['preenchido']['localizacao']) {
    header('Location: dadosLocalizacaoInfantil.php');
}

$_SESSION['novo_aluno_infantil']['curso'] = 2;
$_SESSION['novo_aluno_infantil']['periodo'] = 1;
$_SESSION['novo_aluno_infantil']['ano'] = 2014;

$data = explode('/', $_SESSION['novo_aluno_infantil']['dados_pessoais']['data_nascimento']);
$data = $data[2] . '-' . $data[1] . '-' . $data[0];

$birthday = new DateTime($data);
$diff = $birthday->diff(new DateTime("2014-03-31"));
$months = $diff->format('%m') + 12 * $diff->format('%y');
$years = floor($months / 12);
$resto = $months % 12;

if ($years == 0) {
    if ($resto < 0) {
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
    if($_SESSION['novo_aluno_infantil']['dados_pessoais']['jaFrequenta'] == 'nao'){
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
    }

    if (!isset($erro)) {
        $_SESSION['novo_aluno_infantil']['escola']['primeira_opcao'] = $_POST['escolaPrimeira'];
        if(isset($_POST['escolaSegunda'])){
            if($_POST['escolaSegunda'] == 'Nenhuma'){
                unset($_SESSION['novo_aluno_infantil']['escola']['segunda_opcao']);
            } else {
                $_SESSION['novo_aluno_infantil']['escola']['segunda_opcao'] = $_POST['escolaSegunda'];
            }
        }
        $_SESSION['novo_aluno_infantil']['escola']['grupo'] = $grupo;
        $_SESSION['novo_aluno_infantil']['preenchido']['escola'] = true;
        header("Location: outrosDadosInfantil.php");
    }
}

if (isset($_SESSION['novo_aluno_infantil']['escola']['primeira_opcao'])) {
    $_POST['escolaPrimeira'] = $_SESSION['novo_aluno_infantil']['escola']['primeira_opcao'];
}
if (isset($_SESSION['novo_aluno_infantil']['escola']['segunda_opcao'])) {
    $_POST['escolaSegunda'] = $_SESSION['novo_aluno_infantil']['escola']['segunda_opcao'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" CONTENT="NO-CACHE">
    <title>SGE &middot; Dados Escolares</title>
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
        </style>
    </head>

    <body>

        <div class="container">

            <?php include 'shared/topo.php'; ?>
            <?php include 'shared/barraTopo.php'; ?>
            <div class='conteudo'>
                <div class='row-fluid' style='text-align: center; height: 90px;'>
                    <div style='text-align: center; padding-top: 15px;'>
                        <h3>Dados Escolares do Aluno</h3>
                        <img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
                    </div>
                </div>
                <div class='row-fluid' style='text-align: center;'>
                    <?php include 'shared/barraLateral.php'; ?>

                    <div class="span8 folha">
                        <img src="img/canto.png" style="position: relative; left: -284px; top: -10px;">
                        <!-- TODO - Atenção: Diferenças entre Infantil e Básica -->
                        <!-- TODO - Atenção: Validação -->
                        <!-- TODO - Atenção: Confirmação -->
                        <form class="form-horizontal" method="post">
                            <h4><?php echo $textoGrupo; ?></h4>
                            <h4><?php echo 'Idade: ' . $years . ' anos e ' . $resto . ' meses.'; ?></h4>
                            <?php if ($grupo > 0) { ?>
                            <h5>Dados da 1&ordf; Opção</h5>                        
                            <label class="control-label" for="inputEscolaPrimeira">Escola</label>
                            <div class="controls">
                                <select name='escolaPrimeira' id="inputEscolaPrimeira" required 
                                onchange=''>
                                <option></option>
                                <?php
                                include 'fnc/listaDeEscolas.php';
                                $escolas = listaDeEscolas($_SESSION['novo_aluno_infantil']['curso'], $_SESSION['novo_aluno_infantil']['periodo'], $_SESSION['novo_aluno_infantil']['ano']);
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
                        <label class="control-label" for="inputEscolaSegunda">Escola</label>
                        <div class="controls">
                            <select name='escolaSegunda' id="inputEscolaSegunda" required 
                            <?php 
                            if($_SESSION['novo_aluno_infantil']['dados_pessoais']['jaFrequenta'] == 'sim'){
                                echo 'disabled';
                            }
                            ?>
                            onchange=''>
                            <option>Nenhuma</option>
                            <?php
                            $escolas = listaDeEscolas($_SESSION['novo_aluno_infantil']['curso'], $_SESSION['novo_aluno_infantil']['periodo'], $_SESSION['novo_aluno_infantil']['ano']);
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
                                <a class='btn' href='dadosLocalizacaoInfantil.php'>Voltar</a>
                                <button class='btn btn-primary'>Avan&ccedil;ar</button>
                                <?php } else { ?>
                                <a class='btn' href='dadosLocalizacaoInfantil.php'>Voltar</a>
                                <button class='btn btn-primary'>Finalizar</button>
                                <?php } ?>
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
        <script type="text/javascript">
            function buscaMunicipio(id_estado, id_elemento) {
                id_elemento = '#' + id_elemento.toString();
                if (id_estado != '') {
                    $.get("ajax/municipios.php", {id_estado: id_estado})
                    .done(function(data) {
                        $(id_elemento).html(data);
                        $(id_elemento).removeAttr('disabled');
                    });
                } else {
                    $(id_elemento).html("<select></select>");
                    $(id_elemento).attr('disabled', '');
                }
            }
            function verificaMaiusculo(elemento) {
                var string = $(elemento).val();
                var caracter = string.substr(string.length - 1, string.length);
                var letra = caracter.toUpperCase();
                if (letra < "A" || letra > "Z") {

                } else {
                    $(elemento).val(string.substr(0, string.length - 1) + letra);
                }
            }
            function verificaCaracteres(elemento) {
                var string = $(elemento).val();
                var caracter = string.substr(string.length - 1, string.length);
                var letra = caracter.toUpperCase();
                if (letra < "A" || letra > "Z") {
                    if (letra != " ") {
                        $(elemento).val(string.substr(0, string.length - 1));
                    }
                } else {
                    $(elemento).val(string.substr(0, string.length - 1) + letra);
                }
            }

        </script>
        <script type="text/javascript">
            function buscaFases(curso, escola, id_periodo, periodo_ano, id_elemento) {
                id_elemento = '#' + id_elemento.toString();
                if (curso != '' && escola != '' && id_periodo != '' && periodo_ano != '') {
                    $.get("ajax/fases.php", {curso: curso, escola: escola, id_periodo: id_periodo, periodo_ano: periodo_ano})
                    .done(function(data) {
                        $(id_elemento).html(data);
                        $(id_elemento).removeAttr('disabled');
                    });
                } else {
                    $(id_elemento).html("");
                    $(id_elemento).attr('disabled', '');
                }
            }

        </script>
        <script>
            $('#bl1').css('display', 'none');
            $('#bl2').addClass('itemVerde');
            $('#bl2').addClass('ativo');
            $('#bl2').removeClass('item');
            $('#bl3').addClass('itemRoxo');
            $('#bl3').addClass('ativo');
            $('#bl3').removeClass('item');
            $('#bl4').addClass('itemAzul');
            $('#bl4').addClass('ativo');
            $('#bl4').removeClass('item');
            $('#bl5').addClass('itemCinza');
            $('#bl5').addClass('marrom');
            $('#bl5').removeClass('item');
            $('#bl6').addClass('itemCinza');
            $('#bl6').addClass('amarelo');
            $('#bl6').removeClass('item');
            $('#bl7').addClass('itemCinza');
            $('#bl7').addClass('oliva');
            $('#bl7').removeClass('item');
            $('#bl8').addClass('itemCinza');
            $('#bl8').addClass('t');
            $('#bl8').removeClass('item');
            $('#bl9').addClass('itemCinza');
            $('#bl9').addClass('verde-azulado');
            $('#bl9').removeClass('item');
        </script>
    </body>
    </html>
