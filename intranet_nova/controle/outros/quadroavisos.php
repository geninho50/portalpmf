
<?php
	require_once("valida_session.php");
	require_once("../scripts/php/funcoes_bd.php"); 
	require_once("../scripts/php/config.php");	
	/*
	//-------------------------------------------
	// em caso de editar
	//-------------------------------------------
	*/
								
	if(isset($_GET['edit']) && isset($_POST['Ftitulo'])){
		$Ttitulo 	 = $_POST['Ftitulo'];
		$Ttexto		 = $_POST['Ftexto'];
		$TdataFim 	 = desFormataData($_POST['FdataFim']);
		$TdataInicio = desFormataData($_POST['FdataInicio']);

		$sql = "UPDATE telao SET 
				inicio   = '$TdataInicio',
				fim      = '$TdataFim',
				manchete =  '$Ttitulo',
				texto    = '$Ttexto'
				WHERE telao_id = ". intval($_GET['edit']).";";

		$Tresult = $drive->pedido($sql);

		if($Tresult == true){
			echo("<script>alert('Aviso editado com Sucesso')</script>");	
			$drive->redirect("inicio.php?pagina=listaavisos&menu=12");
		}else{
			echo("<script>alert('Nao foi possivel editar o Aviso')</script>");
			$drive->redirect("inicio.php?pagina=quadroavisos&menu=12&ac=edit&edit=".intval($_GET['edit']));
		}

	}

	if(isset($_GET['ac']) && $_GET['ac'] == 'edit'){
		$sql 		= "SELECT * FROM telao where telao_id = ". intval($_GET['edit']) . ";";
		$result		= $drive->pedido($sql);
		$edit 	= pg_fetch_object($result);
		$edit->inicio = formataData($edit->inicio);
		$edit->fim = formataData($edit->fim);
	}

	function formataData($data){
		$dataArr = explode("-", $data);
		$dataFinal = $dataArr[2] . "/" . $dataArr[1] . "/" . $dataArr[0];
		return $dataFinal;
	}

	function desFormataData($data){
		$dataArr = explode("/", $data);
		$dataFinal = $dataArr[2] . "-" . $dataArr[1] . "-" . $dataArr[0];
		return $dataFinal;
	}
?>

<style type="text/css">
.hidden {
  display: none !important;
  visibility: hidden !important;
}
</style>
	<div class="centro">
		<div id="caminho_migalhas">intranet &gt;</div>
		<div id="titulo_pagina">Inserir aviso</div>
		<div id="margem_direita"><br>
			<div class="conteudo_abas">
				<div role="form">
					<div id="conteudo_dados" >
						<? if(empty($_POST['passoCrop'])){ ?>
							<form method="post" enctype="multipart/form-data">
								
								<div class="texto_formulario">Titulo:</div>
								<input name="Ftitulo" id="Ftitulo" type="text" class="componente_miolo" maxlength="50" value="<?=$edit->manchete?>"/><br>
								<script type="text/javascript">
									var Ftitulo = new LiveValidation('Ftitulo'); 
									Ftitulo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
								</script>  

								<div class="texto_formulario">Texto:</div>
								<input name="Ftexto" id="Ftexto" type="text" class="componente_miolo" maxlength="200" value="<?=$edit->texto?>"/><br>
							
								<div style="float: left">
								<div class="texto_formulario">Data Inicio:</div>
								<input name="FdataInicio" id="FdataInicio" type="text" class="componente_miolo" style="width: 100px;" value="<?=$edit->inicio?>"/><br>
								<script type="text/javascript">
									var FdataInicio = new LiveValidation('FdataInicio'); 
									Ftitulo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
								</script>  
								</div>

								<div style="float: left; margin-left: 50px;">
								<div class="texto_formulario">Data Fim:</div>
								<input name="FdataFim" id="FdataFim" type="text" class="componente_miolo" style="width: 100px;" value="<?=$edit->fim?>"/><br>
								<script type="text/javascript">
									var FdataFim = new LiveValidation('FdataFim'); 
									Ftitulo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
								</script>  
								</div>
								
								<div style="margin-top: 50px;">
								<?php if(!isset($_GET['edit'])) { ?>
								<input type="hidden" name="passoCrop" value="1" />
								<div class="texto_formulario">Arquivo da imagem:</div>
								<input name="Farquivo" id="Farquivo" type="file" size="68"/> 
								<script type="text/javascript">
									var Farquivo = new LiveValidation('Farquivo'); 
									Farquivo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
								</script>  
								<br><br>
								<input type="checkbox" name="FtelaCheia" id="FtelaCheia">
								<label for="FtelaCheia">Imagem de aviso para tela cheia</label>

								<?php }?>
								</div>
								<br/>
								<br/>
								<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btSalv" id="btSalv" value="btSalv" />
							</form>
							<?
							}else{

								if($_POST['passoCrop'] == 1){
									include ("cropar.php");
								}else{
									include "../scripts/php/wideimage/WideImage.inc.php";
									require_once("../scripts/php/funcoes.php");
									/*
									//-------------------------------------------
									// Dados a serem inseridos no banco de dados
									//-------------------------------------------
									$sizes['x1'] = $_POST['x1'];
									$sizes['y1'] = $_POST['y1'];
									$sizes['x2'] = $_POST['x2'];
									$sizes['y2'] = $_POST['y2'];
									$sizes['w']  = $_POST['w'];
									$sizes['h']  = $_POST['h'];
									*/
									$Ttitulo 	 = $_POST['Ftitulo'];
									$Ttexto		 = $_POST['Ftexto'];
									$TdataFim 	 = $_POST['FdataFim'];
									$TdataInicio = $_POST['FdataInicio'];
									$TnomeImg 	 = $_POST['FnomeImg'];
									$TimagemTemp = $_POST['FimagemTemp'];
									$TimagemReal = $_POST['FimagemReal'];
									$TtelaCheia  = $_POST['FtelaCheia'];
									
									/*
									//-------------------------------------------------------
									//redimensiona as imagens => pequena => preview => media
									//-------------------------------------------------------		
									if(!$sizes['x1']==0 or !$sizes['y1']==0){
									
										$img = wiImage::load($TimagemTemp);
										$res = $img->crop($sizes['x1'],$sizes['y1'],$sizes['w'],$sizes['h']);
										$res->saveToFile($TimagemReal , null, 1000);
										@unlink($TimagemTemp);
									
									}
									*/
									//------------------------------------
									// insere no dados no banco de dados
									//------------------------------------
									
									$Tdata = date('Y/m/d');

									$sql = "INSERT INTO 
											telao(  inicio, 
													fim, 
													manchete, 
													texto, 
													imagem,
													tela_cheia
											)VALUES(
													'$TdataInicio',
													'$TdataFim',
													'$Ttitulo',
													'$Ttexto',
													'$TimagemReal',
													'$TtelaCheia'
													)";
									
									$Tresult = $drive->pedido($sql);
	
									if($Tresult == true){
										echo("<script>alert('Aviso cadastrado com Sucesso')</script>");	
										$drive->redirect("inicio.php?pagina=listaavisos&menu=12");
									}else{
										echo("<script>alert('Nao Foi Possivel Cadastrar a Aviso')</script>");
										$drive->redirect("inicio.php?pagina=quadroavisos&menu=12");
									}
								}
							} ?>
				</div>
			</div>
		</div>
	</div>
</div>  
<script src="http://www.pmf.sc.gov.br/sistemas/casacivil/scd/jquery.maskedinput.js"></script>
<script> 
	$(document).ready(function(){
			$('#FdataFim').mask('99/99/9999');
			$('#FdataInicio').mask('99/99/9999');
			$('#Ftitulo').maxlength({max: 50});
			$('#Ftexto').maxlength({max: 200});
	});
</script>