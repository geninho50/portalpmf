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
            if(isset($_GET['n'])){
				//------------------------------------------------------------
				//Recupera informações gerais para gerar a página de conteúdo
				//------------------------------------------------------------
				$TnoticiaId	  = $_GET['n'];
				$sqlIdNoticia = "SELECT noti_entidade_id FROM noticias WHERE noti_id = ".$TnoticiaId;
				$rIdnoticia   = $drive->pedido($sqlIdNoticia);
				$objIdNoticia = pg_fetch_object($rIdnoticia);
				$TentidadeId  = $objIdNoticia->noti_entidade_id;


				
				//------------------------------------------------------
				//Reliza toda as consulta necessárias no Banco de Dados
				//------------------------------------------------------
				$sqlNoticia	 = "SELECT * FROM noticias WHERE noti_id = ".$TnoticiaId." AND noti_entidade_id = ".$TentidadeId; 					
				$sqlImagens  = "SELECT IMG.*, NIMG.* FROM imagens AS IMG JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.nimg_img_id WHERE NIMG.nimg_noti_id = ".$TnoticiaId." ORDER BY IMG.img_id DESC";								
				$sqlArquivos = "SELECT ARQ.*, NARQ.* FROM arquivos AS ARQ JOIN noticias_arquivos AS NARQ ON ARQ.arq_id = NARQ.narq_arq_id WHERE NARQ.narq_noti_id = ".$TnoticiaId." ORDER BY ARQ.arq_nome ASC";												
				$sqlVideos 	 = "SELECT MID.*, NMID.* FROM midia AS MID JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id WHERE NMID.nmidia_noti_id = ".$TnoticiaId." AND NMID.nmidia_tipo = 0";		
				$sqlAudios 	 = "SELECT MID.*, NMID.* FROM midia AS MID JOIN noticias_midia AS NMID ON MID.midia_id = nMID.nmidia_midia_id WHERE NMID.nmidia_noti_id = ".$TnoticiaId." AND NMID.nmidia_tipo = 1";		
				$resNoticia  = $drive->pedido($sqlNoticia);
				$resImagem   = $drive->pedido($sqlImagens);
				$resArquivo  = $drive->pedido($sqlArquivos);
				$resVideos   = $drive->pedido($sqlVideos);
				$resAudios   = $drive->pedido($sqlAudios);
                
			 	//----------------------------
				//Recupera os dados da página
				//----------------------------			
				while($obj = pg_fetch_object($resNoticia) ){					
					$Ttexto  = $obj->noti_texto;
					$Ttitulo = $obj->noti_titulo;
					$Topoio  = $obj->noti_manchete;
				}			
				//-----------------------------------------------
				//Recupera todas as imagens relacionadas a página 
				//------------------------------------------------	
				$TnumImagens = 0;
				$TgaleriaImg = "";			
				while($obj = pg_fetch_object($resImagem)){
					$Tlegenda 	 = strip_tags($obj->img_legenda);
					$Tautor		 = $obj->img_autor;
					$TimgPequena = $obj->img_link_v_pequena;
					$TimgMedia   = $obj->img_link_v_media;
					$Tprincipal  = $obj->nimg_principal;					
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
					$TgaleriaDoc .= "<li><a href=\"../../../".$obj->arq_link."\" >".$obj->narq_legenda."</a></li>";					
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
                <div id="caminho_migalhas">home &gt;</div> <br />
                <div id="titulo_pagina"><?=$Ttitulo?></div>
                <div id="chamada_noticia"><?=$Topoio?></div>
	                <div id="conteudo_pagina">
    		            <div>  	
							<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);

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