<?php

	$drive->conecta();
	$sqlDestaques  = "SELECT destaque_lateral_img as image,destaque_lateral_titulo as titulo, destaque_lateral_link as link, destaque_lateral_descricao as descricao  FROM destaque_lateral WHERE destaque_lateral_entidade_id = $bannerEntityId  ORDER BY destaque_lateral_posicao ASC LIMIT 8";
	$sqlDestaquesCount  = "SELECT count(*) FROM destaque_lateral WHERE destaque_lateral_entidade_id = $bannerEntityId";
	$directory = "/arquivos/destaques/";

	$rsqlDestaques = $drive->pedido($sqlDestaques);
	$resultCount = $drive->pedido($sqlDestaquesCount);
	$rsqlDestaquesCount = pg_fetch_object($resultCount);
	$teste = 1;

	if($rsqlDestaquesCount->count == 0 && $activateMiniportal){
			$sqlDestaques  = "SELECT miniportal_imagem as image,miniportal_title as titulo, concat('/servicos/index.php?pagina=miniportal&id=',miniportal_id) link, miniportal_descricao as descricao FROM miniportal WHERE miniportal_active = 't' LIMIT 4";
			$sqlDestaquesCount  = "SELECT count(*) FROM miniportal";
			$directory = "/arquivos/miniportal/";
			$rsqlDestaques = $drive->pedido($sqlDestaques);
			$resultCount = $drive->pedido($sqlDestaquesCount);
			$rsqlDestaquesCount = pg_fetch_object($resultCount);
	}
	if($bannersColumn == 4) {
		if($rsqlDestaquesCount->count >= 4 || $rsqlDestaquesCount->count == 2) {
			echo("<div class=\"blocks blocks--two-columns column4-lg\">");
		} else if ($rsqlDestaquesCount->count == 3) {
			echo("<div class=\"blocks blocks--three-columns column4-lg\">");
		} else if ($rsqlDestaquesCount->count == 1) {
			echo("<div class=\"blocks blocks--one-columns column4-lg\">");
		}
	} else {
		if($rsqlDestaquesCount->count >= 4 || $rsqlDestaquesCount->count == 2) {
			echo("<div class=\"blocks blocks--four-columns column8-lg\">");
		} else if ($rsqlDestaquesCount->count == 3) {
			echo("<div class=\"blocks blocks--three-columns column8-lg\">");
		} else if ($rsqlDestaquesCount->count == 1) {
			echo("<div class=\"blocks blocks--one-columns column8-lg\">");
		}
	}

	$hasImage = "has-image";
	while($objDestaques = pg_fetch_object($rsqlDestaques)){
		echo("<a class=\"has-image blocks__item ". (empty($objDestaques->image)? '':$hasImage ) ." \" style=\"background-image: url('".$directory.$objDestaques->image."');\" href=\"".$objDestaques->link."\">
			<i class=\"fa fa-arrow-circle-o-right\"></i>
			<div class=\"blocks__text\"><p class=\"blocks__title\">".$objDestaques->titulo."</p><p class=\"blocks__description hidden-sm hidden-xs\">".$objDestaques->descricao."</p></div></a>");
	}
 	echo("</div>");
?>