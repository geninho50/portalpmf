<?php

if(isset($_GET['id']) && !empty($_GET['id']) )
{

	$doc = $_GET['id'];
	
	
	
	/*APLICA O CONTADOR DE ACESSOS*/
		
		$sqlAcessos = "SELECT doc_acessos FROM documentos WHERE doc_id = '$doc' ";
		$resultado  = $drive->pedido( $sqlAcessos );
		$contador   = pg_fetch_object( $resultado );
		
		if($contador->doc_acessos == NULL || $contador->doc_acessos == 0 || $contador->doc_acessos == "")
		{
			$contadoraux = 1;
		}else {
			$contadoraux = $contador->doc_acessos + 1;
		}
					
		$inserecontagem = "UPDATE documentos SET doc_acessos = '$contadoraux' WHERE doc_id = '$doc' ";
		$drive->pedido($inserecontagem);
		
		/*****************************/
	
	
	
	$sqlservrel = "SELECT docs_serv_id FROM documentos_servicos WHERE docs_doc_id = $doc";
	$rsqlservrel = $drive->pedido($sqlservrel);
	
	
	
	
	$sql = "SELECT * FROM documentos WHERE doc_id = $doc";
	$resultado = $drive->pedido($sql);
	$objdoc = pg_fetch_object($resultado);
	
	
	$sql2 = "SELECT docs_serv_id FROM documentos_servicos WHERE docs_doc_id = $objdoc->doc_id";
	$resultado2 = $drive->pedido($sql2);
	$objdocserv = pg_fetch_object($resultado2);
	
	$sql3 = "SELECT serv_entidade_id FROM servicos WHERE serv_id = $objdocserv->docs_serv_id";
	$resultado3 = $drive->pedido($sql3);
	$objserv = pg_fetch_object($resultado3);
	
	
	$sql4 = "SELECT entidade_nome FROM entidades WHERE entidade_id = $objserv->serv_entidade_id";
	$resultado4 = $drive->pedido($sql4);
	$objentidade = pg_fetch_object($resultado4);
	
	

}else
{
	$drive->redirect("?pagina=servacessados&menu=2&info=documentos");
}



?>
<div class="centro">
     <div id="caminho_migalhas">home &gt; serviços</div>
     <div id="titulo_noticia"><h1><?=html_entity_decode($objdoc->doc_nome)?></h1>
      <p><?=$objentidade->entidade_nome?></p></div>

    
     <div>        
       
     <br>
     
     
      <a href="../../arquivos/documentos/<?=$objdoc->doc_link?>"><img src="../../layout/imagens/entid_btn_download_grande.png" border="0"/></a>
      <br><br>
     
     
     <div class="dados_servicos">  
      <h3><img src="../../layout/imagens/entid_marcador_grande.png" align="absmiddle" />&nbsp;descrição</h3>
      <ul>
      <li><?=html_entity_decode($objdoc->doc_descricao)?></li>
      </ul>
      </div>    
        
        
 
     <div class="dados_servicos">  
      <h3><img src="../../layout/imagens/entid_marcador_grande.png" align="absmiddle" />&nbsp;serviços relacionados</h3>
      <ul>
      
      
 		<?php
			$string = NULL;
			while($objservrel = pg_fetch_object($rsqlservrel))
			{
				
				$sqlaux = "SELECT serv_id, serv_nome FROM servicos WHERE serv_id = $objservrel->docs_serv_id";
				$resultadoaux = $drive->pedido($sqlaux);
				$objaux = pg_fetch_object($resultadoaux);
				
				
				$string =  "<li>&raquo; <a href=\"../../servicos/?pagina=servpagina&id=$objaux->serv_id\">" . html_entity_decode($objaux->serv_nome) . "</a></li>";
				
				echo($string);
			}
		?>      
      
      </ul>
      </div>        
      
          
      </div>
   </div><!-- fim coluna_C2 -->   
   