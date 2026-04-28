<div class="centro">
	<div id="caminho_migalhas">home &gt; ouvidoria</div>
	<div id="titulo_pagina">Relatórios de Pedidos de Informações Atendido</div>
    <div id="conteudo_pagina">
    <br>
	<?php
	  ini_set('display_errors', 1);
     error_reporting(E_ALL);
		$mes = array (
				0 => 'Todos meses',
				01 => 'Janeiro',
				02 => 'Fevereiro',
				03 => 'Março',
				04 => 'Abril',
				05 => 'Maio',
				06 => 'Junho',
				07 => 'Julho',
				8 => 'Agosto',
				9 => 'Setembro',
				10 => 'Outubro',
				11 => 'Novembro',
				12 => 'Dezembro'
		);

		$sql = "SELECT ano FROM relatorios_ouvidoria GROUP BY ano ORDER BY ano DESC";
		$result		= $drive->pedido($sql);
		$anos 	= pg_fetch_all($result);
		?>

		<div id="mapa">
    	<ul>
		<?php
		foreach ($anos as $ano) {
			$ano = $ano['ano'];
			echo "<li class='level_0'><h2>$ano</h2>";
			$sql = "SELECT mes FROM relatorios_ouvidoria where ano = '$ano' GROUP BY mes, ano  ORDER BY mes ASC ";
			$result		= $drive->pedido($sql);
			$meses 	= pg_fetch_all($result);

			echo "<ul>";
			foreach ($meses as $mesNum) {
				if($mesNum['mes'] == 0){
					$mesNum = $mesNum['mes'];
					$sql = "SELECT * FROM relatorios_ouvidoria  where ano = '$ano' and mes = '$mesNum' ORDER BY titulo";
					$result		= $drive->pedido($sql);
					$relatorios 	= pg_fetch_all($result);
					foreach ($relatorios as $relatorio) {
					?>
					<li class='level_1'>
						<a href="http://www.pmf.sc.gov.br/ouvidoria/pdf/<?=$relatorio['arquivo']?>" target="_blank">
							<?=$relatorio['titulo']?>
						</a>
					</li>
					<?php 
					}
				} else {
					$mesNum = $mesNum['mes'];
					echo "<li class='level_1'><p><strong>$mes[$mesNum]</strong></p>";
					$sql = "SELECT * FROM relatorios_ouvidoria  where ano = '$ano' and mes = '$mesNum' ORDER BY titulo";
					$result		= $drive->pedido($sql);
					$relatorios 	= pg_fetch_all($result);

					echo "<ul>";
					foreach ($relatorios as $relatorio) {
					?>
					<li class='level_2'>
						<a href="http://www.pmf.sc.gov.br/ouvidoria/pdf/<?=$relatorio['arquivo']?>" target="_blank">
							<?=$relatorio['titulo']?>
						</a>
					</li>
					<?php 
					}
					echo "</ul>";
					echo "</li>";
				}
			}
			echo "</ul>";
			echo "</li>";
		}
		?>
		</ul>
		</div>

	
			
    </div>
</div>
