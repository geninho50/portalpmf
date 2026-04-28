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
            if(isset($_GET['e'])){
				//------------------------------------------------------------
				//Recupera informações gerais para gerar a página de conteúdo
				//------------------------------------------------------------
				$TevetntoId	  = $_GET['e'];
				$sqlIdEvento  = "SELECT evento_entidade_id FROM eventos WHERE evento_id = ".$TevetntoId;
				$rIdEvento    = $drive->pedido($sqlIdEvento);
				$objIdEvento  = pg_fetch_object($rIdEvento);
				$TentidadeId  = $objIdEvento->evento_entidade_id;
				
				//------------------------------------------------------
				//Reliza toda as consulta necessárias no Banco de Dados
				//------------------------------------------------------
				$sqlEventos	 = "SELECT * FROM eventos WHERE evento_id = ".$TevetntoId." AND evento_entidade_id = ".$TentidadeId; 					
				$sqlImagens  = "SELECT IMG.*, EIMG.* FROM imagens AS IMG JOIN eventos_imagens AS EIMG ON IMG.img_id = EIMG.eimg_img_id WHERE EIMG.eimg_evento_id = ".$TevetntoId." ORDER BY IMG.img_id DESC";								
				$sqlArquivos = "SELECT ARQ.*, EARQ.* FROM arquivos AS ARQ JOIN eventos_arquivos AS EARQ ON ARQ.arq_id = EARQ.earq_arq_id WHERE EARQ.earq_evento_id = ".$TevetntoId." ORDER BY ARQ.arq_nome ASC";												
				$sqlVideos 	 = "SELECT MID.*, EMID.* FROM midia AS MID JOIN eventos_midia AS EMID ON MID.midia_id = EMID.emidia_midia_id WHERE EMID.emidia_evento_id = ".$TevetntoId." AND EMID.emidia_tipo = 0";		
				$sqlAudios 	 = "SELECT MID.*, EMID.* FROM midia AS MID JOIN eventos_midia AS EMID ON MID.midia_id = EMID.emidia_midia_id WHERE EMID.emidia_evento_id = ".$TevetntoId." AND EMID.emidia_tipo = 1";	
				$sqlNoticia  = "SELECT * FROM noticias WHERE noti_evento_id = ".$TevetntoId." AND noti_status='t'";			
				$resEvento   = $drive->pedido($sqlEventos);
				$resImagem   = $drive->pedido($sqlImagens);
				$resArquivo  = $drive->pedido($sqlArquivos);
				$resVideos   = $drive->pedido($sqlVideos);
				$resAudios   = $drive->pedido($sqlAudios);
				$resNoticia  = $drive->pedido($sqlNoticia);

				//----------------------------
				//Recupera os dados da página
				//----------------------------			
				while($obj = pg_fetch_object($resEvento) ){					
					$Ttexto  = $obj->evento_texto;
					$Ttitulo = $obj->evento_nome;
					$Tbanner = $obj->evento_img_banner;
					$Tdata1	 = explode("-", $obj->evento_data_inicio);
					$Tdata2	 = explode("-", $obj->evento_data_final);
					$Tdata   = $Tdata1[2]."/".$Tdata1[1]."/".$Tdata1[0]." a ".$Tdata2[2]."/".$Tdata2[1]."/".$Tdata1[0];
					if($obj->evento_horario_inicial == "" && $obj->eventos_horario_final == ""){
						$Thorario = "";
					}else{
						$Thorario = " ".$obj->evento_horario_inicial." às ".$obj->evento_horario_final;
					}
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
					$Tprincipal  = $obj->eimg_principal;				
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
					$TgaleriaDoc .= "<li><a href=\"../../../".$obj->arq_link."\" >".$obj->earq_legenda."</a></li>";					
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
					
				//----------------------------------------------------------	
				// Recuperas as notícias associadas a este evento se houver	
				//----------------------------------------------------------
				$Tnoticias = "";
				while($obj = pg_fetch_object($resNoticia)){
					$TtituloNoti = $obj->noti_titulo;
					$Tnoticias  .= "<li>".$TtituloNoti."</li>";
				}
				
				//----------------------------
				//imprime a página na integra
				//----------------------------						
				?>		
               
               
				<div class="centro">
    				<div id="caminho_migalhas">not&iacute;cias e eventos</div>
     				<div id="titulo_noticia"><?=$Ttitulo?></div>
     				<div id="chamada_noticia">
						<?=$Tdata?><br/>
						<?php
                        if(!empty($Thorario)){
                            echo "Horário: ".$Thorario;
                        }
                        ?>
     				</div>
     				<?php
	 				if(!empty($Tbanner)){
	  					echo "<img src=\"../../../".$Tbanner."\" border=\"0\" width=\"516\" height=\"210\"><br><br>";
					}
	 				?>
     				<div id="conteudo_pagina">
      					<?php
                        echo $TimgPrinc;
       					if(!empty($Tnoticias)){
       						?>
       						<div id="noticias_relaciondas">
                                <h2>notícias relacionadas</h2>
                                <ul>
                                	<?=$Tnoticias?>          
          						</ul>
       						</div> 
       						<?php
        				}
        				echo "<p>".$Ttexto."</p>";
						echo "<br class=\"clearfloat\">";
						
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
						<br class="clearfloat" />
            	</div>
            </div>                        
			<?php
			}
            ?>		
      	</div>
   	</div>
</body>
</html>