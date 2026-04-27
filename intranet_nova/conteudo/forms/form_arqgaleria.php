<?php
//------------------------------------------
// Página implementada em : 31/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>
<script>
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir o Arquivo?')){
		return true;
	}else{
		return false;
	}
}

function verificaRemocao(){
	if(confirm('Tem certeza que deseja Remover o Arquivo?')){
		return true;
	}else{
		return false;
	}
}
</script>
<?php 
	//-----------------------------------------
	// Up arquivo
	//-----------------------------------------

	if(isset($_POST['btUp_x'])){
	
		$TidArqPag 		= $_POST['FidArqPag'];
		$sqlPosicao 	= "SELECT intranet_arqpagina_ordem FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TidArqPag";
		$TreturnPosic	= $drive->pedido($sqlPosicao);
		$Tposicao		= pg_fetch_object($TreturnPosic);
		
		if($Tposicao->intranet_arqpagina_ordem != 1){
			$TposicaoUp		= $Tposicao->intranet_arqpagina_ordem - 1;
			$TposicaoDown	= $Tposicao->intranet_arqpagina_ordem;
			$sqlInverte1	= "UPDATE intranet_pagina_arquivos SET intranet_arqpagina_ordem = $TposicaoDown WHERE intranet_arqpagina_ordem = $TposicaoUp";
			$sqlInverte2	= "UPDATE intranet_pagina_arquivos SET intranet_arqpagina_ordem = $TposicaoUp WHERE intranet_arqpagina_id = $TidArqPag";			
			$drive->pedido($sqlInverte1);
			$drive->pedido($sqlInverte2);
			$drive->redirect("inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos");
		}
		
	}
	
	//-----------------------------------------
	// Fim Up arquivo
	//-----------------------------------------
	
	
	//-----------------------------------------
	// Down arquivo
	//-----------------------------------------

	if(isset($_POST['btDown_x'])){
	
		$TidArqPag 		= $_POST['FidArqPag'];
		$TidPag			= $_GET['idPag'];
		$sqlPosicao 	= "SELECT intranet_arqpagina_ordem FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TidArqPag";
		$sqlTotal	 	= "SELECT * FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = $TidPag";
		$TreturnPosic	= $drive->pedido($sqlPosicao);
		$TterurnNum		= $drive->pedido($sqlTotal);
		$TnumTotal		= pg_num_rows($TterurnNum);
		$Tposicao		= pg_fetch_object($TreturnPosic);
	
		if($Tposicao->intranet_arqpagina_ordem != $TnumTotal){
			$TposicaoUp		= $Tposicao->intranet_arqpagina_ordem;
			$TposicaoDown	= $Tposicao->intranet_arqpagina_ordem + 1;
			$sqlInverte1	= "UPDATE intranet_pagina_arquivos SET intranet_arqpagina_ordem = $TposicaoUp WHERE intranet_arqpagina_ordem = $TposicaoDown";
			$sqlInverte2	= "UPDATE intranet_pagina_arquivos SET intranet_arqpagina_ordem = $TposicaoDown WHERE intranet_arqpagina_id = $TidArqPag";			
			$drive->pedido($sqlInverte1);
			$drive->pedido($sqlInverte2);
			$drive->redirect("inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos");
		}
		
	}
	
	//-----------------------------------------
	// Fim Down arquivo
	//-----------------------------------------
	
	require_once("../scripts/php/funcoes.php");
	$TidPag		= $_GET['idPag'];
	$sqlArq  	=  "SELECT ARQ.*,PARQ.* FROM arquivos AS ARQ
					JOIN intranet_pagina_arquivos AS PARQ ON ARQ.arq_id = PARQ.intranet_arqpagina_arq_id
					WHERE PARQ.intranet_arqpagina_pag_id = $TidPag ORDER BY PARQ.intranet_arqpagina_ordem ASC";
	
	$Treturn 	= $drive->pedido($sqlArq);
	$TreturbNum	= $drive->pedido($sqlArq);
	$Tnum		= pg_num_rows($TreturbNum);
	echo "<h1>Arquivos incluídos na Página: ".$Tnum."</h1>
	<table width=\"500\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		while($Tarquivos = pg_fetch_object($Treturn)){
		echo"
		<form method=\"post\">
		<input type=\"hidden\" name=\"FidArqPag\" value=\"".$Tarquivos->intranet_arqpagina_id."\" />
		<input type=\"hidden\" name=\"FidArq\" value=\"".$Tarquivos->arq_id."\" />
		<tr>
			<td width=\"250\" class=\"result_busca_admB\"><font color=\"#8F6F56\">".$Tarquivos->intranet_arqpagina_ordem."&deg;</font><strong>&nbsp;&nbsp;".subString($Tarquivos->arq_nome, 25)."</strong></td>
			<td width=\"250\" class=\"result_busca_admB\">
				<input type=\"image\" src=\"../layout/imagens/atualiza_btn_up3.png\" name=\"btUp\" id=\"btUp\" value=\"btUp\" align=\"absmiddle\"/>
				<input type=\"image\" src=\"../layout/imagens/atualiza_btn_down3.png\" name=\"btDown\" id=\"btDown\" value=\"btDown\" align=\"absmiddle\"/>
				<a href=\"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos&sb=ordena&id=".$Tarquivos->arq_id."\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" /></a>  
				<input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\" align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
				<input type=\"image\" src=\"../layout/imagens/atualiza_btn_remover_54px.png\" name=\"btRemove\" id=\"btRemove\" value=\"btRemove\" align=\"absmiddle\" onclick=\"return verificaRemocao()\"/>    
			</td>
		</tr>
		</form>";
		}
	
	echo"</table>
	<br class=\"clearfloat\">";

//----------------------------
// Remover Arquivo da pagina
//----------------------------
if(isset($_POST['btRemove_x'])){
	$TidArqPag	= $_POST['FidArqPag'];
	$TidPag		= $_GET['idPag'];
	$sqlCount 	= "SELECT COUNT(*) FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = $TidPag";
	$TresultC	= $drive->pedido($sqlCount);
	$Tmaximo	= pg_fetch_object($TresultC);	
	$sqlLocR 	= "SELECT intranet_arqpagina_ordem FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TidArqPag";
	$TresultR	= $drive->pedido($sqlLocR);
	$TordemR 	= pg_fetch_object($TresultR);	
	$Tatualiza 	= $Tmaximo->count - $TordemR->intranet_arqpagina_ordem;
	$Tatual 	= $TordemR->intranet_arqpagina_ordem;
	for ($i=0; $i < $Tatualiza; $i++){	
		$Tatual = $Tatual + 1;
		$Tprox 	= $Tatual - 1;		 
		$sqlUp 	= "UPDATE intranet_pagina_arquivos SET intranet_arqpagina_ordem = $Tprox WHERE intranet_arqpagina_ordem = $Tatual AND intranet_arqpagina_pag_id = $TidPag";
		$drive->pedido($sqlUp);	
	}	
	$sqlRemove	= "DELETE FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TidArqPag";
	$TreturnExc = $drive->pedido($sqlRemove);
	if ($TreturnExc == true){		
		echo"<script>alert(\"Arquivo Removido com Sucesso!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos\"</script>");
	}else{
		echo("<script>alert('Não Foi Possível Remover o Arquivo!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
		echo("<script>window.location = \"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos\"</script>");
	}
}

//----------------------------
// Exclusão do Arquivo
//----------------------------

if(isset($_POST['btExcluir_x'])){
	
	$TidPag		= $_GET['idPag'];
	$TidArqPag	= $_POST['FidArqPag'];
	$TidArq  	= $_POST['FidArq'];
	$Tvalida 	= 0;
	//------------------------------------------------------------
	// verifica se o arquivo esta sendo utilizado em alguma página
	//------------------------------------------------------------	
	$sqlArq	= "SELECT ARQ.*,PARQ.* FROM arquivos AS ARQ
				  JOIN intranet_pagina_arquivos AS PARQ ON ARQ.arq_id = PARQ.intranet_arqpagina_arq_id
				  WHERE ARQ.arq_id = $TidArq AND PARQ.intranet_arqpagina_pag_id <> $TidPag";	
	$Treturn	= $drive->pedido($sqlArq);
	$TverArq	= pg_fetch_object($Treturn);
	
	if($TverArq != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Arquivo!\\n\\nEste Arquivo está sendo utilizado em outra Página.\");</script>";
	}

	//------------------------------------------------------------
	// verifica se o arquivo esta sendo utilizado em alguma notícia
	//------------------------------------------------------------
	$sqlNot		= "SELECT ARQ.*,NARQ.* FROM arquivos AS ARQ
				  JOIN noticias_arquivos AS NARQ ON ARQ.arq_id = NARQ.narq_arq_id
				  WHERE ARQ.arq_id = $TidArq";	
	$Treturn	= $drive->pedido($sqlNot);
	$TverNot	= pg_fetch_object($Treturn);
	
	if($TverNot != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Arquivo!\\n\\nEste Arquivo está sendo utilizado em uma Notícia.\");</script>";
	}
	
	//------------------------------------------------------------
	// verifica se o arquivo esta sendo utilizado em algum evento
	//------------------------------------------------------------
	$sqlEve		= "SELECT ARQ.*,EARQ.* FROM arquivos AS ARQ
				  JOIN eventos_arquivos AS EARQ ON ARQ.arq_id = EARQ.earq_arq_id
				  WHERE ARQ.arq_id = $TidArq";	
	$Treturn	= $drive->pedido($sqlEve);
	$TverEve	= pg_fetch_object($Treturn);
	
	if($TverEve != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Arquivo!\\n\\nEste Arquivo está sendo utilizado em um Evento.\");</script>";
	}
	
	//-------------------------------------------------------------------------------
	// Se o arquivo não estiver associado a nenhum outro registro - apaga o arquivo
	//-------------------------------------------------------------------------------
	if($Tvalida == 0){
		
		$sqlLoc 	= "SELECT * FROM arquivos WHERE arq_id = $TidArq ";
		$Tresult    = $drive->pedido($sqlLoc);
		$TobjArq	= pg_fetch_object($Tresult);
					
		$sqlExc 	= "DELETE FROM arquivos WHERE arq_id = $TidArq ";
		$Tresult 	= $drive->pedido($sqlExc);
	
		//---------------------
		// Reordena arquivos
		//---------------------
		
		$sqlCount 	= "SELECT COUNT(*) FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = $TidPag";
		$TresultC	= $drive->pedido($sqlCount);
		$Tmaximo	= pg_fetch_object($TresultC);	
		$sqlLocR 	= "SELECT intranet_arqpagina_ordem FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TidArqPag";
		$TresultR	= $drive->pedido($sqlLocR);
		$TordemR 	= pg_fetch_object($TresultR);	
		$Tatualiza 	= $Tmaximo->count - $TordemR->intranet_arqpagina_ordem;
		$Tatual 	= $TordemR->intranet_arqpagina_ordem;
		for ($i=0; $i < $Tatualiza; $i++){	
			$Tatual = $Tatual + 1;
			$Tprox 	= $Tatual - 1;		 
			$sqlUp 	= "UPDATE intranet_pagina_arquivos SET intranet_arqpagina_ordem = $Tprox WHERE intranet_arqpagina_ordem = $Tatual AND intranet_arqpagina_pag_id = $TidPag";
			$drive->pedido($sqlUp);	
		}	
		$sqlRemove	= "DELETE FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TidArqPag";
		$TreturnExc = $drive->pedido($sqlRemove);
	
		if($Tresult){
			
			@unlink("../".$TobjArq->arq_link);

			echo("<script>alert('Arquivo Excluido com Sucesso!')</script>");
			echo("<script>window.location = \"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos\"</script>");
		}else{	
			echo("<script>alert('Não Foi Possível Excluir o Arquivo!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
			echo("<script>window.location = \"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=arquivos\"</script>");
		}
	}
}
?> 





