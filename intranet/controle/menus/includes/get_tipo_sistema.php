<?php
//----------------------------------------------------------------------------------------------------------------------------------------
// $get_sistema  	= refere-se a qual sistema o gestor de menus. (intranet o internet) usado também para puxar os menus referentes a ele 
//					  (números ficam confusos quando chega o momento de dar manutenção direta na base)
// $nome_sistema 	= String para dar o título a página
// $select_intranet = armazena se o menu intranet permanecerá selecionado
// $select_internet	= armazena se o menu internet permenecerá selecionado
//----------------------------------------------------------------------------------------------------------------------------------------
$get_sistema = $_GET['sistema'];
switch($get_sistema){
	case 'intranet' :
		$nome_sistema	 = "Intranet PMF"; 
		$select_intranet = "selected = \"selected\"";
		$select_internet = "";
	break;	
	case 'internet' :
		$nome_sistema	 = "ADM DA INTERNET"; 
		$select_intranet = "";
		$select_internet = "selected = \"selected\"";
	break;	
	default :
	
		$get_sistema 	 = 'intranet';
		$nome_sistema	 = "Intranet PMF"; 
		$select_intranet = "selected = \"selected\"";
		$select_internet = "";
	break;
}
?>