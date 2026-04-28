<?php 
//----------------------------------------------------------------------------
// verifica se a coluna de destaques � de uma entidade ou de p�gina principal
//----------------------------------------------------------------------------
if ($menu_principal == "home" || $menu_principal == "governo" || $menu_principal == "noticias"){   
	//--------------------------------
	// verifica o caminho das imagens
	//--------------------------------
	if($menu_principal == "home"){
		$caminho = ""; 
	}else{
		$caminho = "../../";
	}

	$drive->conecta();
	$sqlDestaques  = "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = 0  ORDER BY destaque_lateral_posicao ASC LIMIT 7";	
	$rsqlDestaques = $drive->pedido($sqlDestaques);
	
	echo("<ul>");
	//-----------------------------------------------------
	// imprime destaque fixo da Lei de Acesso a Informa��o
	// Alterado para o hotsite Transparencia - 10/04/2013
	//-----------------------------------------------------
	//echo("<li><a href=\"http://www.pmf.sc.gov.br/sites/transparencia/\"><img src=\"http://www.pmf.sc.gov.br/arquivos/destaques/jpg/15_05_2012_8.41.13.c0ab9b25e92913d1dd50f229b7b31ebf.jpg\"  border=\"0\"  alt=\"Banner: Lei de Acesso a Informa��o\" /></a></li>");
	
	//------------------------------------------
	// imprime banners perssonalizados se tiver 
	//------------------------------------------
	while($objDestaques = pg_fetch_object($rsqlDestaques)){		
		echo("<li><a href=\"".$objDestaques->destaque_lateral_link."\"><img src=\"".$caminho."arquivos/destaques/".$objDestaques->destaque_lateral_img."\"  border=\"0\"  alt=\"Banner: ".$objDestaques->destaque_lateral_titulo."\" /></a></li>");
	}
 	echo("</ul>");
	
}else if($menu_principal == "entidade"){ 

	$sqlDestaques  = "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = $IdEntidade ORDER BY destaque_lateral_posicao ASC LIMIT 7";	
	$rsqlDestaques = $drive->pedido($sqlDestaques);
		
	echo("<ul>");
	//-----------------------------------------------------
	// imprime destaque fixo da Lei de Acesso a Informa��o
	// Alterado para o hotsite Transparencia - 10/04/2013
	//-----------------------------------------------------
	//echo("<li><a href=\"http://www.pmf.sc.gov.br/sites/transparencia/\"><img src=\"http://www.pmf.sc.gov.br/arquivos/destaques/jpg/15_05_2012_8.41.13.c0ab9b25e92913d1dd50f229b7b31ebf.jpg\"  border=\"0\"  alt=\"Banner: Lei de Acesso a Informa��o\" /></a></li>");
	
	//------------------------------------------
	// imprime banners perssonalizados se tiver 
	//------------------------------------------  		
	while($objDestaques = pg_fetch_object($rsqlDestaques)){		
		echo("<li><a href=\"".$objDestaques->destaque_lateral_link."\"><img src=\"../../arquivos/destaques/".$objDestaques->destaque_lateral_img."\" border=\"0\" alt=\"Banner: ".$objDestaques->destaque_lateral_titulo."\" /></a></li>");
	} 
	echo("</ul>");
 } 
?>