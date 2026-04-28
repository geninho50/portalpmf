<div class="centro">
<div id="caminho_migalhas">home &gt;</div>
<?php
		
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
	if(isset($_GET['cms']))
	{
		//------------------------------------------------------------
		//Recupera informações gerais para gerar a página de conteúdo
		//------------------------------------------------------------
		$titulocms = $_GET['cms'];
		$titulocms = str_replace(" ", "+", $titulocms);
		$sqlIdPagina = "SELECT cmspagina_id,cmspagina_entidade_id FROM cms_pagina WHERE cmspagina_abbr = '$titulocms' AND cmspagina_entidade_id = $IdEntidade";
		$rIdPagina = $drive->pedido($sqlIdPagina);
		$objIdPagina = pg_fetch_object($rIdPagina);
		$cms = $objIdPagina->cmspagina_id;
		$cmsentidadeid = $objIdPagina->cmspagina_entidade_id;
		
		if($cmsentidadeid == $IdEntidade){
			//------------------------------------------------------
			//Reliza toda as consulta necessárias no Banco de Dados
			//------------------------------------------------------
			$sqlNoticia = "SELECT CMS.* FROM cms_pagina AS CMS
				   WHERE CMS.cmspagina_id = $cms AND cmspagina_entidade_id = $IdEntidade "; 
					
			$sqlImagens = "SELECT IMG.*, CIMG.* FROM imagens AS IMG
							JOIN cms_pagina_imagens AS CIMG ON IMG.img_id = CIMG.cmsimg_img_id
							WHERE CIMG.cmsimg_pagina_id = $cms";	
							
			$sqlArquivos = "SELECT ARQ.*,CARQ.* FROM arquivos AS ARQ
							JOIN cms_pagina_arquivos AS CARQ ON ARQ.arq_id = CARQ.cmsarq_arq_id
							WHERE CARQ.cmsarq_pagina_id = $cms ORDER BY CARQ.cmsarq_posicao ASC";					
						
			$sqlMidia = "SELECT MID.*, CMID.* FROM midia AS MID
						 JOIN cms_pagina_midia AS CMID ON MID.midia_id = CMID.cmsmidia_midia_id
						 WHERE CMID.cmsmidia_pagina_id = $cms";
	
			$resNoticia = $drive->pedido($sqlNoticia);
			$resImagem = $drive->pedido($sqlImagens);
			$resArquivo = $drive->pedido($sqlArquivos);
			$resMidia = $drive->pedido($sqlMidia);
			
			//----------------------------
			//Recupera os arquivos da página
			//----------------------------

			while($obj = pg_fetch_object($resArquivo)){
				$arquivos.="<li><a href=\"../../$obj->arq_link\" >$obj->cmsarq_legenda</a></li>";
			}
			
			//-----------------------------------------------------------
	       	//Recupera todas as imagens relacionadas a página em questão
			//-----------------------------------------------------------	
	
			$numImagens = 0;
			$galeria = "";
			
			while($obj = pg_fetch_object($resImagem)){
				$legenda = $obj->img_legenda;
				$principal = $obj->nimg_principal;
				$imgPequena = $obj->img_link_v_pequena;
				$imgMedia = $obj->img_link_v_media;
				$imgAlta = $obj->img_link_v_alta;
				$legenda2 = strip_tags($obj->cmsimg_legenda);
				
				$impressaoLegenda = "";
				if ($legenda2 != "") {
		  		 $impressaoLegenda = "<br><div>$legenda2</div>";
				}
				$numImagens++;
				
			//--------------------------------------------------
			//Verifica se alguma imagem é a principal da página
			//--------------------------------------------------
				
			if($principal=='t'){
		
			$p="
			  <div id=\"imagem_principal\">
			  <a href=\"../$imgAlta\" rel=\"colorbox-principal\" title=\"$legenda2\" >
				 <img src=\"../$imgMedia\" border=\"0\" >
			  </a>$impressaoLegenda
			  </div>
		  
			";
		
	     	}	
				
			//---------------------------------------------------
			//monta a galeria de imagens
			//---------------------------------------------------
				
				$galeria.= "<a href=\"../$imgAlta\" rel=\"colorbox-galeria\" title=\"$legenda2\" >
							<li>
							<img src=\"../$imgPequena\" border=\"0\">
							</li>
							</a>";
			}
			
			//----------------------------
			//Recupera os dados da página
			//----------------------------
			
				while($obj = pg_fetch_object($resNoticia) ){
					
						$texto = $obj->cmspagina_texto;
						$titulo = $obj->cmspagina_titulo;
						$iframe = $obj->cmspagina_iframe;
						$tipoGaleria = $obj->cmspagina_estilo_galeria;
					
					}
					
		    //------------------------------------------------------------------------
			//Recupera todos as mídias relacionadas a página em questão - Áudio/Vídeo
			//------------------------------------------------------------------------
					
					while($obj = pg_fetch_object($resMidia)){
						$nomeMidia = $obj->midia_link;
						$legenda = $obj->cmsmidia_legenda;
						$tipo = $obj->midia_tipo;
						
				//--------------------------
				// Verifica o tipo de mídia
				// 0 -> Vídeo
				// 1 -> Áudio
				//--------------------------
						
						
						if($tipo==0){
							$width="240";					
							$height = "173";
							$player="../../scripts/php/videoPlayer";
							$video ="http://portal.pmf.sc.gov.br/$nomeMidia";				
							$retorno=videoPlayer($video,$width,$height,$player);
						}else{
							$width="240";					
							$height = "24";
							$player="../../scripts/php/audioPlayer";
							$audio ="http://portal.pmf.sc.gov.br/$nomeMidia";				
							$retorno=audioPlayer($audio,$width,$height,$player);
						
						}
						
				//------------------------------------------------------------------------
				//se ouver audio ou véideo ele será colocado no lugar da imagem principal
				//------------------------------------------------------------------------
						
						$p="  <div id=\"imagem_principal\">
			  					<div class=\"video_principal\">$retorno</div>
			  					<div>$legenda</div>
			  					</div>";
					}		
					
					
			//----------------------------
			//imprime a página na integra
			//----------------------------
							?>		
 
					<div id="titulo_pagina"><?=$titulo?></div>
					<div id="conteudo_pagina">
					<div>        
				   
     
                    <?=$p?>
                    <p><?=$texto?></p>
                    
                    
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
					
					if(!empty($arquivos)){
					?>
                    <div id="arquivos" class="arquivos-download"><h1>arquivos para download</h1>
                    <ul> 
                    <?=$arquivos?>
                    </ul>
                    </div>
             		<?php
                    }
                    
					
					//---------------------------------------------------
					//Se houver imagens cadastradas na página - imprime
					//---------------------------------------------------
		  			if(!empty($galeria))
					{
				
					    //-------------------------------------------
						//seta qual o tipo de galeria a ser impresso
						//-------------------------------------------
						if($tipoGaleria==0){
							$estiloGaleria = "<div id=\"galeria\">
												<h1>galeria de imagens</h1>
												<ul>
													".$galeria."
												
												</ul>
												
											 </div>";
						}else{
							$estiloGaleria = "<div id=\"galeriaTexto\">
												<ul>
													".$galeria."
												
												</ul><br class=\"clearfloat\" />
											 </div>";
						}

						//-----------------------------------------------
						//imprime a galeria se houver mais de uma imagem
						//-----------------------------------------------
						if ($numImagens >= 1){
							echo $estiloGaleria;                     
					  	}    
					}
                    ?>
                  
					</div><!-- fim conteudo_pagina --> 
					</div>
		<?php
        }else{
		  echo("<h3><center>P&Aacute;GINA N&Atilde;O ENCONTRADA</center></h3>");
		}
	
 ?>
                    
        			
   </div><!-- fim coluna_C2 -->   
<?php
}else
{
	$drive->redirect($path);
}  
?>