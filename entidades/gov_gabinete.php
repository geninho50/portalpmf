<?php

	$sql = "SELECT
				uni_usuarios.user_nome,
				uni_usuarios.user_curriculo,
				uni_usuarios.user_foto_link,
				cargos.cargo_nome
			FROM
				uni_usuarios
			INNER JOIN
				cargos ON uni_usuarios.user_cargo_id = cargos.cargo_id
			WHERE
				uni_usuarios.user_gab = 't'
			AND
				uni_usuarios.user_entidade_id = $IdEntidade
			ORDER BY 
				cargos.cargo_posicao
			";
				
	$result = $drive->pedido($sql);
	
	$rowGab = pg_num_rows($result);

?>

<div class="centro">

	<div id="caminho_migalhas">home &gt; sobre</div>

	<div id="titulo_pagina">gabinete</div>

	<div><br><br>
    
    	
		
        <?php

		if($rowGab == 0){
		
			echo"Em construção";
		
		}else{

			while($gabinete = pg_fetch_object($result)){
			
			?>
		
			<table width="510" border="0" cellspacing="0" cellpadding="0" class="tabela-gabinete">
	
				<tr>
	
					<td width="140" valign="top"><img src="<?="../".$gabinete->user_foto_link;?>"  class="img_gabinete" /></td>

					<td valign="top"><h2><?=utf8_encode($gabinete->user_nome)?></h2>
	
						<strong><?=utf8_encode($gabinete->cargo_nome)?></strong>
	
						<br><br>
	
						<p><?=$gabinete->user_curriculo?></p>
	
					</td>
	
				</tr>
	
			</table>
			
			<br /><br />
			
			<?php
			
			}
		
		}
		
		?>

	</div>

</div>  