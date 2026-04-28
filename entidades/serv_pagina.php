<script type="text/javascript">

function stAba(menu,conteudo){
		this.menu = menu;
		this.conteudo = conteudo;
}

var arAbas = new Array();
arAbas[0] = new stAba('aba_descricao','conteudo_descricao');
arAbas[1] = new stAba('aba_passosreq','conteudo_passosreq');
arAbas[2] = new stAba('aba_download','conteudo_download');
arAbas[3] = new stAba('aba_onde','conteudo_onde');
arAbas[4] = new stAba('aba_links','conteudo_links');


function AlternarAbas(menu,conteudo){
	for (i=0;i<arAbas.length;i++){
		document.getElementById(arAbas[i].menu).className = 'aba_entid';
		document.getElementById(arAbas[i].conteudo).style.display = 'none';
	}
	document.getElementById(menu).className = 'aba_sel';
	document.getElementById(conteudo).style.display = 'inline';
}

</script>


<?php
	$drive->conecta();
	if(isset($_GET['id']) && !empty($_GET['id']) )
	{	
	
		$id  = $_GET['id'];			
		
		/*APLICA O CONTADOR DE ACESSOS*/
		
		$sqlAcessos = "SELECT serv_acessos FROM servicos WHERE serv_id = $id";
		$resultado = $drive->pedido($sqlAcessos);
		$contador = pg_fetch_object($resultado);
		
			if($contador->serv_acessos == NULL || $contador->serv_acessos == 0 || $contador->serv_acessos == "")
			{
				$contadoraux = 1;
			}else {
				$contadoraux = $contador->serv_acessos + 1;
			}
			
					
			$inserecontagem = "UPDATE servicos SET serv_acessos = $contadoraux WHERE serv_id = $id";
			$drive->pedido($inserecontagem);
		
		/*****************************/
		
		$sql = "SELECT * FROM servicos WHERE serv_id = $id";
		$resultado = $drive->pedido($sql);
		$objserv = pg_fetch_object($resultado);
		
		$sql2 = "SELECT * FROM entidades WHERE entidade_id = $objserv->serv_entidade_id";
		$resultado2 = $drive->pedido($sql2);
		$objentidade = pg_fetch_object($resultado2);
		
		$sql3 = "SELECT * FROM passos WHERE passo_serv_id = $objserv->serv_id ORDER BY passo_ordem ASC ";
		$resultado3 = $drive->pedido($sql3);
		$rowpassos = pg_num_rows($resultado3);
		
		
				
		$sql4 = "
				SELECT * FROM documentos AS DOC
				JOIN documentos_servicos AS DOCS
				ON DOCS.docs_doc_id = DOC.doc_id AND DOCS.docs_serv_id = $id
				";
		
		
		$resultado4 = $drive->pedido($sql4);
		$rowdocumentos = pg_num_rows($resultado4);
		
		
		$sql5 = "SELECT DISTINCT pac_serv_pac_id, pac_serv_serv_id FROM pacote_servicos WHERE pac_serv_serv_id = $id ORDER BY pac_serv_pac_id ASC";
				
		$resultado5 = $drive->pedido($sql5);
	
		$rowpacotes = pg_num_rows($resultado5);
		
		
		
		$sql6 = "SELECT * FROM requisitos WHERE req_serv_id = $id ORDER BY req_ordem ASC";
		$resultado6 = $drive->pedido($sql6);
		$rowrequisitos = pg_num_rows($resultado6);
		
		$sql7 = "SELECT * FROM locais AS LOC
			     JOIN locais_servicos AS LOCS
				 ON LOCS.locs_loc_id = LOC.loc_id AND LOCS.locs_serv_id = $id		
				";
		
		
		$resultado7 = $drive->pedido($sql7);
		$rowlocais = pg_num_rows($resultado7);		
				
		
	}
	else
	{
		$drive->redirect("?pagina=servonline");
	}
	
?>


<div class="centro">
     <div id="caminho_migalhas">home &gt; serviços</div>
     <div id="titulo_noticia"><h1><?=(html_entity_decode($objserv->serv_nome))?></h1>
      <p><?=$objentidade->entidade_nome?></p></div>

    
     <div>        
       
     <br>
     
          
        
     <div class="painel_abas">
     <div id="aba_descricao" class="aba_sel" onClick="AlternarAbas('aba_descricao','conteudo_descricao')"><span>descrição</span></div>
     <div id="aba_passosreq" class="aba_entid" onClick="AlternarAbas('aba_passosreq','conteudo_passosreq')"><span>solicitar</span></div>
     <div id="aba_download" class="aba_entid" onClick="AlternarAbas('aba_download','conteudo_download')"><span>downloads</span></div>
     <div id="aba_onde" class="aba_entid" onClick="AlternarAbas('aba_onde','conteudo_onde')"><span>onde encontrar</span></div>
     <div id="aba_links" class="aba_entid" onClick="AlternarAbas('aba_links','conteudo_links')"><span>links</span></div>
     </div><!-- fim painel_abas -->   
     
     
     
     <div class="conteudo_abas_entid">  
      
      <div id="conteudo_descricao" style="display:inline">
      <table width="445" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td width="111" align="left" valign="top">
      
     <?php
	  	$string = NULL;
	  	if($objserv->serv_flag_online == "t")
		{
		
		if((int)$objserv->serv_abrir_interno == 0)
		{
			echo("<br><a href=\"$objserv->serv_link\" target=\"_self\" border=\"0\"><img src=\"../../layout/imagens/serv_btn_online2.png\" border=\"0\" /></a>");
		}
		
		else
		{
		
			echo("<br><a href=\"sistema.php?servicoid=".$objserv->serv_id."\" target=\"_self\" border=\"0\"><img src=\"../../layout/imagens/serv_btn_online2.png\" border=\"0\" /></a>");
		}
		
		
		
		} 
		
		else {
		echo("<br><img src=\"../../layout/imagens/entid_btn_descricao.jpg\" alt=\"informações\" border=\"0\" align=\"absmiddle\" />");
		}
		

		
	   ?>      
      </td>
       <td width="334" valign="top"><br>
       <?=$objserv->serv_descricao?>       
       
       </td>

     </tr>
    </table>
    </p>  
      
      </div><!-- fim conteudo_descricao -->  
      
      <div id="conteudo_passosreq" style="display:none"> 
         
      
      
      <?php
		  	if($rowpassos != 0)
			{
			$string = "<br><div class=\"container_6\"><h3>como proceder</h3></div><ul>";
			
			while($objpassos = pg_fetch_object($resultado3))
			{
				$string .= "<li>" . strip_tags($objpassos->passo_descricao) ."</li>";
			}
			
			$string .= "</ul><br>";
			
			echo($string);
			}
		  ?>
      
      
 <?php
		
			if($rowrequisitos != 0)
			{
				$string = "<br><div class=\"container_6\"><h3>requisitos</h3></div><ul>";
				
					while($objreq = pg_fetch_object($resultado6))
					{
						$string .= "<li>" . strip_tags($objreq->req_descricao) . "</li>";
					}
				
				$string .= "</ul>";
				echo($string);
		    } else {
			   echo("Este serviço não possui requisitos para solicitação.");
			}
		?>      
             
         
      
      </div><!-- fim conteudo_passosreq -->
      
      <div id="conteudo_download" style="display:none"> 
      
      <?php
		 	if($rowdocumentos !=0)
			{
				$string = "<br><table>";
				
					while($objdoc = pg_fetch_object($resultado4))
					{
						$string .= "<tr><td width=\"260\">" . html_entity_decode($objdoc->doc_nome) . "</td><td width=\"140\"><a href=\"index.php?pagina=servdoc&doc=$objdoc->doc_id\"><img src=\"../../layout/imagens/serv_btn_info.png\" alt=\"informações\" width=\"38\" height=\"19\" border=\"0\" align=\"absmiddle\" /></a> <a href=\"../../arquivos/documentos/$objdoc->doc_link\"><img src=\"../../layout/imagens/entid_btn_download.png\" alt=\"online\" height=\"19\" border=\"0\" align=\"absmiddle\" /></a></td></tr> ";
					}
				
				$string .= "</table>";
				
				echo($string);
			} else {
			    echo("Não existem arquivos para download.");
			}
		 ?>	
      
     
          
      </div><!-- fim conteudo_download -->
      
      <div id="conteudo_onde" style="display:none">
      
     <?php
				if($rowlocais != 0)
				{
					$string = "<ul>";
				
					while($objlocais = pg_fetch_object($resultado7))
					{
						$string .= "<li>
									<h3>$objlocais->loc_nome</h3>
									$objlocais->loc_nome, Nº $objlocais->loc_num, CEP: $objlocais->loc_cep<br />
									<b>Horário:</b> $objlocais->loc_horario - $objlocais->loc_horario2<br />
									<b>Telefone:</b> (48) $objlocais->loc_fone<br />
									<b>Fax:</b> (48) $objlocais->loc_fax<br />
									<b>E-mail:</b> $objlocais->loc_email @pmf.sc.gov.br<br />
									<br></li>
							   ";
					}
					
					$string .= "</ul>";
					echo($string);
				} else {
				  echo("Nenhum local cadastrado.");
				}
			?>     
      
 

      </div><!-- fim conteudo_onde -->
      
      <div id="conteudo_links" style="display:none"> 
      
      
 <?php
			
			if($rowpacotes != 0)
			{
				$string = "<div class=\"container_6\"><h3>serviços relacionados: </h3></div><ul>";
				
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
				
						$string .= "</ul>";
				
						echo($string);
				
			} else {
		     	echo("Não existem outros serviços relacionados a este.");
			}
		
		?>     
             
      
      </div><!-- fim conteudo_links -->
      
      
     </div><!-- fim conteudo_abas_ext -->  

     <br class="clearfloat">         
       
	

	
    </div>
   </div><!-- fim coluna_C2 -->   
   