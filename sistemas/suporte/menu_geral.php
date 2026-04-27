<?php
	include_once("http://www.pmf.sc.gov.br/analyticstracking.php");
	include("header.php");
?>

<?php
	$urlHost = $_SERVER['HTTP_HOST'];
	//-------------------------------------------------------------
	// Mini-header
	//-------------------------------------------------------------
	if(($menu_principal != "intranet") && ($menu_principal != "internet")){
			require_once("../../scripts/php/security.php");
		?>
		<div class="mini-header">
	    <ul class="mini-header__items">
	      <li><a href="http://www.pmf.sc.gov.br/intranet/index.php" target="_self">Intranet</a></li>
	      <li><a href="http://www.pmf.sc.gov.br/governo/index.php?pagina=govquem" target="_self">Contatos</a></li>
	      <li><a href="http://www.pmf.sc.gov.br/sites/portalservidor">Portal do Servidor</a></li>
		  <!--<li><a href="http://portaldocidadao.pmf.sc.gov.br/PMFSite/">Portal do Cidad&atilde;o</a></li>-->
	      <li><a href="http://www.pmf.sc.gov.br/email.html" target="_blank">Webmail</a></li>
	      <li><a href="http://obrasgov.pmf.sc.gov.br/obras-gov-map/#/map" target="_blank">Mapa de obras</a></li>
	      <li><a href="https://www.floripanoponto.com.br/" target="_blank">Floripa no Ponto</a></li>
	      <li><a href="http://www.pmf.sc.gov.br/temporeal/" target="_blank">Floripa em Tempo Real</a></li>
	      <li><a href="http://somarfloripa.com/" target="_blank">Somar Floripa</a></li>
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
  	<a href="http://www.pmf.sc.gov.br">
  		<img src="http://www.pmf.sc.gov.br/layout/imagens/marca-pmf.svg">
  	</a>
	</div>

	<?php if(($menu_principal == "intranet") || ($menu_principal == "internet")) {  ?>
	<ul class="header__nav header__intranet">
		<?php
			$TuserId 	  = $_SESSION['SuserId'];
			$sqlEntidades = "SELECT PERM.*, ENT.* FROM intranet_permissoes AS PERM INNER JOIN entidades AS ENT ON PERM.intranet_entidade_id = ENT.entidade_id WHERE PERM.intranet_user_id = $TuserId ORDER BY ENT.entidade_tipo ASC, ENT.entidade_linha_1";
			$TresultEnt	  = $drive->pedido($sqlEntidades);
			$i 			  = 0;
			while ($Tentidades = pg_fetch_object($TresultEnt)){
				$TentidadeId[$i] 	= $Tentidades->entidade_id;
				$TentidadeNome[$i] 	= $Tentidades->entidade_linha_1;
				$TentidadeTipo[$i]	= $Tentidades->entidade_tipo;
				$i++;
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
			<a href="http://www.pmf.sc.gov.br/servicos/index.php">Carta de Serviços</a>
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
							while($serv = pg_fetch_object($result)) {
								echo("<li><a href=\"http://$urlHost/servicos/index.php?pagina=servpagina&id=$serv->serv_id\">". html_entity_decode($serv->serv_nome)."</a></li>");
							}
						?>
					</ul>
					<a class="orange" href="http://www.pmf.sc.gov.br/servicos/index.php?pagina=servonline">Ver todos os serviços</a>
				</div>
				<div data-parent="mais-acessados" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<h4>Mais acessados</h4>
					<ul>
						<?php
							$queryMaisAcessados = "SELECT * FROM servicos WHERE servicos.serv_status = 't' AND servicos.serv_acessos <> 0 ORDER BY servicos.serv_acessos DESC LIMIT 12";
					    $result = $drive->pedido($queryMaisAcessados);
					    while($serv = pg_fetch_object($result)) {
								echo("<li><a href=\"http://$urlHost/servicos/index.php?pagina=servpagina&id=$serv->serv_id\">$serv->serv_nome</a></li>");
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
							while($entidade = pg_fetch_object($result)) {
								echo("<li><a href=\"http://$urlHost/servicos/index.php?pagina=servsecretaria&idSecretaria=$entidade->entidade_id\">$entidade->entidade_linha_1</a></li>");
							}
						?>
					</ul>
				</div>
				<div data-parent="por-assunto" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<h4>Por assunto</h4>
					<ul>
						<?php
							$queryPorCategoria = "SELECT categorias.* FROM categorias JOIN servicos on servicos.serv_categoria_cidadao = categorias.cat_id or servicos.serv_categoria_empresa = cat_id
					    GROUP BY categorias.cat_id, categorias.cat_nome, categorias.cat_banner, categorias.cat_banner_titulo, categorias.cat_banner_descricao
					    ORDER BY (
					    	SELECT SUM(serv_acessos) FROM servicos
					    	WHERE servicos.serv_categoria_cidadao = categorias.cat_id OR servicos.serv_categoria_empresa = categorias.cat_id )  DESC
					    LIMIT 12";
							$result = $drive->pedido($queryPorCategoria);
							while($cat = pg_fetch_object($result)) {
								echo("<li><a href=\"http://$urlHost/servicos/index.php?pagina=servcategoria&id=$cat->cat_id\">$cat->cat_nome</a></li>");
							}
						?>
					</ul>
				</div>
			</div>
		</li>

		<li>
			<a href="http://www.pmf.sc.gov.br/governo/index.php?pagina=goveditais">Editais</a>
		</li>

		<li class="has-submenu">
			<a href="#">Prefeitura</a>
			<div class="header__submenu">
				<div class="header__submenu-tier-2 open">
					<ul>
						<li><a href="http://www.pmf.sc.gov.br/governo/index.php?pagina=govestrutura">Estrutura Organizacional</a></li>
						<li><a href="http://www.pmf.sc.gov.br/governo/index.php?pagina=govquem">Contatos</a></li>
						<li><a href="http://www.pmf.sc.gov.br/entidades/fazenda/index.php?cms=pro+cidadao&menu=4&submenuid=1968">Pró-Cidadão</a></li>
						<li><a href="https://leismunicipais.com.br/prefeitura/sc/florianopolis/">Leis Municipais</a></li>
						<li><a href="https://www.floripanoponto.com.br/" target="_blank">Floripa no Ponto</a></li>
						<li><a href="http://www.pmf.sc.gov.br/ouvidoria/index.php">Ouvidoria</a></li>
					</ul>
				</div>
			</div>
		</li>

		<li class="has-submenu"> 
			<a href="#">Secretarias</a>
			<div class="header__submenu">
				<div class="header__submenu-tier-1">
					<h4>Secretarias e Órgãos</h4>
					<a href="#" data-target="a-prefeitura" class="has-second-tier active">A Prefeitura</a>
					<a href="#" data-target="secretarias" class="has-second-tier">Secretarias</a>
					<a href="#" data-target="orgaos" class="has-second-tier">Órgãos</a>
				</div>
				<div data-parent="a-prefeitura" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$queryAPrefeitura = "SELECT entidade_path, entidade_nome, entidade_tipo, entidade_linha_1, entidade_flag_site FROM entidades WHERE entidade_tipo = 0 AND entidade_flag_site = 1 ORDER BY entidade_linha_1";
							$result = $drive->pedido($queryAPrefeitura);
							while ($entidade = pg_fetch_object($result)) {
								echo("<li><a href=\"http://$urlHost/entidades/$entidade->entidade_path/index.php\">$entidade->entidade_nome</a></li>");
							}
						 ?>
					</ul>
				</div>
				<div data-parent="secretarias" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$querySecPorSecretaria = "SELECT entidade_path, entidade_nome, entidade_tipo, entidade_linha_1, entidade_flag_site FROM entidades WHERE entidade_tipo = 4 AND entidade_flag_site = 1 ORDER BY entidade_linha_1";
							$result = $drive->pedido($querySecPorSecretaria);
							while($entidade = pg_fetch_object($result)) {
								echo("<li><a href=\"http://$urlHost/entidades/$entidade->entidade_path/index.php\">$entidade->entidade_linha_1</a></li>");
							}
						?>
					</ul>
				</div>
				<div data-parent="orgaos" class="header__submenu-tier-2">
					<a href="#" class="header__submenu-back"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Voltar</a>
					<ul>
						<?php
							$querySecPorOrgaos = "SELECT entidade_path, entidade_nome, entidade_tipo, entidade_linha_1, entidade_flag_site FROM entidades WHERE entidade_tipo = 6 AND entidade_flag_site = 1 ORDER BY entidade_linha_1";
							$result = $drive->pedido($querySecPorOrgaos);
							while($entidade = pg_fetch_object($result)) {
								echo("<li><a href=\"http://$urlHost/entidades/$entidade->entidade_path/index.php\">$entidade->entidade_nome</a></li>");
							}
						?>
					</ul>
				</div>
			</div>
		</li>
		<li>
			 <a href="http://www.pmf.sc.gov.br/transparencia/index.php" target="_blank">Transpar&ecirc;ncia</a>
		</li>
		<?php if(($menu_principal != "intranet") && ($menu_principal != "internet")){  ?>
			<li class="mini-header__items-mobile">
				<ul>
				      <li><a href="http://www.pmf.sc.gov.br/intranet/index.php" target="_self">Intranet</a></li>
				      <li><a href="http://www.pmf.sc.gov.br/governo/index.php?pagina=govquem" target="_self">Contatos</a></li>
				      <li><a href="http://www.pmf.sc.gov.br/sites/portalservidor">Portal do Servidor</a></li>
				      <li><a href="http://portaldocidadao.pmf.sc.gov.br/PMFSite/">Portal do Cidadão</a></li>
				      <li><a href="http://www.pmf.sc.gov.br/email.html" target="_blank">Webmail</a></li>
					  <li><a href="http://portalrastreabilidade.pmf.sc.gov.br/obras-gov-map/#/map" target="_blank">Mapa de obras</a></li>
					  <li><a href="http://www.pmf.sc.gov.br/transparencia/index.php" target="_blank">Portal de transparência</a></li>
					  <li><a href="http://www.pmf.sc.gov.br/temporeal/" target="_blank">Floripa em Tempo Real</a></li>
					  <li><a href="http://somarfloripa.com/" target="_blank">Somar Floripa</a></li>
		        </ul>
		  </li>
	 	<?php } ?>

		<li>
			<a href="http://www.pmf.sc.gov.br/sistemas/consulta/parqueMarina/">Parque Urbano e Marina</a>
		</li>

		<li>
			<a href="http://www.pmf.sc.gov.br/ouvidoria/">Ouvidoria</a>
		</li>

		<li>
			<a href="http://www.pmf.sc.gov.br/entidades/gapre/index.php?cms=organizacoes+sociais&menu=4&submenuid=2028">Creche e Sa&uacute;de J&aacute;</a>
		</li>

		<li>
			<a href="http://florianopolis.fepese.org.br/">Concurso P&uacute;blico 2019</a>
		</li>

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
		<li><a href="http://www.pmf.sc.gov.br/servicos/index.php?pagina=servcategoria&perfil=cidadao">Cidadão</a></li>
		<li><a href="http://www.pmf.sc.gov.br/servicos/index.php?pagina=servcategoria&perfil=empresa">Empresa</a></li>
	</ul>-->
	<a href="#" class="header__mobile-nav">
		<span></span>
		<span></span>
		<span></span>
	</a>
<?php } ?>
</div>
