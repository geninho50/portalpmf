<?php
session_start();
require_once(CAMINHO_SITE."/scripts/php/paginacao.php");

	
			$sqlServicos = "SELECT entidades.entidade_nome, 
			                       servicos.serv_link, 
								   servicos.serv_nome, 
								   servicos.serv_id, 
								   servicos.serv_acessos, 
								   servicos.serv_flag_online, 
								   servicos.serv_descricao, 
								   servicos.serv_abrir_interno
							  FROM entidades 
						INNER JOIN servicos 
						        ON entidades.entidade_id = servicos.serv_entidade_id 
							   AND entidades.entidade_id = $IdEntidade 
							   AND servicos.serv_status = 't' 
						 ORDER BY servicos.serv_acessos DESC LIMIT 10 ";

			$sqlDocumento = "SELECT documentos.doc_nome, 
			                        documentos.doc_acessos, 
									documentos.doc_id, 
									servicos.serv_nome, 
									servicos.serv_abrir_interno, 
									entidades.entidade_nome, 
									documentos.doc_descricao
							   FROM entidades 
						 INNER JOIN ( servicos INNER JOIN (documentos INNER JOIN documentos_servicos 
						                                                      ON documentos.doc_id = documentos_servicos.docs_doc_id) 
																			  ON servicos.serv_id = documentos_servicos.docs_serv_id) 
								 ON entidades.entidade_id = servicos.serv_entidade_id
								AND entidades.entidade_id = $IdEntidade 
						  ORDER BY documentos.doc_acessos  DESC LIMIT 10";


			$busca1 = $drive->pedido($sqlServicos);
			$busca2 = $drive->pedido($sqlServicos);
			$resultadobuscaServ = $drive->pedido($sqlServicos);
			$rowServ = pg_num_rows($resultadobuscaServ);
			
			$resultadobuscaDoc = $drive->pedido($sqlDocumento);
			$rowDoc = pg_num_rows($resultadobuscaDoc);

?>
<ul class="painel_abas tabs">
	<li id="aba_servicos" class="category-tab active">
		<a href="?pagina=servacessados&menu=<?=$menuServ?>&info=servicos">Serviços</a>
	</li>
	<li id="aba_documentos" class="category-tab">
		<a href="?pagina=servacessados&menu=<?=$menuServ?>&info=documentos">Documentos</a>
	</li>
</ul>

<div class="list-servicos list-servicos--entidades">
<?php /****************************************************/ 

//======================== paginação ============================				

$tamanho_pagina = 10	; // qtd de resultado por página

$pagina_at= $_GET['pagina_at']; 
 
	if (!$pagina_at) // verifica página atual
		
		{
		
			$inicio = 0;
		
			$pagina_at = 1;
		
			$total_paginas = num_pag($tamanho_pagina, $busca1); //calcula total de paginas 
		
			$imprime = imp_obj($busca2, $nomes_bd); // retorna um array com as informações dos objetos
			
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
	
		if($rowServ == 0)
		{
			echo("<center><b>Nenhum resultado encontrado !!</b></center>");
		}
		else
		{
			
			for($i=$inicio; $i < $final; $i++)
			{
				$string  = "<div class=\"service-card\">";
				$string .= "<h3>" . html_entity_decode($imprime[$i]->serv_nome) . " (".$imprime[$i]->serv_acessos.") </h3>";
				$string .= "<div class=\"flex-container\">";
				$string .= "<div class=\"column6-lg column6-md column8-sm text-wrapper\"><p>";
				$string .= $imprime[$i]->serv_descricao;
				$string .= "</p></div>";
				$string .= "<div class=\"column2-lg column2-md column8-sm btn-wrapper\"><a class=\"btn-block btn-primary btn-sm\" href=\"?pagina=servpagina&menu=" . $menuServ . "&id=".$imprime[$i]->serv_id."\">Mais informações</a>";
				
				if($imprime[$i]->serv_flag_online == "t")
				{
					if($imprime[$i]->serv_abrir_interno == 0)
					{
						$string .= "&nbsp;<a class=\"btn-block btn-primary btn-sm\" href=\"".$imprime[$i]->serv_link."\">Acessar</a>";
					}
					else
					{
						$string .= "&nbsp;<a class=\"btn-block btn-primary btn-sm\" href=\"sistema.php?servicoid=".$imprime[$i]->serv_id."\">Vers&atilde;o on-line</a>";
					}
				}
				 
				
				$string .= "</div></div></div>" ;

				echo($string);
				
			}
			
			echo("</div>");
					
// ========================= imprime num de páginas rodapé  =========================
			
				echo "<p align=\"center\">";
			
				$caminho = "?pagina=servacessados&menu=3&info=servicos";
			
				imprime_num_pag($total_paginas, $caminho, $pagina_at);
			
				echo "<p>";				

// ========================= fim imprime num de páginas  =========================	
		
		}
	?>

<?php /****************************************************/ ?>