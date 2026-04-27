<?php
if($resultado){

	$objSite 			= pg_fetch_object($resultado);
	$idEntidade 		= $objSite->entidade_id;
	$NomeEntidade 		= $objSite->entidade_nome;
	$SiglaEntidade		= $objSite->entidade_sigla;
	$IdEntidade			= (int)$objSite->entidade_id;
	$TipoEntidade 		= $objSite->entidade_tipo;
	$EmailEntidade  	= $objSite->entidade_email;
	$FoneEntidade   	= $objSite->entidade_fone;
	$FaxEntidade    	= $objSite->entidade_fax;
	$DescEntidade 		= $objSite->entidade_descricao;
	$ImgBanner 			= $objSite->entidade_img_banner;
	$Nome1				= $objSite->entidade_linha_1;
	$Nome2				= $objSite->entidade_linha_2;
	$Csobre				= $objSite->conteudo_sobre;
	$Cgestao			= $objSite->conteudo_gestao;
	$Cnot				= $objSite->conteudo_noticias;
	$CServ				= $objSite->conteudo_servicos;
	$st_twitter			= $objSite->entidade_flag_twitter;
	$twitter			= $objSite->entidade_twitter;
	$st_transmissao		= $objSite->entidade_flag_aovivo;
	$link_transmissao   = $objSite->entidade_aovivo;
	$logo				= $objSite->entidade_logo;
	$flgCalendario      = $objSite->entidade_eve_calendario;
	$flgGaleriaImg      = $objSite->entidade_eve_imagem;
	$flgGaleriaVid      = $objSite->entidade_eve_videos;
	$transmData         = $objSite->entidade_eve_data_trans;
	$transmTitulo       = $objSite->entidade_eve_titulo_trans;
	$transmDescricao    = $objSite->entidade_eve_desc_trans;

	switch($TipoEntidade)
	{
		default  : $TipoEntidadeNome = "";
		break;
	}

	$sqlMenu = "SELECT * FROM cms_menu  WHERE cmsmenu_entidade_id = $IdEntidade AND cmsmenu_status = 0 ORDER BY cmsmenu_posicao";
	$rMenu   = $drive->pedido($sqlMenu);


	//----------------------------------------------------
	//busca destaques postados no sistema
	//----------------------------------------------------
	$TdestSql	= "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = $IdEntidade ORDER BY destaque_lateral_posicao ASC";
	$TresultDet	= $drive->pedido($TdestSql);


	//----------------------------------------------------
	//identifica página a ser carregada
	//----------------------------------------------------

	if(isset($_GET['pagina'])) {
		$pagina = $_GET['pagina'];
	} else {
		if(isset($_GET['cms'])) {
			$pagina = "cms";
			$cms = $_GET['cms'];
		} else {
	 		$pagina = "home";
		}
	};


}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$NomeEntidade?></title>

<link rel="stylesheet" href="../../layout/pmf-estilo.css" type="text/css">
<link rel="stylesheet" href="../../layout/pmf-estilo-home.css" type="text/css">
<link rel="stylesheet" href="../../layout/pmf-estilo-noticias.css" type="text/css">
<link rel="stylesheet" href="../../layout/pmf-estilo-sites.css" type="text/css">

<?php
//if($idEntidade == 157){
//	echo "<link rel=\"stylesheet\" href=\"../../layout/prefeitura_sites_fenaostra.css\" type=\"text/css\">";
//}else{
//	echo "<link rel=\"stylesheet\" href=\"../../layout/prefeitura_sites.css\" type=\"text/css\">";
//}
?>

<link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />


	<link rel="stylesheet" href="../../../scripts/colorbox/colorbox.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="../../scripts/jcarosellite/jcarousellite.css" type="text/css" media="screen"/>



	<script>
		entidade = <?php echo $idEntidade; ?>;
	</script>

</head>

<body>
<div class="layout_sites">

<?php $menu_principal = "entidade";  ?>
<?php require_once(CAMINHO_SITE."/layout/menus/menu_geral.php"); ?>

<script>


jQuery(document).ready(function($)
{
	var conteudoNoticias = $('#conteudo_noticias');
	conteudoNoticias.load('../reload_noticia_evento.php?entidade=<?=$idEntidade?>');

	var refreshId = setInterval(function()
	{
		conteudoNoticias.load('../reload_noticia_evento.php?entidade=<?=$idEntidade?>');
	}, 	300000);

});


</script>


<script type="text/javascript">


function stAba(menu,conteudo){
		this.menu = menu;
		this.conteudo = conteudo;
}

var arAbas = new Array();
arAbas[0] = new stAba('aba_noticias','conteudo_noticias');
arAbas[1] = new stAba('aba_twitter','conteudo_twitter');


function AlternarAbas(menu,conteudo){
	for (i=0;i<arAbas.length;i++){
		document.getElementById(arAbas[i].menu).className = 'aba_link';
		document.getElementById(arAbas[i].conteudo).style.display = 'none';
	}
	document.getElementById(menu).className = 'aba_sel';
	document.getElementById(conteudo).style.display = 'inline';
}


</script>


<div class="flex-container page-template">







   			<div class="page-navigation">
        	<?php if($logo != "" ){	?>
          		<div class="page-navigation__logo">
     						<img src='../../arquivos/eventologo/<?=$logo?>' border='0'>
   						</div>
          	<?php } ?>

     				<?php
					$menu = 0;
					require_once(CAMINHO_SITE."/layout/themePMF/includes/sites/menu_eventos_novo.php");
					?>
   			</div>



       		<div class="page-content">
         			<?php
					//-------------------------------------
					//Caminhos para os itens FIXOS do menu
					//-------------------------------------
						switch ($pagina){
							case "home": 		require_once(CAMINHO_SITE."/sites/home.php"); 		break;
							case "noticias":	require_once(CAMINHO_SITE."/sites/not_ultimas.php");break;
							case "notpagina":	require_once(CAMINHO_SITE."/sites/not_pagina.php");	break;
							case "calendario":	require_once(CAMINHO_SITE."/sites/calendario.php");	break;
							case "imagens":		require_once(CAMINHO_SITE."/sites/galeria_img.php");break;
							case "videos":		require_once(CAMINHO_SITE."/sites/galeria_vid.php");break;
							case "cms":		    require_once(CAMINHO_SITE."/sites/cms.php"); break;
							default: 			require_once(CAMINHO_SITE."/sites/home.php");		break;
						}
					?>
    		</div>




<script>
	if(entidade == 260){
		$('.bannernext').remove();
		$('.bannerprev').remove();
		$('#menu_fechado_6').remove();
		$('.painel_ultimas').remove();
	}

</script>
</div>
</div>
<?php require_once(CAMINHO_SITE."/layout/rodape/rodape.php"); ?>
</body>
</html>
