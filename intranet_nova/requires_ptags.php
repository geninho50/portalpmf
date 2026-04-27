<?php
	// ---------- Efeito Ptags ---------- 
	
	if(	$_GET['pagina'] == "imgcad" || $_GET['pagina'] == "imgedit" || $_GET['pagina'] == "imginclui" || //midias->imagens
		$_GET['pagina'] == "arqcad" || $_GET['pagina'] == "arqedit" || $_GET['pagina'] == "arqinclui" || //midias->arquivos
		$_GET['pagina'] == "audcad" || $_GET['pagina'] == "audedit" || $_GET['pagina'] == "audinclui" || //midias->audios
		$_GET['pagina'] == "videcad" || $_GET['pagina'] == "videdit" || $_GET['pagina'] == "vidinclui" || //midias->videos
		$_GET['pagina'] == "avisocad" || $_GET['pagina'] == "avisoedit" || $_GET['pagina'] == "avisoinclui" ||$_GET['pagina'] == "avisoconsulta" ||  //comunic->avisos
		$_GET['pagina'] == "sistcad" || $_GET['pagina'] == "sistedit" || $_GET['pagina'] == "sistinclui" || //sistemas->sistemas
		$_GET['pagina'] == "pagconsulta" || $_GET['pagina'] == "paginclui" || $_GET['pagina'] == "pagedit" || //cosnteudo->pagina_inclui
		$_GET['pagina'] == "sistconsulta" ||// sistemas->favoritos
		$_GET['pagina'] == "midias" || //midias->consulta
		$_GET['pagina'] == "incluinot" || $_GET['pagina'] == "edtnot" //notícias
		){
		
		echo('
		<link href="../scripts/js/ptags/jquery.ptags.css" rel="stylesheet" type="text/css" />		
		<script type="text/javascript" src="../scripts/js/ptags/jquery.ptags.js"></script>
		<link href="../scripts/js/ptags/jquery.ptags.default.css" rel="stylesheet" type="text/css" />		
		<script type="text/javascript">
			$(document).ready(function(){
				$("#Ftags").ptags();
			});
		</script>
		');
	}
	
	// ---------- Fim Efeito Ptags ----------
?>