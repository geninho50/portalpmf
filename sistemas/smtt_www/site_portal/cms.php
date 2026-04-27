<div class="centro">
<div id="caminho_migalhas">home &gt;</div>
<?php
		
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
	
	if(isset($_GET['cms']))
	{
		$titulocms = $_GET['cms'];
		$titulocms = str_replace(" ", "+", $titulocms);
		$sqlIdPagina = "SELECT cmspagina_id,cmspagina_entidade_id FROM cms_pagina WHERE cmspagina_abbr = '$titulocms';
		$rIdPagina = $drive->pedido($sqlIdPagina);
		$objIdPagina = pg_fetch_object($rIdPagina);
		$cms = $objIdPagina->cmspagina_id;
		$cmsentidadeid = $objIdPagina->cmspagina_entidade_id";
		
			$sqlNoticia = "SELECT CMS.* FROM cms_pagina AS CMS
				   WHERE CMS.cmspagina_id = $cms"; 
					
			$sqlImagens = "SELECT IMG.*, CIMG.* FROM imagens AS IMG
							JOIN cms_pagina_imagens AS CIMG ON IMG.img_id = CIMG.cmsimg_img_id
							WHERE CIMG.cmsimg_pagina_id = $cms";	
							
			$sqlArquivos = "SELECT ARQ.*,CARQ.* FROM arquivos AS ARQ
							JOIN cms_pagina_arquivos AS CARQ ON ARQ.arq_id = CARQ.cmsarq_arq_id
							WHERE CARQ.cmsarq_pagina_id = $cms";					
						
			$sqlMidia = "SELECT MID.*, CMID.* FROM midia AS MID
						 JOIN cms_pagina_midia AS CMID ON MID.midia_id = CMID.cmsmidia_midia_id
						 WHERE CMID.cmsmidia_pagina_id = $cms";
	
			$resNoticia = $drive->pedido($sqlNoticia);
			$resImagem = $drive->pedido($sqlImagens);
			$resArquivo = $drive->pedido($sqlArquivos);
			$resMidia = $drive->pedido($sqlMidia);
			
			while($obj = pg_fetch_object($resArquivo)){
				$arquivos.="<li><a href=\"../../$obj->arq_link\" >$obj->cmsarq_legenda</a></li>";
			
	
			while($obj = pg_fetch_object($resImagem)){
				$legenda = $obj->img_legenda;
				$principal = $obj->nimg_principal;
				$imgPequena = $obj->img_link_v_pequena;
				$imgMedia = $obj->img_link_v_media;
				$imgAlta = $obj->img_link_v_alta;
				$legenda2 = strip_tags($obj->cmsimg_legenda);
				
			if($principal=='t'){
		
			$p="
				
			  <a href=\"../$imgAlta\" rel=\"lightbox\" title=\"$legenda2\" >
				 <img src=\"../$imgMedia\" border=\"0\" width=\"253\" height=\"175\" >
			  </a><br>
			  <div>$legenda2</div>
		  
			";
		
	     	}	
				
			
				
				$galeria.= "<a href=\"../$imgAlta\" rel=\"lightbox[galeria]\" title=\"$legenda2\" >
							<li>
							<img src=\"../$imgPequena\" border=\"0\">
							</li>
							</a>";
			}
			
			
				while($obj = pg_fetch_object($resNoticia) ){
						
								
						$texto = $obj->cmspagina_texto;
						$titulo = $obj->cmspagina_titulo;
					
					}
					
					while($obj = pg_fetch_object($resMidia)){
						$nomeMidia = $obj->midia_link;
						$legenda = $obj->cmsmidia_legenda;
						$tipo = $obj->midia_tipo;
						
						
						if($tipo==0){
							$width="253";					
							$height = "175";
							$player="../scripts/php/videoPlayer";
							$video ="http://portal.pmf.sc.gov.br/$nomeMidia";				
							$retorno=videoPlayer($video,$width,$height,$player);
						}else{
							$width="253";					
							$height = "24";
							$player="../scripts/php/audioPlayer";
							$audio ="http://portal.pmf.sc.gov.br/$nomeMidia";				
							$retorno=audioPlayer($audio,$width,$height,$player);
						
						}
						
						$p="				
							  $retorno<br>
							  <div>$legenda</div>";
					}		
					
			?>		
					
					<div id="titulo_pagina"><?=$titulo?></div>
					 
					<div id="conteudo_pagina">
                    
                    
					<div>        
				   
                     <div id="imagem_principal">
                    <?=$p?>
                    </div> 
							  
					<p>
						<?=$texto?>
					</p> 
                    
                    
                    <?php
					if(!empty($arquivos)){
					?>
                    <div id="arquivos"><h1>arquivos para download</h1>
                    <ul> 
                    <?=$arquivos?>
                    </ul>
                    </div>
             		<?php
                    }
                    ?> 
						
		 			 <?php	
		  			if(!empty($galeria))
					{
					?>
						<div id="galeria"><h1>galeria de imagens</h1>    
						<ul>
					
						<?=$galeria?>

						</ul>
                        </div>
                    <?php    
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