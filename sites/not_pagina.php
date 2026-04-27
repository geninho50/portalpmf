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
					WHERE NARQ.narq_noti_id = $idNoticia";					
				
	$sqlMidia = "SELECT MID.*, NMID.* FROM midia AS MID
				 JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id
				 WHERE NMID.nmidia_noti_id = $idNoticia";
	
	$resNoticia = $drive->pedido($sqlNoticia);
	$resImagem = $drive->pedido($sqlImagens);
	$resArquivo = $drive->pedido($sqlArquivos);
	$resMidia = $drive->pedido($sqlMidia);
	
	while($obj = pg_fetch_object($resArquivo)){
		$arquivos.="<li><a href=\"../../$obj->arq_link\" >$obj->narq_legenda</a></li>";
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
		   $impressaoLegenda = "<div>$legenda2</div>";
		}
		
		if($principal=='t'){
		
			$p="<span id=\"legenda_foto\">foto/divulga&ccedil;&atilde;o: $autor</span><br>
			  <div id=\"imagem_principal\">	
			  <a href=\"../$imgAlta\" rel=\"colorbox-principal\" title=\"$legenda2\" >
				 <img src=\"../$imgMedia\" border=\"0\" width=\"253\" height=\"175\" >
			  </a><br>
			  $impressaoLegenda</div>
		  
			";
		
		}
		
		if($i==0){
			$p="
			<span id=\"legenda_foto\">foto/divulga&ccedil;&atilde;o: $autor</span><br>
			  <div id=\"imagem_principal\">	
			  <a href=\"../$imgAlta\" rel=\"colorbox-principal\" title=\"$legenda2\" >
				 <img src=\"../$imgMedia\" border=\"0\" width=\"253\" height=\"175\" >
			  </a><br>
			  $impressaoLegenda</div>
		  
			";
		}
		
		
		$i++;
		
		if($numImg>1){
		$galeria.= "<a href=\"../$imgAlta\" rel=\"colorbox-galeria\" title=\"$legenda2  (foto/divulga&ccedil;&atilde;o:$autor)\" >
					<li>
					<img src=\"../$imgPequena\" border=\"0\">
					</li>
					</a>";
					
		}	
	}
	
	while($obj = pg_fetch_object($resNoticia) ){
		
		$editoria = $obj->edit_nome;		
		$texto = $obj->noti_texto;
		$titulo = $obj->noti_titulo;
		$manchete = $obj->noti_manchete;
		$data = transformaData($obj->noti_data);
	
	}
	
	while($obj = pg_fetch_object($resMidia)){
		$nomeMidia = $obj->midia_link;
		$legenda = $obj->nmidia_legenda;
		$tipo = $obj->midia_tipo;
		if($tipo==0){
			$width="253";					
			$height = "175";
			$player="../../scripts/php/videoPlayer";
			$video ="http://portal.pmf.sc.gov.br/$nomeMidia";				
			$retorno=videoPlayer($video,$width,$height,$player);
		}else{
			$width="253";					
			$height = "24";
			$player="../../scripts/php/audioPlayer";
			$audio ="http://portal.pmf.sc.gov.br/$nomeMidia";				
			$retorno=audioPlayer($audio,$width,$height,$player);
		
		}
		
		$p="				
			  $retorno<br>
			  <div>$legenda</div>";
	}
	
 ?>
<div id="pagina">
     <div id="caminho_migalhas"><?=$data." - ".$editoria?></div>
     <div id="titulo_noticia"><?=$titulo?></div>
     <div id="chamada_noticia"><?=$manchete?></div>
     
     
     <div id="conteudo_pagina">        
          <?=$p?>
               
              
       <p>
       <?=$texto?>
       </p> 
       

<br />

<?
if(!empty($arquivos)){
?>
    <div id="arquivos" class="arquivos-download"><h1>arquivos para download</h1> 
    <ul>
    <?=$arquivos?>
    </ul></div> 
             
<?
}
?>  


        
<?
if(!empty($galeria) ){
?>        
<div id="galeria"><h1>galeria de imagens</h1>    
<ul>

<?=$galeria?>

</ul></div>      
<?
}
?>


<br class="clearfloat" />       
       
          
  </div>
   </div><!-- fim coluna_C2 -->   
   