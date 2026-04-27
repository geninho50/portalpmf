<div id="pagina">
<div id="caminho_migalhas">home &gt;</div>

<?php	
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
	if(isset($_GET['cms'])){
		
		//------------------------------------------------------------
		//Recupera informações gerais para gerar a página de conteúdo
		//------------------------------------------------------------
		$titulocms 	 	= $_GET['cms'];
		$titulocms 	 	= str_replace(" ", "+", $titulocms);
		$sqlIdPagina 	= "SELECT cmspagina_id,cmspagina_entidade_id FROM cms_pagina WHERE cmspagina_abbr = '$titulocms' AND cmspagina_entidade_id = $IdEntidade";
		$rIdPagina 		= $drive->pedido($sqlIdPagina);
		$objIdPagina	= pg_fetch_object($rIdPagina);
		$cms 			= $objIdPagina->cmspagina_id;
		$cmsentidadeid  = $objIdPagina->cmspagina_entidade_id;
		
		if($cmsentidadeid == $IdEntidade){
		
			//------------------------------------------------------
			//Reliza toda as consulta necessárias no Banco de Dados
			//------------------------------------------------------
			$sqlPagina   = "SELECT CMS.* FROM cms_pagina AS CMS WHERE CMS.cmspagina_id = $cms AND cmspagina_entidade_id = $IdEntidade"; 				
			$sqlImagens  = "SELECT IMG.*, CIMG.* FROM imagens AS IMG JOIN cms_pagina_imagens AS CIMG ON IMG.img_id = CIMG.cmsimg_img_id WHERE CIMG.cmsimg_pagina_id = ".$cms." ORDER BY CIMG.cmsimg_img_id DESC";	
			$sqlArquivos = "SELECT ARQ.*, CARQ.* FROM arquivos AS ARQ JOIN cms_pagina_arquivos AS CARQ ON ARQ.arq_id = CARQ.cmsarq_arq_id WHERE CARQ.cmsarq_pagina_id = ".$cms." ORDER BY CARQ.cmsarq_posicao ASC";	
			$sqlVideos 	 = "SELECT MID.*, CMID.* FROM midia AS MID JOIN cms_pagina_midia AS CMID ON MID.midia_id = CMID.cmsmidia_midia_id WHERE CMID.cmsmidia_pagina_id = ".$cms." AND CMID.cmsmidia_tipo = 0";		
			$sqlAudios 	 = "SELECT MID.*, CMID.* FROM midia AS MID JOIN cms_pagina_midia AS CMID ON MID.midia_id = CMID.cmsmidia_midia_id WHERE CMID.cmsmidia_pagina_id = ".$cms." AND CMID.cmsmidia_tipo = 1";			
			$resPagina   = $drive->pedido($sqlPagina);
			$resImagem   = $drive->pedido($sqlImagens);
			$resArquivo  = $drive->pedido($sqlArquivos);
			$resVideos   = $drive->pedido($sqlVideos);
			$resAudios   = $drive->pedido($sqlAudios);
			
			//----------------------------
			//Recupera os dados da página
			//----------------------------
			while($objPagina = pg_fetch_object($resPagina)){			
				$texto 		 = $objPagina->cmspagina_texto;
				$titulo 	 = $objPagina->cmspagina_titulo;
				$iframe 	 = $objPagina->cmspagina_iframe;
				$tipoGaleria = $objPagina->cmspagina_estilo_galeria;
			}
			
			//-----------------------------------------------------------
	       	//Recupera todas as imagens relacionadas a página em questão
			//-----------------------------------------------------------		   	
			$numImagens = 0;
			$galeria = "";
			while($objImage = pg_fetch_object($resImagem)){
				$legenda 	= $objImage->img_legenda;
				$principal 	= $objImage->cmsimg_principal;
				$imgPequena = $objImage->img_link_v_pequena;
				$imgMedia 	= $objImage->img_link_v_media;
				$imgAlta 	= $objImage->img_link_v_alta;
				$legenda2 	= $objImage->cmsimg_legenda;				
				$numImagens++;
				//--------------------------------------------------
				//Verifica se alguma imagem é a principal da página
				//--------------------------------------------------
				if($principal=='t'){ 
					$midiaPrincipal=" 				
								  <a href=\"../$imgAlta\" rel=\"colorbox-principal\" title=\"$legenda2\" >
									 <img src=\"../$imgMedia\" border=\"0\" width=\"253\" height=\"175\" >
								  </a><br>
								  <div>$legenda2</div>";
				} 			
				
				//---------------------------------------------------
				//Verifica a qual tipo de galeria pertence a imagem
				//---------------------------------------------------
				if(($tipoGaleria=="")or($tipoGaleria==0)){ 
						$galeria.= "<a href=\"../$imgAlta\" rel=\"colorbox-galeria\" title=\"$legenda2\" >
									<li>
									<img src=\"../$imgPequena\" border=\"0\">
									</li>
									</a>";
				}else{						
						$galeria.= "<li>
									<img src=\"../$imgPequena\" border=\"0\"><div>$legenda2</div>
									</li>";									
				} 
			}
			
			//-------------------------------------------------
			//Recupera todos os arquivos relacionados a página
			//-------------------------------------------------
			$TgaleriaDoc = "";
			while($obj = pg_fetch_object($resArquivo)){
				$TgaleriaDoc .= "<li><a href=\"../../../".$obj->arq_link."\" >".$obj->cmsarq_legenda."</a></li>";					
			}

			//-----------------------------------------------
			//Recupera todos os vídeos relacionados a página
			//-----------------------------------------------				
			$width   	 = "130";					
			$height  	 = "117";
			$player  	 = "../../../scripts/php/videoPlayer";                   
			$TgaleriaVid = "";
			while($obj = pg_fetch_object($resVideos)){
				$video 	 = "http://portal.pmf.sc.gov.br/".$obj->midia_link;				
				$retorno = videoPlayer($video,$width,$height,$player);
				$TgaleriaVid .="
					<li>
						".$retorno."<br />
						<div style=\"padding-top:4px;\"></div>
						<br />
						".strip_tags($obj->midia_legenda)."
					</li>";					
			}
			
			//-----------------------------------------------
			//Recupera todos os áudios relacionados a página
			//-----------------------------------------------				
			$width   	 = "290";					
			$height  	 = "24";
			$player  	 = "../../../scripts/php/audioPlayer";                   
			$TgaleriaAud = "";
			while($obj = pg_fetch_object($resAudios)){
				$video 	 = "http://portal.pmf.sc.gov.br/".$obj->midia_link;				
				$retorno = audioPlayer($video,$width,$height,$player);
				$TgaleriaAud .="
					<li>
						<span style=\"width:100%\"><b>&nbsp;".strip_tags($obj->midia_legenda)."</b></span>
						<div style=\"padding-top:4px;\"></div><br />
						".$retorno."
					</li>";					
			}
			
			
			
			//----------------------------
			//imprime a página na integra
			//----------------------------
			?>					
			<div id="titulo_pagina"><?=$titulo?></div><br>					 
			<div id="conteudo_pagina">
            	<div>
                    <?php   
                    if($principal=='t'){ 
                    ?>
					<div id="imagem_principal">
                    	<?=$midiaPrincipal?>
                    </div>
                    <?php  
                    }
					
                    echo $texto; ?>
                    
					<br />                 
				</div>
			</div>
			<?php
			//---------------------------------------------
			//Se existir algum IFRAME cadastrado - imprime
			//---------------------------------------------
			if($iframe != ""){
				echo $iframe;
			}

			//---------------------------------------------------
			//Se houver arquivos cadastrados na página - imprime
			//---------------------------------------------------							
			if(!empty($TgaleriaDoc)){
			?>
				<div id="arquivos" class="arquivos-download">
					<h1>arquivos para download</h1>
					<ul><?=$TgaleriaDoc?></ul>
				</div>
			<?php
			}	
			//---------------------------------------------------
			//Se houver videos cadastrados na página - imprime
			//---------------------------------------------------
			if(!empty($TgaleriaVid)){
			?>							
				<div id="galeria">
					<h1>galeria de vídeos</h1>
					<ul><?=$TgaleriaVid?></ul>
				</div>
			<?php	
			}

			//---------------------------------------------------
			//Se houver áudios cadastrados na página - imprime
			//---------------------------------------------------
			if(!empty($TgaleriaAud)){
			?>							
				<div id="galeria">
					<h1>relação de áudios</h1>
					<ul><?=$TgaleriaAud?></ul>
				</div>
			<?php	
			}
			
			
			//---------------------------------------------------
			//Se houver imagens cadastradas na página - imprime
			//---------------------------------------------------
			if(!empty($galeria) ){
				
				//-------------------------------------------
				//seta qual o tipo de galeria a ser impresso
				//-------------------------------------------
				if($tipoGaleria==0){
					$estiloGaleria = "<div id=\"galeria\">
										<h1>galeria de imagens</h1>
										<ul>
											".$galeria."
										</ul>
										<br class=\"clearfloat\">
									 </div>";
				}else{
					$estiloGaleria = "<div id=\"galeriaTexto\">
										<ul>
											".$galeria."
										</ul>
										<br class=\"clearfloat\">
									 </div>";
				}

				//-----------------------------------------------
				//imprime a galeria se houver mais de uma imagem
				//-----------------------------------------------
				if (($numImagens > 1) || ( ($principal!='t') && ($numImagens == 1)) ){
					echo $estiloGaleria;                     
				}   
			}
        }else{
			echo("<h3><center>P&Aacute;GINA N&Atilde;O ENCONTRADA</center></h3>");
		}             
   		?>
	<br>     			
</div>
<?php	
}else{
	$drive->redirect($path);
}  
?>
