<?php
//------------------------------------------
// Página implementada em : 26/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

if(!isset($_POST['btEdit_x'])){

	$TimgId = $_GET['id'];
	$sql 	= "SELECT * FROM imagens WHERE img_id = $TimgId";
	$Tresult = $drive->pedido($sql);
	$Timg = pg_fetch_object($Tresult);

?>
<form method="post">
<input type="hidden" name="Fid" value="<?=$Timg->img_id?>" />
<img src="<?=$Timg->img_link_v_media?>" width="260" height="195" style="border:solid 5px #FFF;"/>               
<div class="texto_formulario">Legenda:</div>
<input name="Flegenda" type="text" class="componente_miolo" maxlength="200" value="<?=$Timg->img_legenda?>" /><br>
<div class="texto_formulario">Autor (origem):</div>
<input name="Fautor" type="text" class="componente_miolo" maxlength="100" value="<?=$Timg->img_autor?>" /><br>


<div class="container_tags"><div class="texto_formulario">Tags de Busca:</div>
<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Timg->img_palavra_chave?>" /><br/>
</div>

<?php 
if($_GET['pagina'] == "pagedit"){	
	
	$Tpag_id = $_GET['idPag'];
	$sql 	 = "SELECT * FROM intranet_pagina_imagens WHERE intranet_imgpagina_pag_id = $Tpag_id AND intranet_imgpagina_img_id = $TimgId";
	$Tresult = $drive->pedido($sql);
	$TimgPag = pg_fetch_object($Tresult);
?>


<input type="hidden" name="idImgPag" value="<?=$TimgPag->intranet_imgpagina_id?>" />	
<input type="checkbox" name="Fprincipal" value="1" <?php if($TimgPag->intranet_imgpagina_principal == 't'){echo"checked=\"checked\"";}?> />
&nbsp;&nbsp;<b>Imagem Principal</b><br><br>
<?
}
?>
<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btEdit" id="btEdit" value="btEdit" />
</form>
<?php
}else{
	$TimgId		= $_POST['Fid'];
	$Tlegenda 	= $_POST['Flegenda'];
	$Tautor 	= $_POST['Fautor'];
	$Ttags 		= $_POST['Ftags'];
	
	$sqlUpdate	= "UPDATE
						imagens
				   SET
				   		img_legenda = '$Tlegenda',
						img_autor = '$Tautor',
						img_palavra_chave = '$Ttags'
				   WHERE
				   		img_id = $TimgId";
	
	$Tresult 	= $drive->pedido($sqlUpdate);
	
		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){
			
			$TpagImgId  = $_POST['idImgPag'];
			
			//-----------------------------------------------------
			// procura se ja existe uma imagem principal na página
			//-----------------------------------------------------
			$sqlPrinc 	= "SELECT * FROM intranet_pagina_imagens WHERE intranet_imgpagina_pag_id = $TpagImgId AND intranet_imgpagina_principal = 't'";
			$TresulImg 	= $drive->pedido($sqlPrinc);	
			$TexistePr	= pg_fetch_object($TresulImg);
			if($TexistePr != false){
				$Tid		= $TexistePr->intranet_imgpagina_id;
				$Tprincipal = 0;
				$sqlUpdate	= "UPDATE intranet_pagina_imagens SET intranet_imgpagina_principal = '$Tprincipal' WHERE intranet_imgpagina_id = $Tid";
				//----------------------------------------------------------
				// desmarca imagem principal para que seja adicionada outra
				//----------------------------------------------------------
				$TresulImg	= $drive->pedido($sqlUpdate);	
			}
			
			$Tprincipal	= $_POST['Fprincipal'];
			if($Tprincipal == NULL){$Tprincipal=0;}
			 
			$sqlUpdate	= "UPDATE intranet_pagina_imagens SET intranet_imgpagina_principal = '$Tprincipal' WHERE intranet_imgpagina_id = $TpagImgId";
			$TresulImg	= $drive->pedido($sqlUpdate);		

			$Tcaminho = "inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens";
		}else{
			$Tcaminho = "inicio.php?pagina=imgedit&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
	
	
		//-------------------------------------------
		// Verifica de qual noticia partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "edtnot"){
			
			$TpagImgId  = $_POST['idImgPag'];
			
			//-----------------------------------------------------
			// procura se ja existe uma imagem principal na página
			//-----------------------------------------------------
			$sqlPrinc 	= "SELECT * FROM intranet_noticia_imagens WHERE intranet_imgnoticia_not_id = $TpagImgId AND intranet_imgnoticia_principal = 't'";
			$TresulImg 	= $drive->pedido($sqlPrinc);	
			$TexistePr	= pg_fetch_object($TresulImg);
			if($TexistePr != false){
				$Tid		= $TexistePr->intranet_imgpagina_id;
				$Tprincipal = 0;
				$sqlUpdate	= "UPDATE intranet_noticia_imagens SET intranet_imgnoticia_principal = '$Tprincipal' WHERE intranet_imgnoticia_id = $Tid";
				//----------------------------------------------------------
				// desmarca imagem principal para que seja adicionada outra
				//----------------------------------------------------------
				$TresulImg	= $drive->pedido($sqlUpdate);	
			}
			
			$Tprincipal	= $_POST['Fprincipal'];
			if($Tprincipal == NULL){$Tprincipal=0;}
			 
			$sqlUpdate	= "UPDATE intranet_noticia_imagens SET intranet_imgnoticia_principal = '$Tprincipal' WHERE intranet_imgnoticia_id = $TpagImgId";
			$TresulImg	= $drive->pedido($sqlUpdate);		

			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&idNot=".$_GET['idNot']."&aba=imagens";
		}else{
			$Tcaminho = "inicio.php?pagina=imgedit&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
	
	if($Tresult == true){
		echo"<script>alert(\"Imagem Editada com Sucesso!\");</script>";
		$drive->redirect($Tcaminho);
	}else{
		echo"<script>alert(\"Nao foi possivel Editar a Imagem!\");</script>";
		$drive->redirect($Tcaminho);
	}
}
?>             