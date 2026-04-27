<div class="centro">
<div id="pagina">
<div id="caminho_migalhas">home &gt;</div>

		<div id="titulo_pagina">galeria de vídeos</div>					 
		<div id="conteudo_pagina">
	<?php
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
	require_once(CAMINHO_SITE."/scripts/php/paginacao.php");
	//-------------------------
	// controle de paginação
	//-------------------------
	if(!isset($_GET['pg'])){
		$pg = 1;
	}else{
		$pg = $_GET['pg'];	
	}	
	$inicio = ($pg * 4) - 4;
	$Tcaminho = "?pagina=videos";
	
	//--------------------------------------------------
	//recupera informações dos vídeos a serem mostrados
	//--------------------------------------------------
	$numSql = "SELECT COUNT(*) FROM midia WHERE midia_entidade_id = $IdEntidade and midia_tipo = 0";
	$sql 	= "SELECT * FROM midia WHERE midia_entidade_id = $IdEntidade and midia_tipo = 0 ORDER BY midia_data DESC LIMIT 4 offset $inicio"; 
	$result = $drive->pedido($sql);
	$TreturnSqlNum = $drive->pedido($numSql);
	?> 
	<div class="coluna_midias sem_margem_topo sem_padding"> 
        <div id="painel_galeria">      
        	<div id='pageVideoLegenda'>
                <div id='imagesVideoLegenda'>
                    <ul class='galleryVideoLegendaSites'>
						<?php 
						//---------------
						//imprime vídeos 
						//---------------
                        $existeVideos = 0;
						while($Tvid=pg_fetch_object($result)){
                            $width="240";					
                            $height = "173";
                            $player="../../scripts/php/videoPlayer";
                            $video ="http://portal.pmf.sc.gov.br/".$Tvid->midia_link;				
                            $retorno=videoPlayer($video,$width,$height,$player);				
                            
                            $Tdata 	  = explode("-", $Tvid->midia_data);
                            $TimpData = $Tdata[2]."/".$Tdata[1]."/".$Tdata[0];						
  
                            echo"
                            <li>
                            <form method=\"post\">
                            <input type=\"hidden\" name=\"FidMid\" value=\"".$Tvid->midia_id."\" />				
                            <center>".$retorno."
                            </center>				
                            <div class=\"legenda_video\">
                            <strong>".$TimpData."</strong><br />".$Tvid->midia_legenda."
                            </div>				
                            </form>
                            </li>";		
                           	$existeVideos++;         
                        }
                        ?>
                    </ul> 
         		</div>	
        	</div>
        </div> </div></div><br>
        <?php
		if($existeVideos > 0){
// ========================= imprime numumero de paginas rodapé  =========================

			$numPagTotal = pg_fetch_object($TreturnSqlNum);
			echo "<div style=\"clear:right\"><br>";
			$TnumPag = $numPagTotal->count;
			if($TnumPag < 4){
				$TnumPag = 4;
			}
			mostra_paginas($TnumPag, $_GET['pg'], $Tcaminho, 4);
			echo "</div>";		

// ========================= fim imprime num de páginas  =========================        
		}else{
			echo"Ainda n&atilde;o foram inclu&iacute;dos v&iacute;deos.
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
		}
		?>
        
        <br class="clearfloat" /> 
	</div>       
</div>