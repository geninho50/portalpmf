<?php
require_once(CAMINHO_SITE."/scripts/php/paginacao.php");
session_start();
if(isset($_POST['bt_busca_x']) || $_SESSION['Sbusca'])
{

	if(isset($_POST['bt_busca_x']))
	{
		$_SESSION['Sbusca'] = "ativo";
		$_SESSION['Spalavra'] = $_POST['txtbusca'];
		$txtbusca = htmlentities($_POST['txtbusca']);
		

	}
	else if(isset($_SESSION['Sbusca']) && $_SESSION['Sbusca'] == "ativo")
	{
		$txtbusca = htmlentities($_SESSION['Spalavra']);
		
		
	}

$sql = "SELECT entidades.entidade_nome, entidades.entidade_sigla, servicos.serv_status, servicos.serv_id, servicos.serv_nome, servicos.serv_descricao, servicos.serv_flag_online, servicos.serv_link, servicos.serv_abrir_interno
	FROM entidades INNER JOIN servicos ON entidades.entidade_id = servicos.serv_entidade_id AND entidades.entidade_id = $IdEntidade
	WHERE (((servicos.serv_nome) ILIKE '%$txtbusca%')) AND servicos.serv_status = 't'";




$sql2 = "SELECT documentos.doc_nome, servicos.serv_nome, entidades.entidade_nome, documentos.doc_descricao, documentos.doc_id, documentos.doc_link
FROM entidades INNER JOIN (servicos INNER JOIN (documentos INNER JOIN documentos_servicos ON documentos.doc_id = documentos_servicos.docs_doc_id) ON servicos.serv_id = documentos_servicos.docs_serv_id) ON entidades.entidade_id = $IdEntidade
WHERE (((documentos.doc_nome) ILIKE '%$txtbusca%'))";


$querybuscaserv = $drive->pedido($sql);
$rowserv = pg_num_rows($querybuscaserv);

$querybuscadoc  = $drive->pedido($sql2);
$rowdoc = pg_num_rows($querybuscadoc);

$V_busca1 = $drive->pedido($sql2);
$V_busca2 = $drive->pedido($sql2);


$entidade = $txtsec;


$sqlent = "SELECT entidade_nome FROM entidades WHERE entidade_id = $IdEntidade";
$resultadoent = $drive->pedido($sqlent);
$objent = pg_fetch_object($resultadoent);
$nomeent = $objent->entidade_nome;


?>

<h3 class="search-string">Pesquisa: <span><?=$TtxtBusca?></span></h3>
<ul class="painel_abas tabs">
	<li id="aba_servicos" class="category-tab">
		<a href="?pagina=servbusca&menu=<?=$menuServ?>&info=servicos">Serviços (<?=$rowserv?>)</a>
	</li>
	<li id="aba_documentos" class="category-tab active">
		<a href="?pagina=servbusca&menu=<?=$menuServ?>&info=documentos">Documentos (<?=$rowdoc?>)</a>
	</li>
</ul>

<div class="list-servicos list-servicos--entidades">
<?php /***********************************************************************************/ ?>    	
        
        
        <?php

//======================== paginação ============================				

$tamanho_pagina = 10	; // qtd de resultado por página

$pagina_at= $_GET['pagina_at']; 
 
	if (!$pagina_at) // verifica página atual
		
		{
		
			$inicio = 0;
		
			$pagina_at = 1;
		
			$total_paginas = num_pag($tamanho_pagina, $V_busca1); //calcula total de paginas 
		
			$imprime = imp_obj($V_busca2, $nomes_bd); // retorna um array com as informações dos objetos
			
			if(count($imprime) > $tamanho_pagina){// verifica impressao impar
		
				$final = $tamanho_pagina;//OK
		
			}else{
		
				$final = count($imprime);//OK
		
			}
			
			$_SESSION['imprime'] = $imprime;// passa vetor com as informaçoes a serem impressas					
		
		}else{
			
			$inicio = ($_GET['pagina_at'] - 1) * $tamanho_pagina; //pega proximo registro a ser impresso - OK
			
			$imprime = $_SESSION['imprime']; //recebe vetor com as informaçoes a serem impressas
			
			if(count($imprime) > ($inicio + $tamanho_pagina)){// verifica impressao impar
			
				$final = $inicio + $tamanho_pagina;//OK
			
			}else{
			
				$final = count($imprime);//OK
			
			}
			
			$total_paginas = $_GET['tp'];//retorna o total de paginas para imprimir no rodape
	
		}
		
// ===================== fim paginação =========================
		
			if($rowdoc == 0)
			{
				echo("<p>Nenhum registro encontrado !</p>");
			}
			else
			{
				for($i=$inicio; $i < $final; $i++)
				{
					$string  = "<div class=\"result_busca_servicos\">";
					$string .= "<span class=\"titulo_linkserv\">" . html_entity_decode($imprime[$i]->doc_nome) . "</span>";
					    
            $string .= "<br>" . html_entity_decode($imprime[$i]->doc_descricao);
			
			$string .= "<br><a href=\"?pagina=servdoc&menu=" . $menuServ . "&id=".$imprime[$i]->doc_id."\"><img src=\"../../layout/imagens/serv_btn_info.png\" alt=\"informações\" width=\"38\" height=\"19\" border=\"0\" align=\"absmiddle\" /></a> <a href=\"../../arquivos/documentos/".$imprime[$i]->doc_link."\"><img src=\"../../layout/imagens/entid_btn_download.png\" alt=\"online\" height=\"19\" border=\"0\" align=\"absmiddle\" /></a><br>";
				
					$string .= "</div>";
					echo($string);
				}
				echo("</div>");
				
// ========================= imprime num de páginas rodapé  =========================
			
				echo "<p align=\"center\">";
			
				$caminho = "?pagina=servbusca&info=documentos&menu=3";
			
				imprime_num_pag($total_paginas, $caminho, $pagina_at);
			
				echo "<p>";				

// ========================= fim imprime num de páginas  =========================		
				
			}
		?>
        
       
        		       

    
   
<?php /***********************************************************************************/ ?>   
    
<?php
}else{
$drive->redirect("?pagina=servdestaques&menu=2");
}