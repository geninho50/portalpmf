<?php
//------------------------------------------
// Página implementada em : 21/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

if(!isset($_POST['btEdidt_x'])){
		
	require_once("../scripts/php/funcoes.php");
	
	$TaudId = $_GET['id'];
	$sql 	= "SELECT * FROM midia WHERE midia_id = $TaudId";
	$Tresult = $drive->pedido($sql);
	$Taud = pg_fetch_object($Tresult);

	// ---------- Carrega Player de Áudio ----------
						
	$nomeMidia 	= $Taud->midia_link;
	$width		="290";					
	$height 	= "24";
	$player		="../scripts/php/audioPlayer";
	$audio  	="http://portal.pmf.sc.gov.br/$nomeMidia";				
	$retorno	= audioPlayer($audio,$width,$height,$player);
	
	// ---------- Fim Carrega Player de Áudio ----------

	echo $retorno;
?>
<br />
<form method="post">
<input type="hidden" name="Fid" value="<?=$Taud->midia_id?>" />
<div class="texto_formulario">Legenda:</div>
<input name="Flegenda" type="text" class="componente_miolo" maxlength="200" value="<?=strip_tags($Taud->midia_legenda)?>" /><br>  
<div class="container_tags">  
<div class="texto_formulario">Tags de Busca:</div>
<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all" value="<?=$Taud->midia_palavra_chave?>" /><br>               
</div>
<br>
<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btEdidt" id="btEdit" value="btEdit" />
</form>
<?php
}else{
	
	$TidAud		= $_POST['Fid'];
	$Tlegenda 	= $_POST['Flegenda'];
	$Ttags 		= $_POST['Ftags'];
	
	$sqlAud		= "UPDATE
						midia
				   SET
				   		midia_legenda = '$Tlegenda',
						midia_palavra_chave = '$Ttags'
				   WHERE
				   		midia_id = $TidAud";
	
	
	$Tresult 	= $drive->pedido($sqlAud);
	
		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){	
			$Tcaminho = "inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=audios";
		}else{
			$Tcaminho = "inicio.php?pagina=audedit&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
		
		//-------------------------------------------
		// Verifica de qual noticia partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "edtnot"){	
			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&idNot=".$_GET['idNot']."&aba=audios";
		}else{
			$Tcaminho = "inicio.php?pagina=audedit&menu=".$_GET['menu']."&id=".$_GET['id']."";
		}
		
		//-------------------------------------------
		// Final de verificação
		//-------------------------------------------

	if($Tresult == true){
		echo"<script>alert(\"Midia Editada com Sucesso!\");</script>";
		$drive->redirect($Tcaminho);
	}else{
		echo"<script>alert(\"Nao foi possivel Editar a Mídia!\");</script>";
		$drive->redirect($Tcaminho);
	}
}
?>