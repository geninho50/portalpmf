<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Prefeitura Municipal de Florianópolis</title>
	<link rel="stylesheet" href="../../../layout/prefeitura.css" type="text/css" />
    <link rel="stylesheet" href="../../../layout/prefeitura_entidades.css" type="text/css">
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

</head>
<body>
	<div class="layout_entidades_novo" style="background-color:#FFF;">
		<div style="text-align:left; background-color:#FFF; padding:10px 5px 0 5px;"> 
			<?php   
            require_once("../../../scripts/php/funcoes.php");
			require_once("../../../scripts/php/funcoes_bd.php");
			$drive->conecta();
            if(isset($_GET['p'])){
				//------------------------------------------------------------
				//Recupera informações gerais para gerar a página de conteúdo
				//------------------------------------------------------------
				$TpaginaId 	 = $_GET['p'];
				$sqlIdPagina = "SELECT cmspagina_entidade_id FROM cms_pagina WHERE cmspagina_id = ".$TpaginaId;
				$rIdPagina 	 = $drive->pedido($sqlIdPagina);
				$objIdPagina = pg_fetch_object($rIdPagina);
				$TentidadeId = $objIdPagina->cmspagina_entidade_id;
				
				//------------------------------------------------------
				//Reliza toda as consulta necessárias no Banco de Dados
				//------------------------------------------------------
				$sqlPagina 	 = "SELECT * FROM cms_pagina WHERE cmspagina_id = ".$TpaginaId." AND cmspagina_entidade_id = ".$TentidadeId; 					
				$sqlImagens  = "SELECT IMG.*, CIMG.* FROM imagens AS IMG JOIN cms_pagina_imagens AS CIMG ON IMG.img_id = CIMG.cmsimg_img_id WHERE CIMG.cmsimg_pagina_id = ".$TpaginaId." ORDER BY IMG.img_id DESC";								
				$sqlArquivos = "SELECT ARQ.*,CARQ.* FROM arquivos AS ARQ JOIN cms_pagina_arquivos AS CARQ ON ARQ.arq_id = CARQ.cmsarq_arq_id WHERE CARQ.cmsarq_pagina_id = ".$TpaginaId." ORDER BY CARQ.cmsarq_posicao ASC";												
				$sqlVideos 	 = "SELECT MID.*, CMID.* FROM midia AS MID JOIN cms_pagina_midia AS CMID ON MID.midia_id = CMID.cmsmidia_midia_id WHERE CMID.cmsmidia_pagina_id = ".$TpaginaId." AND CMID.cmsmidia_tipo = 0";		
				$sqlAudios 	 = "SELECT MID.*, CMID.* FROM midia AS MID JOIN cms_pagina_midia AS CMID ON MID.midia_id = CMID.cmsmidia_midia_id WHERE CMID.cmsmidia_pagina_id = ".$TpaginaId." AND CMID.cmsmidia_tipo = 1";		
				$resPagina   = $drive->pedido($sqlPagina);
				$resImagem   = $drive->pedido($sqlImagens);
				$resArquivo  = $drive->pedido($sqlArquivos);
				$resVideos   = $drive->pedido($sqlVideos);
				$resAudios   = $drive->pedido($sqlAudios);
                
			 	//----------------------------
				//Recupera os dados da página
				//----------------------------			
				while($obj = pg_fetch_object($resPagina) ){					
					$Ttexto  = $obj->cmspagina_texto;
					$Ttitulo = $obj->cmspagina_titulo;
					$Tiframe = $obj->cmspagina_iframe;
				}
								
				//-----------------------------------------------
				//Recupera todas as imagens relacionadas a página 
				//------------------------------------------------	
				$TnumImagens = 0;
				$TgaleriaImg = "";				
				while($obj = pg_fetch_object($resImagem)){
					$Tlegenda 	 = strip_tags($obj->img_legenda);
					$Tautor		 = $obj->img_autor;
					$TimgPequena = $obj->img_link_v_alta;
					$TimgMedia   = $obj->img_link_v_media;
					$Tprincipal  = $obj->cmsimg_principal;					
					$numImagens++;           
					//--------------------------------------------------
					//Verifica se alguma imagem é a principal da página
					//--------------------------------------------------
						
					if($Tprincipal=='t'){						
						$TimgPrinc = " 	<div id=\"imagem_principal\">					  						
						 					<img src=\"../../../".$TimgMedia."\" border=\"0\" >
											".$Tlegenda."
					  					</div>";			
					}
					
					//-----------------------------
					// monta a galeria de imagens
					//-----------------------------
					$TgaleriaImg .= "<li><img src=\"../../../".$TimgPequena."\" border=\"0\" ></li>";
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
					$video 	 = "https://portal.pmf.sc.gov.br/".$obj->midia_link;				
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
					$video 	 = "https://portal.pmf.sc.gov.br/".$obj->midia_link;				
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
                <div id="caminho_migalhas">home &gt;</div> 
                <div id="titulo_pagina"><?=$Ttitulo?></div>
	                <div id="conteudo_pagina">
    		            <div>  	
							<?php
                            echo $TimgPrinc."<p>".$Ttexto."</p>";
							
                            //---------------------------------------------
                            //Se existir algum IFRAME cadastrado - imprime
                            //---------------------------------------------
							if(!empty($Tiframe)){
								echo $Tiframe;
							}
							
							//---------------------------------------------------
							//Se houver arquivos cadastrados na página - imprime
							//---------------------------------------------------							
							if(!empty($TgaleriaDoc)){
							?>
								<div id="arquivos">
                                	<h1>arquivos para download</h1>
                                    <ul><?=$TgaleriaDoc?></ul>
								</div>
							<?php
							}
							
							//---------------------------------------------------
							//Se houver imagens cadastradas na página - imprime
							//---------------------------------------------------
							if(!empty($TgaleriaImg)){
							?>							
								<div id="galeria">
									<h1>galeria de imagens</h1>
									<ul><?=$TgaleriaImg?></ul>
								</div>
							<?php	
							}
							
							//---------------------------------------------------
							//Se houver videos cadastrados na página - imprime
							//---------------------------------------------------
							if(!empty($TgaleriaVid)){
							?>							
								<div id="videos">
									<h1>galeria de vídeos</h1>
									<ul><?=$TgaleriaVid?></ul>
								</div>
							<?php	
							}

							//---------------------------------------------------
							//Se houver áudiso cadastrados na página - imprime
							//---------------------------------------------------
							if(!empty($TgaleriaAud)){
							?>							
								<div id="audios">
									<h1>relação de áudios</h1>
									<ul><?=$TgaleriaAud?></ul>
								</div>
							<?php	
							}

                            ?>
 						</div>
                  	</div>
               	</div>                           
			<?php
			}
            ?>
			</div>
      	</div>
   	</div>
</body>
</html>