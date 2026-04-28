
<span>DESTAQUES</span> &laquo;

<br><br>

<div class="coluna_destaque_serv">
        
        	<?php
				$drive->conecta();
				$sqlDestaques = "SELECT * FROM destaque_servico WHERE destaque_servico_entidade_id = 0 ORDER BY destaque_servico_posicao asc limit 5";
				$rsqlDestaques = $drive->pedido($sqlDestaques);
		
				while($objDestaques = pg_fetch_object($rsqlDestaques))
				{
			
					
					echo("<div class=\"coluna_tarja_serv\">");
					echo("<a href=\"?pagina=servpagina&id=$objDestaques->destaque_servico_servico_id\"><img src=\"../arquivos/destaques/" . "$objDestaques->destaque_servico_img\" class=\"element_float\" width=\"115\" height=\"85\" border=\"0\" /></a>");
					echo("<div><a href=\"?pagina=servpagina&id=$objDestaques->destaque_servico_servico_id\">");
					echo($objDestaques->destaque_servico_descricao);
					echo("</a>");
                	echo("<br class=\"clearfloat\" /> </div>");
					echo("</div>");
		   			
				}
			$drive->close();	
			?>
            
</div>  


   
 
  
  
   
 

