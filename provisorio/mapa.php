<?php
//---------------------------------------------------------------------
// busca as configurações e funções para mostrar corretamento o portal
//---------------------------------------------------------------------
require_once("scripts/php/config.php");
require_once(CAMINHO_SITE."/scripts/php/funcoes_bd.php");
require_once("scripts/php/funcoes.php");
$drive->conecta();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Prefeitura Municipal de Florianópolis</title>
    
    <link rel="stylesheet" href="layout/pmf-estilo.css" type="text/css">
    <link rel="stylesheet" href="layout/pmf-estilo-home.css" type="text/css">
	<link rel="stylesheet" href="layout/pmf-estilo-governo.css" type="text/css">
    <link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
	<style>

#mapa{width:100%;}
#mapa ul{padding:0;margin:0;}
#mapa li{list-style:none;}
#mapa .level_0{padding:3px 0 3px 0;font-size:16px; border-bottom:1px dashed #B2ADA7;}
#mapa .level_1{padding:0 0 3px 40px;font-size:14px;}
#mapa .level_2{padding:0 0 3px 40px;font-size:13px;font-style:italic;}
#mapa a{text-decoration:none;}
#mapa a:visited{text-decoration:none;}
#mapa a:hover{color:#0178BA}    
    </style>	
</head>
<body>
	<div class="layout_governo">
	<?php 
	$menu_principal = "home"; 
	include("layout/menus/menu_geral.php");
	?>
	<div id="conteudo_wrapper">
       	<div id="conteudo">
        	<div id="conteudo_coluna1"></div>
            <div id="conteudo_coluna2">
                <div id="titulo_pagina">mapa de navegação</div>
                <br /><br />
                <div id="mapa">
                    <ul>
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>"><b>Home</b></a></li>
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/"><b>Cidade</b></a>
                            <ul>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Sobre Florianópolis</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=a+cidade&menu=5">A Cidade</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=historia&menu=5">História</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=galeria+de+fotos&menu=5">Galeria de Fotos</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=folder+institucional&menu=5">Folder</a></li>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">O que visitar</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=atrativos+turisticos+culturais&menu=6">Atrativos Culturais</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=atrativos+naturais+++praias&menu=6">Atrativos Naturais</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=parques+municipais&menu=6">Parques Municipais</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=roteiros+tematicos&menu=6">Roteiros Temáticos</a></li>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Hospedagem</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=hoteis+++centro&menu=7">Centro</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=hoteis+e+pousadas+++praias+do+leste&menu=7">Praias do Leste</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=hoteis+e+pousadas+++praias+do+norte&menu=7">Praias do Norte</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=hoteis+e+pousadas+++praias+do+sul&menu=7">Praias do Sul</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=hoteis+++continente&menu=7">Continente</a></li>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Bares e Restaurantes</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=bares&menu=8">Bares</a></li>
                            <!--            <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=restaurantes&menu=8">Restaurantes</a></li> -->
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Informações Úteis</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=transportes&menu=9">Transportes</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=telefones+uteis&menu=9">Telefones Úteis</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=agencias+de+turismo&menu=9">Agências de Turismo</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=aeroporto+internacional+hercilio+luz&menu=9">Aeroporto Internacional Hercílio Luz</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=compras+++shoppings&menu=9">Compras</a></li>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=centro+de+atendimento+ao+turista&menu=0">Postos de Informações Turísticas</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Multimídia</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=videos&menu=11">Vídeos</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=wallpapers&menu=11">Wallpapers</a></li>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/turismo/index.php?cms=links&menu=0">Links</a></li>
                            </ul>
                        </li>
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/"><b>Governo</b></a>
                            <ul>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/">Gestão e Transparência</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/index.php?pagina=govquem&menu=2">Endereços e Telefones</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/index.php?pagina=govestrutura&menu=3">Estrutura Organizacional</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/index.php?pagina=govgabinete&menu=4">Gabinete do Prefeito</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/index.php?pagina=govdiariooficial&menu=5">Diário Oficial</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/index.php?pagina=goveditais&menu=6">Editais</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://editais.sc.gov.br/prefeituras/editais.asp?usuario=0540">Licitações</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/index.php?pagina=govpregao&menu=8">Compras Públicas</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Consultas Públicas</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/consultas-publicas/">Abertas</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/governo/consultas-publicas/?page_id=7">Encerradas</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/servicos/"><b>Serviços</b></a>
                            <ul>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/servicos/">Home</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Pró-Cidadão</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/receita/?cms=pro+cidadao">Sobre o Pró-Cidadão</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/entidades/receita/?cms=unidades+de+atendimento">Unidades de Atendimento</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/servicos/index.php?pagina=camera">Câmera On-Line</a></li>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/servicos/index.php?pagina=servonline2&menu=1">Serviços On-Line (via Web)</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/servicos/index.php?pagina=servonline&menu=2">Listagem Completa</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/servicos/index.php?pagina=servacessados&menu=3">Mais Acessados</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/servicos/index.php?menu=4">Lista Alfabética</a></li>
                            </ul>
                        </li>
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/noticias/"><b>Notícias</b></a>
                            <ul>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/noticias/">Manchetes</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/noticias/index.php?pagina=notultimas&menu=2">Últimas Notícias</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/noticias/index.php?pagina=calendario&menu=3">Calendário</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/noticias/index.php?pagina=agendaeventos&menu=4">Agenda de Eventos</a></li>
                            </ul>                    
                        </li>
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/midia/"><b>Mídia</b></a>
                            <ul>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/midia/">Galeria de Imagens</a>
                                    <ul>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/midia/index.php?pagina=imgalbuns&menu=1">Album por Dia</a></li>
                                        <li class="level_2"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/midia/index.php?pagina=imgbusca&menu=1">Consulta</a></li>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/midia/index.php?pagina=assessores&menu=2">Contatos</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/midia/index.php?pagina=marcas&menu=3">Marcas PMF</a></li>
                            </ul>
                        </li>
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/ouvidoria/"><b>Ouvidoria</b></a>          
                            <ul>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/ouvidoria/">Fale com o Ouvidor</a></li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="http://<?php echo($urlHost);?>/ouvidoria/index.php?pagina=consulta&menu=2">Consulte Reivindicação</a></li>
                            </ul>    
                        </li>  
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#"><b>Sites</b></a>
                        	<ul>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Prefeitura</a>
                                	<ul>
										<?php
                                        $sql 	 = "SELECT * FROM entidades WHERE entidade_tipo = 0 AND entidade_id <> 0 AND entidade_flag_site = 1 ORDER BY entidade_linha_1 ASC";
                                        $TentPmf = $drive->pedido($sql);
                                        while($Tret = pg_fetch_object($TentPmf)){
                                            echo"<li class=\"level_2\"><img src=\"layout/imagens/marcador_mapa.jpg\" border=\"0\" /><a href=\"http://$urlHost/entidades/".$Tret->entidade_path."/\">".$Tret->entidade_linha_1."</a></li>";
                                        }
                                        ?>
									</ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Secretarias Executivas</a>
                                	<ul>
										<?php
                                        $sql 	  = "SELECT * FROM entidades WHERE entidade_tipo = 5 AND entidade_flag_site = 1 ORDER BY entidade_linha_1 ASC";
                                        $TsecExec = $drive->pedido($sql);
										while($Tret = pg_fetch_object($TsecExec)){
                                            echo"<li class=\"level_2\"><img src=\"layout/imagens/marcador_mapa.jpg\" border=\"0\" /><a href=\"http://$urlHost/entidades/".$Tret->entidade_path."/\">".$Tret->entidade_linha_1."</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Secretarias Municipais</a>
                                	<ul>
										<?php
                                        $sql 	 = "SELECT * FROM entidades WHERE entidade_tipo = 4 AND entidade_flag_site = 1 ORDER BY entidade_linha_1 ASC";
                                        $TsecMun = $drive->pedido($sql);
										while($Tret = pg_fetch_object($TsecMun)){
                                            echo"<li class=\"level_2\"><img src=\"layout/imagens/marcador_mapa.jpg\" border=\"0\" /><a href=\"http://$urlHost/entidades/".$Tret->entidade_path."/\">".$Tret->entidade_linha_1."</a></li>";
                                        }
                                        ?>
                                	</ul>
                                </li>
                                <li class="level_1"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#">Orgãos</a>
                                	<ul>
										<?php		
                                        $sql  = "SELECT * FROM entidades WHERE entidade_tipo = 6 AND entidade_flag_site = 1 ORDER BY entidade_sigla ASC";
                                        $Torg = $drive->pedido($sql);	
										while($Tret = pg_fetch_object($Torg)){
											if(strtoupper($Tret->entidade_linha_1) != strtoupper($Tret->entidade_sigla)){
                                            	echo"<li class=\"level_2\"><img src=\"layout/imagens/marcador_mapa.jpg\" border=\"0\" /><a href=\"http://$urlHost/entidades/".$Tret->entidade_path."/\">".$Tret->entidade_sigla." - ".$Tret->entidade_linha_1."</a></li>";
											}else{
												echo"<li class=\"level_2\"><img src=\"layout/imagens/marcador_mapa.jpg\" border=\"0\" /><a href=\"http://$urlHost/entidades/".$Tret->entidade_path."/\">".$Tret->entidade_linha_1."</a></li>";
											}
									    }
                                        ?>
                                    </ul>
                                </li>
                            </ul>  
                        </li> 
                        <li class="level_0"><img src="layout/imagens/marcador_mapa.jpg" border="0" /><a href="#"><b>Hot Sites</b></a>
                        	<ul>
                            	<?php		
								$sql  = "SELECT * FROM entidades WHERE entidade_tipo = 7 AND entidade_excluida = 'f' AND mostrar = 't' ORDER BY entidade_linha_1 ASC";
								$Torg = $drive->pedido($sql);	
								while($Tret = pg_fetch_object($Torg)){
									echo"<li class=\"level_1\"><img src=\"layout/imagens/marcador_mapa.jpg\" border=\"0\" /><a href=\"http://$urlHost/sites/".$Tret->entidade_path."/\">".$Tret->entidade_linha_1."</a></li>";
								}
								?>
                          	</ul>
                        </li>
                    </ul>
            	</div>
            </div>
        	<br class="clearfloat">
		</div>	<!-- fim do conteudo -->
	</div> <!-- fim do conteudo_wrapper -->
	<?php include("layout/rodape/rodape.php"); ?>
</div><!-- fim layout-home -->
</body>
</html>
<?php
$drive->close();
?>