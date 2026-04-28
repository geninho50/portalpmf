<?php
	if($resultado)
	{
		$objSite = pg_fetch_object($resultado);


		$NomeEntidade 	= '';
		$SiglaEntidade	= '';
		$IdEntidade		= 0;
		$TipoEntidade 	= '';
		$EmailEntidade  = '';
		$FoneEntidade   = '';
		$FaxEntidade    = '';
		$DescEntidade 	= '';
		$ImgBanner 		= '';
		$Nome1			= '';
		$Nome2			= '';
		$Csobre			= '';
		$Cgestao		= '';
		$Cnot			= '';
		$CServ			= '';

		if(  isset( $objSite->entidade_sigla ) ){
			$SiglaEntidade	= $objSite->entidade_sigla;
		}		
		if(  isset( $objSite->entidade_nome ) ){
			$NomeEntidade 	= $objSite->entidade_nome;
		}
		if(  isset( $objSite->entidade_id ) ){
			$IdEntidade		= (int)$objSite->entidade_id;
		}		
		if(  isset( $objSite->entidade_tipo ) ){
			$TipoEntidade 	= $objSite->entidade_tipo;
		}
		if(  isset( $objSite->entidade_email ) ){
			$EmailEntidade  = $objSite->entidade_email;
		}
		if(  isset( $objSite->entidade_fone ) ){
			$FoneEntidade   = $objSite->entidade_fone;
		}
		if(  isset( $objSite->entidade_fax ) ){
			$FaxEntidade    = $objSite->entidade_fax;
		}
		if(  isset( $objSite->entidade_descricao ) ){
			$DescEntidade 	= $objSite->entidade_descricao;
		}
		if(  isset( $objSite->entidade_img_banner ) ){
			$ImgBanner 		= $objSite->entidade_img_banner;
		}
		if(  isset( $objSite->entidade_linha_1 ) ){
			$Nome1			= $objSite->entidade_linha_1;
		}
		if(  isset( $objSite->entidade_linha_2 ) ){
			$Nome2			= $objSite->entidade_linha_2;
		}
		if(  isset( $objSite->conteudo_sobre ) ){
			$Csobre			= $objSite->conteudo_sobre;
		}
		if(  isset( $objSite->conteudo_gestao ) ){
			$Cgestao		= $objSite->conteudo_gestao;
		}
		if(  isset( $objSite->conteudo_noticias ) ){
			$Cnot			= $objSite->conteudo_noticias;
		}
		if(  isset( $objSite->conteudo_servicos ) ){
			$CServ			= $objSite->conteudo_servicos;
		}

	

/*		$NomeEntidade 	= $objSite->entidade_nome;
		$IdEntidade		= (int)$objSite->entidade_id;
		$TipoEntidade 	= $objSite->entidade_tipo;
		$EmailEntidade  = $objSite->entidade_email;
		$FoneEntidade   = $objSite->entidade_fone;
		$FaxEntidade    = $objSite->entidade_fax;
		$DescEntidade 	= $objSite->entidade_descricao;
		$ImgBanner 		= $objSite->entidade_img_banner;
		$Nome1			= $objSite->entidade_linha_1;
		$Nome2			= $objSite->entidade_linha_2;
		$Csobre			= $objSite->conteudo_sobre;
		$Cgestao		= $objSite->conteudo_gestao;
		$Cnot			= $objSite->conteudo_noticias;
		$CServ			= $objSite->conteudo_servicos;
*/
		switch($TipoEntidade)
		{
			case "0" : $TipoEntidadeNome = "Prefeitura";
			break;
			case "4" : $TipoEntidadeNome = "Secretaria Municipal";
			break;
			case "5" : $TipoEntidadeNome = "Secretaria Executiva";
			break;
			case "6" : $TipoEntidadeNome = "&Oacute;rg&atilde;os";
			break;
			default  : $TipoEntidadeNome = "Prefeitura";
			break;
		}

		$sqlMenu = "SELECT * 
		              FROM cms_menu  
					 WHERE cmsmenu_entidade_id = $IdEntidade 
					   AND cmsmenu_status = 0 
				  ORDER BY cmsmenu_posicao ";	
				  
		$rMenu   = $drive->pedido($sqlMenu);

	}

	/*else
	{
		$drive->redirect("../index.php");
	}*/

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php

include(CAMINHO_SITE."/layout/themePMF/includes/header.php");


if(  isset($_GET['pagina']) ){
	switch ($_GET['pagina']){
		case "notpagina":    
			include "meta_not_pagina.php";    
			break;        
		default:         
			break;
	}
}
?>

<title><?=$NomeEntidade?></title>


  <link rel="stylesheet" href="../../layout/pmf-estilo.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-home.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-governo.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-servicos.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-noticias.css" type="text/css">
  <link rel="stylesheet" href="../../layout/pmf-estilo-entidades.css" type="text/css">
  <link rel="stylesheet" href="../../scripts/colorbox/colorbox.css" type="text/css" media="screen"/>
  <link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="../../scripts/slider/style.css" type="text/css" media="screen"/>

</head>

<body class="<?php echo(strtolower($SiglaEntidade));?>">
	<?php if($IdEntidade == 13) { ?>
		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-54931358-1', 'auto');
			  ga('send', 'pageview');
		</script>
	<?php } ?>

	<?php $menu_principal = "entidade";  ?>
	<?php require_once(CAMINHO_SITE."/layout/menus/menu_geral.php"); ?>

	<script src="../../scripts/colorbox/jquery.colorbox.js"></script>
	<script>
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$("a[rel='colorbox-principal']").colorbox({transition:"elastic"});
				$("a[rel='colorbox-galeria']").colorbox({transition:"elastic"});
				$("a[rel='cmdca']").colorbox({iframe:true, innerWidth:606, innerHeight:600});
				<?php

				if(  isset($_GET['pagina']) && isset($_GET['r'])  ){
					if( $_GET['pagina'] == "cmddoacao" ){
						//----------------------------------
						// verifica autenticidade do boleto
						//----------------------------------
						require_once("../../sistemas/cmdca/scripts/php/conexao_bd.class.php");
						$objpg->conecta();
						$sql 		= "SELECT doacao_id FROM doacao WHERE doacao_hash = '".$_GET['r']."'";
						$TsqlValida = $objpg->pedido($sql);
						$Tvalida 	= pg_fetch_row($TsqlValida);
						$objpg->close();
						if($Tvalida > 0){
							echo("$.fn.colorbox({iframe:true, href:\"../../sistemas/cmdca/externo/boleto_bb.php?r=".$_GET['r']."\", open:true, innerWidth:750, innerHeight:600});");
						}
					}
				} ?>

			});
	</script>
	<div class="flex-container page-template entity-template">

		<div class="page-navigation">
			<!-- menu -->
			<?php $menu = 0;  ?>
			<?php require_once(CAMINHO_SITE."/layout/themePMF/includes/entidades/menu_entidade.php"); ?>
		</div>

		<?php 
		
		if(isset($_GET['pagina']) && $_GET['pagina'] != 'home'){  ?>
			<div class="page-content">
				<h1 class="page-header"><?=$NomeEntidade?></h1>
				<?php

                 // bloquear at� o dia 10/10   
                // 4392 - Estabelecida
				// 4534 - N�o estabelecida
				// 5227 - ITBI
				// 3687 - CND Imoveis
				// 3551 - CND Pessoa F�sica
				// 248 - Comprova��o de Documento Eletr�nico
				// 3688 - Seunda via de DAM
				// 4437 - Nota fiscal 

				/*
				3547,3687,4248,4253,4260,4264,4270,4583,4622,4626,5034,5158,5159,5176,5177,5181,
				5203,5204,5205,5207,5225,5226,5229,5230,5231,5232,5233,5234,5235,5236,5237,5238,5239,
				5251,5252,5253,5254,5255,5256,5257,5160,5212,4392,4534,5210,5209,5213,5211,5292,5292,
				5605229,230,240,3546,3551,3686,3687,3688,3691,3778,3802,4260,4270,4437,4583,4622,
				4626,5055,5059,5060,5074,5159,5160,5165,5176,5177,5178,5181,5237,5238,5239,5245,
				5613,5634,4396,5145,5265,4523,4326,5608 
				*/

				if( ( $dia < '20261016' && $dia > '20220915' ) ){
					
					$mystring = '1,4626,5613,5239,4622,5238,3791,251,4260,5055,3689,5178,5176,5177,
								5074,5245,4270,5165,3691,4583,5176,3546,5060,5181,240,230,5159,229,
								5160,5634,5059,5237,3686,236,5146';
								 
					$pos = strpos($mystring, $_GET['id'] );
					
					if ( $pos != false ) {
						if( $_GET['id'] =='5227' ){
							$_GET['id'] = '9998';
						}else{
							$_GET['id'] = '9999';
						}
					}
				}

				switch ($_GET['pagina']){
						//------------------------------
						// caminhos para páginas do CMS
						//------------------------------
						case "home": 			require_once(CAMINHO_SITE."/entidades/home.php"); 				break;
						// case "notultimas": 		require_once(CAMINHO_SITE."/entidades/not_ultimas.php"); 		break;
						// case "notpagina": 		require_once(CAMINHO_SITE."/entidades/not_pagina.php"); 		break;
						// case "notbusca": 		require_once(CAMINHO_SITE."/entidades/not_busca.php");			break;
						// case "agendaeventos": 	require_once(CAMINHO_SITE."/entidades/evento_agenda.php"); 		break;
						case "eventopagina": 	require_once(CAMINHO_SITE."/entidades/evento_pagina.php");		break;
						case "servacessados": 	require_once(CAMINHO_SITE."/entidades/serv_acessados.php"); 	break;
						case "servdestaques": 	require_once(CAMINHO_SITE."/entidades/serv_guia.php"); 			break;
						case "servlistagem": 	require_once(CAMINHO_SITE."/entidades/serv_listagem.php");		break;
						case "servbusca": 		require_once(CAMINHO_SITE."/entidades/serv_busca.php"); 		break;

						case "servpagina": 		
							 if( $_GET['id'] == '9998' || $_GET['id'] == '9999'  ){
							    require_once( CAMINHO_SITE."/layout/themePMF/includes/servicos/serv_fora.php"); 
							 }else{
							    require_once(CAMINHO_SITE."/entidades/serv_pagina_nova.php");
							 }
							break;

						case "servpaginanova": 	
							if( $_GET['id'] == '9998' || $_GET['id'] == '9999'  ){
								require_once( CAMINHO_SITE."/layout/themePMF/includes/servicos/serv_fora.php"); 
							}else{
								require_once(CAMINHO_SITE."/entidades/serv_pagina_nova.php");
							}
							break;

						case "servdoc":			require_once(CAMINHO_SITE."/entidades/serv_doc.php"); 			break;
						case "servonline": 		require_once(CAMINHO_SITE."/entidades/serv_online.php");		break;

				     // case "govgestao": 	   require_once(CAMINHO_SITE."/entidades/home.php"); 				break;
						case "govgestao": 	    require_once(CAMINHO_SITE."/entidades/gov_gestao.php");         break;

						case "govquem": 		require_once(CAMINHO_SITE."/entidades/gov_quem.php"); 			break;
						case "govorganograma": 	require_once(CAMINHO_SITE."/entidades/gov_organograma.php"); 	break;
						case "govgabinete": 	require_once(CAMINHO_SITE."/entidades/gov_gabinete.php"); 		break;

						//case "goveditais": 	require_once(CAMINHO_SITE."/entidades/home.php"); 				 break;
						case "goveditais":    	require_once(CAMINHO_SITE."/entidades/gov_editais.php");         break;
						//removidos paginas de editais e gestao por conta do portal da transparencia // 29/07/15
						case "entcal": 			require_once(CAMINHO_SITE."/entidades/calendario.php"); 		break;
						case "endereco": 		require_once(CAMINHO_SITE."/entidades/enderecos.php"); 			break;
						case "org": 			require_once(CAMINHO_SITE."/entidades/org.php"); 				break;
						//--------------------------------------------
						// caminhos para página específicas da COMCAP
						//--------------------------------------------
						case "ccplist": require_once(CAMINHO_SITE."/entidades/comcap_lista_licitacoes.php"); 	break;
						case "ccpusr": 	require_once(CAMINHO_SITE."/entidades/comcap_user_licitacoes.php"); 	break;
						//--------------------------------------------
						// caminhos para páginas específicas do CMDCA
						//--------------------------------------------
						case "cmdproj":	  require_once(CAMINHO_SITE."/sistemas/cmdca/externo/projetos.php"); 	break;
						case "cmddoacao": require_once(CAMINHO_SITE."/sistemas/cmdca/externo/doacao.php"); 		break;
						//------------------------
						// caminho página default
						//------------------------
						default: require_once(CAMINHO_SITE."/entidades/home.php"); break;
					}
				?>
			</div>
		<?php 

		

			} else if (isset($_GET['cms']) && !empty($_GET['cms'])) {   ?>
			<div class="page-content">
				<h1 class="page-header"><?=$NomeEntidade?></h1>
				<?php
					$cms = $_GET['cms'];
					require_once(CAMINHO_SITE."/entidades/cms.php");
				?>
			</div>
		<?php } else {

			$pasta = explode("/" , $_SERVER['PHP_SELF']);
			$path = $pasta[2];
			//home background Image
			$pathToFolder = CAMINHO_SITE."/entidades/$path/imagem/";

			if(glob($pathToFolder.'/home.*')){
				$files = glob($pathToFolder . '/home.*');
			}else{
				$files = glob($pathToFolder . '/*.*');
			}

			$file = array_rand($files);

			if(count($files) > 0){
				$style="/entidades/$path/".basename($files[$file]);
			} else {
				$style = "/layout/imagens/home-background/mercadopublico3.jpg";
			}
			?>
			<div class="page-content flex-container">
				<?php require_once(CAMINHO_SITE."/layout/themePMF/includes/entidades/hero_entidade.php"); ?>
				<?php require_once(CAMINHO_SITE."/entidades/home.php"); ?>
			</div>
		<?php } ?>
	</div>
	<!-- banners -->
	<?php // require_once(CAMINHO_SITE."/layout/destaques/destaques_lateral_novo.php"); ?>

<?php require_once(CAMINHO_SITE."/layout/rodape/rodape.php"); ?>
<?php //require_once("../tracker.php"); ?>
<?php
	$minJs = "/layout/themePMF/js/entidades.min.js";
	if (file_exists(CAMINHO_SITE.$minJs)){
		echo "<script src=\"$minJs\"></script>";
	}
 ?>
</body>
</html>