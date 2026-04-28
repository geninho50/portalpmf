<?php

//* Desenvolvido por Rodrigo Rigoni
//* Data: 13/10/2009
//* (48) 8446-2464

// ################################# Sistema de Paginação ############################


	//* Retorna o numero de páginas necessárias para
	//* mostrar todos os resultados da perquis.
	//* REQUISITOS:
	//*		$tamanho: Quantos resultados serão exibidos por pag.
	//*				  Ex.: 2
	//*		$objetos: variável contendo os obj resultantes
	//*				  da pesquisa no BD.

	function num_pag($tamanho, $objetos){

		$total_obj = 0;
		while($V_resultado2 = pg_fetch_object($objetos))
			{ $total_obj++; }

		$total_paginas = ceil($total_obj/$tamanho);

	return $total_paginas;

	}

	//* Imprime numerção das paginas
	//* Ex.: < 1 2 3 ... >
	//* REQUISITOS:
	//*		$total_paginas: Quantas páginas serão necessárias
	//*		$caminho: caminho da página de retorno
	//*				Ex.: "inicio.php?pagina=editalcad&menu=4"
	//*		$pagina_at: página que esta sendo mostrada (atual)

	function imprime_num_pag($total_paginas, $caminho, $pagina_at){

		if($total_paginas > 1)
		{
		$anterior = $pagina_at - 1;
			if (($anterior >= $total_paginas) or ($anterior == 0))
			{
			echo"Anterior";
			}else{
			echo"<a href = '$caminho&pagina_at=".$anterior."&tp=$total_paginas'>Anterior</a>"; // ok
			}
			echo "&nbsp;";
		for($i=1; $i <= $total_paginas; $i++)
			{
			if($pagina_at == $i)
				{
				echo "<b>".$pagina_at."</b>";
				}else{
				echo "<a href = '$caminho&pagina_at=".$i."&tp=$total_paginas'> ".$i." </a>";
				}
			}
			echo "&nbsp;";
			$proximo = $pagina_at + 1;

			if ($proximo <= $total_paginas)
			{
			echo"<a href = '$caminho&pagina_at=".$proximo."&tp=$total_paginas'>Próximo</a>"; // ok
			}else{
			echo"Próximo</td>"; // ok
			}
		}
	}


	//* Armazena em um vetor as informações dos Objetos
	//* passados por paramento.
	//* REQUISITOS:
	//*		$objetos: variável contendo os obj resultantes
	//*				  da pesquisa no BD.
	//* 	$nomes_bd: nomes das variaveis do banco de dados
	//*       	   	   que deseja que seja impressa.
	//*				   Ex.: "arqrel_id;arquel_nome;arqrel_descricao"

	function imp_obj($objetos){

		$i = 0;
		while ($resultado = pg_fetch_object($objetos)){ // percorre os objetos
			$imprime[$i]= $resultado;
			$i++;
		}

		return $imprime;
	}

//################################### Fim Sistema de Paginação #####################################<br>

	function mostra_paginas($totalRegistros, $pagAtual, $caminho, $tamanhoPag){
		$totalPaginas = ceil($totalRegistros/$tamanhoPag);
		require_once (CAMINHO_SITE."/layout/themePMF/includes/Mobile_Detect.php");
		$detect = new Mobile_Detect;
		if ($detect->isMobile() ) {
			$mobile = true;
			$showMax = 6;
		} else {
			$mobile = false;
			$showMax = 10; // Desktop tem +2
		}

		echo "<div class=\"pagination\">";
		if($pagAtual == "" || $pagAtual == 1){
			$pagAtual=1;
		}

		if($pagAtual == 1){
			$showMax--;
		} else if($pagAtual == 2){
			$showMax -= 3;
		} else {
			$showMax -= 4;
		}

		if($pagAtual + $showMax >= (int)$totalPaginas && $pagAtual > $showMax){
			$inicio = (int)$totalPaginas - $showMax;
		} else {
			$inicio = $pagAtual;
		}
		$fim = ($pagAtual + $showMax) < (int)$totalPaginas ? ($pagAtual + $showMax):(int)$totalPaginas;

		if($pagAtual > 1){
			echo "<a href=\"".$caminho."&pg=".($pagAtual-1)."\"><i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i></a>";
		}

		if($pagAtual == 2){
			echo "<a href=\"".$caminho."&pg=1\">1</a>";
		} else if ($pagAtual == 3){
			echo "<a href=\"".$caminho."&pg=1\">1</a>";
			echo "<a href=\"".$caminho."&pg=2\">2</a>";
		} else if ($pagAtual > 3 ){
			echo "<a href=\"".$caminho."&pg=1\">1</a>";
			echo "<a class=\"pagination-separator\">[...]</a>";
		}

		for ($i=$inicio; $i < $fim; $i++) {
			if($i == $pagAtual){
					echo "<span>".$i."</span>";
				} else {
					echo "<a href=\"".$caminho."&pg=".$i."\">".$i."</a>";
				}
		}
		if($pagAtual == (int)$totalPaginas){
			echo "<span>".$pagAtual."</span>";
		} else if($fim == (int)$totalPaginas && !$mobile){
			echo "<a href=\"".$caminho."&pg=".(int)$totalPaginas."\">".(int)$totalPaginas."</a>";
		} else if ($fim + 1 == (int)$totalPaginas && !$mobile){
			echo "<a href=\"".$caminho."&pg=".((int)$totalPaginas - 1)."\">".((int)$totalPaginas - 1)."</a>";
			echo "<a href=\"".$caminho."&pg=".(int)$totalPaginas."\">".(int)$totalPaginas."</a>";
		} else if($fim < (int)$totalPaginas && !$mobile){
			echo "<a class=\"pagination-separator\">[...]</a><a href=\"".$caminho."&pg=".(int)$totalPaginas."\">".(int)$totalPaginas."</a>";
		}
		if($pagAtual < (int)$totalPaginas){
			if($mobile && (int)$totalPaginas <= $fim){
				echo "<a href=\"".$caminho."&pg=".(int)$totalPaginas."\">".(int)$totalPaginas."</a>";
				if((int)$totalPaginas < $showMax){
					echo "<a href=\"".$caminho."&pg=".($pagAtual+1)."\"><i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i></a>";
				}
			} else {
				echo "<a href=\"".$caminho."&pg=".($pagAtual+1)."\"><i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i></a>";
			}
		}

		echo "</div>";
	}

?>
