<?php
	
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	


if(!empty($_GET))
{
	if(isset($_GET['servicoid']))
	{
		if($_GET['servicoid'] != "")
		{
			
			$servicoid = (int)$_GET['servicoid'];
			$sqlservico = "SELECT serv_flag_online, serv_link FROM servicos WHERE serv_id = $servicoid";
			
			$resultadoserv = $drive->pedido($sqlservico);
			$objserv=pg_fetch_object($resultadoserv);
			
			if($objserv->serv_flag_online == "t")
			{
				if($objserv->serv_link != "")
				{
				
							if($resultado)
							{
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
								
								$sqlMenu = "SELECT * FROM cms_menu  WHERE 
											cmsmenu_entidade_id = $IdEntidade ORDER BY cmsmenu_posicao";
								$rMenu   = $drive->pedido($sqlMenu);
								
								
							} //if resultado
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=$NomeEntidade?></title>
<link rel="stylesheet" href="../../layout/prefeitura.css" type="text/css">
<link rel="stylesheet" href="../../layout/prefeitura_entidades.css" type="text/css">
<link rel="stylesheet" href="../../scripts/lightbox/css/lightbox.css" type="text/css" media="screen" />

<script src="../../scripts/js/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="../../scripts/tabbedpane/TabbedPane.js" type="text/javascript"></script>
<script src="../../scripts/calendar/calendar.js" type="text/javascript"></script>
<script src="../../scripts/lightbox/js/lightbox.js" type="text/javascript"></script>
<script  src="../../scripts/lightbox/js/prototype.js" type="text/javascript"></script>
<script src="../../scripts/lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>

</head>

<body>

	<?php $menu_principal = "entidade";  ?>
    <?php require_once(CAMINHO_SITE."/layout/menus/menu_geral.php"); ?>

<div class="flex-container page-template consulta-saude">


   <div class="page-navigation">
     
     <?php $menu = 0;  ?>
    
     <?php require_once(CAMINHO_SITE."/layout/themePMF/includes/entidades/menu_entidade.php"); ?>
     
   </div>
   
   
   
   <div class="page-content">
      	 
          <?php
		  	$pasta = explode("/" , $_SERVER['PHP_SELF']);
			$path = $pasta[2];	
			
			$pasta2 = explode("/", $objserv->serv_link);
			$path2 = $pasta2[0];
			
			if($path == "fazenda" && $path2 == "procidadao")
			{
				$pathfinal = "../../servicos/".$objserv->serv_link;
				
			}else{$pathfinal = $objserv->serv_link;
			}
		  ?>	
    	  <iframe src ="<?=$pathfinal?>" width="700" height="800" frameborder="0" scrolling="auto">
            <p>Seu navegador não suporta iframes</p>
     </iframe>  

   </div><!-- conteudo_coluna_sistema -->  

 
</div><!-- fim conteudo -->



<?php require_once(CAMINHO_SITE."/layout/rodape/rodape.php"); ?>

</body>
</html>

<?php
				
				}else{$drive->redirect("/servicos/index.php");} //if != ""
			
			}else{$drive->redirect("/servicos/index.php");} //if == "t"
			
		
		} // if get servico != ""
	}
	else
	{
				if(isset($_GET['pagina']))
				{
					$drive->redirect("index.php?pagina=".$_GET['pagina']);
				}
				else if(isset($_GET['cms']) && !empty($_GET['cms']))
				{
					$drive->redirect("index.php?cms=".$_GET['cms']);
				}else{$drive->redirect("index.php");}
	}
	// if get servico
}else{$drive->redirect("index.php");} // if get

?>
