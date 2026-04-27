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

include 'fnc/buscaAluno.php';
$aluno = buscaAluno($_GET['idAluno']);

if (count($_POST) > 0) {

    if (isset($_POST['zonaMoradia'])) {
        if ($_POST['zonaMoradia'] == '') {
            $erro['zonaMoradia'] = true;
        }
    } else {
        $erro['zonaMoradia'] = true;
    }

    if (isset($_POST['autorizaUso'])) {
        if ($_POST['autorizaUso'] == '') {
            $erro['autorizaUso'] = true;
        }
    } else {
        $erro['autorizaUso'] = true;
    }

    if (isset($_POST['bolsaFamilia'])) {
        if ($_POST['bolsaFamilia'] == '') {
            $erro['bolsaFamilia'] = true;
        }
    } else {
        $erro['bolsaFamilia'] = true;
    }

    if (isset($_POST['localPermanencia'])) {
        if ($_POST['localPermanencia'] == '') {
            $erro['localPermanencia'] = true;
        } elseif ($_POST['localPermanencia'] == 'outro') {
            if (isset($_POST['outroLocalPermanencia'])) {
                if ($_POST['outroLocalPermanencia'] == '') {
                    $erro['outroLocalPermanencia'] = true;
                }
            } else {
                $erro['outroLocalPermanencia'] = true;
            }
        }
    } else {
        $erro['localPermanencia'] = true;
    }

    if (isset($_POST['possuiComputador'])) {
        if ($_POST['possuiComputador'] == '') {
            $erro['possuiComputador'] = true;
        }
    } else {
        $erro['possuiComputador'] = true;
    }

    if (isset($_POST['acessoInternet'])) {
        if ($_POST['acessoInternet'] == '') {
            $erro['acessoInternet'] = true;
        }
    } else {
        $erro['acessoInternet'] = true;
    }

    if (isset($_POST['carro'])) {
        if ($_POST['carro'] == '') {
            $erro['carro'] = true;
        }
    } else {
        $erro['carro'] = true;
    }

    if (isset($_POST['moradia'])) {
        if ($_POST['moradia'] == '') {
            $erro['moradia'] = true;
        }
    } else {
        $erro['moradia'] = true;
    }

    if (isset($_POST['pensao'])) {
        if ($_POST['pensao'] == '') {
            $erro['pensao'] = true;
        }
    } else {
        $erro['pensao'] = true;
    }
}

include 'fnc/buscaUtilizouTransporte.php';
$utilizouTransporte = buscaUtilizouTransporte($_GET['idAluno']);
include 'fnc/buscaOutrosDados.php';
$outrosDados = buscaOutrosDados($_GET['idAluno']);

if ($utilizouTransporte != false) {
    $_SESSION['outrosDados']['utilizou_transporte'] = 'sim';
    $_SESSION['outrosDados']['tipo_transporte'] = $utilizouTransporte[0];
} else {
    $_SESSION['outrosDados']['utilizou_transporte'] = 'nao';
}

if (isset($_SESSION['outrosDados']['tipo_transporte'])) {
    if ($_SESSION['outrosDados']['tipo_transporte'] == 2) {
        $_SESSION['outrosDados']['numero_cartao_transporte'] = $outrosDados[0];
    }
}

if (isset($outrosDados)) {

    if (isset($outrosDados[2])) {
        $_SESSION['outrosDados']['zona_moradia'] = strtolower($outrosDados[2]);
    }

    if (isset($outrosDados[3])) {
        if ($outrosDados[3] == 0) {
            $_SESSION['outrosDados']['autoriza_uso'] = 'nao';
        } else {
            $_SESSION['outrosDados']['autoriza_uso'] = 'sim';
        }
    }

    if (isset($outrosDados[4])) {
        if ($outrosDados[4] == 0) {
            $_SESSION['outrosDados']['bolsa_familia'] = 'nao';
        } else {
            $_SESSION['outrosDados']['bolsa_familia'] = 'sim';
        }
    }

    if (isset($outrosDados[5])) {
        if ($outrosDados[5] == 'Casa') {
            $_SESSION['outrosDados']['local_permanencia'] = 'casa';
        } else {
            if ($outrosDados[5] == 'Unidade de Educação') {
                $_SESSION['outrosDados']['local_permanencia'] = 'ue';
            } else {
                $_SESSION['outrosDados']['local_permanencia'] = 'outro';
                $_SESSION['outrosDados']['outro_local_permanencia'] = ($outrosDados[5]);
            }
        }
    }

    if (isset($outrosDados[6])) {
        if ($outrosDados[6] == 0) {
            $_SESSION['outrosDados']['possui_computador'] = 'nao';
        } else {
            if ($outrosDados[6] == 1) {
                $_SESSION['outrosDados']['possui_computador'] = 'sim';
            }
        }
    }

    if (isset($outrosDados[9])) {
        if ($outrosDados[9] == 0) {
            $_SESSION['outrosDados']['carro'] = 'nao';
        } else {
            $_SESSION['outrosDados']['carro'] = 'sim';
        }
    }

    if (isset($outrosDados[10])) {
        if ($outrosDados[10] == 'Alugada') {
            $_SESSION['outrosDados']['moradia'] = 'alugada';
        } else {
            if ($outrosDados[10] == 'Propria') {
                $_SESSION['outrosDados']['moradia'] = 'propria';
            } else {
                $_SESSION['outrosDados']['moradia'] = 'outros';
            }
        }
    }

    if (isset($outrosDados[11])) {
        if ($outrosDados[11] == 0) {
            $_SESSION['outrosDados']['pensao'] = 'nao';
        } else {
            $_SESSION['outrosDados']['pensao'] = 'sim';
        }
    }

    if (isset($outrosDados[7])) {
        $_SESSION['outrosDados']['acesso_internet'] = strtolower($outrosDados[7]);
    }
    if (isset($outrosDados[8])) {
        $_SESSION['outrosDados']['tempo_residencia'] = $outrosDados[8];
    }
}

if (count($_POST) > 0) {
    if (!isset($erro)) {
        $_SESSION['outrosDados']['utilizou_transporte'] = $_POST['utilizouTransporte'];
        if(isset($_POST['tipoTransporte'])){
            $_SESSION['outrosDados']['tipo_transporte'] = $_POST['tipoTransporte'];
        }
        if(isseT($_POST['numeroTransporte'])){
            $_SESSION['outrosDados']['numero_cartao_transporte'] = $_POST['numeroTransporte'];
        }
        $_SESSION['outrosDados']['precisara_transporte'] = $_POST['precisaraTransporte'];
        $_SESSION['outrosDados']['zona_moradia'] = $_POST['zonaMoradia'];
        $_SESSION['outrosDados']['autoriza_uso'] = $_POST['autorizaUso'];
        $_SESSION['outrosDados']['pensao'] = $_POST['pensao'];
        $_SESSION['outrosDados']['carro'] = $_POST['carro'];
        $_SESSION['outrosDados']['moradia'] = $_POST['moradia'];
        $_SESSION['outrosDados']['bolsa_familia'] = $_POST['bolsaFamilia'];
        $_SESSION['outrosDados']['local_permanencia'] = $_POST['localPermanencia'];
        $_SESSION['outrosDados']['outro_local_permanencia'] = $_POST['outroLocalPermanencia'];
        $_SESSION['outrosDados']['possui_computador'] = $_POST['possuiComputador'];
        $_SESSION['outrosDados']['acesso_internet'] = $_POST['acessoInternet'];
        $_SESSION['outrosDados']['tempo_residencia'] = $_POST['tempoResidencia'];

        include 'fnc/inserirOutrosDados.php';
        (inserirOutrosDados($_SESSION['outrosDados'], $_GET['idAluno']));

        include_once 'fnc/removeTransporte.php';
        include_once 'fnc/inserirTransporte.php';
        removeTransporte($_GET['idAluno']);
        (inserirTransporte($_SESSION, $_GET['idAluno']));

        $_SESSION['preenchido']['outros_dados'] = true;
        $sucesso = true;

    }
}

if (isset($_SESSION['outrosDados']['utilizou_transporte'])) {
    $_POST['utilizouTransporte'] = $_SESSION['outrosDados']['utilizou_transporte'];
}
if (isset($_SESSION['outrosDados']['tipo_transporte'])) {
    $_POST['tipoTransporte'] = $_SESSION['outrosDados']['tipo_transporte'];
}
if (isset($_SESSION['outrosDados']['numero_cartao_transporte'])) {
    $_POST['numeroTransporte'] = $_SESSION['outrosDados']['numero_cartao_transporte'];
}
if (isset($_SESSION['outrosDados']['precisara_transporte'])) {
    $_POST['precisaraTransporte'] = $_SESSION['outrosDados']['precisara_transporte'];
}
if (isset($_SESSION['outrosDados']['carro'])) {
    $_POST['carro'] = $_SESSION['outrosDados']['carro'];
}
if (isset($_SESSION['outrosDados']['moradia'])) {
    $_POST['moradia'] = $_SESSION['outrosDados']['moradia'];
}
if (isset($_SESSION['outrosDados']['pensao'])) {
    $_POST['pensao'] = $_SESSION['outrosDados']['pensao'];
}
if (isset($_SESSION['outrosDados']['zona_moradia'])) {
    $_POST['zonaMoradia'] = $_SESSION['outrosDados']['zona_moradia'];
}
if (isset($_SESSION['outrosDados']['autoriza_uso'])) {
    $_POST['autorizaUso'] = $_SESSION['outrosDados']['autoriza_uso'];
}
if (isset($_SESSION['outrosDados']['bolsa_familia'])) {
    $_POST['bolsaFamilia'] = $_SESSION['outrosDados']['bolsa_familia'];
}
if (isset($_SESSION['outrosDados']['local_permanencia'])) {
    $_POST['localPermanencia'] = $_SESSION['outrosDados']['local_permanencia'];
}
if (isset($_SESSION['outrosDados']['outro_local_permanencia'])) {
    $_POST['outroLocalPermanencia'] = $_SESSION['outrosDados']['outro_local_permanencia'];
}
if (isset($_SESSION['outrosDados']['possui_computador'])) {
    $_POST['possuiComputador'] = $_SESSION['outrosDados']['possui_computador'];
}
if (isset($_SESSION['outrosDados']['acesso_internet'])) {
    $_POST['acessoInternet'] = $_SESSION['outrosDados']['acesso_internet'];
}
if (isset($_SESSION['outrosDados']['tempo_residencia'])) {
    $_POST['tempoResidencia'] = $_SESSION['outrosDados']['tempo_residencia'];
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

                            <form class="form-horizontal" method="post" id='form1' style='margin-left: 100px; margin-right: 100px; '>
                                <div class="control-group highlight" style='margin-bottom: 0px;'>
                                    <label class="control-label" for="inputTransporteAno">Utilizou transporte<br> escolar em 2013</label>
                                    <div class="controls" style='line-height: 40px;'>                
                                        <input type="radio" name="utilizouTransporte" value="sim" 
                                        <?php
                                        if (isset($_POST['utilizouTransporte'])) {
                                            if ($_POST['utilizouTransporte'] == 'sim') {
                                                echo 'checked';
                                            }
                                        }
                                        ?>
                                        onclick="$('#inputTipoTransporte').removeAttr('disabled');
                                        $('#divTransporte').css('display', 'inherit');
                                        if ($('#inputTipoTransporte').val() == 'publico') {
                                        $('#inputNumeroCartaoTransporte').removeAttr('disabled');
                                    } else {
                                    $('#inputNumeroCartaoTransporte').attr('disabled', '');
                                }">
                                <font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="utilizouTransporte" value="nao"
                                <?php
                                if (isset($_POST['utilizouTransporte'])) {
                                    if ($_POST['utilizouTransporte'] == 'nao') {
                                        echo 'checked';
                                    }
                                }
                                ?>
                                onclick="$('#inputTipoTransporte').attr('disabled', '');
                                $('#inputNumeroCartaoTransporte').attr('disabled', '');
                                $('#divTransporte').css('display', 'none');
                                "><font style='position: relative; top: 4px; left: 5px;'>Não</font>
                            </div>
                        </div>
                        <?php if (isset($erro['utilizouTransporte'])) { ?>
                        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                            <strong>Erro!</strong> Você deve informar se utilizou transporte escolar em 2013.
                        </div>
                        <?php } ?>
                        <div id='divTransporte' <?php
                        if (isset($_POST['utilizouTransporte'])) {
                            if ($_POST['utilizouTransporte'] == 'nao') {
                                echo 'style="display: none;"';
                            }
                        }
                        ?>>
                        <label class="control-label" for="inputTipoTransporte">Tipo de Transporte</label>
                        <div class="controls">
                            <select name='tipoTransporte' id='inputTipoTransporte' 
                            onchange="if ($(this).val() == '2') {
                            $('#inputNumeroCartaoTransporte').removeAttr('disabled');
                        } else {
                        $('#inputNumeroCartaoTransporte').attr('disabled', '');
                        $('#inputNumeroCartaoTransporte').val('');
                    }" 
                    <?php
                    if (isset($_POST['utilizouTransporte'])) {
                        if ($_POST['utilizouTransporte'] == 'nao') {
                            echo 'disabled';
                        }
                    }
                    ?>>

                    <?php
                    include 'fnc/listaDeRedes.php';
                    $redes = listaDeRedes();
                    foreach ($redes as $key => $value) {
                        if (isset($_POST['tipoTransporte'])) {
                            if ($_POST['tipoTransporte'] == $key) {
                                echo "<option value='" . $value[0] . "' selected>" . ($value[1]) . "</option>";
                            } else {
                                echo "<option value='" . $value[0] . "'>" . ($value[1]) . "</option>";
                            }
                        } else {
                            echo "<option value='" . $value[0] . "'>" . ($value[1]) . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <?php if (isset($erro['tipoTransporte'])) { ?>
            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                <strong>Erro!</strong> Você deve informar um tipo de transporte.
            </div>
            <?php } ?>                    
            <label class="control-label" for="inputNumeroCartaoTransporte">N&ordm; Cartão de Transporte</label>
            <div class="controls">
                <input type='text'  maxlength="10" name='numeroTransporte' id='inputNumeroCartaoTransporte' onkeypress='verificaDigitos("#inputNumeroCartaoTransporte");' onkeyup='verificaDigitos("#inputNumeroCartaoTransporte");'
                <?php
                if (isset($_POST['numeroTransporte'])) {
                    if ($_POST['numeroTransporte'] != '') {
                        echo 'value="' . $_POST['numeroTransporte'] . '"';
                    }
                }
                ?>
                <?php
                if (isset($_POST['tipoTransporte'])) {
                    if ($_POST['tipoTransporte'] != 2) {
                        echo 'disabled';
                    }
                } else {
                    echo 'disabled';
                }
                ?>>
            </div>
            <?php if (isset($erro['numeroTransporte'])) { ?>
            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                <strong>Erro!</strong> Você deve informar o número do cartão de transporte.
            </div>
            <?php } ?> 
            <?php if (isset($erro['numeroTransporteInvalido'])) { ?>
            <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
                <strong>Erro!</strong> Você deve informar um número válido.
            </div>
            <?php } ?>  
        </div>
        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputPrecisaraTransporte">Precisará de transporte público em 2014?</label>
            <div class="controls" style='line-height: 40px'>                
                <input type="radio" name="precisaraTransporte" value="sim" 
                <?php
                if (isset($_POST['precisaraTransporte'])) {
                    if ($_POST['precisaraTransporte'] == 'sim') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="radio" name="precisaraTransporte" value="nao"
                <?php
                if (isset($_POST['precisaraTransporte'])) {
                    if ($_POST['precisaraTransporte'] == 'nao') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
            </div>
        </div>
        <?php if (isset($erro['precisaraTransporte'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar se precisará de transporte em 2014.
        </div>
        <?php } ?> 
        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputZonaMoradia">Zona de Moradia</label>
            <div class="controls">                
                <input type="radio" name="zonaMoradia" value="rural" 
                <?php
                if (isset($_POST['zonaMoradia'])) {
                    if ($_POST['zonaMoradia'] == 'rural') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Rural</font> &nbsp; &nbsp; &nbsp;
                <input type="radio" name="zonaMoradia" value="urbana"
                <?php
                if (isset($_POST['zonaMoradia'])) {
                    if ($_POST['zonaMoradia'] == 'urbana') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Urbana</font>
            </div>
        </div>   
        <?php if (isset($erro['zonaMoradia'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar sua zona de moradia.
        </div>
        <?php } ?>  
        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputAutorizaUso">Autoriza Uso de imagem e produção?</label>
            <div class="controls" style='line-height: 40px'>                
                <input type="radio" name="autorizaUso" value="sim" 
                <?php
                if (isset($_POST['autorizaUso'])) {
                    if ($_POST['autorizaUso'] == 'sim') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="radio" name="autorizaUso" value="nao"
                <?php
                if (isset($_POST['autorizaUso'])) {
                    if ($_POST['autorizaUso'] == 'nao') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
            </div>
        </div>      
        <?php if (isset($erro['autorizaUso'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar se autoriza uso de imagem e produção.
        </div>
        <?php } ?>  
        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputBolsaFamilia">Família recebe<br> Bolsa Família?</label>
            <div class="controls" style='line-height: 40px'>                
                <input type="radio" name="bolsaFamilia" value="sim" 
                <?php
                if (isset($_POST['bolsaFamilia'])) {
                    if ($_POST['bolsaFamilia'] == 'sim') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="radio" name="bolsaFamilia" value="nao"
                <?php
                if (isset($_POST['bolsaFamilia'])) {
                    if ($_POST['bolsaFamilia'] == 'nao') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
            </div>
        </div>      
        <?php if (isset($erro['bolsaFamilia'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar se sua família recebe bolsa família.
        </div>
        <?php } ?>  

        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputPensao">Família recebe<br> pensão?</label>
            <div class="controls" style='line-height: 40px'>                
                <input type="radio" name="pensao" value="sim" 
                <?php
                if (isset($_POST['pensao'])) {
                    if ($_POST['pensao'] == 'sim') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="radio" name="pensao" value="nao"
                <?php
                if (isset($_POST['pensao'])) {
                    if ($_POST['pensao'] == 'nao') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
            </div>
        </div>      
        <?php if (isset($erro['pensao'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar se sua família recebe pensão.
        </div>
        <?php } ?> 

        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputCarro">Família possui carro?</label>
            <div class="controls" style='line-height: 20px'>                
                <input type="radio" name="carro" value="sim" 
                <?php
                if (isset($_POST['carro'])) {
                    if ($_POST['carro'] == 'sim') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="radio" name="carro" value="nao"
                <?php
                if (isset($_POST['carro'])) {
                    if ($_POST['carro'] == 'nao') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
            </div>
        </div>      
        <?php if (isset($erro['carro'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar se sua família possui carro.
        </div>
        <?php } ?>

        <div class="control-group highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputMoradia"> Situação da Moradia</label>
            <div class="controls" style='line-height: 20px'>                
                <input type="radio" name="moradia" value="propria" 
                <?php
                if (isset($_POST['moradia'])) {
                    if ($_POST['moradia'] == 'propria') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Casa Própria</font> &nbsp; &nbsp; &nbsp;
                <input type="radio" name="moradia" value="alugada"
                <?php
                if (isset($_POST['moradia'])) {
                    if ($_POST['moradia'] == 'alugada') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Alugada</font> &nbsp; &nbsp; &nbsp;
                <input type="radio" name="moradia" value="outros"
                <?php
                if (isset($_POST['moradia'])) {
                    if ($_POST['moradia'] == 'outros') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Outro</font>
            </div>
        </div>      
        <?php if (isset($erro['moradia'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar a situação da moradia da família.
        </div>
        <?php } ?>

        <div class="control-group  highlight" style='margin-bottom: 0px;'>
            <label class="control-label" for="inputBolsaFamilia">Local de Permanência<br> no contra-turno</label>
            <div class="controls" style='line-height: 40px'>                
                <input type="radio" name="localPermanencia" value="casa" onclick="$('#divOutroLocal').css('display', 'none');"
                <?php
                if (isset($_POST['localPermanencia'])) {
                    if ($_POST['localPermanencia'] == 'casa') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Casa</font> &nbsp;
                <input type="radio" name="localPermanencia" value="ue" onclick="$('#divOutroLocal').css('display', 'none');"
                <?php
                if (isset($_POST['localPermanencia'])) {
                    if ($_POST['localPermanencia'] == 'ue') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Unidade de Educação</font> &nbsp;
                <input type="radio" name="localPermanencia" value="outro" onclick="$('#divOutroLocal').css('display', 'inherit');"
                <?php
                if (isset($_POST['localPermanencia'])) {
                    if ($_POST['localPermanencia'] == 'outro') {
                        echo 'checked';
                    }
                }
                ?>><font style='position: relative; top: 4px; left: 5px;'>Outro</font>
            </div>
        </div>      
        <?php if (isset($erro['localPermanencia'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar o local de permanência no contra-turno.
        </div>
        <?php } ?>  
        <div id='divOutroLocal'
        <?php
        if (isset($_POST['localPermanencia'])) {
            if ($_POST['localPermanencia'] != 'outro') {
                echo 'style="display: none;"';
            } else {
                echo 'style="display: inherit; margin-bottom: 0px;"';
            }
        } else {
            echo 'style="display: none;"';
        }
        ?>>
        <div class="control-group highlight">
            <label class="control-label" for="inputOutroLocalPermanencia">Outro Local de Permanência</label>
            <div class="controls" style='margin-bottom: 0px; margin-top: 10px;'>
                <input type='text' name='outroLocalPermanencia' id='inputOutroLocalPermanencia' 
                <?php
                if (isset($_POST['outroLocalPermanencia'])) {
                    if ($_POST['outroLocalPermanencia'] != '') {
                        echo 'value="' . $_POST['outroLocalPermanencia'] . '"';
                    }
                }
                ?>>
            </div>
        </div>   
        <?php if (isset($erro['outroLocalPermanencia'])) { ?>
        <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
            <strong>Erro!</strong> Você deve informar o local de permanência no contra-turno.
        </div>
        <?php } ?>  
    </div>  
    <div class="control-group highlight" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputPossuiComputador">Possui Computador?</label>
        <div class="controls" style='line-height: 20px'>                
            <input type="radio" name="possuiComputador" value="sim" 
            <?php
            if (isset($_POST['possuiComputador'])) {
                if ($_POST['possuiComputador'] == 'sim') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Sim</font> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="possuiComputador" value="nao"
            <?php
            if (isset($_POST['possuiComputador'])) {
                if ($_POST['possuiComputador'] == 'nao') {
                    echo 'checked';
                }
            }
            ?>><font style='position: relative; top: 4px; left: 5px;'>Não</font>
        </div>
    </div>     
    <?php if (isset($erro['possuiComputador'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar se possui computador.
    </div>
    <?php } ?>  
    <div class="control-group" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputAcessoInternet">Local de Acesso à Internet</label>
        <div class="controls" style='line-height: 20px'>                
            <select name='acessoInternet' id='inputAcessoInternet'>
                <option value='casa' 
                <?php
                if (isset($_POST['acessoInternet'])) {
                    if ($_POST['acessoInternet'] == 'casa') {
                        echo 'selected';
                    }
                }
                ?>>Casa</option>
                <option value='escola' 
                <?php
                if (isset($_POST['acessoInternet'])) {
                    if ($_POST['acessoInternet'] == 'escola') {
                        echo 'selected';
                    }
                }
                ?>>Escola</option>
                <option value='trabalho' 
                <?php
                if (isset($_POST['acessoInternet'])) {
                    if ($_POST['acessoInternet'] == 'trabalho') {
                        echo 'selected';
                    }
                }
                ?>>Trabalho</option>
                <option value='outro' 
                <?php
                if (isset($_POST['acessoInternet'])) {
                    if ($_POST['acessoInternet'] == 'outro') {
                        echo 'selected';
                    }
                }
                ?>>Outro</option>
            </select>
        </div>
    </div>     
    <?php if (isset($erro['acessoInternet'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar o local de acesso à Internet.
    </div>
    <?php } ?>     
    <div class="control-group" style='margin-bottom: 0px;'>
        <label class="control-label" for="inputTempoResidencia">Tempo de Residência no Município</label>
        <div class="controls" style='line-height: 50px'>                
            <select name='tempoResidencia' id='inputTempoResidencia'>
                <option value='1' 
                <?php
                if (isset($_POST['tempoResidencia'])) {
                    if ($_POST['tempoResidencia'] == '1') {
                        echo 'selected';
                    }
                }
                ?>>Até 3 meses</option>
                <option value='2' 
                <?php
                if (isset($_POST['tempoResidencia'])) {
                    if ($_POST['tempoResidencia'] == '2') {
                        echo 'selected';
                    }
                }
                ?>>De 3 à 6 meses</option>
                <option value='3' 
                <?php
                if (isset($_POST['tempoResidencia'])) {
                    if ($_POST['tempoResidencia'] == '3') {
                        echo 'selected';
                    }
                }
                ?>>De 6 à 9 meses</option>
                <option value='4' 
                <?php
                if (isset($_POST['tempoResidencia'])) {
                    if ($_POST['tempoResidencia'] == '4') {
                        echo 'selected';
                    }
                }
                ?>>De 9 a 12 meses</option>
                <option value='5' 
                <?php
                if (isset($_POST['tempoResidencia'])) {
                    if ($_POST['tempoResidencia'] == '5') {
                        echo 'selected';
                    }
                }
                ?>>Mais de 12 meses</option>
            </select>
        </div>
    </div>     
    <?php if (isset($erro['acessoInternet'])) { ?>
    <div class="erro" style='width: 80%; margin-left: auto; margin-right: auto;'>
        <strong>Erro!</strong> Você deve informar o tempo de residência no município.
    </div>
    <?php } ?> 
    <br>
</form>

<div style='margin-right: 20px;'>
    <a class='btn btn-primary pull-right' onclick='$("#form1").submit();'>Salvar</a>
    <a class='btn pull-right' style='margin-right: 5px;' href='editarAlunoFundamental.php?idAluno=<?php echo $_GET["idAluno"];?>'>Voltar</a>;
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
