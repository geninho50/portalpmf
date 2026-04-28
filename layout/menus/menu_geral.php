<?php
	// include_once("../../analyticstracking.php");
	include(CAMINHO_SITE."/layout/themePMF/includes/header.php");

	if( !isset( $menu_principal ) ){
		$menu_principal = "";
	}

	$urlHost = $_SERVER['HTTP_HOST'];
	//-------------------------------------------------------------
	// Mini-header
	//-------------------------------------------------------------
	

	if(($menu_principal != "intranet") && ($menu_principal != "internet")){
			require_once(CAMINHO_SITE."/scripts/php/security.php");
		?>
		<div class="mini-header" id="miniheader" >
	    <ul class="mini-header__items">
	      <li style="margin-right:10px"><a href="https://<?php echo($urlHost);?>/intranet/index.php" target="_self">Intranet</a></li>		
		  <li style="margin-right:10px"><a href="#">|</a></li> 
	      <li style="margin-right:10px"><a href="https://contatos.pmf.sc.gov.br" target="_blank">Contatos</a></li>		
		  <li style="margin-right:10px"><a href="#">|</a></li>  
	      <li style="margin-right:10px"><a href="https://<?php echo($urlHost);?>/sites/portaldoservidor">Portal do servidor</a></li>
		  <li style="margin-right:10px"><a href="#">|</a></li> 		 
		 <!--
		  <li><a  id="bannerAbertura" target="_blank" href="https://covidometrofloripa.com.br/" ><b>comunicado de <br>incidente de seguran&Ccedil;a</b></a></li>
		  <li class="mini-header__social" ><a href="https://www.pmf.sc.gov.br/entidades/sadm/index.php?cms=contratacoes+e+aquisicoes+da+lei+no++13+979+2020&menu=0"><b>Dispensas de Licitação nas Ações de Enfrentamento ao CORONAVÝRUS</b></a></li>
		  <li class="mini-header__social" >
		    <a href="https://www.pmf.sc.gov.br/entidades/sadm/index.php?cms=pregoes+e++editais+de+chamamento+da+covid+19"><b>Pregões Eletrônicos simplificados - Lei nº 13.979/2020</b></a></li>
		  <li><a href="http://portaldocidadao.pmf.sc.gov.br/PMFSite/">Portal do Cidad&atilde;o</a></li>
		-->
	      <li style="margin-right:10px"><a href="https://www.pmf.sc.gov.br/email.html" target="_blank">Webmail</a></li>
		  <li style="margin-right:10px"><a href="#">|</a></li> 
		  <li style="margin-right:10px"><a href="https://cigaobras.pmf.sc.gov.br/portalTransparencia/#/89" target="_blank">Mapa de Obras</a></li>
		  <!-- <li style="margin-right:10px"><a href="http://obrasgov.pmf.sc.gov.br/obras-gov-map/#/map" target="_blank">Mapa de Obras</a></li>		   -->
		  <li style="margin-right:10px"><a href="#">|</a></li> 
		  <li style="margin-right:10px"><a href="https://www.floripanoponto.com.br/" target="_blank">Floripa no Ponto</a></li>
		  <li style="margin-right:10px"><a href="#">|</a></li> 
	        <!--<li><a href="https://www.pmf.sc.gov.br/temporeal/" target="_blank">Floripa em Tempo Real</a></li>-->
	      <li style="margin-right:10px">
		  <a href="https://somarfloripa.com/" target="_blank">Somar Floripa</a>
		  </li>
		  <li style="margin-right:10px"><a href="#">|</a></li> 
		  <li style="margin-right:10px">
		  <a href="https://transparencia.e-publica.net/epublica-portal/#/florianopolis/portal?entidade=2002" target="_blank">Dados Abertos</a>
		  </li>
		  <li style="margin-right:10px"><a href="#">|</a></li> 
		  <li style="margin-right:10px">
		  <a href="https://www.pmf.sc.gov.br/ouvidoria/index.php" target="_blank">Acesso à Informação e Denúncias</a>
		  </li>
		  <li style="margin-right:10px"><a href="#">|</a></li> 
		  <li style="margin-right:10px">
		  <a href="https://leismunicipais.com.br/estatuto-do-servidor-funcionario-publico-florianopolis-sc" target="_blank"> Estatuto do Servidor</a>
		  </li>		  		  		  
		  <li style="margin-right:10px"><a href="#">|</a></li> 
		  <li style="margin-right:10px">
			<a  >Acessibilidade</a>
			<a href="#" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
			<a href="#" id="btnMais" >&nbsp;&nbsp;<strong>A+</strong>&nbsp;</a>		  
			<a href="#" id="btnMenos" >&nbsp;<strong>A-</strong>&nbsp;&nbsp;</a>
			<a href="#" onclick="funcContraste();" >&nbsp;&nbsp;<strong>Contraste</strong>&nbsp;&nbsp;</a>
		  </li>		  		  		  		  
          <!-- <a href="#" id="btnZerar" >&nbsp;&nbsp;<strong>Normal</strong>&nbsp;&nbsp;</a> -->
		  
	    </ul>
	    <ul class="mini-header__social">
	    	<li>Siga a prefeitura</li>
			<li><a href="https://www.facebook.com/prefeituradeflorianopolis/" target="_blank" alt="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
			<li><a href="https://www.instagram.com/prefflorianopolis/" target="_blank" alt="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			<li><a href="https://www.youtube.com/playlist?list=PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU" target="_blank" alt="Youtube"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
		 	<li><a href="https://twitter.com/scflorianopolis" target="_blank" alt="Twitter"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li> 
	    </ul>
	  </div>

	<?php
	}
?>

<?php
//-------------------------------------------------------------
// Header
//-------------------------------------------------------------
 ?>

<div class="header">
  <div class="header__brand">
  	<a href="https://<?php echo($urlHost);?>">
  		<img src="https://<?php echo($urlHost);?>/layout/imagens/marca-pmf.svg">
  	</a>
	</div>

<?php if(($menu_principal == "intranet") || ($menu_principal == "internet")) {  ?>
	<ul class="header__nav header__intranet">
		<?php
			$TuserId 	  = $_SESSION['SuserId'];
			$sqlEntidades = "SELECT PERM.*, 
			                        ENT.* 
							   FROM intranet_permissoes AS PERM 
					     INNER JOIN entidades AS ENT 
						    ON PERM.intranet_entidade_id = ENT.entidade_id 
					          WHERE PERM.intranet_user_id = $TuserId 
							ORDER BY ENT.entidade_tipo ASC, ENT.entidade_linha_1";
			
			$TresultEnt	  = $drive->pedido($sqlEntidades);			
			$i 			  = 0;
			if( !is_null( $TresultEnt ) ){			
				while ($Tentidades = pg_fetch_object($TresultEnt)){
					$TentidadeId[$i] 	= $Tentidades->entidade_id;
					$TentidadeNome[$i] 	= $Tentidades->entidade_linha_1;
					$TentidadeTipo[$i]	= $Tentidades->entidade_tipo;
					$TentidadeLink[$i]	= $Tentidades->entidade_link;
					$i++;
				}
			}else{
				$TentidadeId[$i] 	= '';
				$TentidadeNome[$i] 	= '';
				$TentidadeTipo[$i]	= '';
				$TentidadeLink[$i]	= '';
			}
		?>
		<li><p>Olá, <?=utf8_encode($_SESSION['SuserNome'])?></p></li>
		<li>
			<form action="inicio.php" method="post">
				<div class="input-wrapper">
	            <select name="entid_intranet" onchange="this.form.submit();">
	                <?php
	                if (in_array(0,$TentidadeTipo)){
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp;=== Prefeitura === </option>
	                    <?php
	                    for($j=0; $j<count($TentidadeId); $j++){
	                        if($TentidadeTipo[$j] == 0){
	                            echo "<option value=\"".$TentidadeId[$j]."\"";
	                            if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
	                                echo " selected=\"selected\" ";
	                            }
	                            echo ">".$TentidadeNome[$j]."</option>";
	                        }
	                    }
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>
	                    <?php
	                }
	                 if (in_array(4,$TentidadeTipo)){
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp=== Secretarias Municipais ===</option>
	                    <?php
	                    for($j=0; $j<count($TentidadeId); $j++){
	                        if($TentidadeTipo[$j] == 4){
	                            echo "<option value=\"".$TentidadeId[$j]."\"";
	                            if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
	                                echo " selected=\"selected\" ";
	                            }
	                            echo ">".$TentidadeNome[$j]."</option>";
	                        }
	                    }
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>
	                    <?php
	                }
	                if (in_array(5,$TentidadeTipo)){
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp;=== Secretarias Executivas === </option>
	                    <?php
	                    for($j=0; $j<count($TentidadeId); $j++){
	                        if($TentidadeTipo[$j] == 5){
	                            echo "<option value=\"".$TentidadeId[$j]."\"";
	                            if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
	                                echo " selected=\"selected\" ";
	                            }
	                            echo ">".$TentidadeNome[$j]."</option>";
	                        }
	                    }
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>
	                    <?php
	                }

	                if (in_array(8,$TentidadeTipo)){
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp;=== Subsecretarias === </option>
	                    <?php
	                    for($j=0; $j<count($TentidadeId); $j++){
	                        if($TentidadeTipo[$j] == 8){
	                            echo "<option value=\"".$TentidadeId[$j]."\"";
	                            if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
	                                echo " selected=\"selected\" ";
	                            }
	                            echo ">".$TentidadeNome[$j]."</option>";
	                        }
	                    }
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>
	                    <?php
	                }

	                if (in_array(9,$TentidadeTipo)){
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp;=== Conselhos === </option>
	                    <?php
	                    for($j=0; $j<count($TentidadeId); $j++){
	                        if($TentidadeTipo[$j] == 9){
	                            echo "<option value=\"".$TentidadeId[$j]."\"";
	                            if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
	                                echo " selected=\"selected\" ";
	                            }
	                            echo ">".$TentidadeNome[$j]."</option>";
	                        }
	                    }
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>
	                    <?php
	                }

	                if (in_array(6,$TentidadeTipo)){
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp=== Org&atilde;os ===</option>
	                    <?php
	                    for($j=0; $j<count($TentidadeId); $j++){
	                        if($TentidadeTipo[$j] == 6){
	                            echo "<option value=\"".$TentidadeId[$j]."\"";
	                            if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
	                                echo " selected=\"selected\" ";
	                            }
	                            echo ">".$TentidadeNome[$j]."</option>";
	                        }
	                    }
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>
	                    <?php
	                }

	                if (in_array(7,$TentidadeTipo)){
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> &nbsp;&nbsp=== Eventos ===</option>
	                    <?php
	                    for($j=0; $j<count($TentidadeId); $j++){
	                        if($TentidadeTipo[$j] == 7){
	                            echo "<option value=\"".$TentidadeId[$j]."\"";
	                            if($_SESSION['SuserEnt'] == $TentidadeId[$j]){
	                                echo " selected=\"selected\" ";
	                            }
	                            echo ">".$TentidadeNome[$j]."</option>";
	                        }
	                    }
	                    ?>
	                    <option value="<?=$_SESSION['SuserEnt']?>"> </option>
	                    <?php
	                }
	                ?>
	            </select>
	    </form>
		</li>
		<li><a href="../intranet/logout.php" target="_self">Logout</a></li>
	</ul>
	<?php } else { ?>
	<ul class="header__nav">

		<a href="#" class="header__nav-close">
			<span></span>
			<span></span>
			Fechar
		</a>

		<li class="has-submenu">
			<a href="https://<?php echo($urlHost);?>/servicos/index.php">Carta de Serviços</a>
			<div class="header__submenu">
				<div class="header__submenu-tier-1">
					<h4>Serviços</h4>
					<a href="#" data-target="todos-os-servicos" class="has-second-tier active">Todos os serviços</a>
					<a href="#" data-target="mais-acessados" class="has-second-tier">Mais acessados</a>
					<a href="#" data-target="por-secretaria" class="has-second-tier">Por secretaria</a>
					<a href="#" data-target="por-assunto" class="has-second-tier">Por assunto</a>
					<a href="<?=CONSULTA_PROCESSO_MENU?>" class="consulta-de-processos">Consulta online de processos</a>
				</div>
				<div data-parent="todos-os-servicos" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<h4>Todos os serviços</h4>
					<ul>
						<?php
							$queryTodosServicos = "SELECT servicos.serv_nome, servicos.serv_id, servicos.serv_link, servicos.serv_abrir_interno FROM servicos WHERE serv_status ='t' AND serv_flag_online ='t' LIMIT 12;";
							$result = $drive->pedido($queryTodosServicos);
							if( !is_null( $result) ){
								while($serv = pg_fetch_object($result)) {
									echo("<li><a href=\"https://$urlHost/servicos/index.php?pagina=servpagina&id=$serv->serv_id\">". html_entity_decode($serv->serv_nome)."</a></li>");
								}
							}
						?>
					</ul>
					<a class="orange" href="https://<?php echo($urlHost);?>/servicos/index.php?pagina=servonline">Ver todos os serviços</a>
				</div>
				<div data-parent="mais-acessados" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<h4>Mais acessados</h4>
					<ul>
						<?php
							$queryMaisAcessados = "SELECT * FROM servicos WHERE servicos.serv_status = 't' AND servicos.serv_acessos <> 0 ORDER BY servicos.serv_acessos DESC LIMIT 12";
							$result = $drive->pedido($queryMaisAcessados);
							if( !is_null( $result) ){
								while($serv = pg_fetch_object($result)) {
										echo("<li><a href=\"https://$urlHost/servicos/index.php?pagina=servpagina&id=$serv->serv_id\">$serv->serv_nome</a></li>");
								}
							}
						?>
					</ul>
				</div>
				<div data-parent="por-secretaria" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<h4>Por secretaria</h4>
					<ul>
						<?php
							$queryPorSecretaria = "SELECT entidade_id, entidade_path, entidade_nome, entidade_tipo, entidade_linha_1, entidade_flag_site FROM entidades WHERE entidade_tipo IN (4,5) AND entidade_flag_site = 1 ORDER BY entidade_linha_1";
							$result = $drive->pedido($queryPorSecretaria);
							if( !is_null( $result) ){
								while($entidade = pg_fetch_object($result)) {
									echo("<li><a href=\"https://$urlHost/servicos/index.php?pagina=servsecretaria&idSecretaria=$entidade->entidade_id\">$entidade->entidade_linha_1</a></li>");
								}
							}
						?>
					</ul>
				</div>
				<div data-parent="por-assunto" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<h4>Por assunto</h4>
					<ul>
						<?php
							$queryPorCategoria = "SELECT categorias.* 
							                        FROM categorias 													
													JOIN servicos 
													  on servicos.serv_categoria_cidadao = categorias.cat_id 
													  or servicos.serv_categoria_empresa = cat_id

					    						GROUP BY categorias.cat_id, categorias.cat_nome, categorias.cat_banner, categorias.cat_banner_titulo, categorias.cat_banner_descricao
					    						ORDER BY (
													    	SELECT SUM(serv_acessos) 
															  FROM servicos
					    	                                 WHERE servicos.serv_categoria_cidadao = categorias.cat_id 
															    OR servicos.serv_categoria_empresa = categorias.cat_id )  DESC  LIMIT 12";

							$result = $drive->pedido($queryPorCategoria);
							if( !is_null( $result) ){
								while($cat = pg_fetch_object($result)) {
									echo("<li><a href=\"https://$urlHost/servicos/index.php?pagina=servcategoria&id=$cat->cat_id\">$cat->cat_nome</a></li>");
								}
							}
						?>
					</ul>
				</div>
			</div>
		</li>

		<li>
			<a href="https://<?php echo($urlHost);?>/governo/index.php?pagina=goveditais">Editais</a>
		</li>

		<li>
			<a target="_blank" href="https://transparencia.e-publica.net/epublica-portal/#/florianopolis/portal/compras/licitacaoTable?entidade=2002">Licita&ccedil;&otilde;es</a>
		</li>

		<li class="has-submenu">
			<a href="#">Prefeitura</a>
			<div class="header__submenu">
				<div class="header__submenu-tier-2 open">
					<ul>
						<li><a href="https://<?php echo($urlHost);?>/governo/index.php?pagina=govestrutura">Estrutura Organizacional</a></li>
						<!-- <li><a href="https://<?php echo($urlHost);?>/governo/index.php?pagina=govquem">Contatos</a></li> -->
						<li><a href="https://contatos.pmf.sc.gov.br/">Contatos</a></li>
						<li><a href="https://<?php echo($urlHost);?>/entidades/fazenda/index.php?cms=pro+cidadao&menu=4&submenuid=1968">Pró-Cidadão</a></li>
						<li><a href="https://leismunicipais.com.br/prefeitura/sc/florianopolis/">Leis Municipais</a></li>
						<li><a href="https://www.floripanoponto.com.br/" target="_blank">Floripa no Ponto</a></li>
						<!--<li><a href="https://floripamaisempregos.santacatarinapelaeducacao.com.br/" target="_blank">Floripa mais Emprego</a></li>-->
						 <li><a href="https://<?php echo($urlHost);?>/ouvidoria/index.php">Ouvidoria</a></li>
					</ul>
				</div>
			</div>
		</li>

		<li class="has-submenu"> 
			<a href="#">Estrutura</a>
			<div class="header__submenu">
				<div class="header__submenu-tier-1">
					<!--<h4>Secretarias, Superintend&ecirc;ncia, Conselhos e Órgãos</h4>
					<h4>Estrutura</h4>-->
					<a href="#" data-target="a-prefeitura" class="has-second-tier active">A Prefeitura</a>
					<a href="#" data-target="secretarias" class="has-second-tier">Secretarias</a>
					<a href="#" data-target="e-secretarias" class="has-second-tier">Secretarias Executivas</a>
					<a href="#" data-target="superintendencia" class="has-second-tier">Subsecretarias</a>
					<a href="#" data-target="conselhos" class="has-second-tier">Conselhos</a>
					<a href="#" data-target="orgaos" class="has-second-tier">Órgãos</a>
				</div>
				<div data-parent="a-prefeitura" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$queryAPrefeitura = "SELECT entidade_path, 
							                            entidade_nome, 
														entidade_tipo, 
														entidade_linha_1, 
														entidade_flag_site,
														entidade_link 
												   FROM entidades 
												  WHERE entidade_tipo = 0 
												    AND entidade_flag_site = 1
											   ORDER BY entidade_linha_1";

							$result = $drive->pedido($queryAPrefeitura);
							if( !is_null( $result) ){
								while ($entidade = pg_fetch_object($result)) {
									if( $entidade->entidade_link != "" ){
										$link = $entidade->entidade_link;
									} else {
										$link = "https://$urlHost/entidades/$entidade->entidade_path/index.php";
									}
									echo("<li><a href=\"$link\">$entidade->entidade_nome</a></li>");
								}
							}
						 ?>
					</ul>
				</div>
				<div data-parent="secretarias" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$querySecPorSecretaria = "SELECT entidade_path, 
							                                 entidade_nome, 
															 entidade_tipo, 
															 entidade_linha_1, 
															 entidade_flag_site 
														FROM entidades 
													   WHERE entidade_tipo = 4 
													     AND entidade_flag_site = 1 
												    ORDER BY entidade_linha_1";

							$result = $drive->pedido($querySecPorSecretaria);
							if( !is_null( $result) ){
								while($entidade = pg_fetch_object($result)) {
									echo("<li><a href=\"https://$urlHost/entidades/$entidade->entidade_path/index.php\">$entidade->entidade_linha_1</a></li>");
								}
							}
						?>
					</ul>
				</div>
				<div data-parent="e-secretarias" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$querySecPorSecretaria = "SELECT entidade_path, 
							                                 entidade_nome, 
															 entidade_tipo, 
															 entidade_linha_1, 
															 entidade_flag_site 
														FROM entidades 
													   WHERE entidade_tipo = 5 
													     AND entidade_flag_site = 1 
													ORDER BY entidade_linha_1";

							$result = $drive->pedido($querySecPorSecretaria);
							if( !is_null( $result) ){
								while($entidade = pg_fetch_object($result)) {
									echo("<li><a href=\"https://$urlHost/entidades/$entidade->entidade_path/index.php\">$entidade->entidade_linha_1</a></li>");
								}
							}
						?>
					</ul>
				</div>
				<div data-parent="superintendencia" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$querySecPorSecretaria = "SELECT entidade_path, 
							                                 entidade_nome, 
															 entidade_tipo,
															 entidade_linha_1, 
															 entidade_flag_site, 
															 entidade_link 
													    FROM entidades 
													   WHERE entidade_tipo = 8 
													     AND entidade_flag_site = 1
												    ORDER BY entidade_linha_1";

							$result = $drive->pedido($querySecPorSecretaria);
							if( !is_null( $result) ){
								while($entidade = pg_fetch_object($result)) {

									$link = "https://$urlHost/entidades/$entidade->entidade_path/index.php";
									if( $entidade->entidade_link != "" ){
										$link = $entidade->entidade_link;
									}
									echo("<li><a href=\"$link\">$entidade->entidade_linha_1</a></li>");
								}
							}
						?>
					</ul>
				</div>				
				<div data-parent="conselhos" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$querySecPorSecretaria = "SELECT entidade_path, 
							                                 entidade_nome, 
															 entidade_tipo, 
															 entidade_linha_1, 
															 entidade_flag_site, 
															 entidade_link 
														FROM entidades 
													   WHERE entidade_tipo = 9 
													     AND entidade_flag_site = 1 
												    ORDER BY entidade_linha_1";

							$result = $drive->pedido($querySecPorSecretaria);
							if( !is_null( $result) ){
								while($entidade = pg_fetch_object($result)) {
									$link = "https://$urlHost/entidades/$entidade->entidade_path/index.php";
									if( $entidade->entidade_linha_1 == "" ){
										$link = $entidade->entidade_link;
									}
									echo("<li><a href=\"$link\">$entidade->entidade_linha_1</a></li>");								}
							}
						?>
					</ul>
				</div>
				<div data-parent="orgaos" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$querySecPorOrgaos = "SELECT entidade_path, 
							                             entidade_nome, 
														 entidade_tipo, 
														 entidade_linha_1, 
														 entidade_flag_site,
														 entidade_link 
													FROM entidades 
												   WHERE entidade_tipo = 6 
												     AND ( entidade_flag_site = 1 or entidade_link IS NOT NULL)
											    ORDER BY entidade_linha_1";

							$result = $drive->pedido($querySecPorOrgaos);
							if( !is_null( $result) ){
								while($entidade = pg_fetch_object($result)) {
									if( $entidade->entidade_link != "" ){
										$link = $entidade->entidade_link;
									} else {
										$link = "https://$urlHost/entidades/$entidade->entidade_path/index.php";
									}
									echo("<li><a href=\"$link\">$entidade->entidade_nome</a></li>");
								}
							}
						?>
					</ul>
				</div>
			</div>
		</li>
		<li>
		
			 <a href="https://transparencia.e-publica.net/epublica-portal/#/florianopolis/portal?entidade=2002" target="_blank">Transpar&ecirc;ncia</a>
			 <!-- <a href="https://<?php echo($urlHost);?>/transparencia/index.php" target="_blank">Transpar&ecirc;ncia</a> -->
		</li>
		<?php if(($menu_principal != "intranet") && ($menu_principal != "internet")){  ?>
			<li class="mini-header__items-mobile">
				<ul>
				      <li><a href="https://<?php echo($urlHost);?>/intranet/index.php" target="_self">Intranet</a></li>
				      <!-- <li><a href="https://<?php echo($urlHost);?>/governo/index.php?pagina=govquem" target="_self">Contatos</a></li> -->
					  <li><a href="https://contatos.pmf.sc.gov.br/" target="_self">Contatos</a></li>
				      <li><a href="https://<?php echo($urlHost);?>/sites/portaldoservidor">Portal do Servidor</a></li>
					  <li class="mini-header__social" ><a href="https://www.pmf.sc.gov.br/entidades/sadm/index.php?cms=contratacoes+e+aquisicoes+da+lei+no++13+979+2020&menu=0"><b>Dispensas de Licitação nas Ações de Enfrentamento ao CORONAVÝRUS</b></a></li>
					  <li class="mini-header__social" >
		    <a href="https://www.pmf.sc.gov.br/entidades/sadm/index.php?cms=pregoes+e++editais+de+chamamento+da+covid+19" ><b>Pregões Eletrônicos simplificados - Lei nº 13.979/2020</b></a></li>

				      <!--<li><a href="http://portaldocidadao.pmf.sc.gov.br/PMFSite/">Portal do Cidadão</a></li>-->
				      <li><a href="https://www.pmf.sc.gov.br/email.html" target="_blank">Webmail</a></li>
					  <li><a href="http://portalrastreabilidade.pmf.sc.gov.br/obras-gov-map/#/map" target="_blank">Mapa de obras</a></li>
					  <li><a href="https://<?php echo($urlHost);?>/transparencia/index.php" target="_blank">Portal de transparência</a></li>
					  <!--<li><a href="https://www.pmf.sc.gov.br/temporeal/" target="_blank">Floripa em Tempo Real</a></li>-->
					  <li><a href="https://somarfloripa.com/" target="_blank">Somar Floripa</a></li>
		        </ul>
		  </li>
	 	<?php } ?>
        
		<li>
		    
			<a href="https://www.pmf.sc.gov.br/sistemas/consulta/parqueMarina/">Parque Urbano e Marina</a> 
			<!--
			 <a href="https://www.pmf.sc.gov.br/entidades/turismo/floripasimples/" target="_blank"><b>Floripa Simples</b></a>
		    -->
			<a href="https://florianopolis.prefeituras.net/login" target="_blank"><b>Aprova Digital</b></a>
		</li>
     
		<li>
		<!-- <a href="https://www.pmf.sc.gov.br/ouvidoria/">Ouvidoria</a> -->
		<a href="https://florianopolis.aprova.com.br/login" target="_blank"><b>Cadastro Habitacional</b></a>
		</li>
		
		<li>
			<a target="_blank" href="https://www.pmf.sc.gov.br/sistemas/procon/" alt="Facebook"><b>PROCON ONLINE</b></a>
		</li>
		<!--
		<li>
			<a href="https://www.pmf.sc.gov.br/entidades/gapre/index.php?cms=organizacoes+sociais&menu=4&submenuid=2028">Creche e Sa&uacute;de J&aacute;</a>
		</li>
		-->
		<li>
			<a href="http://proxximo.pmf.sc.gov.br/?mod=infotv.agendamento" target="_blank" alt="Facebook">
			<img src="https://www.pmf.sc.gov.br/entidades/fazenda/arquivos/agendamentoOnline.jpg" width="180px" height="80px" ></a>
		</li>		
       <!--
		<a href="https://www.pmf.sc.gov.br/entidades/fazenda/index.php?pagina=notpagina&menu=&noti=22571" alt="Facebook"><img src="https://www.pmf.sc.gov.br/entidades/fazenda/arquivos/bannerAgenda.png" width="240px" height="80px" ></a>			      
		<li>
			<a href="https://www.pmf.sc.gov.br/radio/" target="_blank" alt="Facebook"><img src="https://www.pmf.sc.gov.br/radio/images/logo_radio_colorido.png" width="60px" height="50px" ></a>
		</li>

		
		<li>
			<a href="http://florianopolis.fepese.org.br/">Concurso P&uacute;blico 2019</a>
		</li>
		
		<li>
			<a href="https://sites.google.com/view/gerve">
				 
				<img src="http://portal.pmf.sc.gov.br/arquivos/imagens/28_04_2020_16_49_248bc85fd0176681998d5aa3f1eb7964.jpg" width="50%" heigth = "50%" > 
			</a>
		</li>
		 -->

	  <li class="mini-header__social-mobile">
	    <ul>
	    	<li>Siga a prefeitura</li>
	      <li><a href="https://www.facebook.com/prefeituradeflorianopolis/" target="_blank" alt="Facebook"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
	      <li><a href="https://www.instagram.com/prefeituradeflorianopolis/" target="_blank" alt="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	      <li><a href="https://www.youtube.com/playlist?list=PLtMqi7ZE12w5VwBgpFv4-CTL4GGqeC6uU" target="_blank" alt="Youtube"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
	    </ul>
	  </li>
	</ul>
	<!--<ul class="header__secondary-nav">
		<li>Serviços para:</li>
		<li><a href="https://<?php echo($urlHost);?>/servicos/index.php?pagina=servcategoria&perfil=cidadao">Cidadão</a></li>
		<li><a href="https://<?php echo($urlHost);?>/servicos/index.php?pagina=servcategoria&perfil=empresa">Empresa</a></li>
	</ul>-->
	<a href="#" class="header__mobile-nav">
		<span></span>
		<span></span>
		<span></span>
	</a>
<?php } ?>
</div>

<script>
    let cliques = 0;
    let contraste = 0;

    //busca os botoes com esses ids
    document.getElementById("btnMais").addEventListener("click", function() {
        if(cliques < 3){ cliques++;}
        funcZoom(cliques);
        localStorage.setItem("Nzoom", cliques); // Salva zoom
    });
    document.getElementById("btnMenos").addEventListener("click", function() {
        if(cliques > 0){ cliques--;}
        funcZoom(cliques);
        localStorage.setItem("Nzoom", cliques);
    });
    document.getElementById("btnZerar").addEventListener("click", function() {
        cliques = 0;
        funcZoom(cliques);
        localStorage.setItem("Nzoom", cliques);
    });

    function funcZoom (cliques){ //adciona mudança de zoom ao body
        switch (cliques) {
            case 0:
                document.body.style.zoom = "1";
            break;
            case 1:
                document.body.style.zoom = "1.2";
            break;
            case 2:
                document.body.style.zoom = "1.5";
            break; 
            case 3:
                document.body.style.zoom = "1.7";
            break; 
        }
    }

  // novo metodo de ajuste de contraste, cada item da lista e um class que recebe o contraste
	function funcContraste () {

		// Lista de todas as classes que receberao o contraste
		var extraClasses = [
			'.mini-header',
			'.mini-header__items',
			'.header',
			'.search-bar',
			'.card',
			'.category-wrapper',
			'.btn-primary',
			'.blocks__item',
			'.proccess-check-wrapper',
			'.social-facebook',
			'.featured-events',
			'.featured-news__details',
			'.canal-pmf',
			'.social-instagram',
			'.rodape',
			'.info-block',
			'.blocks--home',
			'.vw-plugin-top-wrapper',
			'.category-list',
			'.flex-container',
			'.page-navigation',
			'.header__submenu',
			'.busca-home-field',
			'.has-image',
			'.has-submenu',
			'.hero-wrapper',
			'.category',
			'.featured-news__item',
			'.secondary-news__item',
			'#rodape',
			'#titulo_noticia',
			'#caminho_migalhas',
			'.arquivos-download'
		];

		if (contraste == 1) {
			extraClasses.forEach(cls => {
				document.querySelectorAll(cls).forEach(el => {
					el.classList.remove("contraste");
				});
			});

			contraste = 0;
		} else {
			extraClasses.forEach(cls => {
				document.querySelectorAll(cls).forEach(el => {
					el.classList.add("contraste");
				});
			});

			contraste = 1;
		}
	}

</script>