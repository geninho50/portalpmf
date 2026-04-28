<?php
   
	$idNoticia = $_GET['noti'];
	
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");

	$sqlNoticia = "SELECT NOTI.*,EDIT.* FROM noticias AS NOTI
					JOIN editorias AS EDIT ON NOTI.noti_edit_id = EDIT.edit_id	
					WHERE NOTI.noti_id=$idNoticia"; 
					
	$sqlImagens = "SELECT IMG.*, NIMG.* FROM imagens AS IMG
					JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.nimg_img_id
					WHERE NIMG.nimg_noti_id = $idNoticia";	
					
	$sqlArquivos = "SELECT ARQ.*,NARQ.* FROM arquivos AS ARQ
					JOIN noticias_arquivos AS NARQ ON ARQ.arq_id = NARQ.narq_arq_id
					WHERE NARQ.narq_noti_id = $idNoticia ORDER BY ARQ.arq_id ASC";					
				
	$sqlMidia = "SELECT MID.*, NMID.* FROM midia AS MID
				 JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id
				 WHERE NMID.nmidia_noti_id = $idNoticia";
	
	$resNoticia = $drive->pedido($sqlNoticia);
	$resImagem = $drive->pedido($sqlImagens);
	$resArquivo = $drive->pedido($sqlArquivos);
	$resMidia = $drive->pedido($sqlMidia);
	
	if( !isset( $arquivos )){
		$arquivos = '';
	}

	while($obj = pg_fetch_object($resArquivo)){
		$arquivos.="<li style=\"background-image: none;\"><a href=\"../../$obj->arq_link\" >$obj->narq_legenda</a></li>";
	}
	
	$i=0;
	$numImg = pg_num_rows($resImagem);
	while($obj = pg_fetch_object($resImagem)){
	    
		$legenda = $obj->img_legenda;
		$imgPequena = $obj->img_link_v_pequena;
		$imgMedia = $obj->img_link_v_media;
		$imgAlta = $obj->img_link_v_alta;
		$principal = $obj->nimg_principal;
		$legenda2 = strip_tags($obj->nimg_legenda);
		if(!empty($obj->img_autor)){
		$autor = $obj->img_autor;
		}
		
		$impressaoLegenda = "";
		if ($legenda2 != "") {
		   $impressaoLegenda = "<br><div>$legenda2</div>";
		}
		
		if($principal=='t'){
		
			$p="
			 <div id=\"imagem_principal\">
			  <span id=\"legenda_foto\">foto/divulga&ccedil;&atilde;o: $autor</span><br>
			  <a href=\"../$imgAlta\" rel=\"colorbox-principal\" title=\"$legenda2\" >
				 <img src=\"../$imgMedia\" border=\"0\" >
			  </a>$impressaoLegenda
			  </div>
		  
			";
		
		}
		
		if($i==0){
			$p="
			<div id=\"imagem_principal\">
			<span id=\"legenda_foto\">foto/divulga&ccedil;&atilde;o: $autor</span><br>
			  <a href=\"../$imgAlta\" rel=\"colorbox-principal\" title=\"$legenda2\" >
				 <img src=\"../$imgAlta\" border=\"0\" >
			  </a>$impressaoLegenda
			  </div>
		  
			";
		}
		
		
		$i++;
		
		if($numImg>1){
		if( !isset( $galeria ) ){
			$galeria = '';
		}	

		$galeria.= "<li>
			    <a href=\"../$imgAlta\" rel=\"colorbox-galeria\" title=\"$legenda2  (foto/divulga&ccedil;&atilde;o:$autor)\" >
			    <img src=\"../$imgAlta\"  width=\"120x\" height=\"90px\"  border=\"0\">
			    </a>
			    </li>";
					
		}	
	}
	
	while($obj = pg_fetch_object($resNoticia) ){
		
		$editoria = $obj->edit_nome;		
		$texto    = stripcslashes( $obj->noti_texto );
		$titulo   = stripcslashes( $obj->noti_titulo );
		$manchete = stripcslashes( $obj->noti_manchete );
		$data = transformaData($obj->noti_data);
	
	}
	
	while($obj = pg_fetch_object($resMidia)){
		$nomeMidia = $obj->midia_link;
		$legenda = $obj->nmidia_legenda;
		$tipo = $obj->midia_tipo;
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
		
		$p="  <div id=\"imagem_principal\">
			  <div class=\"video_principal\">$retorno</div>
			  <div>$legenda</div>
			  </div>";
	}
	
 ?>
<div class="centro">
    <div id="caminho_migalhas"><?=$data." - ".$editoria?></div>
    <div id="titulo_noticia"><?=$titulo?></div>
    <div id="chamada_noticia"><?=str_replace("&nbsp;", "", strip_tags($manchete))?></div>
     
    <div id="conteudo_pagina"><br>        
        <?=$p?>
               
              
		<p>
			<?=$texto?>
		</p> 

		<br />
	<?php
	if(!empty($arquivos)){
	?>
    <div id="arquivos" class="arquivos-download"><h1>arquivos para download</h1> 
		<ul>
			<?=$arquivos?>
		</ul>
	</div> 
             
	<?php
	}
	?>  
	
	<?php
	if(!empty($galeria) ){
	?>        
		<div id="galeria"><h1>galeria de imagens</h1>    
			<ul>
				<?=$galeria?>
			</ul>
		</div>
	<?php
	}
	?>
	</div> 

<br class="clearfloat" />       
	
	         
</div><!-- fim coluna_C2 -->   
   
