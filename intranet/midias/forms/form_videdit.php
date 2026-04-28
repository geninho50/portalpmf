<?php 
//------------------------------------------
// Página implementada em : 21/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

if(!isset($_POST['btEdit_x'])){
	
	require_once("../scripts/php/funcoes.php");
	
	$TvidId  = $_GET['id'];
	$sqlVid  = "SELECT * FROM midia WHERE midia_id = $TvidId";
	$Treturn = $drive->pedido($sqlVid);
	$Tvid 	 = pg_fetch_object($Treturn);
	
	// ---------- Carrega Player de Vídeo ----------
	
	$width	 = "172";					
	$height  = "129";
	$player	 = "../scripts/php/videoPlayer";
	$video 	 = "http://portal.pmf.sc.gov.br/".$Tvid->midia_link;				
	$retorno = videoPlayer($video,$width,$height,$player);
	
	// ---------- Fim Carrega Player de Vídeo ----------	
	
?>
<form method="post">
<input type="hidden" name="FidVid" value="<?=$Tvid->midia_id?>" />
<?=$retorno?>
<br />
<br />
<div class="texto_formulario">Legenda:</div>
<input name="Flegenda" type="text" class="componente_miolo" maxlength="200" value="<?=$Tvid->midia_legenda?>" /><br> 

<div class="container_tags">  
<div class="texto_formulario">Tags de Busca:</div>
<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Tvid->midia_palavra_chave?>" /><br>  
</div>

<br>
<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btEdit" id="btEdit" value="btEdit" />
</form>
<?php
}else{
	
	$TvidId 	= $_POST['FidVid'];
	$Tlegenda 	= $_POST['Flegenda'];
	$Ttags 		= $_POST['Ftags'];
	
	$sqlUpdate  = "UPDATE
						midia
				   SET
				   		midia_legenda = '$Tlegenda',
						midia_palavra_chave = '$Ttags' 
				   WHERE
				   		midia_id = $TvidId";
						
	$Tresult 	= $drive->pedido($sqlUpdate);

		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){	
			$Tcaminho = "inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=videos";
		}else{
			$Tcaminho = "inicio.php?pagina=videdit&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
		
		//-------------------------------------------
		// Verifica de qual noticia partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "edtnot"){	
			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&idNot=".$_GET['idNot']."&aba=videos";
		}else{
			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
		
		//-------------------------------------------
		// Final de verificação
		//-------------------------------------------

			
	if($Tresult == true){
		echo"<script>alert(\"Midia Editada com Sucesso!\");</script>";
		$drive->redirect($Tcaminho);
	}else{
		echo"<script>alert(\"Nao foi possivel Editar a Midia!\");</script>";
		$drive->redirect($Tcaminho);;
	}
	
}
?>