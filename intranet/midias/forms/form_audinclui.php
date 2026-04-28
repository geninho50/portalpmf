<?php
//------------------------------------------
// Página implementada em : 21/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

 if(!isset($_POST['btSalv_x'])){ ?>
<form method="post" enctype="multipart/form-data">
<div class="texto_formulario">Arquivo de &aacute;udio:</div>
<input name="Farquivo" id="Farquivo" type="file" size="68"/><br />Obs.: Apenas arquivos .mp3, com no m&aacute;ximo de 15 MB      
<script type="text/javascript">
	var Farquivo = new LiveValidation('Farquivo'); 
	Farquivo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
<div class="texto_formulario">Legenda:</div>
<input name="Flegenda" id="Flegenda" type="text" class="componente_miolo" maxlength="200" /><br>  
T&iacute;tulo de exibi&ccedil;&atilde;o do &aacute;udio<br />
<script type="text/javascript">
	var Flegenda = new LiveValidation('Flegenda'); 
	Flegenda.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script> 
<div class="container_tags">  
<div class="texto_formulario">Tags de Busca:</div>
<input type="text" name="Ftags" id="Ftags" class="ui-widget-content ui-corner-all" />Dica: cadastre o t&iacute;tulo do arquivo como TAG . D&ecirc; espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma. <br />
<script type="text/javascript">
	var Ftags = new LiveValidation('Ftags'); 
	Ftags.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script> 
</div>
<br>    
<br>
<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btSalv" id="btSalv" value="btSalv" />
</form>
<?php
}else{
	$TentidadeId= $_SESSION['SuserEnt'];
	$TtipoMidia	= 1;
	$Tdata		= date("Y/m/d");
	$Tarquivo 	= $_FILES['Farquivo'];
	$Tlegenda 	= $_POST['Flegenda'];
	$Ttag		= $_POST['Ftags'];
	
	// ---------- Upload Audio ----------
	
	$Tdiretorio = CAMINHO_SITE."/".UPLOAD_AUDIO;  
	$Textensao  = "mp3";	
	$TretUpload = $drive->upload($Tdiretorio,$Tarquivo,$Textensao,15);	
	$Tcaminho 	= UPLOAD_AUDIO."mp3/".$TretUpload[4].".mp3";
	
	// ---------- Fim Upload Audio ----------
	
	if($TretUpload[1] == true){
		$sql = "INSERT INTO 
					midia(
						midia_id,
					 	midia_legenda, 
					 	midia_tipo, 
					 	midia_palavra_chave, 
					 	midia_link, 
					 	midia_data,
					 	midia_entidade_id) 
				VALUES
					 (default, 
					 '$Tlegenda', 
					  $TtipoMidia, 
					 '$Ttag', 
					 '$Tcaminho', 
					 '$Tdata',
					  $TentidadeId) " ;
					  
		$Tresult = $drive->pedido($sql);
		
		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){
		
			$Tpagina  = $_GET['idPag'];
			$sqlLoc   = "SELECT midia_id FROM midia ORDER BY midia_id DESC LIMIT 1";
			$TretMid  = $drive->pedido($sqlLoc);
			$Tmidia   = pg_fetch_object($TretMid);
			$TmidId   = $Tmidia->midia_id;
			$sqlMid1  = "INSERT INTO 
							intranet_pagina_midias(
								intranet_midpagina_id, 
								intranet_midpagina_pag_id,
								intranet_midpagina_mid_id,
								intranet_midpagina_tipo
						)VALUES(
							default, 
							$Tpagina,
							$TmidId,
							1)";
	
			$TretMid  = $drive->pedido($sqlMid1);
			
			$Tcaminho = "inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=audios";
		}else{
			$Tcaminho = "inicio.php?pagina=audinclui&menu=".$_GET['menu']."";
		}
		
		//-------------------------------------------
		// Verifica de qual notícia partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){
		
			$Tnoticia = $_GET['idNot'];
			$sqlLoc   = "SELECT midia_id FROM midia ORDER BY midia_id DESC LIMIT 1";
			$TretMid  = $drive->pedido($sqlLoc);
			$Tmidia   = pg_fetch_object($TretMid);
			$TmidId   = $Tmidia->midia_id;
			$sqlMid1  = "INSERT INTO 
							intranet_noticia_midias(
								intranet_midnoticia_id, 
								intranet_midnoticia_not_id,
								intranet_midnoticia_mid_id,
								intranet_midnoticia_tipo
						)VALUES(
							default, 
							$Tnoticia,
							$TmidId,
							1)";
	
			$TretMid  = $drive->pedido($sqlMid1);
			
			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&idNot=".$_GET['idNot']."&aba=audios";
		}else{
			$Tcaminho = "inicio.php?pagina=audinclui&menu=".$_GET['menu']."";
		}
		
		//-------------------------------------------
		// Final de verificação
		//-------------------------------------------
		
		if($Tresult == true){
			echo("<script>alert('Upload da Midia efetuado com Sucesso')</script>");	
			echo("<script>window.location = \"".$Tcaminho."\";</script>");
		}else{
			echo("<script>alert('Nao Foi Possivel Efetuar o Upload da Midia')</script>");
			echo("<script>window.location = \"".$Tcaminho."\";</script>");
		}
	}else{
		echo("<script>alert('Nao Foi Possivel Efetuar o Upload da Midia')</script>");
		echo("<script>window.location = \"".$Tcaminho."\";</script>");
	}
}
?>
