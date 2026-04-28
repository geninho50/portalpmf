<?php
	$drive->conecta();
	$sqlEntidades = "SELECT entidade_id , entidade_sigla, entidade_linha_1 FROM entidades";
	$resultado = $drive->pedido($sqlEntidades); 
?>
<? /*
<label>
      <select name="select" id="select" class="combosecretarias">
        <?php
			while($obj = pg_fetch_object($resultado))
			{
				echo("<option value=\"$obj->entidade_id\">");
				echo("$obj->entidade_sigla");
				echo("</option>");
			}
		?>
      </select>
</label>
*/?>
<div id="linksmenu"> 
      <a href="home.html" id="marcal" target="_self"><i>Marca</i></a>  
      <a href="home.html" id="principal" target="_self"><i>Home</i></a>
      <a href="cidade.html" id="cidade" target="_self"><i>Cidade</i></a>
      <a href="governo.html" id="governo" target="_self"><i>Governo</i></a>
      <a href="servicos.html" id="servicos" target="_self"><i>Serviços</i></a>
      <a href="noticias.html" id="noticias" target="_self"><i>Notícias</i></a>
      <a href="ouvidoria.html" id="ouvidoria" target="_self"><i>Ouvidoria</i></a>
</div>   
<div class="cabecalho_data">10 de junho de 2009</div> 




