<?php
	
if(isset($_GET['pagina']) && !empty($_GET['pagina']))
{
	
	// ---------- Carrega Jquery ----------
	
	if( $_GET['pagina'] == "imgcad" || $_GET['pagina'] == "imgedit" || $_GET['pagina'] == "imginclui" || //midias->imagens
		$_GET['pagina'] == "arqcad" || $_GET['pagina'] == "arqedit" || $_GET['pagina'] == "arqinclui" || //midias->arquivos
		$_GET['pagina'] == "audcad" || $_GET['pagina'] == "audedit" || $_GET['pagina'] == "audinclui" || //midias->audios
		$_GET['pagina'] == "videcad" || $_GET['pagina'] == "videdit" || $_GET['pagina'] == "vidinclui" || //midias->videos
		$_GET['pagina'] == "sistcad" || $_GET['pagina'] == "sistedit" || $_GET['pagina'] == "sistinclui" || //sistemas->sistemas
		$_GET['pagina'] == "avisocad" || $_GET['pagina'] == "avisoedit" || $_GET['pagina'] == "avisoinclui" || $_GET['pagina'] == "avisoconsulta" || //comunic->avisos
		$_GET['pagina'] == "perfiledit" || $_GET['pagina'] == "perfilinclui" || //controle->perfis
		$_GET['pagina'] == "pagconsulta" || $_GET['pagina'] == "paginclui" || $_GET['pagina'] == "pagedit" || $_GET['pagina'] == "pagcad" || //cosnteudo->pagina_inclui
		$_GET['pagina'] == "sistconsulta" ||// sistemas->favoritos
		$_GET['pagina'] == "midias" || //midias->consulta
		$_GET['pagina'] == "userdados" || //controle/usuarios
		$_GET['pagina'] == "mailenvionot" || $_GET['pagina'] == "mailhistind" ||//maling->envio
		$_GET['pagina'] == "incluinot" || $_GET['pagina'] == "cadnot" || $_GET['pagina'] == "edtnot"  //notícias->inclui
		){ 
		
		echo('
		 <script src="../scripts/js/jquery/jquery.js" type="text/javascript"></script>
		 ');
	}
	
	// ---------- Fim Carrega Jquery ----------
	
	// ---------- Efeito Calendário ---------- 
	
	if(	$_GET['pagina'] == "imgcad" || //midias->imagens
		$_GET['pagina'] == "arqcad" || //midias->arquivos
		$_GET['pagina'] == "audcad" || //midias->audios
		$_GET['pagina'] == "avisocad" || $_GET['pagina'] == "avisoinclui" || $_GET['pagina'] == "avisoedit" || $_GET['pagina'] == "avisoconsulta" || //comunic->avisos
		$_GET['pagina'] == "videcad" ||  //midias->videos	
		$_GET['pagina'] == "pagconsulta" || $_GET['pagina'] == "paginclui" || $_GET['pagina'] == "pagedit" || $_GET['pagina'] == "pagcad" || //cosnteudo->pagina_inclui	 
		$_GET['pagina'] == "sistconsulta" ||// sistemas->favoritos
		$_GET['pagina'] == "midias" || //midias->consulta
		$_GET['pagina'] == "intracalinclui" || $_GET['pagina'] == "intracalcad" || $_GET['pagina'] == "caledit" || //calendario->inclui
		$_GET['pagina'] == "mailenvionot" || $_GET['pagina'] == "mailhistind" || $_GET['pagina'] ==  "mailhistgeral" ||//maling->envio
		$_GET['pagina'] == "incluinot" || $_GET['pagina'] == "cadnot" || $_GET['pagina'] == "edtnot" || $_GET['pagina'] == "radinclui" //notícias->inclui
		){
	
		echo('
		<script type="text/javascript" src="../scripts/js/calendario/src/js/jscal2.js"></script>
		<script type="text/javascript" src="../scripts/js/calendario/src/js/lang/pt.js"></script>
		');
	}
	
	// ---------- Fim Efeito Calendário ----------
	
	// ---------- Combo dinamico setores ---------- 
	
	if($_GET['pagina'] == "userdados"){
		echo('
		<script type="text/javascript" src="controle/usuarios/script_setores.js"></script>
		');
	}
	// ---------- Fim Combo dinamico setores ---------- 
	
	// ------------- Imagens ON e OFF do sistema de permissão de menus ------------------//
	if($_GET['pagina'] == "perfiledit" || $_GET['pagina'] == "perfilinclui" || $_GET['pagina'] == "mailenvionot")
	{
		if($_GET['pagina'] == "perfiledit" || $_GET['pagina'] == "perfilinclui" || $_GET['pagina'] == "mailenvionot")
		{
			echo
			("
		    <script language=\"javascript\">
				$(document).ready(function()
				{
					$(\"input:checkbox\").each( function(){
						if(this.checked)
						{
							$(\"#FC\"+this.id).addClass('fakechecked');
						}
						else
						{
							$(\"#FC\"+this.id).removeClass('fakechecked');	
						}
					});
					
					$(\".fakecheck\").click(function()
					{
						($(this).hasClass('fakechecked')) ? $(this).removeClass('fakechecked') : $(this).addClass('fakechecked');
						$(this.hash).trigger(\"click\");
						return false;
					});
				});
			</script> 
			");
		}
	}
	//----------Fim imagens radio -------------//
}	
?>