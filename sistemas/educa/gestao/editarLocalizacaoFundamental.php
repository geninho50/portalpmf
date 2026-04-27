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

if (count($_POST) > 0) {
    if (isset($_POST['cep'])) {
        if ($_POST['cep'] == '') {
            $erro['cep'] = true;
        }
        
        include_once 'fnc/buscaEnderecoCEP.php';
        $endereco = buscaEnderecoCEP($_POST['cep']);
        if (count($endereco) != 8) {
            $erro['cepNaoEncontrado'] = true;
        } else {
            if ($endereco[4] != 8452) {
                $erro['foraDaArea'] = true;
            }
        }
    } else {
        $erro['cep'] = true;
    }

    if (isset($_POST['logradouro'])) {
        if ($_POST['logradouro'] == '') {
            $erro['logradouro'] = true;
        }
    } else {
        $erro['logradouro'] = true;
    }

    if (!isset($_POST['numero'])) {
        $erro['numero'] = true;
    } else {
        if (!ctype_digit($_POST['numero'])) {
            $erro['numeroInvalido'] = true;
        }
        if ($_POST['numero'] == '') {
            $erro['numero'] = true;
        }
    }


    if (isset($_POST['bairro'])) {
        if ($_POST['bairro'] == '') {
            $erro['bairro'] = true;
        }
    } else {
        $erro['bairro'] = true;
    }

    if (isset($_POST['estado'])) {
        if ($_POST['estado'] == '') {
            $erro['estado'] = true;
        }
    } else {
        $erro['estado'] = true;
    }

    if (isset($_POST['municipio'])) {
        if ($_POST['municipio'] == '') {
            $erro['municipio'] = true;
        }
    } else {
        $erro['municipio'] = true;
    }
    if (!isset($erro)) {
        $_SESSION['localizacao']['cep'] = $_POST['cep'];
        $_SESSION['localizacao']['logradouro'] = $_POST['logradouro'];
        $_SESSION['localizacao']['numero'] = $_POST['numero'];
        $_SESSION['localizacao']['complemento'] = $_POST['complemento'];
        $_SESSION['localizacao']['bairro'] = $_POST['bairro'];
        $_SESSION['localizacao']['estado'] = 25;
        $_SESSION['localizacao']['municipio'] = 8452;

        include_once 'fnc/removeEndereco.php';
        include_once 'fnc/inserirEndereco.php';
        removeEndereco($_GET['idAluno'], 1);
        $resultado = inserirEndereco($_SESSION['localizacao'], $_GET['idAluno'], 1);
        if($resultado == true){
            $sucesso = true;
            include_once 'fnc/insereAuditoriaEditarLocalizacaoFundamental.php';
            insereAuditoriaEditarLocalizacaoFundamental($_SESSION['localizacao'], $_GET['idAluno'], $_SESSION['usuario']['id']);
        } else {
            $sucesso = false;
        }
    }
}


include 'fnc/buscaEndereco.php';
include 'fnc/buscaAlunoEndereco.php';
$end = buscaAlunoEndereco($_GET['idAluno']);

include 'fnc/buscaAluno.php';
$aluno = buscaAluno($_GET['idAluno']);

$_SESSION['localizacao']['cep'] = substr($end[11], 0, 2) . '.' . substr($end[11], 2, 3) . '-' . substr($end[11], 5, 3);
if ($_SESSION['localizacao']['cep'] == '.-') {
    $_SESSION['localizacao']['cep'] = '';
} else {

    $endereco = buscaEndereco($_SESSION['localizacao']['cep']);
    $_SESSION['localizacao']['logradouro'] = $endereco[1];
    $_SESSION['localizacao']['bairro'] = $endereco[2];
    $_SESSION['localizacao']['estado'] = $endereco[4];
    $_SESSION['localizacao']['municipio'] = $endereco[6];
}

if (isset($end[6])) {
    $_SESSION['localizacao']['logradouro'] = $end[6];
}
if (isset($end[7])) {
    $_SESSION['localizacao']['numero'] = $end[7];
}
if (isset($end[8])) {
    $_SESSION['localizacao']['complemento'] = $end[8];
}
if (isset($end[3])) {
    $_SESSION['localizacao']['bairro'] = $end[3];
}



if (isset($_SESSION['localizacao']['cep'])) {
    $_POST['cep'] = $_SESSION['localizacao']['cep'];
}
if (isset($_SESSION['localizacao']['logradouro'])) {
    $_POST['logradouro'] = $_SESSION['localizacao']['logradouro'];
}
if (isset($_SESSION['localizacao']['numero'])) {
    $_POST['numero'] = $_SESSION['localizacao']['numero'];
}
if (isset($_SESSION['localizacao']['complemento'])) {
    $_POST['complemento'] = $_SESSION['localizacao']['complemento'];
}
if (isset($_SESSION['localizacao']['bairro'])) {
    $_POST['bairro'] = $_SESSION['localizacao']['bairro'];
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
                        <div class="span12" style=' padding-top: 0px; text-align: center; padding-left: 150px;'>
                            <h3 style='margin-right:130px;'>Dados de Localização</h3>
                            <?php
                            if(isset($sucesso)){
                                if($sucesso){
                                    ?>
                                    <div class="sucesso" style='padding-right: 50px; margin-right: 150px;'>
                                        <strong>Sucesso!</strong> Localização atualizada!
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
                            <form id='form1' class="form-horizontal" method="post" onsubmit="$('#inputLogradouro').removeAttr('disabled');
                            $('#inputEstado').removeAttr('disabled');
                            $('#inputMunicipio').removeAttr('disabled');" style="">
                            <h4 style='margin-right:130px;'>Endereço de Residência do Aluno</h4>
                            <label class="control-label" for="inputCEP">CEP</label>
                            <div class="controls">
                                <input name='cep' type="text" id="inputCEP" data-mask='99.999-999' 
                                onchange='buscaEndereco($(this).val(), "inputLogradouro", "inputBairro", "inputMunicipio", "inputEstado");'
                                <?php
                                if (isset($_POST['cep'])) {
                                   echo 'value="' . $_POST['cep'] . '"';
                               }
                               ?>>
                           </div>
                           <div class="erro" id="foraDaArea" style="display: <?php
                           if (isset($erro['foraDaArea'])) {
                            if ($erro['foraDaArea'] == true) {
                                echo 'inherited';
                            } else {
                                echo 'none';
                            }
                        }
                        else
                            echo 'none';
                        ?>;">
                        <strong>Erro!</strong> O CEP entrado corresponde à um endereço fora da cidade de Florianópolis!
                    </div>
                    <div class="erro" id="CepNaoEncontrado" style="display: 
                    <?php
                    if (isset($erro['cepNaoEncontrado'])) {
                        if ($erro['cepNaoEncontrado']) {
                            echo 'inherited';
                        } else {
                            echo 'none';
                        }
                    }
                    else
                        echo 'none';
                    ?>">
                    <strong>Erro!</strong> CEP não encontrado!
                </div>
                <?php if (isset($erro['cep'])) { ?>
                <div class="erro">
                    <strong>Erro!</strong> Preencha o CEP para continuar.
                </div>
                <?php } ?>

                <label class="control-label" for="inputLogradouro">Logradouro</label>
                <div class="controls">
                    <input name='logradouro' type="text" id="inputLogradouro"
                    <?php
                    if (isset($_POST['logradouro'])) {
                        echo 'value="' . $_POST['logradouro'] . '"';
                    }
                    ?>>
                </div>
                <?php if (isset($erro['logradouro'])) { ?>
                <div class="erro">
                    <strong>Erro!</strong> Preencha o logradouro para continuar.
                </div>
                <?php } ?>

                <label class="control-label" for="inputNumero">Número
                    <span class="dica" data-toggle="tooltip" title="Caso o endereço não tenha número, preencha com o número 0">?</span>
                </label>
                <div class="controls">
                    <input name='numero' type="text" id="inputNumero"
                    <?php
                    if (isset($_POST['numero'])) {
                        echo 'value="' . $_POST['numero'] . '"';
                    }
                    ?>>
                </div>
                <?php if (isset($erro['numero'])) { ?>
                <div class="erro">
                    <strong>Erro!</strong> Número inválido!
                </div>
                <?php } ?>
                <?php if (isset($erro['numeroInvalido'])) { ?>
                <div class="erro">
                    <strong>Erro!</strong> Número inválido!
                </div>
                <?php } ?>

                <label class="control-label" for="inputComplemento">Complemento</label>
                <div class="controls">
                    <input name='complemento' type="text" id="inputComplemento"
                    <?php
                    if (isset($_POST['complemento'])) {
                        echo 'value="' . $_POST['complemento'] . '"';
                    }
                    ?>>
                </div>

                <label class="control-label" for="inputBairro">Bairro</label>
                <div class="controls">
                    <select name='bairro' id="inputBairro">
                        <option></option>
                        <?php
                        include 'fnc/listaDeBairros.php';
                        $estados = listaDeBairros(8452);
                        foreach ($estados as $key => $value) {
                            if ($key == $_POST['bairro']) {
                                echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                            } else {
                                echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <?php if (isset($erro['logradouro'])) { ?>
                <div class="erro">
                    <strong>Erro!</strong> Escolha um bairro para continuar.
                </div>
                <?php } ?>

                <label class="control-label" for="inputEstado">Unidade Federativa</label>
                <div class="controls">
                    <select name='estado' id="inputEstado" onchange="buscaMunicipio($(this).val(), 'inputMunicipio');" disabled>
                        <option></option>
                        <?php
                        include 'fnc/listaDeEstados.php';
                        $estados = listaDeEstados();
                        foreach ($estados as $key => $value) {
                            if ($key == 25) {
                                echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                            } else {
                                echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <label class="control-label" for="inputMunicipio">Município</label>
                <div class="controls">
                    <select name='municipio' id="inputMunicipio" disabled>
                        <?php
                        include 'fnc/listaDeMunicipios.php';
                                    $municipios = listaDeMunicipios(99); //99 para buscar todos os municipios
                                    foreach ($municipios as $key => $value) {
                                        if ($key == 8452) {
                                            echo '<option value="' . $key . '" selected>' . ($value[1]) . '</option>';
                                        } else {
                                            echo '<option value="' . $key . '">' . ($value[1]) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <hr>
                        </form>
                        <div style='margin-right: 20px;'>
                            <a class='btn btn-primary pull-right' onclick='$("#form1").submit();'>Salvar</a>
                            <a class='btn pull-right' style='margin-right: 5px;' href='editarAlunoFundamental.php?idAluno=<?php echo $_GET['idAluno']; ?>'>Voltar</a>;
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
        function buscaEndereco(cd_cep, id_elemento_logradouro, id_elemento_bairro, id_elemento_localidade, id_elemento_estado) {

            $.get("ajax/endereco.php", {cd_cep: cd_cep})
            .done(function(data) {

                var ar = JSON.parse(data);
                $('#foraDaArea').css('display', 'none');
                $('#CepNaoEncontrado').css('display', 'none');

                if (ar.length === 8) {
                    if (ar[4] != '8452') {
                        $('#foraDaArea').css('display', 'inherit');
                        $("#" + id_elemento_logradouro).val('');
                        $("#" + id_elemento_bairro + ">option:selected").removeAttr('selected');
                    } else {
                                            //$("#" + id_elemento_estado + ">option:selected").removeAttr('selected');
                                            $("#" + id_elemento_estado + ">option[value='" + ar[6] + "']").attr('selected', '');
                                            $("#" + id_elemento_estado).attr('disabled', '');
                                            //$("#" + id_elemento_localidade + ">option:selected").removeAttr('selected');
                                            $("#" + id_elemento_localidade + ">option[value='" + ar[4] + "']").attr('selected', '');
                                            $("#" + id_elemento_localidade).attr('disabled', '');
                                            $("#" + id_elemento_bairro + ">option:selected").removeAttr('selected');
                                            $("#" + id_elemento_bairro + ">option[value='" + ar[2] + "']").attr('selected', '');
                                            $("#" + id_elemento_logradouro).val(ar[1]);
                                        }
                                    } else {
                                        $('#CepNaoEncontrado').css('display', 'inherit');
                                    }
                                });

}
$('.dica').tooltip();
$('#conteudo').css('display', 'inherit');
</script>

</body>
</html>
