<?php

	$idNoticia = $_GET['noti'];
	
	require_once("../../scripts/php/funcoes_bd.php");
	require_once("../../scripts/php/funcoes.php");
	
	$drive->conecta();
	
	//verifica se a notica existe
	
	
	$sqlNoticia = "SELECT NOTI.*,EDIT.* FROM noticias AS NOTI
					JOIN editorias AS EDIT ON NOTI.noti_edit_id = EDIT.edit_id	
					WHERE NOTI.noti_id=$idNoticia"; 
					
	$sqlImagens = "SELECT IMG.*, NIMG.* FROM imagens AS IMG
					JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.nimg_img_id
					WHERE NIMG.nimg_noti_id = $idNoticia";	
					
	
				 
	$resNoticia = $drive->pedido($sqlNoticia);
	$resImagem = $drive->pedido($sqlImagens);

	while($obj = pg_fetch_object($resImagem)){
		
		$imgPequena = $obj->img_link_v_pequena;
		$imgMedia = $obj->img_link_v_media;
		$imgAlta = $obj->img_link_v_alta;
			
	}
	
	while($obj = pg_fetch_object($resNoticia) ){
		
		$texto = $obj->noti_texto;
		$titulo = $obj->noti_titulo;
		$manchete = $obj->noti_manchete;
		$data = transformaData($obj->noti_data);
		$entidadeId = $obj->noti_entidade_id;
	
	}
$facebook = substr($imgAlta, 3);


	echo "<meta property='og:locale' content='pt_BR'>";
	echo "<meta property='og:url' content='http://www.pmf.sc.gov.br/noticias/index.php?pagina=notpagina&noti=".$idNoticia."'>";
	echo "<meta property='og:type'  content='article' />";
	echo "<meta property='og:title' content='$titulo'>";
	echo "<meta property='og:description' content='$manchete'>";
	echo "<meta property='og:image' content='http://www.pmf.sc.gov.br/".$facebook."'>";
	echo "<meta property='og:image:type' content='image/jpeg'>";
	echo "<meta property='og:image:width' content='800'>";
	echo "<meta property='og:image:height' content='600'>";
	echo "<meta property='fb:app_id' content='2223020837717082'>";
	echo "<meta itemprop='image' content='www.pmf.sc.gov.br/".$facebook."'>";
	
?>