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

$sqlServicos = "SELECT entidades.entidade_nome, servicos.serv_link, servicos.serv_nome, servicos.serv_id, servicos.serv_acessos, servicos.serv_flag_online, servicos.serv_descricao,servicos.serv_abrir_interno
FROM entidades INNER JOIN servicos ON entidades.entidade_id = servicos.serv_entidade_id AND entidades.entidade_id = $IdEntidade AND servicos.serv_status = 't' ORDER BY servicos.serv_nome ASC LIMIT 10 OFFSET $Tinicio";

$sqlNumServicos = "SELECT COUNT(*) FROM entidades INNER JOIN servicos ON entidades.entidade_id = servicos.serv_entidade_id AND entidades.entidade_id = $IdEntidade AND servicos.serv_status = 't'";

$sqlDocumento = "SELECT documentos.doc_nome, documentos.doc_acessos, documentos.doc_id, servicos.serv_nome,servicos.serv_abrir_interno, entidades.entidade_nome, documentos.doc_descricao
FROM entidades INNER JOIN (servicos INNER JOIN (documentos INNER JOIN documentos_servicos ON documentos.doc_id = documentos_servicos.docs_doc_id) ON servicos.serv_id = documentos_servicos.docs_serv_id) ON entidades.entidade_id = servicos.serv_entidade_id
AND entidades.entidade_id = $IdEntidade ORDER BY documentos.doc_nome ASC";


$TreturnSqlServ = $drive->pedido($sqlServicos);
$TreturnSqlNum = $drive->pedido($sqlNumServicos);


$resultadobuscaServ = $drive->pedido($sqlServicos);
$rowServ = pg_num_rows($resultadobuscaServ);

$resultadobuscaDoc = $drive->pedido($sqlDocumento);
$rowDoc = pg_num_rows($resultadobuscaDoc);

$Tcaminho = "?pagina=servlistagem&menu=".$_GET['menu']."&info=servicos";
$numPagTotal = pg_fetch_object($TreturnSqlNum);
$TnunServ = $numPagTotal->count;
?>

<ul class="painel_abas tabs">
	<li id="aba_servicos" class="category-tab active">
		<a href="?pagina=servlistagem&menu=<?=$menuServ?>&info=servicos">Serviços (<?=$TnunServ?>)</a>
	</li>
	<li id="aba_documentos" class="category-tab">
		<a href="?pagina=servlistagem&menu=<?=$menuServ?>&info=documentos">Documentos (<?=$rowDoc?>)</a>
	</li>
</ul>

<div class="list-servicos list-servicos--entidades">
 
  <?php
		$i = 0;	
		while($Tservicos = pg_fetch_object($TreturnSqlServ)){
			$string  = "<div class=\"service-card\">";
			$string .= "<h3>" . html_entity_decode($Tservicos->serv_nome) . "</h3>";		
			$string .= "<div class=\"flex-container\">";
			$string .= "<div class=\"column6-lg column6-md column8-sm text-wrapper\"><p>";
			$string .= strip_tags($Tservicos->serv_descricao);
			$string .= "</p></div>";
			$string .= "<div class=\"column2-lg column2-md column8-sm btn-wrapper\"><a class=\"btn-block btn-primary btn-sm\" href=\"?pagina=servpagina&menu=" . $menuServ . "&id=".$Tservicos->serv_id."\">Mais informa&ccedil;&otilde;es</a>";
			if($Tservicos->serv_flag_online == "t"){
				if($Tservicos->serv_abrir_interno == 0){
					$string .= "&nbsp;<a class=\"btn-block btn-primary btn-sm\" href=\"".$Tservicos->serv_link."\">Acessar</a>";
				}else{
					$string .= "&nbsp;<a class=\"btn-block btn-primary btn-sm\" href=\"sistema.php?servicoid=".$Tservicos->serv_id."\">Vers&atilde;o on-line</a>";
				}
			}
			$string .= "</div></div></div>";
			echo($string);	
			$i++;
		}
		if($i == 0){
			echo "<p>Nenhum serviço encontrado!</p>";	
		}else{			
			//=======================================
			// imprime no rodapé o número de páginas 
			//=======================================		
			echo "<p>";						
			mostra_paginas($TnunServ, $_GET['pg'], $Tcaminho, 10);
			echo "<p>";	
		}
	?>

</div>