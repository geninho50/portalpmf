 <?php
session_start();
	if((isset($_POST['bt_busca_x'])) or (isset($_GET['bt_busca_y'])))
	{

		//recebe o texto do campo de busca
		$txtbusca = htmlentities($_POST['txtbusca']);
			
		// retira caracteres comuns e
		//substitui os espaços dos caracteres especiais por espaço
		$caracteres = array(",",".",":","!","?",";");
		$txtresultado = str_ireplace($caracteres, " ", $txtbusca); 
			
		//retira os espaços e armazena cada expressão em um vetor
		$txtresultado = preg_split("/[\s,]+/", $txtresultado, -1, PREG_SPLIT_NO_EMPTY);
		$txtunique = array_unique($txtresultado);
		
		for($i = 0; $i < count($txtunique); $i++)
		{
					
					$txtsql[$i] = "SELECT * FROM noticias 
								   
								   WHERE 
								    
								   ((noti_manchete ILIKE '%$txtunique[$i]%') 
								   OR (noti_titulo ILIKE '%$txtunique[$i]%')
								   OR (noti_palavra_chave ILIKE '%$txtunique[$i]%'))
								   
								   AND noti_entidade_id = $IdEntidade
								   
								   ORDER BY noti_titulo asc";  	
								
					
		}	
		
	
	}
	else
	{
		
		$drive->redirect("index.php");
	}
  
 ?>
  

<?php
require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
require_once(CAMINHO_SITE."/scripts/php/paginacao.php");

?>

<div class="centro">
	<div id="caminho_migalhas">home &gt; not&iacute;cias e eventos</div>
	<div id="titulo_pagina">&uacute;ltimas not&iacute;cias</div>
	<div>
	
    
    <br><ul class="listagem">
		
 		<?php

			if(!isset($_GET['pagina_at'])){	
				for($i = 0; $i < count($txtsql); $i++)
				{
					$V_noticias1 = $drive->pedido($txtsql[$i]);
					$V_noticias2 = $drive->pedido($txtsql[$i]);
				}
			}	
				
//======================== paginação ============================				

$tamanho_pagina = 10	; // qtd de resultado por página

$pagina_at= $_GET['pagina_at']; 
 
	if (!$pagina_at) // verifica página atual
		
		{
		
			$inicio = 0;
		
			$pagina_at = 1;
		
			$total_paginas = num_pag($tamanho_pagina, $V_noticias1); //calcula total de paginas 
		
			$imprime = imp_obj($V_noticias2, $nomes_bd); // retorna um array com as informações dos objetos
			
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
		
		if($imprime == null){
			echo "Nenhuma notícia entcontrada.";
		}
		
		for($i=$inicio; $i < $final; $i++) // inicia impressão da pagina
		{	
		
		$V_data = $imprime[$i]->noti_data;
		$V_date = explode("-", $V_data, 3);
		$V_data_final = $V_date[2]."/".$V_date[1]."/".$V_date[0];				
		
		$id_not = $imprime[$i]->noti_id;
		
		
		$sql_img = "SELECT 
						imagens.img_link_v_pequena
					FROM 
						noticias_imagens 
					INNER JOIN 
						imagens 
					ON 
						noticias_imagens.nimg_img_id = imagens.img_id
					WHERE
						noticias_imagens.nimg_noti_id = $id_not
					AND
						noticias_imagens.nimg_principal = 't'
					
					";
		
		$result = $drive->pedido($sql_img);
		$image = pg_fetch_object($result);
		
		
		$mancheteOrig = strip_tags(stripcslashes($imprime[$i]->noti_manchete) );
		$manchete = substr($mancheteOrig, 0, 170);
		if (strlen($mancheteOrig) > 170) {
			$manchete = $manchete."...";
		}
		
		
		if ($image->img_link_v_pequena != ""){
		?>   
        <li>   
		<table class="result_busca_noticia" width="98%">
        	<tr>
				<td  width="125">                
                	<a href="?pagina=notpagina&menu=<?=$menuNot?>&noti=<?=$imprime[$i]->noti_id?>">
						<img src="../<?=$image->img_link_v_pequena?>" width="115" height="85" border="0" class="element_float" />
                    </a>
               	</td>
				<td>
					<h3><a href="?pagina=notpagina&menu=<?=$menuNot?>&noti=<?=$imprime[$i]->noti_id?>">
                        <?=stripcslashes($imprime[$i]->noti_titulo) ?></a></h3> 
                        <?php echo($manchete);?>
                        <h5><?php echo ($V_data_final." ".$imprime[$i]->noti_hora);?></h5> 
					
				</td>
        	</tr>
     	</table>
        </li> 
		<?PHP
		}else{
		?>
        <li>
		<table class="result_busca_noticia" width="98%">
        	<tr>
				<td>
					<h3><a href="?pagina=notpagina&menu=<?=$menuNot?>&noti=<?=$imprime[$i]->noti_id?>">
                        <?=stripcslashes($imprime[$i]->noti_titulo)?></a></h3> 
                        <?php echo($manchete);?>
                        <h5><?php echo ($V_data_final." ".$imprime[$i]->noti_hora." - ".$imprime[$i]->entidade_sigla);?></h5> 
					
				</td>
        	</tr>
     	</table>
        </li>
        
		<?php
			}//fim if verifica existe foto
		}
			echo"<br />";
// ========================= imprime num de páginas rodapé  =========================
			
				echo "<p align=\"center\">";
			
				$caminho = "?pagina=notbusca&menu=4&bt_busca_y=yes";
			
				imprime_num_pag($total_paginas, $caminho, $pagina_at);
			
				echo "<p>";				

// ========================= fim imprime num de páginas  =========================			
		?>	
	</div>
</div><!-- fim coluna_C2 --> 