<?php
//------------------------------------------
// Página implementada em : 31/05/2010
// por: Rodrigo Rigoni
// E-mail: rigoni_chz@hotmail.com
//------------------------------------------
?>

<script type="text/javascript">
function verificaExclusao(){
	if(confirm('Tem certeza que deseja Excluir a Imagem?')){
		return true;
	}else{
		return false;
	}
}

function verificaRemocao(){
	if(confirm('Tem certeza que deseja Remover a Imagem?')){
		return true;
	}else{
		return false;
	}
}
</script>
<?php

$TidPag		= $_GET['idPag'];
				
$sqlImg  	=  "SELECT IMG.*,PIMG.* FROM imagens AS IMG
				JOIN intranet_pagina_imagens AS PIMG ON IMG.img_id = PIMG.intranet_imgpagina_img_id
				WHERE PIMG.intranet_imgpagina_pag_id = $TidPag 
				ORDER BY PIMG.intranet_imgpagina_id DESC";

$Treturn 	= $drive->pedido($sqlImg);
$TreturbNum	= $drive->pedido($sqlImg);
$Tnum		= pg_num_rows($TreturbNum);

echo"
<h1>Imagens incluídas na Página: ".$Tnum."</h1>
<div id=\"pagePequenaAba\">
    <div id=\"imagesPequenaAba\">
        <ul class=\"galleryPequenaAba\">";
            while($Timg = pg_fetch_object($Treturn)){
			echo"
			<form method=\"post\">
			<input type=\"hidden\" name=\"FidImg\" value=\"".$Timg->img_id."\" />
			<input type=\"hidden\" name=\"FidImgPag\" value=\"".$Timg->intranet_imgpagina_id."\" />
			<li>
                <a href=\"".$Timg->img_link_v_alta."\" rel=\"lightbox\" title=\"".$Timg->img_legenda."\">
                    <img src=\"".$Timg->img_link_v_pequena."\" border=\"0\" align=\"left\" class=\"galleryPequenaBotao_img\">
                </a><br>
                <br><center>
				<a href=\"?pagina=pagedit&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=imagens&sb=galeria&id=".$Timg->img_id."\">
                	<img src=\"../layout/imagens/atualiza_btn_editar.png\" alt=\"editar\" width=\"50\" height=\"18\" border=\"0\" align=\"absmiddle\" />
                </a>
				<input type=\"image\" src=\"../layout/imagens/atualiza_btn_excluir.png\" name=\"btExcluir\" id=\"btExcluir\" value=\"btExcluir\"  align=\"absmiddle\" onclick=\"return verificaExclusao()\" />
				<div style=\"padding-top:4px;\"></div>
				<input type=\"image\" src=\"../layout/imagens/atualiza_btn_remover_intranet.png\" name=\"btRemove\" id=\"btRemove\" value=\"btRemove\"  align=\"absmiddle\"  onclick=\"return verificaRemocao()\" />
                </center>
            </li>
			</form>";
			}
		echo"	
        </ul>
    </div>
</div>
<br class=\"clearfloat\">";

if (isset($_POST['btRemove_x'])){
//-------------------------
// remove imagem da página
//-------------------------

	$TidImg  = $_POST['FidImgPag'];
	
	$sqlRemove = "DELETE FROM intranet_pagina_imagens WHERE intranet_imgpagina_id = $TidImg";

	$Tresult   = $drive->pedido($sqlRemove);
	
	if($Tresult){
		echo("<script>alert('Imagem Removida com Sucesso!')</script>");
		echo("<script>window.location = \"inicio.php?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=".$_GET['aba']."&sb=".$_GET['sb']."\"</script>");
	}else{	
		echo("<script>alert('Não Foi Possível Remover a Imagem!\\n\\nErro no Servidor, tente novamente mais tarde')</script>");		
	}

}

if (isset($_POST['btExcluir_x'])){
//-------------------------
// Exclui a imagem
//-------------------------
	$TidImgPag  = $_POST['FidImgPag'];
	$TpagId	 	= $_GET['idPag'];
	$TidImg  	= $_POST['FidImg'];
	$Tvalida 	= 0;
	//------------------------------------------------------------
	// verifica se a imagem esta sendo utilizada em alguma página
	//------------------------------------------------------------	
	$sqlImg		= "SELECT IMG.*,PIMG.* FROM imagens AS IMG
				  JOIN intranet_pagina_imagens AS PIMG ON IMG.img_id = PIMG.intranet_imgpagina_img_id
				  WHERE IMG.img_id = $TidImg AND PIMG.intranet_imgpagina_pag_id <> $TpagId";	
	$Treturn	= $drive->pedido($sqlImg);
	$TverImg	= pg_fetch_object($Treturn);
	
	if($TverImg != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR a Imagem!\\n\\nEsta Imagem está sendo utilizada em outra Página.\");</script>";
	}
	
	//------------------------------------------------------------
	// verifica se a imagem esta sendo utilizada em alguma notícia
	//------------------------------------------------------------
	$sqlNot		= "SELECT IMG.*,NIMG.* FROM imagens AS IMG
				  JOIN noticias_imagens AS NIMG ON IMG.img_id = NIMG.ning_img_id
				  WHERE IMG.img_id = $TidImg";	
	$Treturn	= $drive->pedido($sqlNot);
	$TverNot	= pg_fetch_object($Treturn);
	
	if($TverNot != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR a Imagem!\\n\\nEsta Imagem está sendo utilizada em uma Notícia.\");</script>";
	}
	
	//------------------------------------------------------------
	// verifica se a imagem esta sendo utilizada em algum evento
	//------------------------------------------------------------
	$sqlEve		= "SELECT IMG.*,EIMG.* FROM imagens AS IMG
				  JOIN eventos_imagens AS EIMG ON IMG.img_id = EIMG.eimg_img_id
				  WHERE IMG.img_id = $TidImg";	
	$Treturn	= $drive->pedido($sqlEve);
	$TverEve	= pg_fetch_object($Treturn);
	
	if($TverEve != false){
		$Tvalida = 1;
		echo"<script>alert(\"Não foi possível EXCLUIR a Imagem!\\n\\nEsta Imagem está sendo utilizada em um Evento.\");</script>";
	}
	
	//-------------------------------------------------------------------------------
	// Se a imagem não estiver associada a nenhum outro registro - apaga os arquivos
	//-------------------------------------------------------------------------------
	if($Tvalida == 0){
		
		$sqlLoc 	= "SELECT * FROM imagens WHERE img_id = $TidImg ";
		$Tresult   = $drive->pedido($sqlLoc);
		$TobjImg 	= pg_fetch_object($Tresult);
					
		$sqlExc 	= "DELETE FROM imagens WHERE img_id = $TidImg ";
		$Tresult 	= $drive->pedido($sqlExc);
		
		$sqlRemove = "DELETE FROM intranet_pagina_imagens WHERE intranet_imgpagina_id = $TidImg";
		$TresultRe = $drive->pedido($sqlRemove);
	
		if($Tresult){
			
			@unlink($TobjImg->img_link_v_alta);
			@unlink($TobjImg->img_link_v_media);
			@unlink($TobjImg->img_link_v_preview);
			@unlink($TobjImg->img_link_v_pequena);

			echo("<script>alert('Imagem Excluida com Sucesso!')</script>");
			echo("<script>window.location = \"inicio.php?pagina=".$_GET['pagina']."&menu=".$_GET['menu']."&idPag=".$_GET['idPag']."&aba=".$_GET['aba']."&sb=".$_GET['sb']."\"</script>");
		}else{	
			echo("<script>alert('Não Foi Possível Excluir a Imagem!\\n\\nErro no Servidor, tente novamente mais tarde')</script>");
		}
	}
}
?>