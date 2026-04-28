
<span>DESTAQUES</span> &laquo;
<?php 

	/*Se o usuario estiver navegando na home ou no governo ou nas noticias entao abre os destaques da home*/
	if ($menu_principal == "home" || $menu_principal == "governo" || $menu_principal == "noticias" || $menu_principal == "servicos" || $menu_principal == "ouvidoria") 
	{   
		/*Verifica se está na home ou não, assim o caminho das imagens muda*/
		if($menu_principal == "home"){
			$caminho = ""; 
		}else{
			$caminho = "../";
		}
		/*******************************************************************/
		
		$drive->conecta();
		$sqlDestaques = "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = 0  ORDER BY destaque_lateral_posicao ASC LIMIT 7";
		
		$rsqlDestaques = $drive->pedido($sqlDestaques);

		
		echo("<ul>");
  
		while($objDestaques = pg_fetch_object($rsqlDestaques))
		{
			
		
			echo("<li>");
			echo("<a href=\"$objDestaques->destaque_lateral_link\"><img src=\"$caminho". "arquivos/destaques/$objDestaques->destaque_lateral_img\"  border=\"0\"  alt=\"$objDestaques->destaque_lateral_titulo\" /></a>");
			echo("</li>");
		
		}
     
		  echo("</ul>");
		
    } 
	 
	 
	 /*Caso contrário abre os destaques da propria pagina da entidade*/
	 else if($menu_principal == "entidade")
	 { 
	 	$sqlDestaques = "SELECT * FROM destaque_lateral 
		WHERE destaque_lateral_entidade_id = $IdEntidade ORDER BY destaque_lateral_posicao ASC LIMIT 6";
		
		$rsqlDestaques = $drive->pedido($sqlDestaques);
		
		echo("<ul>");
  
		while($objDestaques = pg_fetch_object($rsqlDestaques))
		{
		
			echo("<li>");
			echo("<a href=\"$objDestaques->destaque_lateral_link\"><img src=\"../../arquivos/destaques/$objDestaques->destaque_lateral_img\" border=\"0\" alt=\"$objDestaques->destaque_lateral_titulo\" /></a>");
			echo("</li>");
		
		}
     
		echo("</ul>");
		
		
	 } 
	 
	
?>


   
 
  
  
   
 

