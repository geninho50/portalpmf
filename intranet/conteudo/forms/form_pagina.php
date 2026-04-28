<?php 
$TidPag 	= $_GET['idPag'];	
$TidEntidade=$_SESSION['SuserEnt'];
$sqlPag 	= "SELECT * FROM intranet_pagina WHERE intranet_pagina_id = $TidPag";
$Treturn 	= $drive->pedido($sqlPag);
$Tpag 		= pg_fetch_object($Treturn);	


$sqlImgPrin	=  "SELECT IMG.*,PIMG.* FROM imagens AS IMG
				JOIN intranet_pagina_imagens AS PIMG ON IMG.img_id = PIMG.intranet_imgpagina_img_id
				WHERE PIMG.intranet_imgpagina_pag_id = $TidPag AND PIMG.intranet_imgpagina_principal = 't'
				ORDER BY PIMG.intranet_imgpagina_id DESC LIMIT 1";
				
				
$TpaginaListaSql="SELECT * FROM intranet_pagina WHERE intranet_pagina_entidade_id=$TidEntidade AND intranet_pagina_status='t' ORDER BY intranet_pagina_id DESC LIMIT 7";
$TretornoPagLista=$drive->pedido($TpaginaListaSql);				
	
$Treturn 	= $drive->pedido($sqlImgPrin);
$TimgPrin	= pg_fetch_object($Treturn);

?>
<div class="centro"> 
<div id="caminho_migalhas">intranet ></div>
<div id="titulo_pagina"><?=$Tpag->intranet_pagina_titulo?></div>

<div>

    <div id="coluna_intranet_2">
		<div id="painel_lateral">
					<h1>outras páginas</h1>
                    <ul>
<?php
					$i=0;
					while($paginaLista=pg_fetch_object($TretornoPagLista)){
						echo'						
							<li><a href="inicio.php?pagina=pagina&idPag='.$paginaLista->intranet_pagina_id.'">'.$paginaLista->intranet_pagina_titulo.'</a></li>';
						$i++;
					}
					echo'</ul>';
					if($i==0){
						echo"
							Este &eacute; o espa&ccedil;o colaborativo da sua secretaria ou &oacute;rg&atilde;o. Em breve estar&atilde;o dispon&iacute;veis textos, arquivos para download, imagens, v&iacute;deos e &aacute;udios.
						";
					}else{
					 echo"<br><a href=\"inicio.php?pagina=pagconsulta\"><img src=\"../layout/imagens/intra_btn_mais.png\" border=\"0\" alt=\"mais páginas\"></a>";	
					}
					?>					
                                        
     	</div>
     </div><!-- fim coluna_intranet_2 --> 





	<div id="coluna_intranet_1">

    <div id="conteudo_pagina">	
    <?php if($TimgPrin != false){?>
    <div id="imagem_principal">
   		<a href="<?=$TimgPrin->img_link_v_alta?>" rel="colorbox-principal" title="<?=$TimgPrin->img_legenda?>">
			<img src="<?=$TimgPrin->img_link_v_media?>" border="0" width="253" height="175" >
		</a>
        <br>
		<div><?=$TimgPrin->img_legenda?></div>
	</div>  
    <? } ?>
	<p>
		<?=$Tpag->intranet_pagina_texto?>
	</p> 

<?php

//--------------------------------------------
// Busca por vúdeos relacionados a pagina
//--------------------------------------------
				
$sqlImg  	=  "SELECT IMG.*,PIMG.* FROM imagens AS IMG
				JOIN intranet_pagina_imagens AS PIMG ON IMG.img_id = PIMG.intranet_imgpagina_img_id
				WHERE PIMG.intranet_imgpagina_pag_id = $TidPag 
				ORDER BY PIMG.intranet_imgpagina_id DESC";
				
$sqlImgNum	= "SELECT * FROM intranet_pagina_imagens WHERE intranet_imgpagina_pag_id = $TidPag";
				
$TreturnNum = $drive->pedido($sqlImgNum);
$Tnum		= pg_num_rows($TreturnNum);
$Treturn 	= $drive->pedido($sqlImg);				

if($Tnum > 0 ){	

echo"<div id=\"galeria\">
	<h1>galeria de imagens</h1> 
	<div>   
	<ul>";
	while($Timg = pg_fetch_object($Treturn)){
		echo"
		<a href=\"".$Timg->img_link_v_alta."\" rel=\"colorbox-galeria\" title=\"".$Timg->img_legenda."\">
		<li><img src=\"".$Timg->img_link_v_pequena."\" border=\"0\"></li></a>";
	}
	echo"
	</ul>
	<br class=\"clearfloat\">
	</div>
</div>     

<br class=\"clearfloat\" />";
}
//--------------------------------------------
// Busca por vúdeos relacionados a pagina
//--------------------------------------------
				
$sqlMid  	=  "SELECT MID.*,PMID.* FROM midia AS MID
				JOIN intranet_pagina_midias AS PMID ON MID.midia_id = PMID.intranet_midpagina_mid_id
				WHERE PMID.intranet_midpagina_pag_id = $TidPag AND PMID.intranet_midpagina_tipo = 0
				ORDER BY PMID.intranet_midpagina_id DESC";
				
$sqlMidNum	= "SELECT * FROM intranet_pagina_midias WHERE intranet_midpagina_pag_id = $TidPag AND intranet_midpagina_tipo = 0";
				
$TreturnNum = $drive->pedido($sqlMidNum);
$Tnum		= pg_num_rows($TreturnNum);
$Treturn 	= $drive->pedido($sqlMid);				

if($Tnum > 0 ){	
	require_once("../scripts/php/funcoes.php");

	echo "<div id=\"videos\">
			<h1>galeria de vídeos</h1>
			<div>    
			<ul>";
			while($Tvid = pg_fetch_object($Treturn)){
		
				// ---------- Carrega Player de Vídeo ----------
				
				$width="226";					
				$height = "164";
				$player="../scripts/php/videoPlayer";
				$video ="http://portal.pmf.sc.gov.br/".$Tvid->midia_link;				
				$retorno=videoPlayer($video,$width,$height,$player);
				
				// ---------- Fim Carrega Player de Vídeo ----------
					
				echo"<li>".$retorno."</li>";
			}
	echo"</ul>
	<br class=\"clearfloat\">
	</div>
	</div>     
<br class=\"clearfloat\" />";
}

//--------------------------------------------
// Busca por áudios relacionados a pagina
//--------------------------------------------
				
$sqlMid  	=  "SELECT MID.*,PMID.* FROM midia AS MID
				JOIN intranet_pagina_midias AS PMID ON MID.midia_id = PMID.intranet_midpagina_mid_id
				WHERE PMID.intranet_midpagina_pag_id = $TidPag AND PMID.intranet_midpagina_tipo = 1
				ORDER BY PMID.intranet_midpagina_id DESC";
				
$sqlMidNum	= "SELECT * FROM intranet_pagina_midias WHERE intranet_midpagina_pag_id = $TidPag AND intranet_midpagina_tipo = 1";
				
$TreturnNum = $drive->pedido($sqlMidNum);
$Tnum		= pg_num_rows($TreturnNum);
$Treturn 	= $drive->pedido($sqlMid);				

if($Tnum > 0 ){	
	require_once("../scripts/php/funcoes.php");
	echo"<div id=\"audios\">
		<h1>galeria de áudios</h1>    
		<ul>";
			while($Taudios	= pg_fetch_object($Treturn)){
			
				// ---------- Carrega Player de Áudio ----------
		
				$nomeMidia 	= $Taudios->midia_link;
				$width		="290";					
				$height 	= "24";
				$player		="../scripts/php/audioPlayer";
				$audio  	="http://portal.pmf.sc.gov.br/".$Taudios->midia_link;				
				$retorno	= audioPlayer($audio,$width,$height,$player);
				
				// ---------- Fim Carrega Player de Áudio ----------
			
				echo "<li>".$retorno."<br>".$Taudios->midia_legenda."</li>";
			}
	echo"</ul>
	</div>     
<br class=\"clearfloat\" />";
}

//--------------------------------------------
// Busca por arquivos relacionados a pagina
//--------------------------------------------

$sqlArq  	=  "SELECT ARQ.*,PARQ.* FROM arquivos AS ARQ
				JOIN intranet_pagina_arquivos AS PARQ ON ARQ.arq_id = PARQ.intranet_arqpagina_arq_id
				WHERE PARQ.intranet_arqpagina_pag_id = $TidPag ORDER BY PARQ.intranet_arqpagina_ordem ASC";
				
$sqlArqNum	= "SELECT * FROM intranet_pagina_arquivos WHERE intranet_arqpagina_pag_id = $TidPag";
				
$TreturnNum = $drive->pedido($sqlArqNum);
$Tnum		= pg_num_rows($TreturnNum);
$Treturn 	= $drive->pedido($sqlArq);

if($Tnum > 0 ){
echo "
	<div id=\"arquivos\">
		<h1>arquivos para download</h1>
		<ul>";
		while($Tarquivos	= pg_fetch_object($Treturn)){		
			echo "<li><a href=\"../".$Tarquivos->arq_link."\">".$Tarquivos->arq_nome."</a></li>";
		}
		echo"</ul>
	</div>";
}
?>


</div><!-- fim conteudo_pagina -->
    
    </div><!-- fim coluna_intranet_1 --> 
 
    <br class="clearfloat">
   </div> 
</div><!-- fim coluna_C2 -->     