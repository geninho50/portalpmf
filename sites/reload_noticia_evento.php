<?php
require_once("../scripts/php/funcoes_bd.php");
require_once("../scripts/php/funcoes.php");
$drive->conecta();

$dataAtual   = date("Y/m/d");
$idEntidade  = (int)$_GET['entidade'];

//-----------------------------------------------------------
//busca as notícias de outras entidades que foram importadas 
//-----------------------------------------------------------
$sqlImport 	 = "SELECT * FROM import_noticias WHERE id_import_noticia_id_entidade = $idEntidade";
$return 	 = $drive->pedido($sqlImport);
$complemento = "";
while($comp  = pg_fetch_object($return)){
	$complemento .=" OR noti_id = ".$comp->id_import_noticia_noti_id;	
}

//------------------------------------------------
//busca todas as noticias incluindo as importadas
//------------------------------------------------
$sqlNoticia = "SELECT 
				entidades.entidade_sigla, 
				noticias.noti_id, 
				noticias.noti_titulo, 
				noticias.noti_manchete, 
				noticias.noti_hora, 
				noticias.noti_data
			FROM 
				noticias 
			INNER JOIN 
				entidades 
			ON 	
				noticias.noti_entidade_id = entidades.entidade_id
			WHERE
				noticias.noti_status = 't'
			AND
				noticias.noti_entidade_id = $idEntidade
			AND
				noticias.noti_data <= '$dataAtual'	
			$complemento
			ORDER BY 
				noticias.noti_data 
			DESC,
				noticias.noti_hora
			DESC LIMIT 5";	


$resNoticia	  = $drive->pedido($sqlNoticia);
$drive->close();
$alturaPainel = "auto"; 

//----------------------------------------
//imprime ultimas 4 notícas mais recentes
//----------------------------------------
echo "<ul style=\"height:".$alturaPainel.";overflow:none;\">";
while($obj = pg_fetch_object($resNoticia)){
	
	$V_data = $obj->noti_data;
	$V_date = explode("-", $V_data, 3);
	$V_data_final = $V_date[2]."/".$V_date[1]."/".$V_date[0];

	
	echo "<li>".$V_data_final."&nbsp;-&nbsp;<a href=\"?pagina=notpagina&amp;noti=".$obj->noti_id."\">".$obj->noti_titulo."</a></li>";
}	

echo "<a href=\"index.php?pagina=noticias&menu=0\">";
echo "<img src=\"../../layout/imagens/intra_btn_mais.png\" border=\"0\" alt=\"mais\"></a>";
echo "</ul>";
?>