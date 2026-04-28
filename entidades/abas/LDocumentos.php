<?php
require_once(CAMINHO_SITE."/scripts/php/paginacao.php");

//========================================================
// faz o controle da paginação (inicio e fim da consulta)
//========================================================
if(!isset($_GET['pg'])){
	$pg = 1;
}else{
	$pg = $_GET['pg'];	
}

$Tinicio  = ($pg * 10) - 10;

$sqlServicos = "SELECT entidades.entidade_nome, servicos.serv_link, servicos.serv_nome, servicos.serv_id, servicos.serv_acessos, servicos.serv_flag_online, servicos.serv_descricao
FROM entidades INNER JOIN servicos ON entidades.entidade_id = servicos.serv_entidade_id AND entidades.entidade_id = $IdEntidade AND servicos.serv_status = 't' ORDER BY servicos.serv_nome ASC";

$sqlDocumento = "SELECT documentos.doc_nome, documentos.doc_acessos, documentos.doc_id, servicos.serv_nome, entidades.entidade_nome, documentos.doc_descricao, documentos.doc_link
FROM entidades INNER JOIN (servicos INNER JOIN (documentos INNER JOIN documentos_servicos ON documentos.doc_id = documentos_servicos.docs_doc_id) ON servicos.serv_id = documentos_servicos.docs_serv_id) ON entidades.entidade_id = servicos.serv_entidade_id
AND entidades.entidade_id = $IdEntidade ORDER BY documentos.doc_nome ASC LIMIT 10 OFFSET $Tinicio";

$sqlNumDocumento = "SELECT COUNT(*)	FROM entidades INNER JOIN (servicos INNER JOIN (documentos INNER JOIN documentos_servicos ON documentos.doc_id = documentos_servicos.docs_doc_id) ON servicos.serv_id = documentos_servicos.docs_serv_id) ON entidades.entidade_id = servicos.serv_entidade_id	AND entidades.entidade_id = $IdEntidade";



$resultadobuscaServ = $drive->pedido($sqlServicos);
$rowServ = pg_num_rows($resultadobuscaServ);

$TreturnSqlDoc = $drive->pedido($sqlDocumento);
$TreturnSqlNum = $drive->pedido($sqlNumDocumento);

$Tcaminho = "?pagina=servlistagem&menu=".$_GET['menu']."&info=documentos";
$numPagTotal = pg_fetch_object($TreturnSqlNum);
$TnunServ = $numPagTotal->count;
?>
       
<ul class="painel_abas tabs">
	<li id="aba_servicos" class="category-tab">
		<a href="?pagina=servlistagem&menu=<?=$menuServ?>&info=servicos">Serviços (<?=$TnunServ?>)</a>
	</li>
	<li id="aba_documentos" class="category-tab active">
		<a href="?pagina=servlistagem&menu=<?=$menuServ?>&info=documentos">Documentos (<?=$rowDoc?>)</a>
	</li>
</ul>

<div class="list-servicos list-servicos--entidades">

	<?php
    $i = 0;
    while($Tdocumentos = pg_fetch_object($TreturnSqlDoc)){
        $string  = "<div class=\"service-card\">";
        $string .= "<h3>" . html_entity_decode($Tdocumentos->doc_nome) . " (".$Tdocumentos->doc_acessos.") </h3>";				
        $string .= "<div class=\"flex-container\">";
				$string .= "<div class=\"column6-lg column6-md column8-sm text-wrapper\"><p>";
        $string .= $Tdocumentos->doc_descricao ;	
        $string .= "</p></div>";			
        $string .= "<div class=\"column2-lg column2-md column8-sm btn-wrapper\"><a class=\"btn-block btn-primary btn-sm\" href=\"?pagina=servdoc&menu=" . $menuServ . "&id=".$Tdocumentos->doc_id."\">Mais informações</a>&nbsp;<a class=\"btn-block btn-primary btn-sm\" href=\"../../arquivos/documentos/".$Tdocumentos->doc_link."\">Download</a>";				 
        $string .= "</div></div></div>" ;
        echo($string);
        $i++;
    }
	if($i == 0){
		echo "<p>Nenhum documento encontrado!</p>";	
	}else{			
		//=======================================
		// imprime no rodapé o número de páginas 
		//=======================================		
		echo "<p>";						
		mostra_paginas($TnunServ, $_GET['pg'], $Tcaminho, 10);
		echo "<p>";	
	}

	echo("</div>");
	?>
