<?php
//------------------------------------------------------
// Define as paginas que utilizam algum recurso em Java	
//------------------------------------------------------
	
if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
	//------------------	
	// Carrega a JQUERY
	//------------------
	/*if( $_GET['pagina'] == "imgcad" || $_GET['pagina'] == "imgedit" || $_GET['pagina'] == "imginclui" || 
		$_GET['pagina'] == "arqcad" || $_GET['pagina'] == "arqedit" || $_GET['pagina'] == "arqinclui" || 
		$_GET['pagina'] == "audcad" || $_GET['pagina'] == "audedit" || $_GET['pagina'] == "audinclui" || 
		$_GET['pagina'] == "videcad" || $_GET['pagina'] == "videdit" || $_GET['pagina'] == "vidinclui" || 
		$_GET['pagina'] == "sistcad" || $_GET['pagina'] == "sistedit" || $_GET['pagina'] == "sistinclui" || 
		$_GET['pagina'] == "avisocad" || $_GET['pagina'] == "avisoedit" || $_GET['pagina'] == "avisoinclui" || $_GET['pagina'] == "avisoconsulta" || 
		$_GET['pagina'] == "perfiledit" || $_GET['pagina'] == "perfilinclui" || 
		$_GET['pagina'] == "pagconsulta" || $_GET['pagina'] == "paginclui" || $_GET['pagina'] == "pagedit" || $_GET['pagina'] == "pagcad" || 
		$_GET['pagina'] == "sistconsulta" ||
		$_GET['pagina'] == "midias" || 
		$_GET['pagina'] == "userdados" || 
		$_GET['pagina'] == "mailenvionot" || $_GET['pagina'] == "mailhistind"){ 
			echo('<script src="../scripts/js/jquery/jquery.js" type="text/javascript"></script>');
	}
	*/
	//-------------------
	// Script CALENDÁRIO
	//-------------------
	if(	$_GET['pagina'] == "imgcad" || 
		$_GET['pagina'] == "arqcad" || 
		$_GET['pagina'] == "audcad" || 
		$_GET['pagina'] == "avisocad" || $_GET['pagina'] == "avisoinclui" || $_GET['pagina'] == "avisoedit" || $_GET['pagina'] == "avisoconsulta" || 
		$_GET['pagina'] == "videcad" || 
		$_GET['pagina'] == "pagconsulta" || $_GET['pagina'] == "paginclui" || $_GET['pagina'] == "pagedit" || $_GET['pagina'] == "pagcad" || 
		$_GET['pagina'] == "sistconsulta" ||
		$_GET['pagina'] == "midias" || 
		$_GET['pagina'] == "intracalinclui" || $_GET['pagina'] == "intracalcad" || $_GET['pagina'] == "caledit" || 
		$_GET['pagina'] == "mailenvionot" || $_GET['pagina'] == "mailhistind" || $_GET['pagina'] ==  "mailhistgeral"||
		$_GET['pagina'] == "comcapLct" ||
		$_GET['pagina'] == "diariocoluna" || $_GET['pagina'] == "editalcad" || $_GET['pagina'] == "editalinclui" ||
		$_GET['pagina'] == "pimg" || $_GET['pagina'] == "pmidia"||
		$_GET['pagina'] == "calinclui" || $_GET['pagina'] == "calcad" || $_GET['pagina'] == "editcal" ||
		$_GET['pagina'] == "addnot" || $_GET['pagina'] == "notedit" || $_GET['pagina'] == "nimg" || $_GET['pagina'] == "nmidia" || $_GET['pagina'] == "noticons" ||
		$_GET['pagina'] == "eventinclui" || $_GET['pagina'] == "evedit" || $_GET['pagina'] == "eventcons" ||
		$_GET['pagina'] == "eimg" || $_GET['pagina'] == "emidia"){		
			echo('
			<script type="text/javascript" src="../scripts/js/calendario/src/js/jscal2.js"></script>
			<script type="text/javascript" src="../scripts/js/calendario/src/js/lang/pt.js"></script>');
	}
		
	//--------------------------------------
	// Script COMBO DINAMICO Setores/Cargos 
	//--------------------------------------
	if($_GET['pagina'] == "userdados"){
		echo('<script type="text/javascript" src="controle/usuarios/script_setores.js"></script>');
	}
}	
?>