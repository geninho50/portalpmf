<?php
$Tcaminho 	= "inicio.php?pagina=submenuedit&idsubmenu=".$_GET['idsubmenu']."&menu=".$_GET['menu']."";
$assId 		= $_GET['assid'];
$sqlDeleta  = "DELETE FROM intranet_menu_relacionado WHERE intranet_menu_rel_id = $assId";
$rSqlDeleta = $drive->pedido($sqlDeleta);

if($rSqlDeleta){
	echo"<script>alert(\"Excluido com Sucesso!\");</script>";
	echo("<script>window.location = \"".$Tcaminho."\";</script>");
}else{
	echo"<script>alert(\"Nao foi possivel excluir!\");</script>";
	echo("<script>window.location = \"".$Tcaminho."\";</script>");
}
?>