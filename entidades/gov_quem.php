      <div class="centro">
      <div id="caminho_migalhas">home &gt; sobre</div>
     <div id="titulo_pagina">nossa equipe</div>
     <div><br><br> 
     
		   <?php
           
		    $sql = "SELECT * FROM entidades WHERE entidade_id = $IdEntidade";
           
		    $result = $drive->pedido($sql);
           
		    $V_entidade = pg_fetch_object($result);    
			
		    ?>
			            
            <?php
            
			$sql = "SELECT
						*
					FROM
						setores
					WHERE
						setor_entidade_id = $IdEntidade
					ORDER BY
						setor_posicao";
			
			$result = $drive->pedido($sql);
			
			
			
			$indice = 0;
			
			while($all_setores = pg_fetch_object($result)){
			
			$setores_id[$indice] = $all_setores->setor_id;	
			
			$setores_nome[$indice] = $all_setores->setor_nome;
			
			$setores_local_id[$indice] = $all_setores->setor_local_id;		
			
			$indice++;
			
			}
			       
			for($i=0; $i < $indice; $i++){
				$sql = "SELECT LOC.*, 
							BAR.bairro_nome 
						FROM locais AS LOC 
					INNER JOIN bairros AS BAR 
							ON LOC.loc_bairro = BAR.bairro_id 
						WHERE LOC.loc_id = $setores_local_id[$i]";

				$result = $drive->pedido($sql);
				
				$local = pg_fetch_object($result);
				
				$V_ent_id = $V_entidade->entidade_id;			
				
				$pos = strpos($local->loc_email, '@');

				if ( $pos !== false ) {
					$complemento_email = "pmf.sc.gov.br";
				}else{
					$complemento_email = "@pmf.sc.gov.br";	
				}
					
				?>    
							
					<span class="titulo_quem_e_quem"><?=$setores_nome[$i]?></span><br><br>
					
					<p><?=$local->loc_rua?>, nº<?=$local->loc_num?> - <?=$local->loc_complemento?><br />
					
					<?=$local->bairro_nome?> - CEP: <?=$local->loc_cep?><br />
				<?php	
					if($local->loc_id == 317) {
					} else {
						if ( strpos($local->loc_fone,'48') === 0 ){
							if ( $local->loc_fone !== '4800000000' ){ ?>
							Telefone: <?=$V_telefone = "(".substr($local->loc_fone,0,2).") ".substr($local->loc_fone,2,4)."-".substr($local->loc_fone,6,4);?> <br/>
					<?php }
							}else{ ?>
							Telefone: <?=$V_telefone = $local->loc_fone; ?>  <br />		
						<?php }	?>
		
				<?php
				}			
					if($local->loc_id == 317) {
				}
				else {
					$pos = strpos($local->loc_email, '@');	
					
					if ( $pos !== false ){						
						echo "Email: " . $local->loc_email;
					} else {
						echo "Email: " . $local->loc_email . $complemento_email;
					}
					echo "<br>";	
				}
			?>
			
                Atendimento
                <?php
                $TvalMat = explode(":", $local->loc_horario);
				$TvalMat = (int)$TvalMat[0];
				$TvalVesp = explode(":", $local->loc_horario3);
				$TvalVesp = (int)$TvalVesp[0];
				if(($TvalMat > 0) and ($TvalVesp > 0)){
					echo "de ".$local->loc_horario."h às ".$local->loc_horario2."h e de ".$local->loc_horario3."h às ".$local->loc_horario4."h";
				}else{
					if(($TvalMat > 0) and ($TvalVesp == 0)){
						echo "de ".$local->loc_horario."h às ".$local->loc_horario2."h";
					}else{
						if(($TvalMat == 0) and ($TvalVesp > 0)){
							echo "de ".$local->loc_horario3."h às ".$local->loc_horario4."h";
						}
					}
				}
				?>
                
                </p><br>
					
				<table width="97%" border="0" cellspacing="0" cellpadding="0">
				
				
				<?PHP	
				
				
			
				$sql = "SELECT USERI.*, CARGO.* FROM uni_usuarios AS USERI
						 JOIN cargos AS CARGO ON USERI.user_cargo_id = CARGO.cargo_id							
						WHERE 
							USERI.user_entidade_id = $V_ent_id 
						AND
							USERI.user_setor_id = $setores_id[$i]
						AND 
							USERI.user_quem = 't' 
						ORDER BY 
							CARGO.cargo_posicao"; 		

				$result = $drive->pedido($sql);		
				
				$alterna = 2;
				
				while($V_usuario = pg_fetch_object($result))
				
				{	
				
				if( $V_usuario->user_fone == '4800000000' ){	
					$V_telefone = '';
				}else{
					$V_telefone = $V_usuario->user_fone;
				}
				
				/*
				if(strlen(trim($V_usuario->user_fone)) > 10) {
					$V_telefone = $V_usuario->user_fone;
					// $V_telefone = "(".substr($V_usuario->user_fone,0,2).") ".substr($V_usuario->user_fone,2,4)."-".substr($V_usuario->user_fone,6,4)."<br>(".substr($V_usuario->user_fone,10,2).") ".substr($V_usuario->user_fone,12,4)."-".substr($V_usuario->user_fone,16,4);	
				} else {
					$V_telefone = "(".substr($V_usuario->user_fone,0,2).") ".substr($V_usuario->user_fone,2,4)."-".substr($V_usuario->user_fone,6,4);
				}
				*/

				$V_cargo_id = $V_usuario->user_cargo_id;
				
				$sql2 = "SELECT * FROM cargos WHERE cargo_id = $V_cargo_id";
				
				$result2 = $drive->pedido($sql2);
				
				$V_cargo2 = pg_fetch_object($result2);
				
				if($alterna%2 == 0){
					
					$classe = "result_busca_governoB";
				
				}else{
				
					$classe = "result_busca_governo";
				}			
				$user_nome = utf8_encode($V_usuario->user_nome);
				$cargo_nome = utf8_encode($V_cargo2->cargo_nome);
				$imprime = "
				
					<tr>
				
						<td class=\"$classe\" width=\"57%\">
				
							<strong>$user_nome</strong><br >

							$cargo_nome
				
						</td>
				
						<td class=\"$classe\" width=\"43%\">
				
							$V_telefone<br />";
				
				if( $V_usuario->user_email != "" and 
				    $V_usuario->user_email != "..." ){
					$imprime .=	"<a href=\"mailto:$V_usuario->user_email\">".$V_usuario->user_email."</a>";
				}
				
				if ( strpos($V_usuario->user_email, '@') !== false ) {					
					$imprime .= "<?=$V_usuario->user_email?><?/>";
				} else{
					$imprime .= "<?=$V_usuario->user_email?>$complemento_email<?/>";
				}
				
				$imprime .= " </td> </tr>";
				
				echo($imprime);
				
				


				$alterna++;
				
				} 
				
				?>  
				
				</table>
				
				<br /><br />
				
				<?php
				
				}
				
				?>
      </div>
   </div>
<!-- fim coluna_C2 -->            
          
          
          
	
