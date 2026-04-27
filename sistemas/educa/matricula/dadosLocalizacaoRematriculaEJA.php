<?php
session_name('re_eja');
session_start();

if (!$_SESSION['preenchido']['outros_dados']) {
	header('Location: outrosDadosRematriculaEJA.php');
}

include 'fnc/buscaEndereco.php';
include 'fnc/buscaAlunoEndereco.php';
$end = buscaAlunoEndereco($_SESSION['id']);

if(isset($end)){
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


if (count($_POST) > 0) {
	if (isset($_POST['cep'])) {
		if ($_POST['cep'] == '') {
			$erro['cep'] = true;
		}
		$endereco = buscaEndereco($_POST['cep']);
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
		$_SESSION['preenchido']['localizacao'] = true;


		header("Location: dadosEscolaresRematriculaEJA.php");
	}
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
	<meta charset="utf-8" CONTENT="NO-CACHE">
	<title>SGE &middot; Dados de Localização</title>
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
      		<div class='conteudo'>
      			<div class='row-fluid' style='text-align: center; height: 90px;'>
      				<div style='text-align: center; padding-top: 15px;'>
      					<h3>Dados de Localização do Aluno</h3>
      					<img src="img/lapis.png" style="width: 470px; position:relative; top: -65px; left: -25px;">
      				</div>
      			</div>
      			<div class='row-fluid' style='text-align: center;'>
      				<div class="span3" style="padding-left: 10px;">
      					<div class='itemLaranja ativo'>
      						Dados de Identificação  
      					</div>
      					<div class='itemVerde ativo'>
      						Dados Pessoais  
      					</div>
      					<div class='itemRoxo ativo'>
      						Outros Dados
      					</div>
      					<div class='itemAzul ativo'>
      						Dados de Localização
      					</div>
      					<div class='itemCinza marrom'>
      						Dados Escolares
      					</div>
      					<div class='itemCinza oliva'>
      						Dados dos Pais
      					</div>
      					<div class='itemCinza t'>
      						Dados de Renda
      					</div>
      					<div class='itemCinza verde-azulado'>
      						Confirmação
      					</div>
      				</div>

      				<div class="span8 folha" style='display: none;' id='conteudo'>
      					<img src="img/canto.png" style="position: relative; left: -238px; top: -10px;">
      					<!-- TODO - Atenção: Diferenças entre Infantil e Básica -->
      					<!-- TODO - Atenção: Validação -->
      					<!-- TODO - Atenção: Confirmação -->
      					<form class="form-horizontal" method="post" onsubmit="$('#inputLogradouro').removeAttr('disabled');
      					$('#inputEstado').removeAttr('disabled');
      					$('#inputMunicipio').removeAttr('disabled');">
      					<h4>Endereço de Residência do Aluno</h4>
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
      					<h5>Não sabe seu CEP? Clique <span class='linkSpan' onclick='window.open("http://www.buscacep.correios.com.br")'>aqui</span> e descubra!</h5>
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
                            <a class='btn' href='outrosDadosRematriculaEJA.php'>Voltar</a>
                            <button class='btn btn-primary'>Avan&ccedil;ar</button>
                        </form>
                    </div>   


                    <noscript>
                    	<div class="span8" style='padding-left: 10px;'>
                    		<div class="alert">
                    			<button type="button" class="close" data-dismiss="alert">&times;</button>
                    			<strong>AVISO!</strong> Você está com o JavaScript desabilitado. 
                    			<bR> Para continuar baixe o navegador Google Chrome <a href='http://www.google.com/intl/pt-BR/chrome/'>aqui</a>
                    				<br> ou habilite o JavaScript em seu navegador seguindo <a href='http://www.enable-javascript.com/pt/'>estas instruções</a>.
                    			</div>
                    		</div>
                    	</noscript>
                    </div>
                </div>

            </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.1.js"></script>
        <script src="js/bootstrap.js"></script>
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
