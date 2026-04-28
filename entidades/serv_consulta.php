<?php
if($resultado){
	$objSite = pg_fetch_object($resultado);
	
	$NomeEntidade 	= $objSite->entidade_nome;
	$SiglaEntidade	= $objSite->entidade_sigla;
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
	
	switch($TipoEntidade){
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
	
	$sqlMenu = "SELECT * FROM cms_menu  WHERE cmsmenu_entidade_id = $IdEntidade AND cmsmenu_status = 0 ORDER BY cmsmenu_posicao";
	$rMenu   = $drive->pedido($sqlMenu);
}

switch($_GET['pagina']){	
	case "contracheque"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/contra_cheque.php";					break;
	case "cadfuncional"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/cadastro_funcional.php";			break;
	case "dependentes"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_dependentes.php";			break;
	case "afastamentos"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_afastamento.php";			break;
	case "frequencia"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_frequencia.php";			break;
	case "ferias"			:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_ferias.php";				break;
	case "ponto"			:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_tele_ponto.php";			break;
	case "bancohoras"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_banco_horas.php";			break;
	case "assistsaude"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_assistencia_saude.php";	break;
	case "comprovrend"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/comprovante_rendimento.php";		break;
	case "cursos"			:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_cursos.php";				break;
	case "vagasub"			:$link_consulta = "http://adm.pmf.sc.gov.br/srh/resultado_escolha_internet.list.2.php";						break;
	case "plansaude"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/consulta_assistencia_saude.php";	break;
	case "alterasenha"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/alteracao_senha.php";				break;
	case "fichafinanceira"	:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/ficha_financeira.php";				break;
	case "adiantamento"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/pedido_ad13.php";					break;
	case "alteararemail"	:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/altera_email.php";					break;
	case "recuperasenha"	:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/recupera_senha.php";				break;
	case "unlockpws"		:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/desbloqueio_senha.php";				break;
	default					:$link_consulta = "http://portal.pmf.sc.gov.br/servicos/interfaces/sadm/contra_cheque.php";					break;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$NomeEntidade?></title>
	<link rel="stylesheet" href="../../layout/pmf-estilo.css" type="text/css">
    <link rel="stylesheet" href="../../layout/pmf-estilo-home.css" type="text/css">
    <link rel="stylesheet" href="../../layout/pmf-estilo-entidades.css" type="text/css">
	<link href="../../layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
   	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body>
	<div class="layout_entidades <?php echo(strtolower($SiglaEntidade));?>">
		<?php 
		$menu_principal = "entidade";
		require_once(CAMINHO_SITE."/layout/menus/menu_geral.php"); 
		?>
		<div class="flex-container page-template">
				<div class="page-navigation">
     					<?php 
						$menu = 0;
						require_once(CAMINHO_SITE."/layout/themePMF/includes/entidades/menu_entidade.php"); 
						?>
   				</div><!-- fim conteudo_coluna1 -->
   				<div class="page-content">
                    <iframe src ="<?=$link_consulta?>" width="700" height="800" frameborder="0" scrolling="auto">
                    	<p>Seu navegador não suporta iframes</p>
                    </iframe>  
                </div><!-- conteudo_coluna2 -->  
		</div>
		<?php 
		require_once(CAMINHO_SITE."/layout/rodape/rodape.php");
		require_once("../tracker.php"); 
		?>
	</div><!-- fim layout-home -->
</body>
</html>