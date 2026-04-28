<?php
$TidNoticia = $_GET['noti'];
require_once("../../../scripts/php/funcoes_bd.php");
require_once("../../../scripts/php/funcoes.php");
$drive->conecta();

//----------------------------------------------------------------
// Recupera do banco de dados as informações referentes a notícia
//----------------------------------------------------------------
$sqlNoticia 	= "SELECT NOTI.*,EDIT.* FROM noticias AS NOTI JOIN editorias AS EDIT ON NOTI.noti_edit_id = EDIT.edit_id WHERE NOTI.noti_id=$TidNoticia"; 
$sqlImagens 	= "SELECT IMG.*, NIMG.* FROM imagens AS IMG	JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.nimg_img_id 	WHERE NIMG.nimg_noti_id = $TidNoticia";
$sqlArquivos 	= "SELECT ARQ.*,NARQ.* FROM arquivos AS ARQ JOIN noticias_arquivos AS NARQ ON ARQ.arq_id = NARQ.narq_arq_id	WHERE NARQ.narq_noti_id = $TidNoticia ORDER BY ARQ.arq_id ASC";					
$sqlMidia 		= "SELECT MID.*, NMID.* FROM midia AS MID JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id WHERE NMID.nmidia_noti_id = $TidNoticia";		
$TreturnNoticia = $drive->pedido($sqlNoticia);
$TreturnImagem  = $drive->pedido($sqlImagens);
$TreturnArquivo = $drive->pedido($sqlArquivos);
$TreturnMidia 	= $drive->pedido($sqlMidia);

//-----------------------------------------
// Monta a estrutura da galeria de imagens
//-----------------------------------------
$Tgaleria = "";
while($Timagem = pg_fetch_object($TreturnImagem)){

	//-----------------------------------------------------------
	// Verifica se existe alguma imagem principal para a noticia
	//-----------------------------------------------------------	
	if($Timagem->nimg_principal == 't'){
		$Tprincipal  = $Timagem->img_link_v_media;
		$TlenImgPrin = $Timagem->nimg_legenda;
	}else{
		$Tgaleria .= "<li>
						 <img src=\"../../../".$Timagem->img_link_v_pequena."\" border=\"0\">
					 </li>";
	}			
}

//----------------------------------------
// Monta a estrutura da lista de arquivos
//----------------------------------------
$Tarquivos = "";
while($Tarquivo = pg_fetch_object($TreturnArquivo)){
	$Tarquivos .= "<li>
						<h1>".$Tarquivo->arq_nome."</h1>".$Tarquivo->narq_legenda."</a>
	     		  </li>";
}

//----------------------------------------------------------------------
// Se existir alguma midia ela será colocado no lugar da foto principal
//----------------------------------------------------------------------
while($$Tmidia = pg_fetch_object($TreturnMidia)){
		if($Tmidia->midia_tipo == 0){
			$width="253";					
			$height = "175";
			$player="../../../scripts/php/videoPlayer";
			$video ="http://portal.pmf.sc.gov.br/".$Tmidia->midia_link;				
			$retorno=videoPlayer($video,$width,$height,$player);
		}else{
			$width="253";					
			$height = "24";
			$player="../../../scripts/php/audioPlayer";
			$audio ="http://portal.pmf.sc.gov.br/".$Tmidia->midia_link;	
			$retorno=audioPlayer($audio,$width,$height,$player);
		
		}
		
		$Tprincipal = $retorno."<br>
			  <div>".$Tmidia->nmidia_legenda."</div>";
	}

//---------------------------
// recupera dados da notícia
//---------------------------
while($Tnoticia = pg_fetch_object($TreturnNoticia) ){		
	$Teditoria 	= $Tnoticia->edit_nome;		
	$Ttexto 	= $Tnoticia->noti_texto;
	$Ttitulo 	= $Tnoticia->noti_titulo;
	$Tmanchete 	= $Tnoticia->noti_manchete;
	$Tdata 		= transformaData($Tnoticia->noti_data);				
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Prefeitura Municipal de Florianópolis</title>
<link rel="stylesheet" href="../../../layout/prefeitura.css" type="text/css">
<link rel="stylesheet" href="../../../layout/prefeitura_noticias.css" type="text/css">
</head>
<body style="background-image:none; background-color:#fff;">
<div class="layout_noticias_novo" style="width:532px;background-image:none;background-color:#fff;">
	<div >
		<div style="width:532px">
			<div id="caminho_migalhas"><?=$Tdata?> - <?=$Teditoria?></div>
			<div id="titulo_noticia"><?=$Ttitulo?></div>
			<div id="chamada_noticia"><?=$Tmanchete?></div>
			<div id="conteudo_pagina">        
				<?php
                if($Tprincipal != ""){
				?>
                	<div id="imagem_principal">                    
                    	<img src="../../../<?=$Tprincipal?>" border="0" width="253" height="175" />
                 		<br />
						<div><?=$TlenImgPrin?></div>
					</div>  
				<?php
				}
				?>
                <p>
					<?=$Ttexto?>
                </p>
				<?php 
				if($Tgaleria != ""){
				 	echo " <div id=\"galeria\"> 
				 			<h1>galeria de imagens</h1>   
							<ul>
								".$Tgaleria."
							</ul>
						</div>";
				}
				if($Tarquivos != ""){
					echo" 	<div id=\"arquivos\">
								<h1>arquivos para download</h1>
								<ul>
								</ul>
							</div>";
				} 
				?>
				<br class="clearfloat" />
			<br /><br />
			</div>
		</div>
	</div>
</div>
</body>
</html> 