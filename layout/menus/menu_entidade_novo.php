<script type="text/javascript">
<?php
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

<!-- menu feio // 03/07/2015
<?php  if(($TipoEntidade) == 4 || ($TipoEntidade == 5)) { ?>
	<div id="titulo-secretaria">&nbsp;</div>
<?php } ?> 
-->
<div id="menugeral">
  <ul>
  	
   <li id="menu_fechado_0" style="display:none" class="primeiro"> 
      <span><a href="index.php?pagina=home&menu=0">HOME</a></span></li>
    
    <li id="menu_aberto_0" style="display:block" class="primeiro"> 
      <span><a href="index.php?pagina=home&menu=0" class="selecionado">HOME</a></span>   
    </li>
    
    
    <?php 
	if($Csobre == "t")
	{
		if($TipoEntidade == 4 || $TipoEntidade == 5)
		{
			$SobreNome = "SECRETARIA";
		}
		else
		{
			$SobreNome = "ENTIDADE";
		}
	?>
    
    
    <li id="menu_fechado_<?=$menuSobre?>" style="display:block"><span><a href="javascript:ControlarMenu('<?=$menuSobre?>','abrir')">SOBRE A <?=$SobreNome?></a></span></li>
    
    <li id="menu_aberto_<?=$menuSobre?>" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuSobre?>','fechar')" class="selecionado">SOBRE A <?=$SobreNome?></a></span>
       
         <ul>
            
         	
            <?php
				//$sqlSobre = "SELECT * from cms_smenu_fixo WHERE entidade_id = $IdEntidade AND status = 0 AND menu_fixo_id = 1 ORDER BY ordem ASC";
				$sqlSobre = "SELECT cms_pagina.cmspagina_abbr, 
				                    cms_pagina.cmspagina_id, 
									cms_smenu_fixo.pagina_id,
									cms_smenu_fixo.entidade_id, 
									cms_smenu_fixo.status, 
									cms_smenu_fixo.menu_fixo_id, 
									cms_smenu_fixo.titulo, 
									cms_smenu_fixo.tipo_link
							   FROM cms_pagina 
						 INNER JOIN cms_smenu_fixo 
						         ON cms_pagina.cmspagina_id = cms_smenu_fixo.pagina_id
							  WHERE (((cms_smenu_fixo.entidade_id) = $IdEntidade) 
							    AND (cms_smenu_fixo.status = 0) 
							    AND (cms_smenu_fixo.menu_fixo_id = 1)) 
						   ORDER BY cms_smenu_fixo.ordem ASC;";
				
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
            <li><a href="index.php?pagina=govorganograma&menu=<?=$menuSobre?>">organograma</a></li> 
            <li><a href="index.php?pagina=govquem&menu=<?=$menuSobre?>">nossa equipe</a></li>  
            <li><a href="index.php?pagina=endereco&menu=<?=$menuSobre?>">endere&ccedil;os</a></li>   
         </ul>    
    </li>
    <? } ?>

    <?php 
		if($Cgestao == "t")
		{
	?>
    	
         <li id="menu_fechado_<?=$menuGestao?>" style="display:block"><span><a href="javascript:ControlarMenu('<?=$menuGestao?>','abrir')">GEST&Atilde;O E TRANSPAR&Ecirc;NCIA</a></span></li>
    
    	 <li id="menu_aberto_<?=$menuGestao?>" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuGestao?>','fechar')" class="selecionado">GEST&Atilde;O E TRANSPAR&Ecirc;NCIA</a></span>
        
        <ul>
        	<li><a href="index.php?pagina=govgestao&menu=<?=$menuGestao?>">relat&oacute;rios</a></li>
            <li><a href="index.php?pagina=goveditais&menu=<?=$menuGestao?>">editais</a></li>
    		

			<?php					
				//------------------------------------------------
				// Monta os menus fixos de Gestão e Transparência
				//------------------------------------------------

				$sqlMenuFixo = "SELECT * FROM cms_smenu_fixo WHERE entidade_id = ".$IdEntidade." AND menu_fixo_id = 2 ORDER BY ordem ASC";
				$TretMenFix  = $drive->pedido($sqlMenuFixo);
				while($objGestao = pg_fetch_object($TretMenFix)){
					if($objGestao->tipo_link == 1){
						echo("<li><a href=\"$objGestao->link\">$objGestao->titulo</a></li>");
					}else{
						$sqlPagina = "SELECT cmspagina_abbr FROM cms_pagina WHERE cmspagina_id = ".$objGestao->pagina_id;
						$TretPag   = $drive->pedido($sqlPagina);
						$objPagina = pg_fetch_object($TretPag);
						echo("<li><a href=\"index.php?cms=$objPagina->cmspagina_abbr&menu=$menuGestao\">$objGestao->titulo</a></li>");
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
  
    <li id="menu_aberto_<?=$menuServ?>" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuServ?>','fechar')" class="selecionado">SERVI&Ccedil;OS</a></span> 
         <ul>

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
WHERE (((cms_smenu_fixo.entidade_id) = $IdEntidade) AND (cms_smenu_fixo.status = 0) AND (cms_smenu_fixo.menu_fixo_id = 3)) ORDER BY cms_smenu_fixo.ordem ASC;";
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
    
     <li id="menu_aberto_<?=$menuNot?>" style="display:none"><span><a href="javascript:ControlarMenu('<?=$menuNot?>','fechar')" class="selecionado">NOT&Iacute;CIAS E EVENTOS</a></span> 
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
     
     
     <li><a href="../../ouvidoria/index.php">OUVIDORIA</a></li>
     
     
 <? } ?>
 
 
   
   <?php 
   
   // teste para verificar se o menu possui mais de 1 item personalizado.
   // caso tenha, � encerrada a lista anterior e criado o div cinza para os itens de menu
   // se s� tiver 1, esse item aparecer� no final do menu geral. 
   if ($MenusPersonalizados >= 2 ) { ?>

    	</ul>
    	</div>
  
  
  <div class="separador-menu">&nbsp;</div>
  
   
    	<div id="menuespecifico">
    	<ul>
    
    <?php } ?>
     
     <?php
	 /*Controladora dos menus*/
	 
	 	$quantidade = pg_num_rows($rMenu);
			
			if($quantidade != 0)
			{
				$quantidade = $qtdMenuEstatico + 1;
				$primeiro = true;
				
				while($objMenu = pg_fetch_object($rMenu))
				{
					if($primeiro && ($MenusPersonalizados >= 2)) { 
						$class_primeiro = " class=\"primeiro\"";
					} else {
						$class_primeiro = "";
					}
					
					switch((int)$objMenu->cmsmenu_tipo_menu)
					{
						/*Caso seja um menu do tipo que possui submenus*/
						case 1: 
							$sqlSubMenu = "SELECT * FROM cms_submenu WHERE cmssubmenu_menu_id = $objMenu->cmsmenu_id ORDER by cmssubmenu_ordem ASC";
							
							$rSubMenu = $drive->pedido($sqlSubMenu); 
							
							echo("<li id=\"menu_fechado_$quantidade\" style=\"display:block\" $class_primeiro>");
							echo("<a href=\"javascript:ControlarMenu('$quantidade','abrir')\">$objMenu->cmsmenu_titulo</a>");
							echo("</li>");
							echo("<li id=\"menu_aberto_$quantidade\" style=\"display:none\" $class_primeiro>");
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
     
     
     <?php if($quantidade < 7) { ?>
    	<br><br><br>
    <?php } ?>
    
   </ul>
   </div>
   
 

 
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