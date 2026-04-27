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
    <title>Prefeitura de Florianópolis</title>
    
    <link rel="stylesheet" href="layout/pmf-estilo.css" type="text/css">
    <link rel="stylesheet" href="layout/pmf-estilo-home.css" type="text/css">
    <link rel="stylesheet" href="scripts/slidesjs/css/global.css">
    <link rel="stylesheet" href="scripts/js/ui/jquery-ui.css">
    <link href="layout/imagens/brasao.gif" rel="shortcut icon" type="image/x-icon" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="scripts/js/jquery/jquery.easing.1.3.js"></script>
    <!-- Alterado  caminho scripts apontado para um servidor pessoal-->  
 	<script src="scripts/js/ui/jquery-ui.min.js"></script>
	<script src="scripts/slidesjs/js/slides.min.jquery.js"></script>
	<script>
	$(function(){
		$('#slides').slides({
			preload: true,
			preloadImage: 'scripts/slidesjs/img/loading.gif',
			play: 5000,
			pause: 2500,
			hoverPause: true
		});
	});
	</script>		
</head>
<body>
    <!----------------------------------------------->
    <!-- Redirecionamento para deficientes visuais -->  
    <!----------------------------------------------->   
    <div style="display:none">
		<a href="mobile/" title="Link para o portal de acessibilidade">para acessar o portal no modulo de acessibilidade, acesse este link</a>
    </div>    
	<div class="layout_home">
	<?php 
	$menu_principal = "home"; 
	include("layout/menus/menu_geral_teste.php");
	?>
	<div id="conteudo_wrapper">
       	<div id="conteudo">
        	<div id="banner">
				<div id="slides">
					<div class="slides_container">
                		<?php
						//--------------------------------------------
						// busca todas as imagens do banner principal
						//--------------------------------------------
						$sqlBanner	= "SELECT * FROM cms_banner WHERE cms_banner_entidade_id = 0 ORDER BY cms_banner_ordem ASC  ";
						$rBanner 	= $drive->pedido($sqlBanner);						
						while($objBanner = pg_fetch_object($rBanner)){							
							echo"<div class=\"slide\">
							<a href=\"".$objBanner->cms_banner_link."\"><img src=\"../../arquivos/banners/".$objBanner->cms_banner_path."\" alt=\"".$objBanner->cms_banner_titulo."\" border=\"0\" width=\"326\" height=\"192\"/> </a><div class=\"caption\" style=\"bottom:0\"><h2>".$objBanner->cms_banner_titulo."</h2><p>".$objBanner->cms_banner_subtitulo."</p></div></div>
							";
						}								
						?> 

					</div>
					<a href="#" class="prev"><img src="scripts/slidesjs/img/arrow-next.png" width="24" height="43" alt="Arrow Prev"></a>
					<a href="#" class="next"><img src="scripts/slidesjs/img/arrow-prev.png" width="24" height="43" alt="Arrow Next"></a>
				</div>
			</div><!-- fim do banner -->            
        	<div id="bloco-menu-aberto">
           		<div id="busca-home">
					<?php
                    //-----------------------------------------------------------------------
                    // busca o titulo de todos os serviços para a busca com o auto completar
                    //-----------------------------------------------------------------------                    
                    $convert_to = array(
                        "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u",
                        "v", "w", "x", "y", "z", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï",
                        "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "а", "б", "в", "г", "д", "е", "ё", "ж",
                        "з", "и", "й", "к", "л", "м", "н", "о", "п", "р", "с", "т", "у", "ф", "х", "ц", "ч", "ш", "щ", "ъ", "ы",
                        "ь", "э", "ю", "я"
                     );
                     $convert_from = array(
                        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
                        "V", "W", "X", "Y", "Z", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï",
                        "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "А", "Б", "В", "Г", "Д", "Е", "Ё", "Ж",
                        "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ъ",
                        "Ь", "Э", "Ю", "Я"
                    );
                    
                    $sql 	  = "SELECT serv_nome, serv_id FROM servicos ORDER BY serv_nome ASC";
                    $TretServ = $drive->pedido($sql);
                    $Tnomes   = "";
                    while($obj = pg_fetch_object($TretServ)) {
                        $Tnomes .= "\"".$obj->serv_id." - ".str_replace($convert_from, $convert_to, html_entity_decode($obj->serv_nome))."\", ";
                    }  
                    ?>
                    <script>
                    $(document).ready(function() {
						$("input#autocomplete").autocomplete({
							source: [<?=$Tnomes?>]
						});
                    });
                    </script>
                    <form method="post" action="servicos/index.php?pagina=servpagina">                      
                        <input name="autocomplete" id="autocomplete" type="text" class="busca-home-field" />
                        <input class="busca-home-botao" type="submit" value="" />
                    </form>
            	</div>        	
                <ul class="menu-aberto-governo">
                     <!-- *** Comentado pois foi solicitado a retirada desse link -->
                    <!--<li class="li-inicio"><a href="governo/index.php?pagina=govgestao">gest&atilde;o e transpar&ecirc;ncia</a></li>-->
                    <li><a href="governo/index.php?pagina=govquem">endereços e telefones</a></li>
                    <li><a href="governo/index.php?pagina=govestrutura">estrutura organizacional</a></li>
                    <li><a href="governo/index.php?pagina=govdiariooficial">diário oficial</a></li>
                    <li><a href="governo/index.php?pagina=goveditais">editais</a>
                     <!-- *** Comentado pois foi solicitado a retirada desse link -->
                    <!--/<a href="http://editais.sc.gov.br/prefeituras/editais.asp?usuario=0540">licitações</a>--></li>
                    <li><a href="http://www.leismunicipais.com.br/legislacao-municipal-da-prefeitura/4571/leis-de-florianopolis.html">leis municipais</a></li>
                    <li><a href="http://portal.pmf.sc.gov.br/governo/consultas-publicas/">consultas p&uacute;blicas</a></li>
                </ul>
                <ul class="menu-aberto-servicos">
                    <li class="li-inicio"><a href="servicos/index.php?pagina=servpagina&acao=open&id=3770">processos eletrônicos</a></li>
                    <li><a href="servicos/index.php?pagina=servonline">nossos serviços</a></li>
                    <li><a href="servicos/index.php?pagina=servonline2">serviços on-line</a></li>
                    <li><a href="http://portal.pmf.sc.gov.br/entidades/fazenda/index.php?cms=unidades+de+atendimento&menu=6">pró-cidadão/CIAC</a></li>
                    <li><a href="servicos/index.php?pagina=onibus">horário de ônibus</a></li>
                    <li><a href="servicos/index.php?pagina=servpagina&amp;id=260">coleta de lixo</a></li>
                    <li><a href="http://geo.pmf.sc.gov.br/">geoprocessamento</a></li>
                </ul>
        	</div><!--fim do menu-aberto -->        
        	<div id="conteudo_destaques">
        		<?php 
	   			$sqlDestaques  = "SELECT * FROM destaque_lateral WHERE destaque_lateral_entidade_id = 0 ORDER BY destaque_lateral_posicao ASC LIMIT 7";
				$rsqlDestaques = $drive->pedido($sqlDestaques);
	   			include("layout/destaques/destaques_lateral_novo.php"); 
				?>  
        	</div>
			<div id="bloco-calendario">    	
            	<?php
				//---------------------------------- 	
				//impressão das datas no calendário 
				//----------------------------------
				$dataAtual = date("Y/m/d");
				$sql 	   = "SELECT * FROM calendario WHERE cal_data >= '$dataAtual' AND cal_tipo = 1 ORDER BY cal_data ASC LIMIT 8";
				$resultado = $drive->pedido($sql);
				$meses = array(1 => "JAN", 2 =>"FEV", 3 =>"MAR", 4 => "ABR", 5 => "MAI", 6 => "JUN", 7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT", 11 => "NOV", 12 => "DEZ");
  				while($obj = pg_fetch_object($resultado)){						
					$tituloEvento = substr($obj->cal_titulo,0,55);
					if(strlen($tituloEvento) == 55){
						$tituloEvento=$tituloEvento."...";
					}							
					$idEvento 	  = $obj->cal_id;
					$data 		  = "<h2>".date("d", strtotime($obj->cal_data))."</h2>&nbsp;<h4>".$meses[date("n", strtotime($obj->cal_data))]."</h4>"; 
					$tituloEvento = str_replace($convert_from, $convert_to, $tituloEvento);
					$TcalImp	 .= "<li><div class=\"data\">".$data."</div><a href=\"".$obj->cal_evento."\">".strtolower($tituloEvento)."</a><br class=\"clearfloat\" /></li>";
		   		}
				?> 
                <label>CALENDÁRIO DA PREFEITURA</label>
     			<ul><?=$TcalImp?></ul>
     			<a href="noticias/index.php?pagina=calendario" class="botao"><span style="color:#000;">calend&aacute;rio completo</span></a>
        	</div><!-- fim do bloco-calendario -->      
        	<div id="bloco-3-destaques">
            	<ul>
            		<?php
					//-----------------------------------------------------------------------
					// Armazena od IDS das notícias diagramadas para não exibir em +NOTÍCIAS
					//-----------------------------------------------------------------------
					$noticias_home = "0"; 
												
					//--------------------------------------------------------
					// Monta as notícias de 1º nível (horizontais superiores)
					//--------------------------------------------------------
					$sql 		= "SELECT * FROM config_manchetes WHERE man_entidade_id = 0";
					$result		= $drive->pedido($sql);
					$V_manchete = pg_fetch_object($result);   

					for($i=0; $i<3; $i++){
						switch ($i) {
							case 0: $notId = $V_manchete->man_noti_1; break;
							case 1:	$notId = $V_manchete->man_noti_2; break;
							case 2: $notId = $V_manchete->man_noti_3; break;
						}    
						$sql = "SELECT 
									editorias.edit_nome, 
									noticias.noti_id,
									noticias.noti_data, 
									noticias.noti_manchete, 
									noticias.noti_titulo, 
									imagens.img_link_v_pequena,
									imagens.img_legenda,
									noticias_imagens.nimg_principal
								FROM((
									noticias 
								INNER JOIN 
									editorias 
								ON 
									noticias.noti_edit_id = editorias.edit_id) 						
								INNER JOIN 
									noticias_imagens 
								ON 
									noticias.noti_id = noticias_imagens.nimg_noti_id) 
								INNER JOIN 
									imagens 
								ON 
									noticias_imagens.nimg_img_id = imagens.img_id
								WHERE
									noticias.noti_id = $notId AND noticias_imagens.nimg_principal = 't'
								";

						$result 		= $drive->pedido($sql);
						$V_noticias 	= pg_fetch_object($result);                                                           
						$noticias_home .=  ",".($V_noticias->noti_id); 
						?>        
						<li>
							<a href="noticias/index.php?pagina=notpagina&noti=<?=$V_noticias->noti_id?>">
							<img src="<?=$V_noticias->img_link_v_pequena?>" /></a>
							<span><?=$V_noticias->edit_nome?></span>&nbsp;<?=transformaData($V_noticias->noti_data)?><br />
							<a href="noticias/index.php?pagina=notpagina&noti=<?=$V_noticias->noti_id?>"><?php echo(subString(strip_tags(html_entity_decode($V_noticias->noti_titulo)),75));?></a>
						</li>   
					<?php
                    } 
                    ?>            
            	</ul>        
        	</div><!-- fim do bloco-3-destaques (notícias principais 1º nível) --> 
            <div id="bloco-5-lista">
				<ul>
					<?php 
                    //---------------------------------------------------
                    // Monta as notícias de 3º nível (verticais direita)
                    //---------------------------------------------------
                    for($i=0; $i<3; $i++){                                    
                        switch ($i) {
                            case 0: $notId = $V_manchete->man_noti_8; break;
                            case 1:	$notId = $V_manchete->man_noti_9; break;
                            case 2: $notId = $V_manchete->man_noti_10; break;
                        }					
                        $sql =" SELECT 
                                    noticias.noti_id, 
                                    noticias.noti_manchete, 
                                    noticias.noti_data, 
                                    noticias.noti_titulo, 
                                    editorias.edit_nome
                                FROM 
                                    noticias 
                                INNER JOIN 
                                    editorias 
                                ON 
                                    noticias.noti_edit_id = editorias.edit_id
                                WHERE
                                    noticias.noti_id = $notId
                                ";
                        
                        $result = $drive->pedido($sql);
                        $V_noticias = pg_fetch_object($result);						
                        $noticias_home .=  ",".($V_noticias->noti_id);					
                        ?> 
                        <li>
                            <span><?php echo($V_noticias->edit_nome);?> - <?=transformaData($V_noticias->noti_data)?></span>
                            <a href="noticias/index.php?pagina=notpagina&noti=<?=$V_noticias->noti_id?>">
                            <?php echo (subString(strip_tags(html_entity_decode($V_noticias->noti_titulo)), 60));?></a>
	                    </li>                    
					<?php
                    } 
                    ?>	
            	</ul>
        	</div><!-- fim do bloco-5-lista (notícias verticais 3º nível) -->     
        	<div id="bloco-4-destaques">
        		<ul>
        			<?php 
					//-------------------------------
					// Monta as notícias de 2º nível 
					//-------------------------------
					for($i=0; $i<4; $i++){			
						switch ($i) {
							case 0: $notId = $V_manchete->man_noti_4; break;
							case 1:	$notId = $V_manchete->man_noti_5; break;
							case 2: $notId = $V_manchete->man_noti_6; break;
							case 3: $notId = $V_manchete->man_noti_7; break;
						}    
						$sql = "SELECT 
									editorias.edit_nome, 
									noticias.noti_id, 
									noticias.noti_data, 
									noticias.noti_manchete, 
									noticias.noti_titulo,
									imagens.img_legenda, 
									imagens.img_link_v_pequena
								FROM((
									noticias 
								INNER JOIN 
									editorias 
								ON 
									noticias.noti_edit_id = editorias.edit_id) 						
								INNER JOIN 
									noticias_imagens 
								ON 
									noticias.noti_id = noticias_imagens.nimg_noti_id) 
								INNER JOIN 
									imagens 
								ON 
									noticias_imagens.nimg_img_id = imagens.img_id
								WHERE
									noticias.noti_id = $notId
								AND
									noticias_imagens.nimg_principal = 't'
								";                
						$result			= $drive->pedido($sql);
						$V_noticias 	= pg_fetch_object($result);                                 
						$noticias_home .=  ",".($V_noticias->noti_id);                                    
						?>     
						<li class="li-inicio">
                        	<?=transformaData($V_noticias->noti_data)?><br />
							<a href="noticias/index.php?pagina=notpagina&noti=<?=$V_noticias->noti_id?>">
							<img src="<?=$V_noticias->img_link_v_pequena?>" border="0" class="element_float" /></a>
							<span><?=$V_noticias->edit_nome?></span><br />
							<a href="noticias/index.php?pagina=notpagina&noti=<?=$V_noticias->noti_id?>">
									<?php echo (subString(strip_tags(html_entity_decode($V_noticias->noti_titulo)),90)) ;?>                       
							</a>
						</li>
					<?php
					}
					?>		
            	</ul>            
        	</div><!-- fim do bloco-4-destaques (notícias com fotos 2º nível) -->
            <div id="bloco-5-lista-lateral">
            	<br>
            	<label>&uacute;ltimas not&iacute;cias</label>
        		<ul>
            		<?php
					//--------------------------------------------------
					// Monta as notícias de 4º nível - Últimas notícias
					//--------------------------------------------------
					$sql =" SELECT 
							noticias.noti_id, 
							noticias.noti_manchete, 
							noticias.noti_data, 
							noticias.noti_titulo, 
							editorias.edit_nome
						FROM 
							noticias 
						INNER JOIN 
							editorias 
						ON 
							noticias.noti_edit_id = editorias.edit_id
						WHERE
							noticias.noti_status = 't'								
						ORDER BY 
							noticias.noti_data DESC LIMIT 6";	
					$result = $drive->pedido($sql);
					$primeiro = true;
					while($V_noticias = pg_fetch_object($result)) { 
					?>
						<li <?php if($primeiro) { echo("class=\"li-inicio\"");} ?>>
						<span><?php echo($V_noticias->edit_nome);?> - <?=transformaData($V_noticias->noti_data)?></span>
						<a href="noticias/index.php?pagina=notpagina&noti=<?=$V_noticias->noti_id?>">
							<?php echo (subString(strip_tags(html_entity_decode($V_noticias->noti_titulo)), 90));?></a>
						</li>		
					<?php
						$primeiro = false;  
					}
					?>
                    <li><a href="./noticias/index.php?pagina=notultimas&menu=2" class="botao">mais not&iacute;cias</a></li>
	            </ul>
        	</div><!-- fim do bloco-5-lista (ultimas notícias)-->
        	<div id="bloco-curiosidades">
        		<label>voc&ecirc; sabia que Florianópolis...</label>
        		<ul>
                    <?php
                    $Tvcsabia = array(				
					"<li><strong>É a capital com o melhor Índice de Desenvolvimento Humano do Brasil.</strong><br>Fonte: ONU</li>",
					"<li><strong>É a capital com maior renda per capita por domicílio.</strong><br>Fonte: IBGE – CENSO 2010</li>",
					"<li><strong>É a capital com menor taxa de analfabetismo no Brasil.</strong><br>Fonte: IBGE 2010/ Secretaria Municipal de Educação</li>",
					"<li><strong>Possui a segunda menor taxa de homicídios entre as capitais.</strong><br>Fonte: Mapa da Violência – Instituto Sangari (2011)</li>",
					"<li><strong>Está entre as dez cidades mais dinâmicas do mundo.</strong><br>Fonte: Newsweek</li>",
					"<li><strong>É a cidade brasileira que mais enriqueceu nas últimas três décadas.</strong><br>Fonte: IBGE</li>",
					"<li><strong>Está entre as dez melhores cidades do Brasil para trabalhar.</strong><br>Fonte: EXAME</li>",
					"<li><strong>É uma das dez melhores cidades para fazer negócios.</strong><br>Fonte: EXAME</li>",
					"<li><strong>É um dos principais pólos tecnológicos do país. São 500 empresas e faturamento de R$ 1 bilhão.</strong><br>Fonte: Secretaria Municipal de Ciência e Tecnologia</li>",
					"<li><strong>Recebeu o Prêmio Top of Mind por três anos consecutivos: 2009, 2010 e 2011, como cidade da tecnologia da informação em Santa Catarina.</strong><br>Fonte: ADVB-SC</li>",
					"<li><strong>É a primeira capital do Brasil e a terceira cidade do país no ranking de inclusão digital.</strong><br>Fonte: Fundação Getúlio Vargas</li>",
					"<li><strong>É a segunda cidade brasileira que mais receberá visitantes estrangeiros no verão 2011/2012.</strong><br>Fonte: Ministério do Turismo</li>",
					"<li><strong>Realiza mais de 1,7 milhão de atendimentos por ano nos centros de saúde e outros 600 mil nas policlínicas e UPAs.</strong><br>Fonte: Secretaria Municipal da Saúde</li>",
					"<li><strong>É a terceira cidade brasileira que mais recebe eventos internacionais e o terceiro destino de turismo de lazer.</strong><br>Fonte: Associação Internacional de Congressos e Convenções (ICCA)</li>",
					"<li><strong>É a terceira capital com maior número de médicos por habitantes.</strong><br>Fonte: CFM/IBGE - Pesquisa Demografia Médica no Brasil, 2011</li>",
					"<li><strong>Possui uma das menores taxas de mortalidade infantil do país.</strong><br>Fonte: Secretaria Municipal de Saúde</li>",
					"<li><strong>Está no topo do ranking das cidades com os empreendedores mais bem-sucedidos.</strong><br>Fonte: Fundação Getúlio Vargas</li>",
					"<li><strong>É a terceira capital do país em qualidade do atendimento do Sistema Único de Saúde (SUS).</strong><br>Fonte: Ministério da Saúde</li>",
					"<li><strong>É a cidade do número 1 no Brasil em plantio de árvores, e está entre as 10 mais do mundo.</strong><br>Fonte: C40 São Paulo Summit</li>",
					"<li><strong>Foi tricampeã dos jogos abertos de Santa Catarina 2009-2010-2011.</strong><br>Fonte: Fundação Municipal de Esportes</li>",
					"<li><strong>Foi a cidade catarinense que mais realizou investimentos no ano de 2010.</strong><br>Fonte: Anuário Multi Cidades</li>",
					"<li><strong>É a segunda cidade do Brasil em maior prevalência em Aleitamento Materno Exclusivo.</strong><br>Fonte: Secretaria Municipal da Saúde</li>",				
					"<li><strong>Recebeu, de 2005 a 2012, o Selo Prefeito Amigo da Criança pela atuação para a garantia dos direitos de crianças e adolescentes.</strong><br>Fonte: Fundação Abrinq</li>",
					"<li><strong>Foi a cidade catarinense que mais realizou investimentos no ano de 2010.</strong><br>Fonte: Anuário Multi Cidades</li>",
					"<li><strong>Está entre as  dez cidades mais criativas do Brasil.</strong><br>Fonte: FecomércioSP</li>",
					"<li><strong>É a capital líder na alimentação saudável e na prática de exercícios do país.</strong><br>Fonte: Ministério da Saúde - Pesquisa Vigitel 2011</li>",
					"<li><strong>É a capital com o melhor IDEB do primeiro ano ao quinto ano.</strong><br>Fonte: Ministério da Educação 2012</li>");

					shuffle($Tvcsabia);
					for($i=0; $i<3; $i++){
						echo($Tvcsabia[$i]);	
					}					
					?>
        		</ul>
        	</div><!-- fim do bloco-curiosidades -->
       		<div id="bloco-banners">
        		<img border="0" src="layout/imagens/cap_inova.png">   
	        </div><!-- fim do bloco-banner -->      
        	
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
