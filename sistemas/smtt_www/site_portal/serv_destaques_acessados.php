<div id="destaques_servicos">

<div id="botoes_destaque">

	<a href="index.php?pagina=onibus&menu=2"><img src="../layout/imagens/botao_onibus.png" border="0" /></a>
    <a href="index.php?pagina=servpagina&amp;id=260&menu=2"><img src="../layout/imagens/botao_lixo.png" border="0" /></a>
    <a href="http://geo.pmf.sc.gov.br" target="_blank"><img src="../layout/imagens/botao_geo.png" border="0" /></a>
    
</div>


<br  />
<div class="separador-menu">&nbsp;</div>

<?php

	$drive->conecta();

	$sql = "SELECT servicos.serv_link, servicos.serv_nome, servicos.serv_id, servicos.serv_acessos
	FROM  servicos WHERE servicos.serv_status = 't' AND servicos.serv_acessos <> 0 AND servicos.serv_id <> 260 ORDER BY servicos.serv_acessos DESC LIMIT 8";
		
	$rsqlDestaques = $drive->pedido($sql);

		
		echo("<ul class=\"lista\"><h3>mais acessados</h3>");
  
		while($objDestaques = pg_fetch_object($rsqlDestaques))
		{
			$snome  = html_entity_decode($objDestaques->serv_nome);
		
			echo("<li>");
			echo("<a href=\"index.php?pagina=servpagina&id=$objDestaques->serv_id&menu=2\">$snome</a>");
			echo("</li>");
		
		}
     
		  echo("</ul>");
			
			
	
?>	

</div>  
          
      
