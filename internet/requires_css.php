<?php
//-----------------------------------------------------
// Define as paginas que utilizam algum recurso em CSS	
//-----------------------------------------------------

if(isset($_GET['pagina']) && !empty($_GET['pagina'])){	
	//--------------------------
	// Modulo CALENDÁRIO JQUERY
	//--------------------------
	if(	$_GET['pagina'] == "imgcad" ||  
		$_GET['pagina'] == "arqcad" ||  
		$_GET['pagina'] == "audcad" ||  
		$_GET['pagina'] == "videcad" || 
		$_GET['pagina'] == "avisocad" || $_GET['pagina'] == "avisoinclui" || $_GET['pagina'] == "avisoedit" || $_GET['pagina'] == "avisoconsulta" ||
		$_GET['pagina'] == "pagconsulta" || $_GET['pagina'] == "paginclui" || $_GET['pagina'] == "pagedit" || $_GET['pagina'] == "pagcad" || 
		$_GET['pagina'] == "sistconsulta" ||
		$_GET['pagina'] == "midias" || 
		$_GET['pagina'] == "intracalinclui" || $_GET['pagina'] == "intracalcad" || $_GET['pagina'] == "caledit" || 
		$_GET['pagina'] == "mailenvionot" || $_GET['pagina'] == "mailhistind" || $_GET['pagina'] ==  "mailhistgeral" ||
		$_GET['pagina'] == "comcapLct" ||
		$_GET['pagina'] == "diariocoluna" || $_GET['pagina'] == "editalcad" || $_GET['pagina'] == "editalinclui" ||
		$_GET['pagina'] == "pimg" || $_GET['pagina'] == "pmidia" ||
		$_GET['pagina'] == "calinclui" || $_GET['pagina'] == "calcad" || $_GET['pagina'] == "editcal" ||
		$_GET['pagina'] == "addnot" || $_GET['pagina'] == "notedit" || $_GET['pagina'] == "nimg" || $_GET['pagina'] == "nmidia"  || $_GET['pagina'] == "noticons" ||
		$_GET['pagina'] == "eventinclui" || $_GET['pagina'] == "evedit" || $_GET['pagina'] == "eventcons" ||
		$_GET['pagina'] == "eimg" || $_GET['pagina'] == "emidia"){ 	
			echo('
			<link rel="stylesheet" type="text/css" href="../scripts/js/calendario/src/css/jscal2.css" />
			<link rel="stylesheet" type="text/css" href="../scripts/js/calendario/src/css/border-radius.css" />
			<link rel="stylesheet" type="text/css" href="../scripts/js/calendario/src/calendario/css/gold/gold.css" />');
	}
}
?>