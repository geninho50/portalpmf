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

if( !isset($menuGestao) ){
	$menuGestao = 0;
}

if( !isset($menuNot) ){
	$menuNot = 0;
}

if( !isset($menuServ) ){
	$menuServ = 0;
}

if( !isset($menuSobre) ){
	$menuSobre = 0;
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
	<?php
		if($Csobre == "t") {
			if($TipoEntidade == 4 || $TipoEntidade == 5) {
				$SobreNome = "Secretaria";
			} else {
				$SobreNome = "Entidade";
			}
	?>
	  <li><a href="#" data-target="nav-sobre" class="has-submenu"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Sobre a <?=$SobreNome?></a></li>
	<?php } ?>

  <?php if($Cgestao == "t") { ?>
		<li><a href="#" class="has-submenu" data-target="nav-gestao-e-transparencia"><i class="fa fa-book" aria-hidden="true"></i> Gest&atilde;o e Transpar&ecirc;ncia</a></li>
	<?php } ?>

  <?php if($CServ == "t") { ?>
    <li><a href="#" data-target="nav-servicos" class="has-submenu"><i class="fa fa-clipboard" aria-hidden="true"></i> Servi&ccedil;os</a></li>
	<?php } ?>

	<?php if($Cnot == "t") { ?>
    <li><a href="#" data-target="nav-noticias-e-eventos" class="has-submenu"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Not&iacute;cias e Eventos</a></li>
		<li><a href="../../ouvidoria/index.php"><i class="fa fa-user-o" aria-hidden="true"></i> Ouvidoria</a></li>
 	<?php } ?>
</ul>

<ul id="nav-gestao-e-transparencia" class="page-navigation__sub-nav">
	<li class="page-navigation__back-button"><a href="#"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Gest&atilde;o e Transpar&ecirc;ncia</a></li>
	<li><a href="index.php?pagina=govgestao&menu=<?=$menuGestao?>">Relat&oacute;rios</a></li>
  <li><a href="index.php?pagina=goveditais&menu=<?=$menuGestao?>">Editais</a></li>
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

<ul id="nav-sobre" class="page-navigation__sub-nav">
	<li class="page-navigation__back-button"><a href="#"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Sobre a <?=$SobreNome?></a></li>
  <?php
		//$sqlSobre = "SELECT * from cms_smenu_fixo WHERE entidade_id = $IdEntidade AND status = 0 AND menu_fixo_id = 1 ORDER BY ordem ASC";
		$sqlSobre = "SELECT cms_pagina.cmspagina_abbr, cms_pagina.cmspagina_id, cms_smenu_fixo.pagina_id,
		cms_smenu_fixo.entidade_id, cms_smenu_fixo.status, cms_smenu_fixo.menu_fixo_id, cms_smenu_fixo.titulo, cms_smenu_fixo.tipo_link
		FROM cms_pagina INNER JOIN cms_smenu_fixo ON cms_pagina.cmspagina_id = cms_smenu_fixo.pagina_id
		WHERE (((cms_smenu_fixo.entidade_id) = $IdEntidade) AND (cms_smenu_fixo.status = 0) AND (cms_smenu_fixo.menu_fixo_id = 1)) ORDER BY cms_smenu_fixo.ordem ASC;";

		$rSobre = $drive->pedido($sqlSobre);

		while($objSobre = pg_fetch_object($rSobre))
		{
			if((int)$objSobre->tipo_link == 1)
			{
				echo("<li><a href=\"$objSobre->link\">$objSobre->titulo</a></li>");
			}
			else
			{
				echo("<li><a href=\"index.php?cms=$objSobre->cmspagina_abbr&menu=$menuSobre&submenuid=sobre\">$objSobre->titulo</a></li>");
			}
		}
	?>
 	<li><a href="index.php?pagina=govgabinete&menu=<?=$menuSobre?>&submenuid=sobre">Gabinete</a></li>
  <li><a href="index.php?pagina=govorganograma&menu=<?=$menuSobre?>&submenuid=sobre">Organograma</a></li>
  <li><a href="index.php?pagina=govquem&menu=<?=$menuSobre?>&submenuid=sobre">Nossa equipe</a></li>
  <li><a href="index.php?pagina=endereco&menu=<?=$menuSobre?>&submenuid=sobre">Endere&ccedil;os</a></li>
</ul>

<ul id="nav-servicos" class="page-navigation__sub-nav">
	<li class="page-navigation__back-button"><a href="#"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Servi&ccedil;os</a></li>
	<li><a href="index.php?pagina=servlistagem&menu=<?=$menuServ?>&submenuid=servicos">Listagem</a></li>
	<li><a href="index.php?pagina=servonline&menu=<?=$menuServ?>&submenuid=servicos">Servi&ccedil;os on-line</a></li>
	<li><a href="index.php?pagina=servacessados&menu=<?=$menuServ?>&submenuid=servicos">Mais acessados</a></li>
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
				echo("<li><a href=\"index.php?cms=$objSobre->cmspagina_abbr&menu=$menuServ&submenuid=servicos\">$objSobre->titulo</a></li>");
			}
		}
	?>
</ul>

<ul id="nav-noticias-e-eventos" class="page-navigation__sub-nav">
	<li class="page-navigation__back-button"><a href="#"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Not&iacute;cias e Eventos</a></li>
	<li><a href="index.php?pagina=notultimas&menu=<?=$menuNot?>&submenuid=noticias-e-eventos">&Uacute;ltimas not&iacute;cias</a></li>
	<li><a href="index.php?pagina=entcal&menu=<?=$menuNot?>&submenuid=noticias-e-eventos">Calend&aacute;rio</a></li>
	<li><a href="index.php?pagina=agendaeventos&menu=<?=$menuNot?>&submenuid=noticias-e-eventos">Agenda de eventos</a></li>
</ul>

<ul class="page-navigation__secondary">

   <?php
		 /*Controladora dos menus*/
	 	$quantidade = pg_num_rows($rMenu);

			if($quantidade != 0)
			{
				$quantidade = $qtdMenuEstatico + 1;
				$primeiro = true;

				if( !isset( $class_primeiro ) ){
					$class_primeiro = "";
				}

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

												if( isset( $objpagina->cmspagina_abbr ) ){
													echo("<li><a href=\"index.php?cms=$objpagina->cmspagina_abbr&menu=$quantidade&submenuid=$objMenu->cmsmenu_id\">
													$objSubMenu->cmssubmenu_titulo</a></li>");
												}	

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

<?php  
	if ($menuServ !='') {
		if($IdEntidade == 328) {?>
			<a href="index.php?pagina=servlistagem&menu=<?=$menuServ?>" class="page-navigation__ancillary-link"> Veja os serviços do <?=$SiglaEntidade?></a></li>
<?php 
		} else {
?>
			<a href="index.php?pagina=servlistagem&menu=<?=$menuServ?>" class="page-navigation__ancillary-link"> Veja os serviços da <?=$SiglaEntidade?></a></li>
<?php
		}
	} ?>	