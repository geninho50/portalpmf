<?php
require_once("../scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes.php");
$drive->conecta();
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Prefeitura de Florianópolis</title>

	<meta name="description" content="Página da Prefeitura Municipal de Florianópolis para dispositivos móveis" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<link rel="apple-touch-icon" href="images/template/engage.png"/>

	<style type="text/css">
		@import url("iphone.css");
	</style>

	<script type="text/javascript" src="orientation.js"></script>
	<script type="text/javascript">
		window.addEventListener("load", function() { setTimeout(loaded, 100) }, false);
	
		function loaded() {
			document.getElementById("page_wrapper").style.visibility = "visible";
			window.scrollTo(0, 1); // pan to the bottom, hides the location bar
		}
	</script>

</head>

<body onorientationchange="updateOrientation();">

	<div id="cabecalho">
		<h1>Prefeitura Municipal de Florinópolis</h1>
	</div>
    

   <div id="pagina">
   
  

     <?php 
				switch ($_GET['pagina']){
					// do valor 10 ao 17 são os includes referentes ao menu Estrutura da Prefeitura
					case "servicos":
					    include "menus/menu_voltar_principal.php";
						include "menus/menu_servicos.php";
						break;
						
					case "servpagina":
						include "menus/menu_voltar_servicos.php";
						include "../servicos/serv_pagina_nova.php";
						break;
						
					case "servonline":
						include "menus/menu_voltar_servicos.php";
						require_once "../servicos/serv_online.php";
						break;
					
					case "servonline2":
						include "menus/menu_voltar_servicos.php";
						require_once "../servicos/serv_online_2.php";
						break;
						
					case "servacessados":
						include "menus/menu_voltar_servicos.php";
						require_once "../servicos/serv_acessados.php";
						break;
						
					case "servalfabetica":
						include "menus/menu_voltar_servicos.php";
						require_once "../servicos/serv_alfabetica.php";
						break;	
						
					case "servbusca":
						include "menus/menu_voltar_servicos.php";
						require_once "../servicos/serv_busca.php";
						break;										
					
					case "servdoc":
						include "menus/menu_voltar_servicos.php";
						require_once "../servicos/serv_doc.php";
						break;
						
					case "onibus":
						include "menus/menu_voltar_principal.php";
						include "../servicos/serv_onibus.php";
						break;	
						
					case "onibuslinha":
						include "menus/menu_voltar_principal.php";
						include "../servicos/serv_onibus_linha.php";
						break;	
						
					case "noticias":
						include "menus/menu_voltar_principal.php";
						include "../noticias/not_ultimas.php";
						break;
					
					case "notultimas":
						include "menus/menu_voltar_principal.php";
						include "../noticias/not_ultimas.php";
						break;
						
					case "notpagina":
						include "menus/menu_voltar_noticias.php";
						include "../noticias/not_pagina.php";
						break;					

					case "calendario":
						include "menus/menu_voltar_principal.php";
						include "../noticias/calendario.php";
						break;
						
					case "gestao":
						include "menus/menu_voltar_principal.php";
						include "../governo/gov_gestao.php";
						break;
						
					case "estrutura":
						include "menus/menu_voltar_principal.php";
						include "../governo/gov_estrutura.php";
						break;	
						
					case "contatos":
						include "menus/menu_voltar_principal.php";
						include "../governo/gov_quem.php";
						break;	
						
					case "govdiariooficial":
						include "menus/menu_voltar_principal.php";
						include "../governo/gov_diario.php";
						break;	
					
					case "editais":
						include "menus/menu_voltar_principal.php";
						include "../governo/gov_editais.php";
						break;	
								
											
											
						
					default:
						include "menus/menu_principal.php";
						break;			   	

							
					
					
					// fim do menu Páginas de Conteúdo						
										
					}
			?>

        </div>
        
        <div id="rodape">
        Copyright &copy; 2009-<?=date("Y")?> Prefeitura de Florianópolis. <br>
        Todos os direitos reservados.<br />
        </div>

   

</body>
</html>
