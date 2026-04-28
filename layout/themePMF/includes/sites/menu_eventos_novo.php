<script type="text/javascript">
<?php

if( !isset( $class_primeiro )){
    $class_primeiro = '';
}

// Consulta para obter o numero total de menus e depois configurar a visualiza�ao

$sqlMenusPersonalizados  = "SELECT * FROM cms_menu  WHERE cmsmenu_entidade_id = $IdEntidade  AND cmsmenu_status = 0";
$rsqlMenusPersonalizados = $drive->pedido($sqlMenusPersonalizados);

$MenusPersonalizados = pg_num_rows($rsqlMenusPersonalizados);

$sqlQtdSubMenu  = "SELECT * FROM cms_menu  WHERE cmsmenu_entidade_id = $IdEntidade  AND cmsmenu_tipo_menu = 1 AND cmsmenu_status = 0";
$rsqlQtdSubMenu = $drive->pedido($sqlQtdSubMenu);

$submenus = pg_num_rows($rsqlQtdSubMenu);

$qtdMenuEstatico = 0; 


if($Csobre == 't')
{
	$qtdMenuEstatico++;
	$menuSobre = $qtdMenuEstatico;
}

//REMOVIDO MENU DE GESTÃO E TRANSPARENCIA POR CONTA DO NOVO PORTAL DA TRANSPARENCIA // 29/07/2015
$Cgestao = 'f';

if($Cgestao == 't')
{
	$qtdMenuEstatico++;
	$menuGestao = $qtdMenuEstatico;
}


if($CServ == 't')
{
	$qtdMenuEstatico++;
	$menuServ = $qtdMenuEstatico;
}


if($Cnot == 't')
{
	$qtdMenuEstatico++;
	$menuNot = $qtdMenuEstatico;
}


$qtdMenuDinamico = $submenus;

if($submenus == 0)
{
	$submenus = $qtdMenuEstatico;
}else{
	$submenus = $submenus + $qtdMenuEstatico;
}

?>

</script>

<!-- menu feio // 03/07/2015
<?php  if(($TipoEntidade) == 4 || ($TipoEntidade == 5)) { ?>
	<div id="titulo-secretaria">&nbsp;</div>
<?php } ?> 
-->
<ul class="page-navigation__primary">  	
	<li><a href="index.php?pagina=home&menu=0"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
</ul> 

<ul class="page-navigation__secondary">
     
   <?php
		 /*Controladora dos menus*/
	 	$quantidade = pg_num_rows($rMenu);
			
			if($quantidade != 0)
			{
				$quantidade = $qtdMenuEstatico + 1;
				$primeiro = true;
				
				while($objMenu = pg_fetch_object($rMenu))
				{
					
					switch((int)$objMenu->cmsmenu_tipo_menu)
					{
						/*Caso seja um menu do tipo que possui submenus*/
						case 1: 
							$sqlSubMenu = "SELECT * FROM cms_submenu WHERE cmssubmenu_menu_id = $objMenu->cmsmenu_id ORDER by cmssubmenu_ordem ASC";
							
							$rSubMenu = $drive->pedido($sqlSubMenu); 

							echo("<li>");
							echo("<a href=\"#\" data-target=\"nav-$objMenu->cmsmenu_id\" class=\"has-submenu\">$objMenu->cmsmenu_titulo</a>"); 
							echo("</li>");
         					echo("<ul id=\"nav-$objMenu->cmsmenu_id\" class=\"page-navigation__sub-nav\">");
         					echo("<li class=\"page-navigation__back-button\"><a href=\"#\"><i class=\"fa fa-arrow-circle-o-left\" aria-hidden=\"true\"></i> $objMenu->cmsmenu_titulo</a></li>");
								 
								 	while($objSubMenu = pg_fetch_object($rSubMenu))
									{						
										switch($objSubMenu->cmssubmenu_tipo_link)
										{
											case "0" :
												$sqlPagina = "SELECT * FROM cms_pagina 
												  WHERE cmspagina_id = $objSubMenu->cmssubmenu_pagina_id";
												$rPagina = $drive->pedido($sqlPagina);
												$objpagina = pg_fetch_object($rPagina);
												
																								
												echo("<li><a href=\"index.php?cms=$objpagina->cmspagina_abbr&menu=$quantidade\">
												$objSubMenu->cmssubmenu_titulo</a></li>");
												
											break;
											
											case "1" :
												$sqlPagina = "SELECT * FROM cms_pagina 
															  WHERE cmspagina_id = $objSubMenu->cmssubmenu_pagina_id";
												
												$rPagina = $drive->pedido($sqlPagina);
												$objpagina = pg_fetch_object($rPagina);
												
												echo("<li><a href=\"$objSubMenu->cmssubmenu_link\">$objSubMenu->cmssubmenu_titulo</a></li>");
											break;
											
											
										}
									}
								 
           						
							
							echo("
								         
							</ul>    
						    </li>");
							$quantidade++;
						break;
						/*Fim*/
						
						/*Caso seja um menu do tipo que abre uma p�gina interna*/
												
						case 2:
						
							$sqlPaginaMenu = "SELECT * FROM cms_pagina WHERE cmspagina_id = $objMenu->cmsmenu_pagina_id";
							$rPaginaMenu = $drive->pedido($sqlPaginaMenu);
							$objPaginaMenu = pg_fetch_object($rPaginaMenu);
							echo("<li $class_primeiro><a href=\"index.php?cms=$objPaginaMenu->cmspagina_abbr&menu=0\">$objMenu->cmsmenu_titulo</a>
								  </li>");
						break;
						/*fim*/
						
						/*Caso seja um menu que abre uma p�gina externa*/
						case 3:
							echo("<li $class_primeiro><a href=\"$objMenu->cmsmenu_link\">$objMenu->cmsmenu_titulo</a>
								  </li>");
						break; 
						/*fim*/
						
					}
					$primeiro = false;
				}
				
			}
	 /**/
	?>
    
</ul>