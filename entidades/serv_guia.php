<div class="centro">
      
     
<div id="caminho_migalhas">home > servi&ccedil;os</div>
 <div id="titulo_pagina">destaques</div>
         
         
       
     
   
       
        
         <div class="sub_2colunas_larga_3">
        
        	<?php
				$drive->conecta();
				$sqlDestaques = "SELECT * FROM destaque_servico WHERE destaque_servico_entidade_id = $IdEntidade ORDER BY destaque_servico_posicao asc limit 5";
				$rsqlDestaques = $drive->pedido($sqlDestaques);
		
				while($objDestaques = pg_fetch_object($rsqlDestaques))
				{
			
					
					echo("<div class=\" coluna_tarja_1\">");
					echo("<img src=\"../../arquivos/destaques/" . "$objDestaques->destaque_servico_img\" class=\"element_float\" width=\"115\" height=\"85\" />
");
					echo("<div><a href=\"?pagina=servpagina&id=$objDestaques->destaque_servico_servico_id\">");
					echo($objDestaques->destaque_servico_descricao);
					echo("</a>");
                	echo("<br class=\"clearfloat\" /> </div>");
					echo("</div>");
		   			
				}
				$drive->close();
			?>
         </div>    
            
                                     
                                     
     
      
</div><!-- fim coluna_C2 -->            
          
          
