<?php
$drive->conecta();
if(isset($_GET['id']) && !empty($_GET['id']) ){	
	$id  = $_GET['id'];
	$preview  = $_POST['preview'];
	//------------------------------
	// verifica se o serviço existe 
	//------------------------------
	$Tvalserv = ($drive->pedido("SELECT serv_id, serv_status FROM servicos WHERE serv_id = ".$id.""));			
	$TvalservRes = pg_fetch_object($Tvalserv);
	if($TvalservRes == null || ( $TvalservRes->serv_status == 'f' && !isset($preview)) ){
		$drive->redirect("?pagina=servonline");
	}
	

	//------------------------------
	// aplica o contador de acessos
	//------------------------------	
	$sqlAcessos = "SELECT serv_acessos FROM servicos WHERE serv_id = $id";
	$resultado 	= $drive->pedido($sqlAcessos);
	$contador 	= pg_fetch_object($resultado);

	if($contador->serv_acessos == NULL || $contador->serv_acessos == 0 || $contador->serv_acessos == ""){
		$contadoraux = 1;
	}else{
		$contadoraux = $contador->serv_acessos + 1;
	}
	$inserecontagem = "UPDATE servicos SET serv_acessos = $contadoraux WHERE serv_id = $id";
	$drive->pedido($inserecontagem);
		
	//-------------------------------------------------	
	// busca os dodos referentes ao serviço solicitado
	//-------------------------------------------------
	$sql 		   = "SELECT * FROM servicos WHERE serv_id = $id";
	$resultado 	   = $drive->pedido($sql);
	$objserv 	   = pg_fetch_object($resultado);
	
	$sql2 		   = "SELECT * FROM entidades WHERE entidade_id = $objserv->serv_entidade_id";
	$resultado2    = $drive->pedido($sql2);
	$objentidade   = pg_fetch_object($resultado2);
	
	$sql3 		   = "SELECT * FROM passos WHERE passo_serv_id = $objserv->serv_id ORDER BY passo_ordem ASC ";
	$resultado3    = $drive->pedido($sql3);
	$rowpassos 	   = pg_num_rows($resultado3);
			
	$sql4 		   = "SELECT * FROM documentos AS DOC JOIN documentos_servicos AS DOCS ON DOCS.docs_doc_id = DOC.doc_id AND DOCS.docs_serv_id = $id";
	$resultado4    = $drive->pedido($sql4);
	$rowdocumentos = pg_num_rows($resultado4);
		
	$sql5 		   = "SELECT DISTINCT pac_serv_pac_id, pac_serv_serv_id FROM pacote_servicos WHERE pac_serv_serv_id = $id ORDER BY pac_serv_pac_id ASC";
	$resultado5    = $drive->pedido($sql5);
	$rowpacotes    = pg_num_rows($resultado5);
		
	$sql6 		   = "SELECT * FROM requisitos WHERE req_serv_id = $id ORDER BY req_ordem ASC";
	$resultado6    = $drive->pedido($sql6);
	$rowrequisitos = pg_num_rows($resultado6);
	
	$sql7 = "SELECT * FROM locais AS LOC JOIN locais_servicos AS LOCS ON LOCS.locs_loc_id = LOC.loc_id AND LOCS.locs_serv_id = $id";
	$resultado7 = $drive->pedido($sql7);
	$rowlocais = pg_num_rows($resultado7);		
}else{
	//-----------------------------------------------------------------------------
	// verifica se a solicitação de abertura de serviço veio do formulário da HOME
	//-----------------------------------------------------------------------------
	if(isset($_POST['autocomplete'])){
		$TidServ  = explode("-", $_POST['autocomplete']);
		$Tvalserv = ($drive->pedido("SELECT serv_id FROM servicos WHERE serv_id = ".$TidServ[0].""));
		if($Tvalserv){
			$drive->redirect("?pagina=servpagina&acao=open&id=".$TidServ[0]."");			
		}else{
			$drive->redirect("?pagina=servonline");
		}
	}else{
		$drive->redirect("?pagina=servonline");
	}
}
	
?>


<div class="centro">
     <div id="caminho_migalhas">home &gt; serviços</div>
     <div id="titulo_pagina"><h1><?=(html_entity_decode($objserv->serv_nome))?></h1>
      <p><?=$objentidade->entidade_nome?></p></div>

    
     <div>        
     <br class="item_ocultar_mobile">  
       
        
     <a href="serv_pagina_print.php?acao=open&id=<?=$id?>" class="item_ocultar_mobile">
     <img src="../layout/imagens/btn_serv_impressao.png" alt="versão para impressão" border="0" align="bottom" class="item_ocultar_mobile" /></a>
     
     
    
     <?php
	  	$string = NULL;
	  	if($objserv->serv_flag_online == "t")
		{
		
		
			if((int)$objserv->serv_abrir_interno == 0)
			{
			echo("<a href=\"$objserv->serv_link\" target=\"_self\" border=\"0\"><img src=\"../layout/imagens/btn_serv_online.png\" border=\"0\" /></a>");
		
			}
			else
			{
			echo("<a href=\"sistema.php?servicoid=".$objserv->serv_id."\" target=\"_self\" border=\"0\"><img src=\"../../layout/imagens/btn_serv_online.png\" border=\"0\" /></a>");
			}
		
		} 
	   ?>  
       <br class="item_ocultar_mobile">
       <br class="item_ocultar_mobile"> 
       
      <div class="dados_servicos">  
      <h3><img src="../layout/imagens/serv_marcador.jpg" width="15" height="16" align="absmiddle" />&nbsp;descrição</h3>
      <ul>
      <li><?=$objserv->serv_descricao?> </li>
      </ul>
      </div>      
           

       
      
      
      <?php
		  	if($rowpassos != 0)
			{
			$string = "<div class=\"dados_servicos\"><h3>";
			$string .= "<img src=\"../layout/imagens/serv_marcador.jpg\"  align=\"absmiddle\" />";
			$string .= "&nbsp;como solicitar</h3><ul>";
			
			while($objpassos = pg_fetch_object($resultado3))
			{
				$string .= "<li>" . strip_tags($objpassos->passo_descricao) ."</li>";
			}
			
			$string .= "</ul></div>";
			
			echo($string);
			}
		  ?>
      
        
           
      
         <?php
		
			if($rowrequisitos != 0)
			{
				$string = "<div class=\"dados_servicos\"><h3>";
				$string .= "<img src=\"../layout/imagens/serv_marcador.jpg\"  align=\"absmiddle\" />";
				$string .= "&nbsp;requisitos</h3><ul>";
				
					while($objreq = pg_fetch_object($resultado6))
					{
						$string .= "<li>" . $objreq->req_descricao . "</li>";
					}
				
				$string .= "</ul></div>";
				echo($string);
		    } 
		?>      
             
         
      
      
      <?php
		 	if($rowdocumentos !=0)
			{
				$string = "<div class=\"dados_servicos\"><h3>";
				$string .= "<img src=\"../layout/imagens/serv_marcador.jpg\"  align=\"absmiddle\" />";
				$string .= "&nbsp;documentos para download</h3><table>";
				
					while($objdoc = pg_fetch_object($resultado4))
					{
						$string .= "<tr><td>" . html_entity_decode($objdoc->doc_nome) . "</td><td width=\"140\"><a href=\"index.php?pagina=servdoc&doc=$objdoc->doc_id\"><img src=\"../layout/imagens/serv_btn_info.png\" alt=\"informações\" class=\"item_ocultar_mobile\"  width=\"38\" height=\"19\" border=\"0\" align=\"absmiddle\" /></a> <a href=\"../arquivos/documentos/$objdoc->doc_link\"><img src=\"../layout/imagens/serv_btn_download.png\" alt=\"online\" height=\"19\" border=\"0\" align=\"absmiddle\" /></a></td></tr> ";
					} 
				
				$string .= "</table></div>";
				
				echo($string);
			} 
		 ?>	
      
     
      
     <?php
				if($rowlocais != 0)
				{
					$string = "<div class=\"dados_servicos\"><h3>";
					$string .= "<img src=\"../layout/imagens/serv_marcador.jpg\"  align=\"absmiddle\" />";
					$string .= "&nbsp;onde encontrar</h3><ul>";
				
					while($objlocais = pg_fetch_object($resultado7))
					{
						$string .= "<li>
									<h4>$objlocais->loc_nome</h4>
									$objlocais->loc_nome, Nº $objlocais->loc_num, CEP: $objlocais->loc_cep<br />
									<b>Horário:</b> $objlocais->loc_horario - $objlocais->loc_horario2<br />
									<b>Telefone:</b> (48) $objlocais->loc_fone<br />
									<b>Fax:</b> (48) $objlocais->loc_fax<br />
									<b>E-mail:</b> $objlocais->loc_email @pmf.sc.gov.br<br />
									
								<br></li>
							   ";
					}
					
					$string .= "</ul></div>";
					echo($string);
				} 
			?>     
      
 
      
      
 <?php
			
			if($rowpacotes != 0)
			{
				$string = "<div class=\"dados_servicos\"><h3>";
				$string .= "<img src=\"../layout/imagens/serv_marcador.jpg\"  align=\"absmiddle\" />";
				$string .= "&nbsp;servi&ccedil;os relacionados</h3><ul>";
				
					$chave = array();
					while($objpacote = pg_fetch_object($resultado5))
					{
						
						$sqlaux = "SELECT DISTINCT  pac_serv_serv_id FROM pacote_servicos WHERE pac_serv_pac_id = $objpacote->pac_serv_pac_id";
						
						$raux = $drive->pedido($sqlaux);
						
						while($objaux = pg_fetch_object($raux))
						{	
							$chave[$objaux->pac_serv_serv_id] = "SELECT * FROM servicos WHERE serv_id = $objaux->pac_serv_serv_id";
						}	
						
						
		
					}
				
				
						$output = array_unique($chave);
						
						foreach($output as $output2)		
						{		
								
								$rservpacote = $drive->pedido($output2);
								$objpac2 = pg_fetch_object($rservpacote);
								$string .= "<li><a href=\"index.php?pagina=servpagina&id=$objpac2->serv_id\">" . html_entity_decode($objpac2->serv_nome) . "</a></li>";
						
						}
				
						$string .= "</ul></div>";
				
						echo($string);
				
			} 
		
		?>     
             
      
 
	
    </div>
   </div><!-- fim coluna_C2 -->   
   