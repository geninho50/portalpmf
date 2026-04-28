<?php
	
if(isset($_GET['pagina']) && !empty($_GET['pagina']))
{

	// ---------- Efeito Calendário ---------- 
	
	if(	$_GET['pagina'] == "imgcad" ||  //midias->imagens
		$_GET['pagina'] == "arqcad" ||  //midias->arquivos
		$_GET['pagina'] == "audcad" ||  //midias->audios
		$_GET['pagina'] == "videcad" ||  //midias->videos
		$_GET['pagina'] == "avisocad" || $_GET['pagina'] == "avisoinclui" || $_GET['pagina'] == "avisoedit" || $_GET['pagina'] == "avisoconsulta" ||//comunic->avisos
		$_GET['pagina'] == "pagconsulta" || $_GET['pagina'] == "paginclui" || $_GET['pagina'] == "pagedit" || $_GET['pagina'] == "pagcad" || //cosnteudo->pagina_inclui
		$_GET['pagina'] == "sistconsulta" ||// sistemas->favoritos
		$_GET['pagina'] == "midias" || //midias->consulta
		$_GET['pagina'] == "intracalinclui" || $_GET['pagina'] == "intracalcad" || $_GET['pagina'] == "caledit" || //calendario->inclui
		$_GET['pagina'] == "mailenvionot" || $_GET['pagina'] == "mailhistind" || $_GET['pagina'] ==  "mailhistgeral" || //maling->envio
		$_GET['pagina'] == "incluinot" || $_GET['pagina'] == "cadnot" || $_GET['pagina'] == "edtnot" || $_GET['pagina'] == "radinclui" //notícias->inclui
		){ 
	
		echo('
		<link rel="stylesheet" type="text/css" href="../scripts/js/calendario/src/css/jscal2.css" />
		<link rel="stylesheet" type="text/css" href="../scripts/js/calendario/src/css/border-radius.css" />
		<link rel="stylesheet" type="text/css" href="../scripts/js/calendario/src/calendario/css/gold/gold.css" />
		');
	}
	
	// ---------- Fim Efeito Calendário ---------- 

	
}
	
	
?>