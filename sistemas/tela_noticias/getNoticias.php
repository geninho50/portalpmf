<?php 
require_once("../../scripts/php/config.php");
require_once("../../scripts/php/funcoes_bd.php");
require_once("../../scripts/php/funcoes.php");
$drive->conecta();

$noticias_home = "0"; 
$dataAtual = date("Y/m/d");
	//$sql = SELECT * FROM config_manchetes WHERE man_entidade_id = 0
	$sql = "SELECT 
					editorias.edit_nome, 
					noticias.noti_data, 
					noticias.noti_manchete, 
					noticias.noti_titulo, 
					imagens.img_link_v_alta
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
				   WHERE noticias.noti_status = 't' 
				   AND noticias.noti_data <= '$dataAtual' 
				   AND  noticias_imagens.nimg_principal = 't'
				   ORDER BY noticias.noti_data DESC, 
				   noticias.noti_hora DESC LIMIT 20 OFFSET 0";

	$result		= $drive->pedido($sql);
	$ultimas_noticias = pg_fetch_all($result);   
	$noticiaArr = array();

	

	for ($i=0; $i < count($ultimas_noticias); $i++) { 

		$noticiaArr[$i]["imagem"]   = $ultimas_noticias[$i]["img_link_v_alta"];
		$noticiaArr[$i]["origem"]   = $ultimas_noticias[$i]["edit_nome"];
		$noticiaArr[$i]["titulo"]   = $ultimas_noticias[$i]["noti_titulo"];
		$noticiaArr[$i]["manchete"] = $ultimas_noticias[$i]["noti_manchete"];

	}
	



echo json_encode(array_values($noticiaArr));