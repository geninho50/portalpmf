<?php
//------------------------------------------
// Página implementada em : 26/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

if(empty($_POST['passoCrop'])){
?>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="passoCrop" value="1" />
<div class="texto_formulario">Arquivo da imagem:</div>
<input name="Farquivo" id="Farquivo" type="file" size="68"/> 
<script type="text/javascript">
	var Farquivo = new LiveValidation('Farquivo'); 
	Farquivo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
<div class="texto_formulario">Legenda:</div>
<input name="Flegenda" id="Flegenda" type="text" class="componente_miolo" maxlength="200" /><br>
<script type="text/javascript">
	var Flegenda = new LiveValidation('Flegenda'); 
	Flegenda.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
<div class="texto_formulario">Autor (origem):</div>
<input name="Fautor" id="Fautor" type="text" class="componente_miolo" maxlength="100" /><br>
<script type="text/javascript">
	var Fautor = new LiveValidation('Fautor'); 
	Fautor.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
<div class="container_tags">  
<div class="texto_formulario">Tags de Busca:</div>
<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all"/>Dica: cadastre o t&iacute;tulo do arquivo como TAG. D&ecirc; espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma. <br />
<script type="text/javascript">
	var Ftags = new LiveValidation('Ftags'); 
	Ftags.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
</div>
<br/>
<br/>
<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btSalv" id="btSalv" value="btSalv" />
</form>

<?php
}else{
	if($_POST['passoCrop'] == 1){
		include ("midias/imagens/cropar.php");
	}else{
		include "../scripts/php/wideimage/WideImage.inc.php";
		require_once("../scripts/php/funcoes.php");
		
		//-------------------------------------------
		// Dados a serem inseridos no banco de dados
		//-------------------------------------------
		$sizes['x1'] = $_POST['x1'];
		$sizes['y1'] = $_POST['y1'];
		$sizes['x2'] = $_POST['x2'];
		$sizes['y2'] = $_POST['y2'];
		$sizes['w']  = $_POST['w'];
		$sizes['h']  = $_POST['h'];
		
		$Ttags 		 = $_POST['Ftags'];
		$Tautor		 = $_POST['Fautor'];
		$Tlegenda 	 = strip_tags($_POST['Flegenda']);
		$TnomeImg 	 = $_POST['FnomeImg'];
		$TimagemTemp = $_POST['FimagemTemp'];
		$TimagemReal = $_POST['FimagemReal'];
		$Tmedia 	 = "../arquivos/imagens/$TnomeImg"."MEDIA.jpg";
		$Tpequena 	 = "../arquivos/imagens/$TnomeImg"."PEQUENA.jpg";
		$Tpreview 	 = "../arquivos/imagens/$TnomeImg"."PREVIEW.jpg";
		
		//-------------------------------------------------------
		//redimensiona as imagens => pequena => preview => media
		//-------------------------------------------------------		
		if(!$sizes['x1']==0 or !$sizes['y1']==0){
		
			$img = wiImage::load($TimagemTemp);
			$res = $img->crop($sizes['x1'],$sizes['y1'],$sizes['w'],$sizes['h']);
			$imgCrop = '../arquivos/imagens/cropada.jpg';
			$res->saveToFile($imgCrop , null, 40);
		
			reduz_imagem($imgCrop ,115, 89, $Tpreview);
			reduz_imagem($imgCrop ,172, 129, $Tpequena);
			reduz_imagem($imgCrop ,260, 195, $Tmedia);
		
			@unlink($imgCrop);
			@unlink($TimagemTemp);
		
		}else{
		
			reduz_imagem($imagemReal,115, 89, $Tpreview);
			reduz_imagem($imagemReal,172, 129, $Tpequena);
			reduz_imagem($imagemReal ,260, 195, $Tmedia);
		
		}
		
		
		//------------------------------------
		// insere no dados no banco de dados
		//------------------------------------
		
		$idEntidade = $_SESSION['SuserEnt'];

		$Tdata = date('Y/m/d');

		$sql = "INSERT INTO 
					imagens(
						img_id,
						img_legenda,
						img_palavra_chave,
						img_link_v_alta,
						img_link_v_media, 
						img_link_v_preview, 
						img_link_v_pequena, 
						img_data,
						img_entidade_id,
						img_autor
				)VALUES(
						default, 
						'$Tlegenda',
						'$Ttags', 
						'$TimagemReal', 
						'$Tmedia', 
						'$Tpreview', 
						'$Tpequena', 
						'$Tdata',
						 $idEntidade,
						'$Tautor')";

		$Tresult = $drive->pedido($sql);
		
		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){
		
			$Tpagina  = $_GET['idPag'];
			$sqlLoc   = "SELECT img_id FROM imagens ORDER BY img_id DESC LIMIT 1";
			$TretImg  = $drive->pedido($sqlLoc);
			$Timagem  = pg_fetch_object($TretImg);
			$TimgId   = $Timagem->img_id;
			$Tprinc	  = 0;
			$sqlImg1  = "INSERT INTO 
							intranet_pagina_imagens(
								intranet_imgpagina_id, 
								intranet_imgpagina_pag_id,
								intranet_imgpagina_img_id,
								intranet_imgpagina_principal
						)VALUES(
							default, 
							$Tpagina,
							$TimgId,
							'$Tprinc')";
	
			$TretImg  = $drive->pedido($sqlImg1);

			$Tcaminho = "inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens";
		}else{
			$Tcaminho = "inicio.php?pagina=imginclui&menu=".$_GET['menu']."";
		}
		
		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "edtnot"){
		
			$Tnoticia = $_GET['idNot'];
			$sqlLoc   = "SELECT img_id FROM imagens ORDER BY img_id DESC LIMIT 1";
			$TretImg  = $drive->pedido($sqlLoc);
			$Timagem  = pg_fetch_object($TretImg);
			$TimgId   = $Timagem->img_id;
			$Tprinc	  = 0;
			$sqlImg1  = "INSERT INTO 
							intranet_noticia_imagens(
								intranet_imgnoticia_id, 
								intranet_imgnoticia_not_id,
								intranet_imgnoticia_img_id,
								intranet_imgnoticia_principal
						)VALUES(
							default, 
							$Tnoticia,
							$TimgId,
							'$Tprinc')";
	
			$TretImg  = $drive->pedido($sqlImg1);

			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&idNot=".$_GET['idNot']."&aba=imagens";
		}else{
			$Tcaminho = "inicio.php?pagina=imginclui&menu=".$_GET['menu']."";
		}
		
				
		if($Tresult == true){
			echo("<script>alert('Imagem cadastrada com Sucesso')</script>");	
			$drive->redirect($Tcaminho);
		}else{
			echo("<script>alert('Nao Foi Possivel Cadastrar a Imagem')</script>");
			$drive->redirect($Tcaminho);
		}
	}
}
?>