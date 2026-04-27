<?php
require_once("../scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
$drive->conecta();

if(!empty($_GET)){
	if(isset($_GET['servicoid'])){
		if($_GET['servicoid'] != ""){
			$servicoid = (int)$_GET['servicoid'];
			if($servicoid == "1000001"){
				$link_servico = "procidadao/online_iss_cadastro.php"				
				?>
				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Prefeitura Municipal de Florianópolis</title>
                <link rel="stylesheet" href="../layout/pmf-estilo.css" type="text/css">
                <link rel="stylesheet" href="../layout/pmf-estilo-servicos.css" type="text/css">               
                <script src="../scripts/tabbedpane/TabbedPane.js" type="text/javascript"></script>
                <script src="../scripts/calendar/calendar.js" type="text/javascript"></script>        
   	            </head>            
                <body>                
                	<div class="layout_servicos">
						<?php 
                        $menu_principal = "servicos";
                        include("../layout/menus/menu_geral.php"); 
                        ?>
                        <div id="conteudo_wrapper">
                            <div id="conteudo">
                                <div id="conteudo_coluna1">
                                    <div id="menu">                                 
                                        <?php 
                                        $menu = 0; 
                                        include("../layout/menus/menu_servicos_novo.php"); 
                                        ?>                            
                                    </div>
                                    <br>
                                </div>                  
                                <iframe src ="<?=$link_servico?>" width="700" height="800" frameborder="0" scrolling="auto" style="background-color:#FFF;">
                                    <p>Seu navegador não suporta iframes</p>
                                </iframe>                  
                            </div>
                            <br class="clearfloat" />               
                        </div><!-- fim conteudo -->
                        <?php include("../layout/rodape/rodape.php");?>
					</div>
                </body>
                </html>				
				<?
                }else{			
					$sql 		= "SELECT serv_flag_online, serv_link FROM servicos WHERE serv_id = $servicoid";			
					$resultado 	= $drive->pedido($sql);
					$objserv	= pg_fetch_object($resultado);			
					if($objserv->serv_flag_online == "t"){
						if($objserv->serv_link != ""){
							?>
							<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                			<html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                            <title>Prefeitura Municipal de Florianópolis</title>
                            <link rel="stylesheet" href="../layout/pmf-estilo.css" type="text/css">
                            <link rel="stylesheet" href="../layout/pmf-estilo-servicos.css" type="text/css">               
                            <script src="../scripts/tabbedpane/TabbedPane.js" type="text/javascript"></script>
                            <script src="../scripts/calendar/calendar.js" type="text/javascript"></script>        
                            </head> 
                			<body>
                				<div class="layout_servicos">
                					<?php 
                                    $menu_principal = "servicos";
                                    include("../layout/menus/menu_geral.php"); 
                                    ?>
                                    <div id="conteudo_wrapper">
                                        <div id="conteudo">
                                            <div id="conteudo_coluna1">
                                                <div id="menu">                                 
                                                    <?php 
                                                    $menu = 0; 
                                                    include("../layout/menus/menu_servicos_novo.php"); 
                                                    ?>                            
                                                </div>
                                                <br>
                                            </div> 
                   						    <iframe src ="<?=$objserv->serv_link?>" width="700" height="800" frameborder="0" scrolling="auto">
                           						<p>Seu navegador não suporta iframes</p>
                     						</iframe> 
                   						</div>
                						<?php include("../layout/rodape/rodape.php");?>
                                 	</div>
	                            </div>
                            </body>
                            </html>
							<?php				
						}else{
							$drive->redirect("/servicos/index.php");
						}			
					}else{
						$drive->redirect("/servicos/index.php");
					}
				}
			}
		}
	}
?>