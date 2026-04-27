<?php
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
?>
	<?php

	//--------------------------------------------------
	// verifica se existe link para transmissão ao vivo
	//--------------------------------------------------
	if($st_transmissao == "t"){
	?>
    <p align="center">
        <div id="transmissao">

            <div class="video">
            <OBJECT ID="MMPlayer1" WIDTH=400 HEIGHT=300 classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" CODEBASE="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject">
            <PARAM NAME="FileName" VALUE="<?=$link_transmissao?>">
            <PARAM NAME="ShowControls" VALUE="1">
            <PARAM NAME="ShowStatusBar" VALUE="1">
            <PARAM NAME="ShowDisplay" VALUE="0">
            <PARAM NAME="DefaultFrame" VALUE="Slide">
            <PARAM NAME="Autostart" VALUE="1">
            <Embed type="application/x-mplayer2" pluginspage="http://www.microsoft.com/Windows/ MediaPlayer/download/default.asp" src="<?=$link_transmissao?>" Name=MMPlayer1 Autostart=1 ShowControls=1 ShowDisplay=0 ShowStatusBar=1 DefaultFrame="Slide" width=400 height=300>
            </embed>
	        </OBJECT>

            </div>

            <div class="texto">
             	<h4>transmiss&atilde;o ao vivo</h4>
                <h2><?=$transmData?></h2>
            	<h1><?=$transmTitulo?></h1>
				<?=$transmDescricao?>
            </div>

        </div>
     </p>
	 <?php
	 }else{
	 //------------------------------------------------------------
	 // se não houver link então exibe um banner ao invés do vídeo
	 //------------------------------------------------------------
	 			$carouselColumn = 8;
	 			echo "<div class=\"flex-container\">";
				include(CAMINHO_SITE."/layout/themePMF/includes/home/carouselImagens.php");
				echo "</div><script src=\"/layout/themePMF/js/sites.min.js\"></script>";
		} ?>






      	<?php
		$contador_agenda = 0;
		$imprimir_agenda = "";

		//se o calendário estiver habilitado, busca dados do calendário
		//senão, $contador_agenda permanecerá zerado.
		if($flgCalendario == "t") {


		$dataAtual = date("Y/m/d");
		$sql 	   = "SELECT * FROM calendario WHERE cal_data >= '$dataAtual' AND cal_tipo = 1  and cal_entidade_id = ".$IdEntidade." ORDER BY cal_data ASC LIMIT 5";
		$resultado = $drive->pedido($sql);

		//------------------------------------------------
		//converte todas as letra MAIÚSCULAS em minúscula
		//------------------------------------------------
		$convert_to = array(
			"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
			"v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
			"ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "?", "?", "?", "?", "?", "?", "?", "?",
			"?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?",
			"?", "?", "?", "?"
		);

		$convert_from = array(
			"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
			"V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
			"Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "?", "?", "?", "?", "?", "?", "?", "?",
			"?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?", "?",
			"?", "?", "?", "?"
		);

		$meses = array(1 => "JAN", 2 =>"FEV", 3 =>"MAR", 4 => "ABR", 5 => "MAI", 6 => "JUN",
						7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT", 11 => "NOV", 12 => "DEZ");



		while($obj = pg_fetch_object($resultado)){

			$tituloEvento = substr($obj->cal_titulo,0,56);
	    if(strlen($tituloEvento) == 56){
	      $tituloEventoExp = explode(" ",$tituloEvento);
	      $tituloEvento = "";
	      for($i = 0; $i < count( $tituloEventoExp )-1; $i++ ){
	        $tituloEvento .= " ".$tituloEventoExp[$i];
	      }
	      $tituloEvento=$tituloEvento."...";
	    }
	    $idEvento 	  = $obj->cal_id;
	    $data 		  = date("d", strtotime($obj->cal_data))."<span>".$meses[date("n", strtotime($obj->cal_data))]."</span>";
	    //$tituloEvento =  str_replace($convert_from, $convert_to, $tituloEvento);
	    if($obj->cal_evento == null){
	      $imprimir_agenda	 .= "<li class=\"featured-events__item\"><p class=\"featured-events__date\">".$data."</p>".strtolower($tituloEvento)."</li>";
	    }else{
	      $imprimir_agenda	 .= "<li class=\"featured-events__item\"><p class=\"featured-events__date\">".$data."</p><a href=\"".$obj->cal_evento."\">".strtolower($tituloEvento)."</a></li>";
	    }

			$contador_agenda = $contador_agenda + 1;
		}


		}

		?>

    <?php

	/* teste inclusao banners - Marco 08/05/2018 */
	if( !isset( $bannerEntityId ) ){
		$bannerEntityId = -1;
	}

	$sqlDestaquesCount = "SELECT count(*) FROM destaque_lateral WHERE destaque_lateral_entidade_id = '$bannerEntityId' ";
	
	$hasBanner = pg_fetch_object($drive->pedido($sqlDestaquesCount));
		
	if($hasBanner->count <= 0){
		$carouselColumn = 8;
	}
	
	if( isset( $hasCarousel ) && $hasCarousel->count > 0) {
		include(CAMINHO_SITE."/layout/themePMF/includes/home/carouselImagens.php");
		$bannersColumn = 4;
	} else {
		$bannersColumn = 8;
	}
	if( $hasBanner->count > 0) {
		include(CAMINHO_SITE."/layout/themePMF/includes/banners.php");
	}
	
	/* fim teste inclusao banners */
	
	
	//--------------------------------------------------------------------------------------------------------
	// busca o número de itens das galerias de vídeo e de imagens
	// estas informações serão usadas para definir layout.
	//--------------------------------------------------------------------------------------------------------
	$TimgSql 	= "SELECT * FROM imagens WHERE img_entidade_id = $IdEntidade ORDER BY img_data DESC LIMIT 6";
	$TvideoSql  = "SELECT * FROM midia WHERE midia_entidade_id = $IdEntidade and midia_tipo = 0 ORDER BY midia_data DESC LIMIT 2";
	$TdestSql	= "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = $IdEntidade ORDER BY destaque_lateral_posicao ASC";
	$TresultImg = $drive->pedido($TimgSql);
	$TresultVid = $drive->pedido($TvideoSql);
	$TresultDet	= $drive->pedido($TdestSql);	
	
	//------------------------------------------------------------------------------------------------------------
	// com base nestas quantidades e nas configuração das galerias, determina quantas fotos e vídeos deve exibir.
	// está quantidade é determinada pelas possíveis combinações entre os paineis de vídeo, imagem e twitter.
	// estas quantidades se modificam para um melhor preenchimento da tela.
	//------------------------------------------------------------------------------------------------------------

	$totalImagens = 0;
	$totalVideos = 0;

	if($TresultImg OR $TresultVid){

		$numResultImagens = pg_num_rows($TresultImg);
		$numResultVideos = pg_num_rows($TresultVid);

		// inicialmente, verifica se as galerias estão habilitadas na configuração
		// e se foram encontrados itens no banco de dados para definir o número máximo que pode ser exibido.
		// o padrão inicial é 1 vídeo + 6 imagens
		if (($numResultImagens > 0) && ($flgGaleriaImg == "t")) { $totalImagens = 6; }
		if (($numResultVideos > 0) && ($flgGaleriaVid == "t")) { $totalVideos = 1; }

		//se não há imagens, o número máximo de vídeos é aumentado para 2
		if (($numResultImagens == 0) && ($numResultVideos > 0) && ($flgGaleriaVid == "t") ) {
			$totalVideos = 2;
		}

		//se há twitter, além de vídeos e imagens, o número de imagens cai para 4
		if (($totalVideos > 0) && ($totalImagens > 0) && ($st_twitter == 't') ) {
			$totalImagens = 4;
		//se há twitter, mas não há vídeos, o número de imagens aumenta para 8
		} else  if (($totalVideos == 0) && ($totalImagens > 0) && ($st_twitter == 't') ) {
			$totalImagens = 8;
		//se não há twitter, mas há vídeos, o número de imagens também aumenta para 8
		} else  if (($totalVideos > 0) && ($totalImagens > 0) && !($st_twitter == 't') ) {
			$totalImagens = 8;
		}


	}


	?>

        <?php

		$dataAtual = date("Y/m/d");

 		//-----------------------------------------------------------
		//busca as notícias de outras entidades que foram importadas
		//-----------------------------------------------------------
		$sqlImport 	 = "SELECT * FROM import_noticias WHERE id_import_noticia_id_entidade = $idEntidade";
		$return 	 = $drive->pedido($sqlImport);
		$complemento = "";
		while($comp  = pg_fetch_object($return)){
			$complemento .=" OR noti_id = ".$comp->id_import_noticia_noti_id;
		}


		//------------------------------------------------
		// busca todas as noticias incluindo as importadas
		//------------------------------------------------
		$sqlNoticia = "SELECT
				entidades.entidade_sigla,
				noticias.noti_id,
				noticias.noti_titulo,
				noticias.noti_manchete,
				noticias.noti_hora,
				noticias.noti_data
			FROM
				noticias
			INNER JOIN
				entidades
			ON
				noticias.noti_entidade_id = entidades.entidade_id
			WHERE
				noticias.noti_status = 't'
			AND
				noticias.noti_entidade_id = $idEntidade
			AND
				noticias.noti_data <= '$dataAtual'
			$complemento
			ORDER BY
				noticias.noti_data
			DESC,
				noticias.noti_hora
			DESC LIMIT 8";

		$resNoticia	 = $drive->pedido($sqlNoticia);
		$imprimir_agenda_celulas = "";
		$imprimir_agenda_lista = "";
		$contador_noticias = 0;
		$numResultNoticias = pg_num_rows($resNoticia);


		while($obj = pg_fetch_object($resNoticia)){

			$V_data = $obj->noti_data;
			$V_date = explode("-", $V_data, 3);
			$V_data_final = $V_date[2]."/".$V_date[1]."/".$V_date[0];


			//----------------------------------------------------------------------
			// PEGA IMAGEM PRINCIPAL APENAS PARA AS 3 PRIMEIRAS NOTÍCIAS
			// caso haja até 3 notícias e não haja agenda ou twitter, não será
			// usado o layout com fotos, mas apenas um box que ocupa a largura da tela
			// contendo os links. Desta forma, não será preciso buscar imagens.
			//----------------------------------------------------------------------


			if( ($contador_noticias < 3) && (($numResultNoticias > 3) || ($contador_agenda > 0) || (($st_twitter == 't') && ($totalVideos == 0) && ($totalImagens == 0)) ) ) {

				$notId = $obj->noti_id;

				$sqlImagens = "SELECT IMG.*, NIMG.* FROM imagens AS IMG
					JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.nimg_img_id
					WHERE NIMG.nimg_noti_id = $notId AND NIMG.nimg_principal = 't'";

				$resImagem = $drive->pedido($sqlImagens);
				$V_img_noticia = pg_fetch_object($resImagem);

				$imprimir_agenda_celulas .= "<div class=\"featured-news__item\">";

				$imprimir_agenda_celulas .= "<a class=\"featured-news__anchor\" href=\"index.php?pagina=notpagina&noti=$obj->noti_id\"></a>";
				if (empty($V_img_noticia->img_link_v_pequena)) {
					$imprimir_agenda_celulas .= "<div class=\"featured-news__image\"><img src=\"/arquivos/eventologo/\".$logo.\" /></div>";
				} else {
					$imprimir_agenda_celulas .= "<div class=\"featured-news__image\"><img src=\"../$V_img_noticia->img_link_v_pequena\" /></div>";
				}

			 $imprimir_agenda_celulas .= "<div class=\"featured-news__details\">";
			 $imprimir_agenda_celulas .= "<p class=\"featured-news__date\">".transformDataNewsFormat($obj->noti_data)."</p>";
			 $imprimir_agenda_celulas .= "<h3 class=\"featured-news__title\"> " . subString(strip_tags(html_entity_decode($obj->noti_titulo)),75) ."</h3>";
			 $imprimir_agenda_celulas .= "</div>";
			 $imprimir_agenda_celulas .= "</div>";



			} else {

			//-------------------------------------------------------------------------------------------------
			// No caso das notícias para as quais não serão exibidas imagens, as mesmas são formatadas numa lista
			//-------------------------------------------------------------------------------------------------

				 if ((($contador_agenda > 0) || (($contador_agenda == 0) && ($st_twitter == 't') && ($totalVideos == 0) && ($totalImagens == 0)) ) && ($contador_noticias == 7)) { break; }

				$imprimir_agenda_lista .= "<div class=\"secondary-news__item\">";
        $imprimir_agenda_lista .=   "<a class=\"secondary-news__anchor\" href=\"index.php?pagina=notpagina&noti=$obj->noti_id\"></a>";
        $imprimir_agenda_lista .=   "<p class=\"secondary-news__category\"><span class=\"secondary-news__date\">".transformaData($obj->noti_data)."</span></p>";
        $imprimir_agenda_lista .=   "<h3 class=\"secondary-news__title\">".subString(strip_tags($obj->noti_titulo), 70)."</h3>";
        $imprimir_agenda_lista .= "</div>";

			};
			$contador_noticias = $contador_noticias + 1;

		} //final WHILE

		?>



         <?php
			//-------------------------------------------------------------------------------------------------
			// Caso haja mais de 3 notícias ou menos de 3 notícias + (agenda e/ou twitter), é usado layout de 3 colunas
			//-------------------------------------------------------------------------------------------------


		 	if(($numResultNoticias > 3) || ($contador_agenda > 0) || (($st_twitter == 't') && ($totalVideos == 0) && ($totalImagens == 0)) ) { ?>



					 <div class="flex-container news-list">

						 <div class="column4-lg column8-md column8-sm column8-xs featured-news">
                <?=$imprimir_agenda_celulas?>
							</div>


            <?php  if ($contador_agenda > 0) { //existem itens no calendário e o mesmo deve ser impresso ?>



                  <?php

				  //caso haja twitter, mas não haja arquivos de mídia, a caixa do twitter sobe para ficar ao lado das notícias.
				  if (($st_twitter == 't') && ($totalVideos == 0) && ($totalImagens == 0)) { ?>
                  <div class="column4-lg column8-md column8-sm column8-xs">
                 	<script src="http://widgets.twimg.com/j/2/widget.js"></script>
                    	<script>
                   		new TWTR.Widget({
                      	version: 2,
                      	type: 'profile',
                      	rpp: 10,
                      	interval: 4000,
                      	width: 165,
                      	height: 180,
                      	theme: {
                        	shell: {
                          	background: '#efefef',
                          	color: '#333333'
                       		},
                        	tweets: {
                          	background: '#dbdedf',
                          	color: '#333',
                          	links: '#333'
                        	}
                      	},
                      	features: {
                        	scrollbar: true,
                        	loop: false,
                        	live: true,
                        	hashtags: true,
                        	timestamp: true,
                        	avatars: false,
                        	behavior: 'all'
                      	}
                    	}).render().setUser('<?=$twitter?>').start();

                    	</script>
            	  </div>

                  <?php } else { ?>

                   <?php  //se o twitter não existir ou for aparecer baixo, o local do twitter é ocupado por notícias

				   if($imprimir_agenda_lista != "") {?>
                	    <div class="column4-lg column8-md column8-sm column8-xs">
                 		    <?=$imprimir_agenda_lista?>
                        </div>
                    <?php } ?>

                  <?php } ?>


            	<div class="column4-lg column8-md column8-sm column8-xs featured-events">
             		<h3>Calendário</h3>
     			 		<ul class="featured-events__list"><?=$imprimir_agenda?></ul>
     					<a href="noticias/index.php?pagina=calendario" class="btn-block btn-primary btn-sm">calend&aacute;rio completo</a>
            	</div>



            <?php  //se não há agenda, mas o twitter deve ser exibido em cima, imprime notícias + twitter


			} else if( ($contador_agenda == 0) && ($st_twitter == 't') && ($totalVideos == 0) && ($totalImagens == 0) ) { ?>

                 <?php if($imprimir_agenda_lista != "") {?>
            		<div class="column4-lg column8-md column8-sm column8-xs">
                 		<?=$imprimir_agenda_lista?>
                	</div>

                <?php } ?>

            	<div class="column4-lg column8-md column8-sm column8-xs">


                    <script src="http://widgets.twimg.com/j/2/widget.js"></script>
                    <script>
                    new TWTR.Widget({
                      version: 2,
                      type: 'profile',
                      rpp: 10,
                      interval: 4000,
                      width: 165,
                      height: 180,
                      theme: {
                        shell: {
                          background: '#efefef',
                          color: '#333333'
                        },
                        tweets: {
                          background: '#dbdedf',
                          color: '#333',
                          links: '#333'
                        }
                      },
                      features: {
                        scrollbar: true,
                        loop: false,
                        live: true,
                        hashtags: true,
                        timestamp: true,
                        avatars: false,
                        behavior: 'all'
                      }
                    }).render().setUser('<?=$twitter?>').start();

                    </script>
            	</div>
                </div>
      		<?php } else {// não existem itens no calendário e serão apresentadas notícias em seu lugar ?>

						<?php if(  ($imprimir_agenda_lista != "") && ($numResultNoticias > 3) ) {?>
	 					 <div class="column4-lg column8-md column8-sm column8-xs">
	 								<?=$imprimir_agenda_lista?>
	 						</div>
	 					<?php } ?>

         	<?php } ?>




    <?php } ?>


    <div id="complemento_home">


      <?php  //se houver até 3 imagens e não houver agenda ou twitter, as notícias são exibidas
	         // em um box que ocupa toda a largura da tela.

	  		if( ($numResultNoticias <= 3) && ($imprimir_agenda_lista != "") ) { ?>
     		 <div class="column8-lg column8-md column8-sm column8-xs" >
             <h1>not&iacute;cias</h1>
             	<ul><?=$imprimir_agenda_lista?> </ul>
       		 </div>
      <?php } ?>


       <?php
	        //se o twitter for exibido em cima junto com a agenda, as notícias são exibidas
	         // em um box que ocupa toda a largura da tela.
	   		if( ($contador_agenda > 0) && ($st_twitter == 't') && ($totalVideos == 0) && ($totalImagens == 0) ) { ?>
      		 <div class="column8-lg column8-md column8-sm column8-xs" >
              <h1>not&iacute;cias</h1>
             	<ul><?=$imprimir_agenda_lista?> </ul>
       		 </div>
       <?php } ?>



       <?php  //caso haja arquivos de mídia...
	   if(($totalVideos > 0) or ($totalImagens > 0)) { ?>

		 <div class="column8-lg column8-md column8-sm column8-xs"  >
     		<h1>arquivos de m&iacute;dia</h1>
			<?php
			//----------------------
			//imprime o útimo video
			//----------------------
			require_once("../../scripts/php/funcoes.php");

			if($totalVideos > 0) { ?>

				<div id="painel_video" <?php if(($totalVideos == 1)) {echo ("class=\"video_unico\"");} ?>>

				<?php

				while($retVideo = pg_fetch_object($TresultVid)){

                    // ---------- Carrega Player de Vídeo ----------
                    $width="240";
                    $height = "173";
                    $player="../../scripts/php/videoPlayer";
                    $video ="http://portal-desenv.pmf.sc.gov.br/".$retVideo->midia_link;
                    $retorno=videoPlayer($video,$width,$height,$player);
                    // ---------- Fim Carrega Player de Vídeo ----------
                    echo $retorno;
					echo "&nbsp;";

				}
                ?>
                <div style="padding-top:6px;"></div>
                    <a href="index.php?pagina=videos">
                        <img src="../../layout/imagens/intra_btn_mais.png" border="0" alt="mais vídeos">
                    </a>
                </div>

			<?php }

            if($totalImagens > 0) { ?>


               <div id="painel_galeria_home" <?php if(($totalImagens == 4)) {echo ("class=\"galeria_pequena\"");}
			   								 else if(($totalImagens == 8) && ($totalVideos == 1) ) {echo ("class=\"galeria_grande\"");}

			   ?>>
               <ul>
                    <?php
					//---------------------------
					//imprime as últimas fotos
					//---------------------------
					$cont = 0;
                    while($imagem=pg_fetch_object($TresultImg)){
                        echo"
                        <li>
                            <a href=../".$imagem->img_link_v_alta." rel='colorbox-galeria'  title=\"".$imagem->img_legenda."\">
                                <img src=../".$imagem->img_link_v_pequena." border=\"0\">
                            </a>
                        </li>";
						$cont ++;
						if ($cont == $totalImagens ) {break;}
                    }
                    ?>
                </ul>
                <a href="index.php?pagina=imagens"><img src="../../layout/imagens/intra_btn_mais.png" border="0" alt="mais imagens"></a>
            	</div>

          <?php }  ?>
    </div>
	<?php }  ?>

    <?php if(($st_twitter == 't') && (($totalVideos > 0) || ($totalImagens > 0))) { ?>

                    <div id="painel_twitter_home">
                    <script src="http://widgets.twimg.com/j/2/widget.js"></script>
                    <script>
                    new TWTR.Widget({
                      version: 2,
                      type: 'profile',
                      rpp: 10,
                      interval: 4000,
                      width: 175,
                      height: 180,
                      theme: {
                        shell: {
                          background: '#efefef',
                          color: '#333333'
                        },
                        tweets: {
                          background: '#dbdedf',
                          color: '#333',
                          links: '#333'
                        }
                      },
                      features: {
                        scrollbar: true,
                        loop: false,
                        live: true,
                        hashtags: true,
                        timestamp: true,
                        avatars: false,
                        behavior: 'all'
                      }
                    }).render().setUser('<?=$twitter?>').start();

                    </script>
            	</div>
      <?php }	?>

    </div>
    <?php
		if($idEntidade == 260){
			echo '<p><b>Email:</b> atendimentoiptu@pmf.sc.gov.br ||
					iptudigital@pmf.sc.gov.br<br><b>Tel:</b> 3251-6400</p>';
		}
   ?>
</div>
