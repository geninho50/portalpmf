<?php if( !($IdEntidade != 43 && $IdEntidade != 129 && $IdEntidade != 14) ): ?>


<div class="centro">

	<div id="caminho_migalhas">home &gt; governo</div>

	<div id="titulo_pagina">editais</div>
    
    <div class="box_msg_baixo">Abaixo estão listados todos os Editais da <strong><?php echo $NomeEntidade; ?></strong>. Clique sobre o edital desejado para fazer o seu download.</div> <br> 
    

	
	<ul class="listagem">

    	<?PHP
		
		require_once("../../scripts/php/funcoes_bd.php");	
		
		require_once("../../scripts/php/paginacao.php");
		
		require_once("../../scripts/php/funcoes.php");

        $drive->conecta();


        //### IF removido pois so corria se não tivesse a "pagina_at" ###

		//if (!$_GET['pagina_at']){	
			
			$V_entidade = $_POST['entidade'];

			
			$txtsql = "SELECT * FROM arquivo_edital WHERE arqedital_entidade_id = $IdEntidade ORDER BY arqedital_data DESC";	
	
			$drive->conecta();
	
			//### for removido pois só corria uma vez ###
			//for($i = 0; $i < count($txtsql); $i++)
	
			//{
	
				$V_editais1 = $drive->pedido($txtsql);
	
				$V_editais2 = $drive->pedido($txtsql);
	
			//}
	
			$drive->close();
		//}
		
//======================== paginação ============================		

$tamanho_pagina = 10	; // qtd de resultado por página

$pagina_at= $_GET['pagina_at']; 

	if (!$pagina_at) // verifica página atual

		{
		
			$inicio = 0;
		
			$pagina_at = 1;
		
			$total_paginas = num_pag($tamanho_pagina, $V_editais1); //calcula total de paginas 
		
			//### $imprime = imp_obj($V_editais2, $nomes_bd) removido pois funcção so pede um parametro $nomes_bd ###

			$imprime = imp_obj($V_editais2); // retorna um array com as informações dos objetos
			
			if(count($imprime) > $tamanho_pagina){// verifica impressao impar
		
				$final = $tamanho_pagina;//OK
		
			}else{
		
				$final = count($imprime);//OK
		
			}
		
			 //### \/ removido pois nao estava sendo utilizado ###
			//$_SESSION['imprime'] = $imprime;// passa vetor com as informaçoes a serem impressas		
		
		}
		
		else 
		
		{				
			
			$inicio = ($_GET['pagina_at'] - 1) * $tamanho_pagina; //pega proximo registro a ser impresso - OK
		
			$imprime = imp_obj($V_editais2); //recebe vetor com as informaçoes a serem impressas
		
			if(count($imprime) > ($inicio + $tamanho_pagina)){// verifica impressao impar
		
				$final = $inicio + $tamanho_pagina;//OK
		
			}else{
		
				$final = count($imprime);//OK
		
			}
		
			$total_paginas = $_GET['tp'];//retorna o total de paginas para imprimir no rodape
			
		}
		
// ===================== fim paginação =========================
	
		if($imprime == null){

		echo"<b>Nenhum registro Encontrado.</b>";

		}
				
		$drive->conecta();
		
		for($i=$inicio; $i < $final; $i++) // inicia impressão da pagina

		{
		
			$id_entidade = $imprime[$i]->arqedital_entidade_id;
		
			$sql = "SELECT entidade_sigla FROM entidades WHERE entidade_id = $id_entidade";
			
			$result = $drive->pedido($sql);
			
			$sigla = pg_fetch_object($result);

		?>

		<li>
			<h4><a href="../../arquivos/editais/<?=$imprime[$i]->arqedital_link;?>">
            <img src="../../layout/imagens/icon_pdf.png" alt="pdf" align="absmiddle" border="0"/> 
			<?=$sigla->entidade_sigla?> - <?=$imprime[$i]->arqedital_nome;?></a></h4>
			<div class="deslocamento-icone"><?=strip_tags($imprime[$i]->arqedital_descricao);?></div>
		</li> 

		<?PHP

		}

		echo "</ul><br />";

// ######################### imprime num de páginas rodapé  #######################

				echo "<p align=\"center\">";

				//### acrescentado &menu=2 ###
				$caminho = "?pagina=goveditais&imp=1&menu=2";

				imprime_num_pag($total_paginas, $caminho, $pagina_at);

				echo "<p>";

// ######################### fim imprime num de páginas  #######################        

        ?>        

	</div>

</div><!-- fim coluna_C2 -->            

          
<?php endif; ?>          