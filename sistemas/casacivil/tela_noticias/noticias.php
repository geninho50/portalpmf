<?php 

require_once("scripts/php/config.php");
require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
$drive->conecta();

$noticias_home = "0"; 
	$sql 		= "SELECT * FROM config_manchetes WHERE man_entidade_id = 0";
	$result		= $drive->pedido($sql);
	$V_manchete = pg_fetch_object($result);   
	$noticia = array();

	for($i=0; $i<4; $i++){
		switch ($i) {
			case 0: $notId = $V_manchete->man_noti_1; break;
			case 1:	$notId = $V_manchete->man_noti_2; break;
			case 2: $notId = $V_manchete->man_noti_3; break;
			case 3: $notId = $V_manchete->man_noti_4; break;
		}    
		$sql = "SELECT 
					editorias.edit_nome, 
					noticias.noti_id,
					noticias.noti_data, 
					noticias.noti_manchete, 
					noticias.noti_titulo, 
					imagens.img_link_v_pequena,
					imagens.img_link_v_alta,
					imagens.img_legenda,
					noticias_imagens.nimg_principal
				FROM((
					noticias 
				INNER JOIN 
					editorias 
				ON 
					noticias.noti_edit_id = editorias.edit_id) 						
				INNER JOIN 
					noticias_imagens 
				ON 
					noticias.noti_id = noticias_imagens.nimg_noti_id) 
				INNER JOIN 
					imagens 
				ON 
					noticias_imagens.nimg_img_id = imagens.img_id
				WHERE
					noticias.noti_id = $notId AND noticias_imagens.nimg_principal = 't'
				";

		$result 		= $drive->pedido($sql);
		$V_noticias 	= pg_fetch_object($result);                                                           
		$noticias_home .=  ",".($V_noticias->noti_id);


		$noticia[$i]["imagem"] = $V_noticias->img_link_v_alta;
		$noticia[$i]["origem"] = $V_noticias->edit_nome . " " . transformaData($V_noticias->noti_data);
		$noticia[$i]["titulo"] = $V_noticias->noti_titulo;
		$noticia[$i]["manchete"] = $V_noticias->noti_manchete;
	}

echo json_encode(array_values($noticia));