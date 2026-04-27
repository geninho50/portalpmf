<?php
//------------------------------------------
// Página implementada em : 31/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>
<script type="text/javascript">
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir o Vídeo?')){
		return true;
	}else{
		return false;
	}
}

function verificaRemocao(){
	if(confirm('Tem certeza que deseja Remover o Vídeo?')){
		return true;
	}else{
		return false;
	}
}
</script>
<?php

$TidPag		= $_GET['idPag'];				
$sqlMid  	=  "SELECT MID.*,PMID.* FROM midia AS MID
				JOIN intranet_pagina_midias AS PMID ON MID.midia_id = PMID.intranet_midpagina_mid_id
				WHERE PMID.intranet_midpagina_pag_id = $TidPag AND PMID.intranet_midpagina_tipo = 0
				ORDER BY PMID.intranet_midpagina_id DESC";

$Treturn 	= $drive->pedido($sqlMid);
$TreturbNum	= $drive->pedido($sqlMid);
$Tnum		= pg_num_rows($TreturbNum);

echo "<h1>Vídeos incluídos na Página: ".$Tnum."</h1>
<div id=\"pagePequenaBotaoVideo\">
	<div id=\"imagesPequenaBotaoVideo\">
		<ul class=\"galleryPequenaBotaoVideo\">";
	
require_once("../scripts/php/funcoes.php");

while($Taud = pg_fetch_object($Treturn)){

			//-------------------------
			// Carrega Player de Vídeo 
			//-------------------------
			$width="172";					
			$height = "129";
			$player="../scripts/php/videoPlayer";
			$video ="http://portal.pmf.sc.gov.br/".$Taud->midia_link;				
			$retorno=videoPlayer($video,$width,$height,$player);

			echo"
			<form method=\"post\">
			<input type=\"hidden\" name=\"FidMid\" value=\"".$Taud->midia_id."\" />
			<input type=\"hidden\" name=\"FidMidPag\" value=\"".$Taud->intranet_midpagina_id."\" />
			<li>
            	".$retorno."<div style=\"padding-top:2px;\"></div>
            	<center>
					<a href=\"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=videos&sb=galeria&id=".$Taud->midia_id."\">
						<img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" />
                	</a>
					<input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
					<input type=\"image\" src=\"../layout/imagens/atualiza_btn_remover_54px.png\" name=\"btRemove\" id=\"btRemove\" value=\"btRemove\"  align=\"absmiddle\" onclick=\"return verificaRemocao()\" />
                </center>
            </li>
			</form>";	
}

echo "
		</ul>
    </div>
</div>
<br class=\"clearfloat\">";

//----------------------------
// Remove o vídeo da página
//----------------------------

if(isset($_POST['btRemove_x'])){
	$TidMid  	= $_POST['FidMidPag'];
	$sqlRemove	= "DELETE FROM intranet_pagina_midias WHERE intranet_midpagina_id = $TidMid";
	$Tresult	= $drive->pedido($sqlRemove);
	if($Tresult){	
		echo("<script>alert('Vídeo Removido com Sucesso!')</script>");
		echo("<script>window.location = \"inicio.php?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=".$_GET['aba']."&sb=".$_GET['sb']."\"</script>");
	}else{	
		echo("<script>alert('Não Foi Possível Remover o Vídeo!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
	}	
}

//----------------------------
// Exclusão do vídeo
//----------------------------

if(isset($_POST['btExcluir_x'])){

	$TidMidPag	= $_POST['FidMidPag'];
	$TpagId	 	= $_GET['idPag'];	
	$TidMid 	= $_POST['FidMid'];
	$Tvalida	= 0;
	//------------------------------------------------------------
	// verifica se o video esta sendo utilizado em alguma página
	//------------------------------------------------------------	
	$sqlMid		= "SELECT MID.*,PMID.* FROM midia AS MID
				  JOIN intranet_pagina_midias AS PMID ON MID.midia_id = PMID.intranet_midpagina_mid_id
				  WHERE MID.midia_id = $TidMid AND PMID.intranet_midpagina_pag_id <> $TpagId";	
	$Treturn	= $drive->pedido($sqlMid);
	$TverMid	= pg_fetch_object($Treturn);
	
	if($TverMid != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Vídeo!\\n\\nEste Vídeo está sendo utilizado em outra Página.\");</script>";
	}

	//------------------------------------------------------------
	// verifica se o video esta sendo utilizado em alguma notícia
	//------------------------------------------------------------
	$sqlNot		= "SELECT MID.*,NMID.* FROM midia AS MID
				  JOIN noticias_midia AS NMID ON MID.midia_id = NMID.nmidia_midia_id
				  WHERE MID.midia_id = $TidMid";	
	$Treturn	= $drive->pedido($sqlNot);
	$TverNot	= pg_fetch_object($Treturn);
	
	if($TverNot != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Vídeo!\\n\\nEste Vídeo está sendo utilizado em uma Notícia.\");</script>";
	}
	
	//------------------------------------------------------------
	// verifica se o vídeo esta sendo utilizado em algum evento
	//------------------------------------------------------------
	$sqlEve		= "SELECT MID.*,EMID.* FROM imagens AS MID
				  JOIN eventos_midia AS EMID ON MID.midia_id = EMID.emidia_midia_id
				  WHERE MID.midia_id = $TidMid";	
	$Treturn	= $drive->pedido($sqlEve);
	$TverEve	= pg_fetch_object($Treturn);
	
	if($TverEve != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR o Vídeo!\\n\\nEste Vídeo está sendo utilizado em um Evento.\");</script>";
	}
	
	//-------------------------------------------------------------------------------
	// Se o vídeo não estiver associado a nenhum outro registro - apaga o arquivo
	//-------------------------------------------------------------------------------
	if($Tvalida == 0){
		
		$sqlLoc 	= "SELECT * FROM midia WHERE midia_id = $TidMid ";
		$Tresult   = $drive->pedido($sqlLoc);
		$TobjMid 	= pg_fetch_object($Tresult);
					
		$sqlExc 	= "DELETE FROM midia WHERE midia_id = $TidMid ";
		$Tresult 	= $drive->pedido($sqlExc);
	
		$sqlRemove 	= "DELETE FROM intranet_pagina_midias WHERE intranet_midpagina_id = $TidMid";
		$TresultRe	= $drive->pedido($sqlRemove);
		
		if($Tresult){
			
			@unlink("../".$TobjMid->midia_link);

			echo("<script>alert('Vídeo Excluido com Sucesso!')</script>");
			echo("<script>window.location = \"inicio.php?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=".$_GET['aba']."&sb=".$_GET['sb']."\"</script>");
		}else{	
			echo("<script>alert('Não Foi Possível Excluir o Vídeo!\\n\\nErro no Servidor, tente novamente mais tarde.')</script>");
		}
	}
}
?> 

