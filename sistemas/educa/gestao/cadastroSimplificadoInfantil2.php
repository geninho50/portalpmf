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

include 'fnc/buscaEscolasComLista.php';
$escolas = buscaEscolasComListaInfantil();

include 'fnc/buscaFases.php';
$fasesF = buscaFases(2);
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

</script>

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
                            <h3>Cadastro Simplificado</h3>

                <?php if (isset($_GET['erro'])) { ?>
                <div class="erro">
                    <strong>Erro!</strong> Um erro ocorreu. Tente novamente!
                </div>
                <?php } ?>
                <?php if (isset($_GET['sucesso'])) { ?>
                <div class="sucesso">
                    <strong>Sucesso!</strong> Criança inserida com sucesso!
                </div>
                <?php } ?>
                            <form style='text-align: center;' action="inserirCriancaCadastroSimplificado.php" method='POST'
                            onsubmit="$('#inputLogradouro').removeAttr('disabled');
                            $('#inputEstado').removeAttr('disabled');
                            $('#inputMunicipio').removeAttr('disabled');">
                            <label>Nome:</label>
                            <input id='nome' onkeypress="verificaCaracteres('#nome');" onkeyup="verificaCaracteres('#nome');" type='text' maxlength="100" name='nome' required>
                            <label>Data de Nascimento:</label>
                            <input name = 'dataNascimento' type = "text" class = 'datepicker' id = "inputDataNasc" placeholder = "dd/mm/aaaa" data-mask = '99/99/9999' onselect = "setCaretPosition($(this), 0);" required>
                            <label>Nome Mãe:</label>
                            <input id='nomeMae' onkeypress="verificaCaracteres('#nomeMae');" onkeyup="verificaCaracteres('#nomeMae');" type='text' maxlength="100" name='nomeMae'>
                            <label>Nome Pai:</label>
                            <input id='nomePai' onkeypress="verificaCaracteres('#nomePai');" onkeyup="verificaCaracteres('#nomePai');" type='text' maxlength="100" name='nomePai'>
                            <label>Unidade:</label>
                            <select name='idEscola'>
                                <?php 
                                if(isset($_SESSION['usuario']['id_escola'])){
                                    include_once 'fnc/buscaEscola.php';
                                    $escola = buscaEscola($_SESSION['usuario']['id_escola']);
                                    ?>
                                    <option value='<?php echo $escola[1][0]; ?>'><?php echo $escola[1][1]; ?></option>
                                    <?php
                                } else {
                                    foreach ($escolas as $key => $value) {
                                        ?>
                                        <option value='<?php echo $value[0]; ?>'><?php echo $value[1]; ?></option>
                                        <?php
                                    } 
                                }
                                ?>

                            </select>

                            <h4>Endereço de Residência do Aluno</h4>
                            <label class="control-label" for="inputCEP">CEP:</label>
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
                <h5>Não sabe seu CEP? Clique <span class='linkSpan' onclick='window.open("http://www.buscacep.correios.com.br")'>aqui</span> e descubra!</h5>
                <label class="control-label" for="inputLogradouro">Logradouro:</label>
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

                <label class="control-label" for="inputNumero">Número:</label>
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

                <label class="control-label" for="inputComplemento">Complemento:</label>
                <div class="controls">
                    <input name='complemento' type="text" id="inputComplemento"
                    <?php
                    if (isset($_POST['complemento'])) {
                        echo 'value="' . $_POST['complemento'] . '"';
                    }
                    ?>>
                </div>

                <label class="control-label" for="inputBairro">Bairro:</label>
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

                <label class="control-label" for="inputEstado">Unidade Federativa:</label>
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

                <label class="control-label" for="inputMunicipio">Município:</label>
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
                            <button class='btn btn-primary'>Cadastrar</button> 
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
         <script type="text/javascript">
                                  function setCaretPosition(elemId, caretPos) {
                                      var elem = document.getElementById(elemId);

                                      if (elem != null) {
                                          if (elem.createTextRange) {
                                              var range = elem.createTextRange();
                                              range.move('character', caretPos);
                                              range.select();
                                          }
                                          else {
                                              if (elem.selectionStart) {
                                                  elem.focus();
                                                  elem.setSelectionRange(caretPos, caretPos);
                                              }
                                              else
                                                  elem.focus();
                                          }
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

  </body>
  </html>
