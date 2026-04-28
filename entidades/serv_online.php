<?php
session_start();
require_once(CAMINHO_SITE."/scripts/php/paginacao.php");
	
			$sqlServicos = "SELECT entidades.entidade_nome, servicos.serv_link, servicos.serv_nome, servicos.serv_id, servicos.serv_acessos, servicos.serv_flag_online, servicos.serv_descricao,servicos.serv_abrir_interno
FROM entidades INNER JOIN servicos ON entidades.entidade_id = servicos.serv_entidade_id AND entidades.entidade_id = $IdEntidade AND servicos.serv_status = 't' AND servicos.serv_flag_online = 't' ORDER BY servicos.serv_nome ASC";

			
		
			$busca1 = $drive->pedido($sqlServicos);
			$busca2 = $drive->pedido($sqlServicos);
			$resultadobuscaServ = $drive->pedido($sqlServicos);
			$rowServ = pg_num_rows($resultadobuscaServ);


?>

<div id="cabecalho_servicos" class="canto_redondo">
		<div id="caminho_migalhas">home &gt; serviços</div>
		<div id="titulo_pagina">serviços on-line</div>

		<div class="box_msg_baixo">Clique no botão "acessar" para usar o serviço via web, ou no botão "info" para mais informações a respeito.</div> 
     	<br>
</div>

<div class="list-servicos list-servicos--entidades">
   
<?php /****************************************************/ ?>


    
    <?php
//======================== paginação ============================				

$tamanho_pagina = 20	; // qtd de resultado por página

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
				$string .= "<h3>" . html_entity_decode($imprime[$i]->serv_nome) . "</h3>";
				$string .= "<div class=\"flex-container btn-wrapper-inline\">";
				$string .= "<a class=\"btn-primary btn-sm\" href=\"?pagina=servpagina&menu=2&id=".$imprime[$i]->serv_id."\">Mais informações</a>";
				
				if($imprime[$i]->serv_flag_online == "t")
				{
					if($imprime[$i]->serv_abrir_interno == 0)
					{
						$string .= "&nbsp;<a class=\"btn-primary btn-sm\" href=\"".$imprime[$i]->serv_link."\">Acessar</a>";
					}
					else
					{
						$string .= "&nbsp;<a class=\"btn-primary btn-sm\" href=\"sistema.php?servicoid=".$imprime[$i]->serv_id."\">Acessar</a>";
					}
				}
				
				$string .= "</div></div>" ;

				echo($string);
				
			}
		
// ========================= imprime num de páginas rodapé  =========================
			
				echo "<p align=\"center\">";
			
				$caminho = "?pagina=servlistagem&menu=3&info=servicos";
			
				imprime_num_pag($total_paginas, $caminho, $pagina_at);
			
				echo "<p>";				

// ========================= fim imprime num de páginas  =========================		
		}
	?>

<?php /****************************************************/ ?>


</div>