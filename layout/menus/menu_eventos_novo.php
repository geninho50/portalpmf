<script type="text/javascript">

<?php

$sqlQtdSubMenu  = "SELECT * FROM cms_menu  WHERE cmsmenu_entidade_id = $IdEntidade  AND cmsmenu_tipo_menu = 1 AND cmsmenu_status = 0";
$rsqlQtdSubMenu = $drive->pedido($sqlQtdSubMenu);

$submenus = pg_num_rows($rsqlQtdSubMenu);


$qtdMenuEstatico = 0; 


if($submenus == 0)
{
	$submenus = $qtdMenuEstatico;
}else{
	$submenus = $submenus + $qtdMenuEstatico;
}

?>

var numSubMenus = <?=$submenus?>;


function ControlarMenu(num,acao){ // acao = 'abrir' ou 'fechar'
	for (i=0;i<=numSubMenus;i++){
		document.getElementById('menu_fechado_'+i).style.display = 'block';
		document.getElementById('menu_aberto_'+i).style.display = 'none';
	}
	
	if (acao == 'abrir'){ 
	    document.getElementById('menu_fechado_'+num).style.display = 'none';
		document.getElementById('menu_aberto_'+num).style.display = 'block';
	} 
}


function verifica(form) 
{
	if(form.txtbusca.value == "")
	{
		alert("Preencha um dado para pesquisa !");
		return false;
	}else {
		return true;
	}
}


</script>


<div id="menugeral">
   <ul>
   
   
    <li id="menu_fechado_0" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=home&menu=0">HOME</a></span></li>
    
    <li id="menu_aberto_0" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=home&menu=0" class="selecionado">HOME</a></span>   
    </li>
    
   
    
    
     
     <?php
	 /*Controladora dos menus*/
	 
	 	$quantidade = pg_num_rows($rMenu);
			
			if($quantidade != 0)
			{
				$quantidade = $qtdMenuEstatico + 1;
				
				while($objMenu = pg_fetch_object($rMenu))
				{
					switch((int)$objMenu->cmsmenu_tipo_menu)
					{
						/*Caso seja um menu do tipo que possui submenus*/
						case 1: 
							$sqlSubMenu = "SELECT * FROM cms_submenu WHERE cmssubmenu_menu_id = $objMenu->cmsmenu_id ORDER by cmssubmenu_ordem ASC";
							
							$rSubMenu = $drive->pedido($sqlSubMenu); 
							
							echo("<li id=\"menu_fechado_$quantidade\" style=\"display:block\">");
							echo("<a href=\"javascript:ControlarMenu('$quantidade','abrir')\">$objMenu->cmsmenu_titulo</a>");
							echo("</li>");
							echo("<li id=\"menu_aberto_$quantidade\" style=\"display:none\">");
							echo("<a href=\"javascript:ControlarMenu('$quantidade','fechar')\" class=\"selecionado\">$objMenu->cmsmenu_titulo</a>"); 
         					echo("
							<ul>
        						 ");
								 
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
						
						/*Caso seja um menu do tipo que abre uma página interna*/
												
						case 2:
						
							$sqlPaginaMenu = "SELECT * FROM cms_pagina WHERE cmspagina_id = $objMenu->cmsmenu_pagina_id";
							$rPaginaMenu = $drive->pedido($sqlPaginaMenu);
							$objPaginaMenu = pg_fetch_object($rPaginaMenu);
							
								  
							echo("<li id=\"menu_fechado_$quantidade\" style=\"display:block\">");
							echo("<span><a href=\"index.php?cms=$objPaginaMenu->cmspagina_abbr&menu=$quantidade\">$objMenu->cmsmenu_titulo</span></a>");
							echo("</li>");
							echo("<li id=\"menu_aberto_$quantidade\" style=\"display:none\">");
							echo("<span><a href=\"index.php?cms=$objPaginaMenu->cmspagina_abbr&menu=$quantidade\" class=\"selecionado\">$objMenu->cmsmenu_titulo</span></a>"); 
							echo("</li>");
							$quantidade++;
	
							
						break;
						/*fim*/
						
						/*Caso seja um menu que abre uma página externa*/
						case 3:
							echo("<li><a href=\"$objMenu->cmsmenu_link\">$objMenu->cmsmenu_titulo</a>
								  </li>");
						break; 
						/*fim*/
						
					}
				}
				
			}
	 /**/
	 ?>
     
   
    <?php if(!(($flgCalendario == "t") or ($flgGaleriaImg == "t") or ($flgGaleriaVid == "t")))  {  ?> 
   
   <li id="menu_fechado_<?=$quantidade?>" style="display:block"> 
      <span><a href="index.php?pagina=noticias&menu=<?=$quantidade?>">NOT&Iacute;CIAS</a></span></li>
    
    <li id="menu_aberto_<?=$quantidade?>" style="display:none"> 
      <span><a href="index.php?pagina=noticias&menu=<?=$quantidade?>" class="selecionado">NOT&Iacute;CIAS</a></span>   
    </li>
    
     <?php }  ?>
     
 
   </ul>
   </div>
   
 
 
 <?php if(($flgCalendario == "t") or ($flgGaleriaImg == "t") or ($flgGaleriaVid == "t"))  {  ?> 
   
   <div class="separador-menu">&nbsp;</div>
   
 <div id="menuespecifico">
    <ul>
        
 
    
    <li id="menu_fechado_<?=$quantidade?>" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=noticias&menu=<?=$quantidade?>">NOT&Iacute;CIAS</a></span></li>
    
    <li id="menu_aberto_<?=$quantidade?>" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=noticias&menu=<?=$quantidade?>" class="selecionado">NOT&Iacute;CIAS</a></span>   
    </li>
    <?php $quantidade++; ?>
    
    
    <?php  if($flgCalendario == "t") {  ?>
    <li id="menu_fechado_<?=$quantidade?>" style="display:block"> 
      <span><a href="index.php?pagina=calendario&menu=<?=$quantidade?>">CALEND&Aacute;RIO</a></span></li>
    
    <li id="menu_aberto_<?=$quantidade?>" style="display:none"> 
      <span><a href="index.php?pagina=calendario&menu=<?=$quantidade?>" class="selecionado">CALEND&Aacute;RIO</a></span>   
    </li>
    <?php $quantidade++; ?>
    <?php }  ?>
    
    
    <?php  if($flgGaleriaImg == "t") {  ?>
    <li id="menu_fechado_<?=$quantidade?>" style="display:block"> 
      <span><a href="index.php?pagina=imagens&menu=<?=$quantidade?>">IMAGENS</a></span></li>
    
    <li id="menu_aberto_<?=$quantidade?>" style="display:none"> 
      <span><a href="index.php?pagina=imagens&menu=<?=$quantidade?>" class="selecionado">IMAGENS</a></span>   
    </li>
    <?php $quantidade++; ?>
    <?php }  ?>
     
    
    <?php  if($flgGaleriaVid == "t") {  ?>
    <li id="menu_fechado_<?=$quantidade?>" style="display:block"> 
      <span><a href="index.php?pagina=videos&menu=<?=$quantidade?>">V&Iacute;DEOS</a></span></li>
    
    <li id="menu_aberto_<?=$quantidade?>" style="display:none"> 
      <span><a href="index.php?pagina=videos&menu=<?=$quantidade?>" class="selecionado">V&Iacute;DEOS</a></span>   
    </li>
     <?php }  ?>
    
    
   </ul>
</div>
 <?php }  ?>
   
 

 
<script type="text/javascript">
<?php 
      $menuAtual = $_GET['menu'];
	  
	  if ( empty($menuAtual) ) {
	      $menuAtual = 0 ;
	   }
	      
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');"; 	     

?>
</script> 