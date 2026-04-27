      <div class="centro">
      <div id="cabecalho_servicos">
      	<div id="caminho_migalhas">home &gt; serviços</div>
     	<div id="titulo_pagina">resultados da busca</div>


     
     	<?php
			
			switch($_GET['info'])
			{
				case "servicos" 	: require_once("abas/Bservicos.php");
				break;
				case "documentos" 	: require_once("abas/Bdocumentos.php");
				break;
				default: require_once("abas/Bservicos.php");
				break; 
			}
			
		?>
     
     </div>     
     
     
     
  
        
          
   </div><!-- fim coluna_C2 -->            
          
          
      
