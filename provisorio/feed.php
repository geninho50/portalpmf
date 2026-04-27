<?php
// Intanciamos/chamamos a classe
$rss = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss xmlns:atom="http://www.w3.org/2005/Atom"></rss>');
$rss->addAttribute('version', '2.0');




// Cria o elemento <channel> dentro de <rss>
$canal = $rss->addChild('channel');
// Adiciona sub-elementos ao elemento <channel>
$canal->addChild('title', 'Notícias Prefeitura Municipal de Florianópolis');
$canal->addChild('link', 'http://www.pmf.sc.gov.br/');
$canal->addChild('description', 'Noticias da Home PMF');
//--------------------------------------------------------

require_once("scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
$drive->conecta();
$sql 		= "SELECT * FROM config_manchetes WHERE man_entidade_id = 0";
$result		= $drive->pedido($sql);
$V_manchete = pg_fetch_object($result);   

for($i=0; $i<3; $i++){
	switch ($i) {
		case 0: $notId = $V_manchete->man_noti_1; break;
		case 1:	$notId = $V_manchete->man_noti_2; break;
		case 2: $notId = $V_manchete->man_noti_3; break;
	}    
	$sql = "SELECT 
			editorias.edit_nome, 
			noticias.noti_id,
			noticias.noti_data, 
			noticias.noti_hora, 
			noticias.noti_manchete, 
			noticias.noti_titulo,
			imagens.img_link_v_alta,
			imagens.img_link_v_pequena,
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
                    
	// Cria um elemento <item> dentro de <channel>
	$item = $canal->addChild('item');
	// Adiciona sub-elementos ao elemento <item>
	$tipo = $V_noticias->noti_titulo;
	$link = "http://www.pmf.sc.gov.br/noticias/index.php?pagina=notpagina&amp;noti=$V_noticias->noti_id";
	$descricao = utf8_encode(subString(strip_tags(html_entity_decode($V_noticias->noti_manchete)),75));
	$data = $V_noticias->noti_data . " " . $V_noticias->noti_hora;
	$data = date("D, d M Y H:i:s ", strtotime($data))."GMT";


	$item->addChild('title', $tipo);
	$item->addChild('link', $link);
	$guid = $item->addChild('guid', $link);
	$guid->addAttribute('isPermaLink', 'false');

	$item->addChild('description', $descricao);
	$item->addChild('pubDate', $data );
	$enclosure = $item->addChild('enclosure');
	$V_noticias->img_link_v_alta = str_replace("..", "http://www.pmf.sc.gov.br", $V_noticias->img_link_v_alta);
	$enclosure->addAttribute('url', $V_noticias->img_link_v_alta);
	$enclosure->addAttribute('length', '500');
    $enclosure->addAttribute('type', 'image/jpg');       

} 


for($i=0; $i<4; $i++){			
	switch ($i) {
		case 0: $notId = $V_manchete->man_noti_4; break;
		case 1:	$notId = $V_manchete->man_noti_5; break;
		case 2: $notId = $V_manchete->man_noti_6; break;
		case 3: $notId = $V_manchete->man_noti_7; break;
	}    
	$sql = "SELECT 
		editorias.edit_nome, 
		noticias.noti_id, 
		noticias.noti_data, 
		noticias.noti_hora, 
		noticias.noti_manchete, 
		noticias.noti_titulo,
		imagens.img_link_v_alta,
		imagens.img_legenda, 
		imagens.img_link_v_pequena
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
			noticias.noti_id = $notId
		AND
			noticias_imagens.nimg_principal = 't'
		";     

	$result			= $drive->pedido($sql);
	$V_noticias 	= pg_fetch_object($result);                                                                
						  
	// Cria um elemento <item> dentro de <channel>
	$item = $canal->addChild('item');
	// Adiciona sub-elementos ao elemento <item>
	$tipo = $V_noticias->noti_titulo;
	$link = "http://www.pmf.sc.gov.br/noticias/index.php?pagina=notpagina&amp;noti=$V_noticias->noti_id";
	$descricao = utf8_encode(subString(strip_tags(html_entity_decode($V_noticias->noti_manchete)),90));
	$data = $V_noticias->noti_data . " " . $V_noticias->noti_hora;
	$data = date("D, d M Y H:i:s ", strtotime($data))."GMT";
	
	$item->addChild('title',$tipo);
	$item->addChild('link', $link);
	$item->addChild('description', $descricao);	
	$item->addChild('pubDate', $data );
	$guid = $item->addChild('guid', $link);
	$guid->addAttribute('isPermaLink', 'false');	
	$enclosure = $item->addChild('enclosure');
	$V_noticias->img_link_v_alta = str_replace("..", "http://www.pmf.sc.gov.br", $V_noticias->img_link_v_alta);
	$enclosure->addAttribute('url', $V_noticias->img_link_v_alta);
	$enclosure->addAttribute('length', '500');
    $enclosure->addAttribute('type', 'image/jpg');       			

}
// Define o tipo de conteúdo e o charset
header("content-type: application/rss+xml; charset=utf-8");
// Entrega o conteúdo do RSS completo:
echo $rss->asXML();
exit;
?>
