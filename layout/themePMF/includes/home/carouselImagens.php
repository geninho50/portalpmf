<?php $carouselColumn = isset($carouselColumn) ? $carouselColumn:4; ?>
<div class="pmf-highlights-slider column<?=$carouselColumn?>-lg column<?=$carouselColumn?>-md column8-sm column8-xs">
	<?php
		$sqlBanner	= "SELECT * FROM cms_banner WHERE cms_banner_entidade_id = $IdEntidade ORDER BY cms_banner_ordem ASC  ";
		$rBanner 	= $drive->pedido( $sqlBanner );
		while( $objBanner = pg_fetch_object( $rBanner ) ) :
      ?>
        <div class="pmf-slide pmf-slide-home">
          <div class="pmf-slide-inner">
              <a href="<?php echo $objBanner->cms_banner_link; ?>"></a>
              <figure class="pmf-slide-img" style="background-image: url('/arquivos/banners/<?php echo $objBanner->cms_banner_path; ?>')";></figure>
              <h2><?php echo $objBanner->cms_banner_titulo; ?></h2>
              <p><?php echo $objBanner->cms_banner_subtitulo; ?></p>
            </div>
          </div>
      <?php
		endwhile;
	?>
</div>
