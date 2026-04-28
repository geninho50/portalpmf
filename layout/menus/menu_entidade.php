<script type="text/javascript">

<?php

$sqlQtdSubMenu   = "SELECT * FROM cms_menu  WHERE cmsmenu_entidade_id = $IdEntidade  AND cmsmenu_tipo_menu = 1 AND cmsmenu_status = 0";
$rsqlQtdSubMenu  = $drive->pedido($sqlQtdSubMenu);
$submenus 		 = pg_num_rows($rsqlQtdSubMenu);
$qtdMenuEstatico = 0; 

//--------------------------------------
// define indice de numeração dos menus
//--------------------------------------
if($Csobre == 't'){
	$qtdMenuEstatico++;
	$menuSobre = $qtdMenuEstatico;
}

if($Cgestao == 't'){
	$qtdMenuEstatico++;
	$menuGestao = $qtdMenuEstatico;
}

if($CServ == 't'){
	$qtdMenuEstatico++;
	$menuServ = $qtdMenuEstatico;
}

if($Cnot == 't'){
	$qtdMenuEstatico++;
	$menuNot = $qtdMenuEstatico;
}


if($submenus == 0)
{
	$submenus = $qtdMenuEstatico;
}else{
	$submenus = $submenus + $qtdMenuEstatico;
}
?>

var numSubMenus = <?=$submenus?>;


function ControlarMenu(num,acao){ // acao = 'abrir' ou 'fechar'
	for (i=1;i<=numSubMenus;i++){
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

<div id="menufixo">
	<ul>
  		<li><a href="index.php?pagina=home&menu=0">HOME</a></li>
        <?php 
		if($Csobre == "t"){
			if($TipoEntidade == 4 || $TipoEntidade == 5){
				$SobreNome = "SECRETARIA";
			}else{
				$SobreNome = "ENTIDADE";
			}
		?>
    		<li id="menu_fechado_<?=$menuSobre?>" style="display:block"><span><a href="javascript:ControlarMenu('<?=$menuSobre?>','abrir')">SOBRE A <?=$SobreNome?></a></span></li>
        	<li id="menu_aberto_<?=$menuSobre?>" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuSobre?>','fechar')">SOBRE A <?=$SobreNome?></a></span>
     <ul>
     <?php	
				//$sqlSobre = "SELECT * from cms_smenu_fixo WHERE entidade_id = $IdEntidade AND status = 0 AND menu_fixo_id = 1 ORDER BY ordem ASC";
				$sqlSobre = "SELECT cms_pagina.cmspagina_abbr, cms_pagina.cmspagina_id, cms_smenu_fixo.pagina_id,
				cms_smenu_fixo.entidade_id, cms_smenu_fixo.status, cms_smenu_fixo.menu_fixo_id, cms_smenu_fixo.titulo, cms_smenu_fixo.tipo_link
				FROM cms_pagina INNER JOIN cms_smenu_fixo ON cms_pagina.cmspagina_id = cms_smenu_fixo.pagina_id
WHERE (((cms_smenu_fixo.entidade_id) = $IdEntidade) AND (cms_smenu_fixo.menu_fixo_id = 1)) ORDER BY cms_smenu_fixo.ordem ASC;";
				
				
				$rSobre = $drive->pedido($sqlSobre);
				
				while($objSobre = pg_fetch_object($rSobre))
				{
					if((int)$objSobre->tipo_link == 1)
					{
						echo("<li><a href=\"$objSobre->link\">$objSobre->titulo</a></li>");
					}
					else
					{
						echo("<li><a href=\"index.php?cms=$objSobre->cmspagina_abbr&menu=$menuSobre\">$objSobre->titulo</a></li>");
					}
				}
			
			?>
         	<li><a href="index.php?pagina=govgabinete&menu=<?=$menuSobre?>">gabinete</a></li>
            <li><a href="index.php?pagina=govquem&menu=<?=$menuSobre?>">quem &eacute; quem</a></li>     
        	<li><a href="index.php?pagina=endereco&menu=<?=$menuSobre?>">endere&ccedil;os</a></li>
         </ul>    
    </li>
    <? } ?>
   
    <?php 
		if($Cgestao == "t")
		{
	?>
    	
         <li id="menu_fechado_<?=$menuGestao?>" style="display:block"><span><a href="javascript:ControlarMenu('<?=$menuGestao?>','abrir')">GEST&Atilde;O E TRANSPAR&Ecirc;NCIA</a></span></li>
    
    	 <li id="menu_aberto_<?=$menuGestao?>" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuGestao?>','fechar')">GEST&Atilde;O E TRANSPAR&Ecirc;NCIA</a></span>
        
        <ul>
        	<li><a href="index.php?pagina=govgestao&menu=<?=$menuGestao?>">relat&oacute;rios</a></li>
            <li><a href="index.php?pagina=goveditais&menu=<?=$menuGestao?>">editais</a></li>
    		 
			<?php
				$sqlSobre = "SELECT cms_pagina.*, cms_smenu_fixo.*
							 FROM cms_pagina 
							 INNER JOIN cms_smenu_fixo ON cms_pagina.cmspagina_id = cms_smenu_fixo.pagina_id
							 WHERE cms_smenu_fixo.entidade_id = $IdEntidade							 
							 AND cms_smenu_fixo.menu_fixo_id = 2
							 ORDER BY cms_smenu_fixo.ordem ASC;";
												
				$rSobre = $drive->pedido($sqlSobre);
				while($objSobre = pg_fetch_object($rSobre)){				
					if((int)$objSobre->tipo_link == 1){
						echo("<li><a href=\"$objSobre->link\">$objSobre->titulo</a></li>");
					}else{
						echo("<li><a href=\"index.php?cms=$objSobre->cmspagina_abbr&menu=$menuGestao\">$objSobre->titulo</a></li>");
					}
				}			
			?>
        </ul>
	<? } ?>
  
  
      <?php 
		if($CServ == "t")
		{
		?>
    <li id="menu_fechado_<?=$menuServ?>" style="display:block"><span><a href="javascript:ControlarMenu('<?=$menuServ?>','abrir')">SERVI&Ccedil;OS</a></span></li>
  
    <li id="menu_aberto_3" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuServ?>','fechar')">SERVI&Ccedil;OS</a></span> 
         <ul>
 
            <li><a href="index.php?pagina=servdestaques&menu=<?=$menuServ?>">destaques</a></li>
            <li><a href="index.php?pagina=servlistagem&menu=<?=$menuServ?>">listagem</a></li>
            <li><a href="index.php?pagina=servonline&menu=<?=$menuServ?>">servi&ccedil;os on-line</a></li>
            <li><a href="index.php?pagina=servacessados&menu=<?=$menuServ?>">mais acessados</a></li>
            <li><form id="frmbuscaserv" name="frmbuscaserv" action="index.php?pagina=servbusca&menu=<?=$menuServ?>" method="post" onsubmit="return verifica(this);">
            consultar
            <input type="txtbusca" name="txtbusca" id="textfield" class="componente_menu_entid" />
            <input type="image" name="bt_busca" id="bt_busca" src="../../layout/imagens/btn_ok_azul.png" alt="ok" align="absmiddle" />	
            </form></li>
            
            <?php
			
				$sqlSobre = "SELECT cms_pagina.cmspagina_abbr, cms_pagina.cmspagina_id, cms_smenu_fixo.pagina_id,
				cms_smenu_fixo.entidade_id, cms_smenu_fixo.status, cms_smenu_fixo.menu_fixo_id, cms_smenu_fixo.titulo, cms_smenu_fixo.tipo_link
				FROM cms_pagina INNER JOIN cms_smenu_fixo ON cms_pagina.cmspagina_id = cms_smenu_fixo.pagina_id
WHERE (((cms_smenu_fixo.entidade_id) = $IdEntidade) AND (cms_smenu_fixo.menu_fixo_id = 3)) ORDER BY cms_smenu_fixo.ordem ASC;";
				$rSobre = $drive->pedido($sqlSobre);
				
				while($objSobre = pg_fetch_object($rSobre))
				{
					if((int)$objSobre->tipo_link == 1)
					{
						echo("<li><a href=\"$objSobre->link\">$objSobre->titulo</a></li>");
					}
					else
					{
						echo("<li><a href=\"index.php?cms=$objSobre->cmspagina_abbr&menu=$menuServ\">$objSobre->titulo</a></li>");
					}
				}
			
			?>
            
                 
         </ul>    
    </li>
    <? } ?>
    
    
    <?php 
	if($Cnot == "t")
	{
	?>
    <li id="menu_fechado_<?=$menuNot?>" style="display:block"><span><a href="javascript:ControlarMenu('<?=$menuNot?>','abrir')">NOT&Iacute;CIAS E EVENTOS</a></span></li>
    
     <li id="menu_aberto_<?=$menuNot?>" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuNot?>','fechar')">NOT&Iacute;CIAS E EVENTOS</a></span> 
         <ul>
         
            <li><a href="index.php?pagina=notultimas&menu=<?=$menuNot?>">&uacute;ltimas not&iacute;cias</a></li>
            <li><a href="index.php?pagina=entcal&menu=<?=$menuNot?>">calend&aacute;rio</a></li>
            <li><a href="index.php?pagina=agendaeventos&menu=<?=$menuNot?>">agenda de eventos</a></li>
            <li><form id="frmbuscaserv" name="frmbuscaserv" action="index.php?pagina=notbusca&menu=<?=$menuNot?>" method="post" onsubmit="return verifica(this);">
             consultar
             <input type="text" name="txtbusca" id="txtbusca" class="componente_menu_entid" />  
             <input type="image" name="bt_busca" id="bt_busca" src="../../../layout/imagens/btn_ok_azul.png" alt="ok" align="absmiddle" />
             </form>
         </li>        
         	
         </ul>    
     </li>
     
     
 <? } ?>
    </ul>
    </div>
    
    <ul>
     
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
							echo("<a href=\"javascript:ControlarMenu('$quantidade','fechar')\">$objMenu->cmsmenu_titulo</a>"); 
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
							echo("<li><a href=\"index.php?cms=$objPaginaMenu->cmspagina_abbr&menu=0\">$objMenu->cmsmenu_titulo</a>
								  </li>");
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
    
    
  <li><a href="../../ouvidoria/index.php">OUVIDORIA</a></li>
  <li><a href="../../index.php">HOME DA PREFEITURA</a></li>
   </ul>
   
 

 
<script type="text/javascript">
<?php 

   
      $menuAtual = $_GET['menu'];
	  print "ControlarMenu('";
	  print $menuAtual;
	  print "','abrir');"; 	     

?>
</script>  