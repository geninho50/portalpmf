
<?php

	require_once("valida_session.php");
	require_once("../scripts/php/funcoes_bd.php"); 
	require_once("../scripts/php/config.php");	

	if($_GET["edit"] != null){
		$sql = "SELECT * FROM relatorios_ouvidoria WHERE id =". intval($_GET['edit']) . ";"; 
		$result		= $drive->pedido($sql);
		$rel 	= pg_fetch_object($result);
	}


?>

<style type="text/css">
.hidden {
  display: none !important;
  visibility: hidden !important;
}

.alert{
	text-align: center;
	font-weight: bold;
	padding: 5px !important;
}

.warning{
	color: red;
}

.success{
	color: green;
}
</style>
	<div class="centro">
		<div id="caminho_migalhas">intranet &gt;</div>
		<div id="titulo_pagina">Inserir Relatório</div>
		<div id="margem_direita"><br>
			<div class="conteudo_abas"  style="width:440px;">
				<div role="form">
					<div id="conteudo_dados" >
					<?php 
						if($_GET["msg"] != null){
							$msgTipo = 'warning';
							switch($_GET["msg"]) {
								case 0:
									$msg = "Arquivo enviado com sucesso!";
									$msgTipo = 'success';
									break;
								case 1:
									$msg = "Titulo não pode estar em branco";
									break;
								case 2:
									$anoAtual = intval( Date('Y') );
									$msg = "Ano não pode ser maior que o ano atual ($anoAtual)";
									break;
								case 3:
									$msg = "Somente são permitidos arquivos em PDF";
									break;
								default:
									$msg = "Ocorreu um erro";
									break;
							}
							echo "<p class='alert ".$msgTipo."'>".$msg."</p>";
						}
					?> 
						<?php if($_GET["edit"] != null) { ?>
							<form method="post" enctype="multipart/form-data" action="controle/ouvidoria/updateRelatorio.php">
						<?php }else{ ?>
							<form method="post" enctype="multipart/form-data" action="controle/ouvidoria/inserirRelatorioOuvidoria.php">
						<?php } ?>

							<div class="texto_formulario">Titulo:</div>
							<input name="Ftitulo" id="Ftitulo" type="text" class="componente_miolo" maxlength="50" value="<?=$rel->titulo?>"/><br>
							<input type="hidden" value="<?=$rel->id?>" id="id" name="id">
							<script type="text/javascript">
								var Ftitulo = new LiveValidation('Ftitulo'); 
								Ftitulo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
							</script>  

							<div style="float: left;"> 
							<div class="texto_formulario">Mês:</div>
								<select name="Fmes" id="Fmes" class="componente_miolo" style="width: 150px;" value="03">
								  <option value="1"> Janeiro   </option>
								  <option value="2"> Fevereiro </option>
								  <option value="3"> Março     </option>
								  <option value="4"> Abril     </option>
								  <option value="5"> Maio      </option>
								  <option value="6"> Junho     </option>
								  <option value="7"> Julho     </option>
								  <option value="8"> Agosto    </option>
								  <option value="9"> Setembro  </option>
								  <option value="10"> Outubro   </option>
								  <option value="11"> Novembro  </option>
								  <option value="12"> Dezembro  </option>
								</select>
							</div>

							<div style="float: right; margin-right: 70px; margin-top: 5px;">
							<div class="texto_formulario">Ano:</div>
							<input name="Fano" id="Fano" type="text" class="componente_miolo" style="width: 100px;" value="<?=$rel->ano?>"><br>
							<script type="text/javascript">
								var Fano = new LiveValidation('Fano'); 
								Fano.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
							</script>  
							</div>
							
							<div style="margin-top: 50px;">
							<?php if($_GET['edit'] == null){ ?>
								<div class="texto_formulario">Arquivo (PDF):</div>
								<input name="Farquivo" id="Farquivo" type="file" size="68"/> 
								<script type="text/javascript">
									var Farquivo = new LiveValidation('Farquivo'); 
									Farquivo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
								</script>  
							<?php }else{
								echo "<script>$('#Fmes').val($rel->mes).attr('selected');</script>";

								}?>
							</div>
						
							<br/>
							<br/>
							<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btSalv" id="btSalv" value="btSalv" />
						</form>
				</div>
			</div>
		</div>
	</div>
</div>  
<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
<script> 
	$(document).ready(function(){
			$('#Fano').mask('9999');
			$('#Ftitulo').maxlength({max: 50});
			$('#Ftexto').maxlength({max: 200});
	});
</script>