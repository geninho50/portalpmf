<?
session_start();
require_once("../scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
$drive->conecta();


if(!empty($_GET))
{
	if(isset($_GET['servicoid']))
	{
		if($_GET['servicoid'] != "")
		{
			
			$servicoid = (int)$_GET['servicoid'];
			
			if($servicoid == "1000001")
			{
			
				$link_servico = "procidadao/online_iss_cadastro.php"
				
?>				

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Prefeitura Municipal de Florianópolis</title>
                <link rel="stylesheet" href="../layout/prefeitura.css" type="text/css">
                <link rel="stylesheet" href="../scripts/lightbox/css/lightbox.css" type="text/css" media="screen" />
                
                <script src="../scripts/js/AC_RunActiveContent.js" type="text/javascript"></script>
                <script src="../scripts/tabbedpane/TabbedPane.js" type="text/javascript"></script>
                <script src="../scripts/calendar/calendar.js" type="text/javascript"></script>
                <script src="../scripts/lightbox/js/lightbox.js" type="text/javascript"></script>
                <script  src="../scripts/lightbox/js/prototype.js" type="text/javascript"></script>
                <script src="../scripts/lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
                
                </head>
                
                <body>
                
                <div class="layout_servicos"><center>
                    <?php $menu_principal = "servicos"; ?>
                    <div id="cabecalho"><?php include("../layout/menus/menu_principal.php"); ?></div>
                
                <div id="conteudo_sistema">
                
                
                   <div id="conteudo_coluna1">
                     <div id="conteudo_coluna1_topo">&nbsp;</div>
                     <div id="menu"><br>
                     
                     <?php $menu = 0;  ?>
                    
                     <?php include("../layout/menus/menu_servicos.php"); ?>
                
                     </div><!-- fim menu -->
                     
                     <br>
                  
                  
                  
                   </div><!-- fim conteudo_coluna1 -->
                   
                   
                 
                   <div id="conteudo_coluna_sistema">
                    
                     <iframe src ="<?=$link_servico?>" width="700" height="800" frameborder="0" scrolling="auto">
                            <p>Seu navegador não suporta iframes</p>
                     </iframe>  
                
                   </div><!-- conteudo_coluna_sistema -->  
                
                  
                
                
                <br class="clearfloat" />
                
                <br><br>
                </div><!-- fim conteudo -->
                <div id="rodape">
                   <strong>Copyright &copy; 2009-2010 Prefeitura Municipal de Florianópolis</strong>. Todos os direitos reservados.<br />
                   Política de Privacidade | Mapa de Navegação.&nbsp;
                </div> <!-- fim rodapé -->
                
                </center></div>
                
                </body>
                </html>				
				
			
			
<?		
			
			
			
} else {
			
			
				$sql = "SELECT serv_flag_online, serv_link FROM servicos WHERE serv_id = $servicoid";
			
				$resultado = $drive->pedido($sql);
				$objserv=pg_fetch_object($resultado);
			
				if($objserv->serv_flag_online == "t")
				{
				if($objserv->serv_link != "")
					{

?>	
					

				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Prefeitura Municipal de Florianópolis</title>
                <link rel="stylesheet" href="../layout/prefeitura.css" type="text/css">
                <link rel="stylesheet" href="../scripts/lightbox/css/lightbox.css" type="text/css" media="screen" />
                
                <script src="../scripts/js/AC_RunActiveContent.js" type="text/javascript"></script>
                <script src="../scripts/tabbedpane/TabbedPane.js" type="text/javascript"></script>
                <script src="../scripts/calendar/calendar.js" type="text/javascript"></script>
                <script src="../scripts/lightbox/js/lightbox.js" type="text/javascript"></script>
                <script  src="../scripts/lightbox/js/prototype.js" type="text/javascript"></script>
                <script src="../scripts/lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
                
                </head>
                
                <body>
                
                <div class="layout_servicos"><center>
                    <?php $menu_principal = "servicos"; ?>
                    <div id="cabecalho"><?php include("../layout/menus/menu_principal.php"); ?></div>
                
                <div id="conteudo_sistema">
                
                
                   <div id="conteudo_coluna1">
                     <div id="conteudo_coluna1_topo">&nbsp;</div>
                     <div id="menu"><br>
                     
                     <?php $menu = 0;  ?>
                    
                     <?php include("../layout/menus/menu_servicos.php"); ?>
                
                     </div><!-- fim menu -->
                     
                     <br>
                  
                  
                  
                   </div><!-- fim conteudo_coluna1 -->
                   
                   
                 
                   <div id="conteudo_coluna_sistema">
                    
                     <iframe src ="<?=$objserv->serv_link?>" width="700" height="800" frameborder="0" scrolling="auto">
                            <p>Seu navegador não suporta iframes</p>
                     </iframe>  
                
                   </div><!-- conteudo_coluna_sistema -->  
                
                  
                
                
                <br class="clearfloat" />
                
                <br><br>
                </div><!-- fim conteudo -->
                <div id="rodape">
                   <strong>Copyright &copy; 2009-2010 Prefeitura Municipal de Florianópolis</strong>. Todos os direitos reservados.<br />
                   Política de Privacidade | Mapa de Navegação.&nbsp;
                </div> <!-- fim rodapé -->
                
                </center></div>
                
                </body>
                </html>


<?
				
					}else{$drive->redirect("/servicos/index.php");}
			
				}else{$drive->redirect("/servicos/index.php");}
				
			}
		
		}
	}
}

?>
