<?
session_start();
require_once("../scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
$drive->conecta();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Prefeitura de Florianópolis</title>

<link rel="stylesheet" href="../layout/pmf-estilo.css" type="text/css">
<link rel="stylesheet" href="../layout/pmf-estilo-servicos.css" type="text/css">

<script src="../scripts/tabbedpane/TabbedPane.js" type="text/javascript"></script>
<script src="../scripts/calendar/calendar.js" type="text/javascript"></script>

</head>

<body>
<?php include_once("analyticstracking.php") ?>

<div class="layout_servicos">

<?php $menu_principal = "servicos";  ?>
<?php include("../layout/menus/menu_geral.php"); ?>


<div id="conteudo_wrapper">
<div id="conteudo">


   <div id="conteudo_coluna1">
     <div id="menu">
     
     <?php $menu = 0;  ?>
    
     <?php include("../layout/menus/menu_servicos_novo.php"); ?>

     </div><!-- fim menu -->
     
     <br>
  
  
  
   </div><!-- fim conteudo_coluna1 -->
   
   
   
   <div id="conteudo_destaques">
       <?php include("serv_destaques_acessados.php"); ?>  
   </div> <!-- fim coluna_destaque -->      
   
   
   
   <div id="conteudo_coluna2">
 
         <div >
         	<?php 
				switch ($_GET['pagina']){
					case "onibus":
						require_once "serv_onibus.php";
						break;				

					case "onibuslinha":
						include "serv_onibus_linha.php";
						break;
						
					case "servguia":
						require_once "serv_guia.php";
						break;				

					case "servonline":
						require_once "serv_online.php";
						break;
					
					case "servonline2":
						require_once "serv_online_2.php";
						break;
						
					case "servacessados":
						require_once "serv_acessados.php";
						break;
						
					case "servalfabetica":
						require_once "serv_alfabetica.php";
						break;	
						
					case "servbusca":
						require_once "serv_busca.php";
						break;	
						
					case "servpagina":
						require_once "serv_pagina_nova.php";
						break;
					
					case "servpaginanova":
						require_once "serv_pagina_nova.php";
						break;		
											
					
					case "servdoc":
						require_once "serv_doc.php";
						break;	
						
					case "camera":
						require_once "camera_pro.php";
						break;
						
					case "cms":
						require_once "cms.php";
						break;
											
						
					default:
						require_once "serv_guia.php";
						break;			   	

										
					}
						?>
			
          </div>      

   </div><!-- conteudo_coluna2 -->  
   
   
   


<br class="clearfloat">
</div>	<!-- fim do conteudo -->
</div> <!-- fim do conteudo_wrapper -->


<?php include("../layout/rodape/rodape.php"); ?>
<?php require_once("../tracker.php"); ?>
</div><!-- fim layout-home -->

</body>
</html>
