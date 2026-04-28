<?php
	$idEvento = $_GET['event'];
	
	require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
	require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
	
	$drive->conecta();
	
	$sqlEvento = "SELECT * FROM eventos WHERE evento_id = $idEvento";
					
	$sqlImagens = "SELECT IMG.*, EIMG.* FROM imagens AS IMG
					JOIN eventos_imagens AS EIMG ON IMG.img_id = EIMG.eimg_img_id
					WHERE EIMG.eimg_evento_id = $idEvento";	
					
	$sqlArquivos = "SELECT ARQ.*,EARQ.* FROM arquivos AS ARQ
					JOIN eventos_arquivos AS EARQ ON ARQ.arq_id = EARQ.earq_arq_id
					WHERE EARQ.earq_evento_id = $idEvento";					
				
	$sqlMidia = "SELECT MID.*, EMID.* FROM midia AS MID
				 JOIN eventos_midia AS EMID ON MID.midia_id = EMID.emidia_midia_id
				 WHERE EMID.emidia_evento_id = $idEvento";
				 
	$sqlNoticia = "SELECT * FROM noticias WHERE noti_evento_id = $idEvento AND noti_status='t' order by noti_data desc";			 

	$resEvento = $drive->pedido($sqlEvento);
	$resImagem = $drive->pedido($sqlImagens);
	$resArquivo = $drive->pedido($sqlArquivos);
	$resMidia = $drive->pedido($sqlMidia);
	$resNoticia = $drive->pedido($sqlNoticia);
	
	while($obj = pg_fetch_object($resEvento)){
	
		$titulo = $obj->evento_nome;
		$data1 = transformaData($obj->evento_data_inicio);
		$data2 = transformaData($obj->evento_data_final);
		$banner = $obj->evento_img_banner;
		$texto = $obj->evento_texto;
		if($obj->evento_horario_inicial == "" && $obj->eventos_horario_final == "")
		{
			$horario = "";
		}else{
			$horario = "Hor&aacute;rio: ".$obj->evento_horario_inicial." às ".$obj->evento_horario_final;
		}
	
	}
	
	while($obj = pg_fetch_object($resArquivo)){
		$arquivos.="<li><a href=\"../../$obj->arq_link\" >$obj->earq_legenda</a></li>";
	}
	$i=0;
	$numImg = pg_num_rows($resImagem);
	while($obj = pg_fetch_object($resImagem)){
		$legenda = $obj->img_legenda;
		$imgPequena = $obj->img_link_v_pequena;
		$imgMedia = $obj->img_link_v_media;
		$imgAlta = $obj->img_link_v_alta;
		$principal = $obj->eimg_principal;
		$legenda2 = strip_tags($obj->eimg_legenda);
		if(!empty($obj->img_autor)){
		$autor = $obj->img_autor;
		}
		
		
		if($principal=='t' or $i==0){
			$achou==true;
			$p="<span id=\"legenda_foto\">foto/divulga&ccedil;&atilde;o: $autor</span><br>
			  <div id=\"imagem_principal\">					
			  <a href=\"../$imgAlta\" rel=\"colorbox-principal\" title=\"$legenda2\" >
				 <img src=\"../$imgMedia\" border=\"0\" width=\"253\" height=\"175\" >
			  </a><br>
			  <div>$legenda2</div></div>
		  
			";
			
		}
		$i++;
		if($numImg>1){
		$galeria.= "<a href=\"../$imgAlta\" rel=\"colorbox-galeria\" title=\"$legenda2 (foto/divulga&ccedil;&atilde;o:$autor)\" >
					<li>
					<img src=\"../$imgPequena\" border=\"0\">
					</li>
					</a>";
		}
	}
	
	while($obj = pg_fetch_object($resMidia)){
		$nomeMidia = $obj->midia_link;
		$legenda = $obj->emidia_legenda;
		$tipo = $obj->midia_tipo;
		if($tipo==0){
			$width="244";					
			$height = "176";
			$player="../../scripts/php/videoPlayer";
			$video ="http://portal.pmf.sc.gov.br/$nomeMidia";				
			$retorno=videoPlayer($video,$width,$height,$player);
			
			$p="				
			  <div id=\"imagem_principal\">$retorno
			  <div>$legenda</div></div>";
			  
		}else{
			$width="253";					
			$height = "24";
			$player="../../scripts/php/audioPlayer";
			$audio ="http://portal.pmf.sc.gov.br/$nomeMidia";				
			$retorno=audioPlayer($audio,$width,$height,$player);
			
			$p="				
			  $retorno
			  <div>$legenda</div>";
		
		}
	
	}
	
	
	while($obj = pg_fetch_object($resNoticia)){
		$tituloNoti = $obj->noti_titulo;
		$idNoticia = $obj->noti_id; 
		$noticias.="<li><a href=\"?pagina=notpagina&noti=$idNoticia\">$tituloNoti</a></li>";
	}
	
 ?>

<div class="centro">
     <div id="caminho_migalhas">not&iacute;cias e eventos</div>
     <div id="titulo_noticia"><?=$titulo?></div>
     <div id="chamada_noticia"><?=$data1?> a <?=$data2?> <br/><?=$horario?></div>
     
     
     <img src='../../<?=$banner?>' border='0' width="510" height="250" ><br><br>
     <div id="conteudo_pagina">
     
    
          <?=$p?>
       
       
       <?php
        if(!empty($noticias)){
       ?> 
       <div id="noticias_relaciondas">
          <h2>notícias relacionadas</h2>
          <ul>
          <?=$noticias?>
          
          </ul>
       </div>          
        <?php
        }
        ?>    
               
               
              
       <p>
       	<?=$texto?>
       </p>
       
<br class="clearfloat">

<?php
if(!empty($arquivos)){
 ?>
<div id="arquivos" class="arquivos-download"><h1>arquivos para download</h1> 
<ul>
<?=$arquivos?>       
</ul></div>     
 <?php
 }
 ?> 


<?php
if(!empty($galeria)){
 ?>

       <div id="galeria"><h1>galeria de imagens</h1>    
      <ul>

<?=$galeria?>
</ul></div>      
        
 <?php
 }
 ?>      
<br class="clearfloat" />
     
          
      </div>
   </div><!-- fim coluna_C2 -->   
   