<?php
//------------------------------------------
// Página implementada em : 07/06/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>
<script>
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir a Página?')){
		return true;
	}else{
		return false;
	}
}
</script>

<?php

require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");


    $TentId  =  $_SESSION['SuserEnt'];
	
	//-------------------------
	// controle de paginação
	//-------------------------
	if(!isset($_GET['pg'])){
		$pg = 1;
	}else{
		$pg = $_GET['pg'];	
	}	
	$inicio = ($pg * 10) - 10; 
	
	$numSql   = "SELECT COUNT(*) FROM intranet_pagina WHERE intranet_pagina_entidade_id = $TentId AND intranet_pagina_status = 'f'";		 
    $sqlEdit  = "SELECT * FROM intranet_pagina WHERE intranet_pagina_entidade_id = $TentId AND intranet_pagina_status = 'f' ORDER BY intranet_pagina_id DESC LIMIT 10 OFFSET $inicio";			
    $Tcaminho = "?pagina=pagcad&menu=".$_GET['menu']."&aba=edicao";
	
	$Treturn = $drive->pedido($sqlEdit); 
	$TreturnSqlNum = $drive->pedido($numSql);
	   
    echo"<div id=\"conteudo_edicao\">";
        $i = 0; 
        while($Tedit = pg_fetch_object($Treturn)){				
            echo "
            <form method=\"post\">
            <input type=\"hidden\" name=\"idPagina\" value=\"".$Tedit->intranet_pagina_id."\" />
            <div class=\"container_item_result\">
                <span class=\"titulo_linkserv\">".$Tedit->intranet_pagina_titulo."</span>
                <br />
                    ".substr($Tedit->intranet_pagina_texto, 0, 150)." ...                           
                <br />
                <span align=\"absmiddle\"><a href=\"inicio.php?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$Tedit->intranet_pagina_id."\"><img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\"  /></a></span>
                <span align=\"absmiddle\"><input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExc\" id=\"btExc\" value=\"btExc\" onclick=\"return verificaExclusao()\" /></span>	
                <span align=\"absmiddle\"><input type=\"image\" src=\"../layout/imagens/atualiza_btn_publicar.png\" name=\"btPub\" id=\"btPub\" value=\"btPub\"  /></span>					
            </div>				
            </form>";
			$i++;
        } 

    echo"</div>
	<br />
	<div id=\"area_paginacao\">";
	
	if($i != 0){
		//-------------------------------------- 
		// imprime numumero de paginas rodapé  
		//--------------------------------------
		$numPagTotal = pg_fetch_object($TreturnSqlNum);
		echo "<p align=\"center\">";
		$TnumPag = $numPagTotal->count;
		if($TnumPag < 10){
			$TnumPag = 10;
		}
		mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 10);
		echo "<p>";				
	}	
	
	echo"</div>";  

if(isset($_POST['btPub_x'])){
//------------------------------
// publica página
//------------------------------
	
	$TidPagina = $_POST['idPagina'];
	$Tstatus   = 1;
	$sqlPagina = "UPDATE intranet_pagina SET intranet_pagina_status = '$Tstatus' WHERE intranet_pagina_id = $TidPagina";
	$Treturn   = $drive->pedido($sqlPagina);
	if ($Treturn == true){		
		echo"<script>alert(\"Pagina publicada com Sucesso!\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=pagcad&menu=".$_GET['menu']."\";</script>");
	}else{		
		echo"<script>alert(\"Não foi possivel publicar a Pagina.\");</script>";
		echo("<script>window.location = \"inicio.php?pagina=pagcad&menu=".$_GET['menu']."\";</script>");
	}	
}



	
if(isset($_POST['btExc_x'])){
//------------------------------
// exclui a página
//------------------------------

	$TidPag		= $_POST['idPagina'];

	//------------------------------
	// Verifica arquivos
	//------------------------------ 
	
	$sqlArqPes 	= "SELECT * FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = $TidPag";
	$TreturnArq = $drive->pedido($sqlArqPes); 
	
	while($TverArq = pg_fetch_object($TreturnArq)){
		$TarqId	   = $TverArq->intranet_arqpagina_id;
		$sqlDelArq = "DELETE FROM intranet_pagina_arquivos WHERE intranet_arqpagina_id = $TarqId";
		$TretDel   = $drive->pedido($sqlDelArq);
	}
	
	//------------------------------
	// Verifica imagens
	//------------------------------ 
	
	$sqImgPes 	= "SELECT * FROM intranet_pagina_imagens WHERE intranet_imgpagina_pag_id = $TidPag";
	$TreturnImg = $drive->pedido($sqImgPes); 
	
	while($TverImg = pg_fetch_object($TreturnImg)){
		$TimgId	   = $TverImg->intranet_imgpagina_id;
		$sqlDelImg = "DELETE FROM intranet_pagina_imagens WHERE intranet_imgpagina_id = $TimgId";
		$TretDel   = $drive->pedido($sqlDelImg);
	}
	
	//------------------------------
	// Verifica midias
	//------------------------------ 
	
	$sqlMidPes 	= "SELECT FROM intranet_pagina_midias WHERE intranet_midpagina_pag_id = $TidPag";
	$TreturnMid = $drive->pedido($sqlMidPes); 
	
	while($TverMid = pg_fetch_object($TreturnMid)){
		$TmidId	   = $TverMid->intranet_arqpagina_id;
		$sqlDelMid = "DELETE FROM intranet_pagina_midias WHERE intranet_midpagina_id = $TmidId";
		$TretDel   = $drive->pedido($sqlDelMid);
	}
	
	$sqlExcPag 	= "DELETE FROM intranet_pagina WHERE intranet_pagina_id = $TidPag";
	$TretDel    = $drive->pedido($sqlExcPag);
	
	if($TretDel){
		echo("<script>alert('Página Excluida com Sucesso!')</script>");
		echo("<script>window.location = \"inicio.php?pagina=pagcad\"</script>");
	}else{	
		echo("<script>alert('Não Foi Possível Excluir a Página!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
		echo("<script>window.location = \"inicio.php?pagina=pagcad\"</script>");
	}
}

?>