<?php 
//------------------------------------------
// Página implementada em : 21/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------

if(!isset($_POST['btInc_x'])){?>

<form method="post" enctype="multipart/form-data">
<div class="texto_formulario">Arquivo para upload:</div>
<input name="Farquivo" id="Farquivo" type="file" size="68"/> 
<script type="text/javascript">
	var Farquivo = new LiveValidation('Farquivo'); 
	Farquivo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>   
<div class="texto_formulario">Título:</div>
<input name="Ftitulo" id="Ftitulo" type="text" class="componente_miolo" maxlength="200" /><br />
<script type="text/javascript">
	var Ftitulo = new LiveValidation('Ftitulo'); 
	Ftitulo.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
<div class="texto_formulario">Descrição:</div>
<label>
<textarea name="Fdescricao" id="Fdescricao" class="componente_miolo" cols="45" rows="7"></textarea>
<script type="text/javascript">
	var Fdescricao = new LiveValidation('Fdescricao'); 
	Fdescricao.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
</label><br />
<div class="texto_formulario">Tags de Busca:</div>
<input type="text" id="Ftags" name="Ftags" class="ui-widget-content ui-corner-all"/>Dica: cadastre tamb&eacute;m o t&iacute;tulo do arquivo como TAG de busca. <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;De espa&ccedil;o ap&oacute;s cada palavra, mesmo que seja apenas uma. <br />
<script type="text/javascript">
	var Ftags = new LiveValidation('Ftags'); 
	Ftags.add( Validate.Presence, {failureMessage: "Obrigatorio"} );  
</script>  
<br /> 
<br />
<input type="image" src="../layout/imagens/intra_btn_salvar.png" name="btInc" id="btInc" value="btInc" />

<?php
}else{
	
	$Ttitulo 	= $_POST['Ftitulo'];
	$Tdescricao = $_POST['Fdescricao'];
	$Ttags 		= $_POST['Ftags'];
	$Tdata 		= date("Y/m/d");
	$Tentidade	= $_SESSION['SuserEnt'];
	$Tarquivo	= $_FILES['Farquivo'];

    // ---------- Upload Arquivo ----------
	
	$Text 		= "pdf#odt#doc#docx#xls#xlsx#ppt#pps#txt#rtf#zip#rar";
	$Tdir 		= CAMINHO_SITE."/".UPLOAD_ARQUIVOS; 
	$Tupload	= $drive->upload($Tdir, $Tarquivo, $Text, 15);
	$Tlink		= UPLOAD_ARQUIVOS.$Tupload[6];
	
	// ---------- Fim Upload Arquivo ----------
	
	if($Tupload[1] == true){
	
		$sqlArq = "INSERT INTO 
						arquivos(
							arq_id, 
							arq_nome, 
							arq_palavra_chave, 
							arq_link, 
							arq_data, 
							arq_descricao,
							arq_entidade_id
					)VALUES(
						default, 
						'$Ttitulo', 
						'$Ttags', 
						'$Tlink', 
						'$Tdata', 
						'$Tdescricao',
						 $Tentidade)";
	
		$Treturn = $drive->pedido($sqlArq);
		
		//-------------------------------------------
		// Verifica de qual pagina partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "pagedit"){
		
			$Tpagina  = $_GET['idPag'];
			$sqlLoc   = "SELECT arq_id FROM arquivos ORDER BY arq_id DESC LIMIT 1";
			$sqlOrd   = "SELECT * FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = ".$_GET['idPag']."";
			$TretArq  = $drive->pedido($sqlLoc);
			$TredOrd  = $drive->pedido($sqlOrd);
			$TarqOrd  = pg_num_rows($TredOrd);
			$Tarquivo = pg_fetch_object($TretArq);
			$TarqId   = $Tarquivo->arq_id;
			$Tordem   = $TarqOrd + 1;
			$sqlArq1  = "INSERT INTO 
							intranet_pagina_arquivos(
								intranet_arqpagina_id, 
								intranet_arqpagina_pag_id,
								intranet_arqpagina_arq_id,
								intranet_arqpagina_ordem
						)VALUES(
							default, 
							$Tpagina,
							$TarqId,
							$Tordem)";
	
			$TretArq  = $drive->pedido($sqlArq1);
			
			$Tcaminho = "inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos";
		}else{
			$Tcaminho = "inicio.php?pagina=arqinclui&menu=".$_GET['menu']."";
		}
		
		//-------------------------------------------
		// Verifica de qual notícia partiu a inserção
		//-------------------------------------------
		
		if($_GET['pagina'] == "edtnot"){
		
			$Tnoticia = $_GET['idNot'];
			$sqlLoc   = "SELECT arq_id FROM arquivos ORDER BY arq_id DESC LIMIT 1";
			$sqlOrd   = "SELECT * FROM intranet_noticia_arquivos WHERE intranet_arqnoticia_not_id = ".$_GET['idNot']."";
			$TretArq  = $drive->pedido($sqlLoc);
			$TredOrd  = $drive->pedido($sqlOrd);
			$TarqOrd  = pg_num_rows($TredOrd);
			$Tarquivo = pg_fetch_object($TretArq);
			$TarqId   = $Tarquivo->arq_id;
			$Tordem   = $TarqOrd + 1;
			$sqlArq1  = "INSERT INTO 
							intranet_noticia_arquivos(
								intranet_arqnoticia_id, 
								intranet_arqnoticia_not_id,
								intranet_arqnoticia_arq_id,
								intranet_arqnoticia_ordem
						)VALUES(
							default, 
							$Tnoticia,
							$TarqId,
							$Tordem)";
	
			$TretArq  = $drive->pedido($sqlArq1);
			
			$Tcaminho = "inicio.php?pagina=edtnot&menu=".$_GET['menu']."&idNot=".$_GET['idNot']."&aba=arquivos";
		}else{
			$Tcaminho = "inicio.php?pagina=arqinclui&menu=".$_GET['menu']."";
		}
		
		//-------------------------------------------
		// Final de verificação
		//-------------------------------------------
		
		if ($Treturn == true){
			echo"<script>alert(\"Arquivo incluido com Sucesso!\");</script>";			
			echo("<script>window.location = \"".$Tcaminho."\";</script>");
        }else{		
			echo"<script>alert(\"Não foi possível incluir o Arquivo.\");</script>";
			echo("<script>window.location = \"".$Tcaminho."\";</script>");
		}	
		
	}else{
		echo"<script>alert(\"Não foi possível incluir o Arquivo.\");</script>";
		echo("<script>window.location = \"".$Tcaminho."\";</script>");
	}
	
}
?>

