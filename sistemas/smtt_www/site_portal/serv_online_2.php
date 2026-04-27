<?php
$drive->conecta();
require_once("../scripts/php/paginacao.php");
require_once("../scripts/php/funcoes.php");
?>
<div class="centro">
	 <div id="cabecalho_servicos" class="canto_redondo">
		<div id="caminho_migalhas">home &gt; serviços</div>
		<div id="titulo_pagina">servi&ccedil;os on-line</div>
	
		<div class="box_msg_baixo">
			Para consultar por secretaria ou &oacute;rgão, selecione-a(o) na lista abaixo.</div> 
     
        <form method="post" action="?pagina=servonline2">
			<?php combo_entidades($drive, "Fentidade", $_POST['Fentidade'])?>
            <input type="image" name="enviar" id="enviar" src="../layout/imagens/atualiza_btn_OK.png" align="absmiddle"/>
        </form>
        
        </div>
	<div id="area_servicos">
        
        <ul class="listagem">
        <?php
		
		//========================================================
		// faz o controle da paginação (inicio e fim da consulta)
		//========================================================
		if(!isset($_GET['pg'])){
			$pg = 1;
		}else{
			$pg = $_GET['pg'];	
		}
		
		$Tinicio  = ($pg * 10) - 10;
		//========================================================================
		// verifica se foi solicitado uma consulta pra uma entidade em especifico
		//========================================================================
		if(((isset($_POST['enviar_x'])) and ($_POST['Fentidade'] != "")) or (isset($_GET['cons']))){
			
			//=================================================================
			//se existe entidade selecionada então mostra serviços da entidade	
			//=================================================================		
			$Tcaminho  = "?pagina=servonline2&cons=s&ent=".$_POST['Fentidade'];					
			if (isset($_POST['enviar_x'])){
				$Tentidade = $_POST['Fentidade'];
			}else{
				$Tentidade = $_GET['ent'];				
			}
			$sqlnum    = "SELECT COUNT(*)	FROM entidades INNER JOIN servicos ON entidades.entidade_id = servicos.serv_entidade_id WHERE (((entidades.entidade_id) = $Tentidade) AND servicos.serv_status = 't' AND servicos.serv_flag_online = 't')";
			$sqlServ   = "SELECT 
							servicos.serv_id, 
							servicos.serv_link, 
							servicos.serv_status, 
							servicos.serv_nome, 
							servicos.serv_descricao, 
							entidades.entidade_nome, 
							entidades.entidade_sigla, 
							servicos.serv_flag_online, 
							servicos.serv_abrir_interno 
						FROM 
							entidades 
						INNER JOIN 
							servicos 
						ON 
							entidades.entidade_id = servicos.serv_entidade_id 
						WHERE
							(((entidades.entidade_id) = $Tentidade) 
						AND 
							servicos.serv_status = 't' 
						AND 
							servicos.serv_flag_online = 't') 
						ORDER BY 
							servicos.serv_nome ASC
						LIMIT 10 OFFSET $Tinicio";
		}else{
			$Tcaminho = "?pagina=servonline2";
			$sqlnum  = "SELECT COUNT(*) FROM entidades INNER JOIN servicos ON entidades.entidade_id = servicos.serv_entidade_id  AND servicos.serv_status = 't' AND servicos.serv_flag_online = 't' ";
			$sqlServ = "SELECT 
							servicos.serv_id, 
							servicos.serv_link, 
							servicos.serv_status, 
							servicos.serv_nome, 
							servicos.serv_descricao, 
							entidades.entidade_nome, 
							entidades.entidade_sigla, 
							servicos.serv_flag_online, 
							servicos.serv_abrir_interno 
						FROM 
							entidades 
						INNER JOIN 
							servicos 
						ON 
							entidades.entidade_id = servicos.serv_entidade_id  
						AND 
							servicos.serv_status = 't' 
						AND 
							servicos.serv_flag_online = 't' 
						ORDER BY 
							servicos.serv_nome ASC
						LIMIT 10 OFFSET $Tinicio";
		}

		$TreturnSqlServ = $drive->pedido($sqlServ);
		$TreturnSqlNum  = $drive->pedido($sqlnum);
		
		//=================================================
		// faz a impressão dos serviços ONLINE disponíveis
		//=================================================
		$i = 0;
		while($Tservicos = pg_fetch_object($TreturnSqlServ)){
			$sid 		 = $Tservicos->serv_id;
			$snome  	 = html_entity_decode($Tservicos->serv_nome);
			$sdesc  	 = $Tservicos->serv_descricao;
			$enome   	 = $Tservicos->entidade_nome;
			$esigla 	 = $Tservicos->entidade_sigla;
			$status 	 = $Tservicos->serv_status;
			$link   	 = $Tservicos->serv_link;
			$online  	 = $Tservicos->serv_flag_online;
			$abrirdentro = $Tservicos->serv_abrir_interno;
			$i++;
			
					
			$string = "<li><table cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"112\">"; 
			$string .= "<a href=\"index.php?pagina=servpagina&acao=open&id=$sid&menu=2\">
							<img src=\"../layout/imagens/serv_btn_info.png\" alt=\"informações\" width=\"38\" height=\"19\" border=\"0\" align=\"absmiddle\" />
						</a>";
			if($online == 't'){
				if($abrirdentro == 0){
					$string .= "<a href=\"".$link."\">
									<img src=\"../layout/imagens/serv_btn_acessar.png\" alt=\"online\"  height=\"19\" border=\"0\" align=\"absmiddle\" class=\"item_ocultar_mobile\" />
								</a>";
				}else{
					$string .= "<a href=\"sistema.php?servicoid=$sid\">
									<img src=\"../layout/imagens/serv_btn_acessar.png\" alt=\"online\"  height=\"19\" border=\"0\" align=\"absmiddle\" class=\"item_ocultar_mobile\" />
								</a>";
				}
			}
						
			$string .= "</td><td>$snome</td></tr></table>";
			$string .= "</li>";
			
			
			
			echo($string);
		}
		echo("<br />");
		if($i == 0){
			echo "<b>Nenhum serviço encontrado!</b>";	
		}else{	
			
			//=======================================
			// imprime no rodapé o número de páginas 
			//=======================================
			$numPagTotal = pg_fetch_object($TreturnSqlNum);
			echo "<p align=\"center\">";						
			mostra_paginas($numPagTotal->count, $_GET['pg'], $Tcaminho, 10);
			echo "<p>";	
		}
		?>
        </ul>
		<br />
	</div>
</div>