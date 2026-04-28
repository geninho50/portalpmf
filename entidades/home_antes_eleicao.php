<?php
require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
$sql 		= "SELECT * FROM config_manchetes WHERE man_entidade_id = ".$IdEntidade;
$result 	= $drive->pedido($sql);
$V_manchete	= pg_fetch_object($result);
$home_vazia = true;
$noti_id = $IdEntidade;
$bannerEntityId = $IdEntidade;
$dataAtual = date("Y/m/d");
?>

<?php
	$sqlCarouselCount	= "SELECT count(*) FROM cms_banner WHERE cms_banner_entidade_id = $IdEntidade";
	$hasCarousel = pg_fetch_object($drive->pedido($sqlCarouselCount));

	$sqlDestaquesCount  = "SELECT count(*) FROM destaque_lateral WHERE destaque_lateral_entidade_id = $bannerEntityId";
	$hasBanner = pg_fetch_object($drive->pedido($sqlDestaquesCount));

	if($hasBanner->count <= 0){
		$carouselColumn = 8;
	}
	if($hasCarousel->count > 0) {
		include(CAMINHO_SITE."/layout/themePMF/includes/home/carouselImagens.php");
		$bannersColumn = 4;
	} else {
		$bannersColumn = 8;
	}
	if($hasBanner->count > 0) {
		include(CAMINHO_SITE."/layout/themePMF/includes/banners.php");
	}

	if($IdEntidade == 328){
		// include(CAMINHO_SITE."/layout/themePMF/includes/consultaProcessoEntidades.php");
		include(CAMINHO_SITE."/layout/themePMF/includes/consultaProcessoProvisorio.php");
	}	
?>

<div class="news-list flex-container">
	<?php
				$sqlNoticiasCount = "SELECT count(*) FROM config_manchetes WHERE man_entidade_id = $noti_id";
			  $hasNoticias = pg_fetch_object($drive->pedido($sqlNoticiasCount));

				$sqlCalendarioCount = "SELECT count(*) FROM calendario WHERE cal_data >= '$dataAtual' AND cal_entidade_id = $IdEntidade  AND cal_tipo = 1 group by cal_id ORDER BY cal_id ASC LIMIT 4";
			  $hasCalendario = pg_fetch_object($drive->pedido($sqlCalendarioCount));
				$calendarioNumeroResult = 4;
				if($hasNoticias->count > 0) {
					include(CAMINHO_SITE."/layout/themePMF/includes/noticiasEntidades.php");
				}
	
				if($hasCalendario->count > 0) {
					echo "<div class=\"column4-lg column4-md featured-events--entidade column8-sm\">";
					include(CAMINHO_SITE."/layout/themePMF/includes/home/calendario.php");
					echo "</div>";
				}
		 ?>
</div>
<script src="/scripts/js/maskinput/inputmask.dependencyLib.min.js"></script>
<script src="/scripts/js/maskinput/inputmask.min.js"></script>
<?php
	include("../layout/rodape/rodape.php");
	$minJs = "/layout/themePMF/js/servicos.min.js";
	if (file_exists(CAMINHO_SITE.$minJs)){
		echo "<script src=\"$minJs\"></script>";
	}
?>
