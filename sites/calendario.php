<?php
require_once("../../scripts/php/funcoes.php");

?>
<div id="pagina">

	<div id="caminho_migalhas">home &gt;</div>

	<div id="titulo_pagina">calend&aacute;rio</div>

	<div>
    	<form name="calendario" method="post">

        

        <select name="mes">
            <option value="0" <?php if (!isset($_POST['mes'])){echo "selected=\"selected\"";}?>>== Todos os meses ==</option> 
            <option value="0"></option> 
            <option value="01" <?php if ($_POST['mes'] == '01'){echo "selected=\"selected\"";}?>>Janeiro</option> 
            <option value="02" <?php if ($_POST['mes'] == '02'){echo "selected=\"selected\"";}?>>Fevereiro</option>
            <option value="03" <?php if ($_POST['mes'] == '03'){echo "selected=\"selected\"";}?>>Mar&ccedil;o</option>
            <option value="04" <?php if ($_POST['mes'] == '04'){echo "selected=\"selected\"";}?>>Abril</option>
            <option value="05" <?php if ($_POST['mes'] == '05'){echo "selected=\"selected\"";}?>>Maio</option>
            <option value="06" <?php if ($_POST['mes'] == '06'){echo "selected=\"selected\"";}?>>Junho</option>
            <option value="07" <?php if ($_POST['mes'] == '07'){echo "selected=\"selected\"";}?>>Julho</option>
            <option value="08" <?php if ($_POST['mes'] == '08'){echo "selected=\"selected\"";}?>>Agosto</option>
            <option value="09" <?php if ($_POST['mes'] == '09'){echo "selected=\"selected\"";}?>>Setembro</option>
            <option value="10" <?php if ($_POST['mes'] == '10'){echo "selected=\"selected\"";}?>>Outubro</option>
            <option value="11" <?php if ($_POST['mes'] == '11'){echo "selected=\"selected\"";}?>>Novembro</option>
            <option value="12" <?php if ($_POST['mes'] == '12'){echo "selected=\"selected\"";}?>>Dezembro</option>
        </select > 
        
        <?php
       
	   	$ano = date("Y");
		
		$i = ($ano - 2010) + 2;
		
		?>
        
        <select name="ano">
        
        	<?php
			$ano = date("Y");	
			$i 	 = ($ano - 2010) + 2;
            for ($j = 1; $j < $i; $j++){
				$ano = 2009 + $j;
				$imprime  = "<option title=\"".$ano."\" value=\"";
				$imprime .= $ano;
				$imprime .= "\"";
				if(isset($_POST['btConsulta_x'])){
					if ($ano == $_POST['ano']){
						$imprime .= " selected=\"selected\">";	
					}else{
						$imprime .= ">";
					}
				}else{
					if (date("Y") == $ano){
						$imprime .= " selected=\"selected\">";	
					}else{
						$imprime .= ">";
					}
				}
				$imprime .= $ano;
				$impirme .= "</option>";
				echo $imprime;	
			}
			$imprime = "<option title=\"". (date("Y") + 1)."\" value=\"";
			$imprime .= date("Y") + 1;
			$imprime .= "\"";
			if ((date("Y") + 1) == $_POST['ano']){
				$imprime .= " selected=\"selected\">";	
			}else{
				$imprime .= ">";
			}
			$imprime .= date("Y") + 1;
			$impirme .= "</option>";	
			echo $imprime;
			?>        	
        
        </select>
                           
        <input type="image" src="../../layout/imagens/atualiza_btn_OK.png"  align="absmiddle"/>
        
        </form>
        
        <br />
        
      	<?php
		
		
		if (!isset($_POST['mes'])){
			
			$data_inicial = date("Y/m")."/01";
			$data_final = date("Y")."/12/31";
			$sql = "SELECT * FROM calendario WHERE cal_data >= '$data_inicial' AND cal_data <= '$data_final' AND cal_tipo = 1 AND cal_entidade_id = $IdEntidade ORDER BY cal_data ";
		}else{
			$consulta  = "SELECT * FROM calendario ";
			
			if($_POST['mes'] > 0){
				$data_inicial = $_POST['ano']."/".$_POST['mes']."/01";
				$data_final = $_POST['ano']."/".$_POST['mes']."/31";
				$consulta .= "WHERE cal_data >= '$data_inicial' AND cal_data <= '$data_final' AND cal_tipo = 1 AND cal_entidade_id = $IdEntidade ";		
			}else{
				$data_inicial = $_POST['ano']."/01/01";
				$data_final = $_POST['ano']."/12/31";
				$consulta .= "WHERE cal_data >= '$data_inicial' AND cal_data <= '$data_final' AND cal_tipo = 1 AND cal_entidade_id = $IdEntidade ";
			}
				
			$consulta .= "ORDER BY cal_data ";
			$sql = $consulta;
			
		}
		

		$result = $drive->pedido($sql);
		$result2 = $drive->pedido($sql);
		$valida = pg_fetch_object($result);
		
		if ($valida == null){
			
			echo"<b>Nenhum registro Encontrado.</b>";
			
		}else{	
		
			$i = 0;
			while($imprime = pg_fetch_object($result2)){
				$vetorCalendario[$i] = $imprime;
				$i++;
			}
			$Cigual = 1;
			for ($j=0; $j < count($vetorCalendario); $j++){
				$mes_cmp = explode("-", $vetorCalendario[$j]->cal_data);
				
				if(($j ==0) or ($mes[1] != $mes_cmp[1])){ // Separa eventos por meses
					echo "<br /><br />";
					$mes = explode("-", $vetorCalendario[$j]->cal_data);
					echo "<H1>".retornaMes($mes[1])." de ".$mes[0]."</H1>";					
				}
				if ($vetorCalendario[$j]->cal_data != $vetorCalendario[$j+1]->cal_data){
				?>
				<ul class="calendario"><li><table width="96%">
					<tr>
						<td width="90">
							<div class="data"><span class="numero"><?=$mes_cmp[2]?></span><?=diasemana($vetorCalendario[$j]->cal_data)?></div>
						</td>
						<td valign="middle">
							<ul class="listagem">
								<?php
									if ($Cigual == 1){
									echo "<li>";
										echo "<strong>".$vetorCalendario[$j]->cal_titulo."</strong>";
										echo "&nbsp;";
										if($vetorCalendario[$j]->cal_evento != ""){ 
											echo "<a href=\"".$vetorCalendario[$j]->cal_evento."\" target=\"blank\"><img src=\"../../layout/imagens/marcador_azul2.png\" border=\"0\" /></a>"; 
										}
										if($vetorCalendario[$j]->cal_complemento != ""){ 
											echo "<br>".$vetorCalendario[$j]->cal_complemento; 
										}
									echo "</li>";
									}else{
										$aux = ($j - $Cigual) + 1;
										for ($k=1; $k <= $Cigual; $k++){
											echo "<li>";
												echo "<b>".$vetorCalendario[$aux]->cal_titulo."</b>";
												echo "&nbsp;";
												if($vetorCalendario[$aux]->cal_evento != ""){ 
													echo "<a href=\"".$vetorCalendario[$aux]->cal_evento."\" target=\"blank\"><img src=\"../../layout/imagens/marcador_azul2.png\" border=\"0\" /></a>"; 
												}
												if($vetorCalendario[$aux]->cal_complemento != ""){ 
													echo "<br>".$vetorCalendario[$aux]->cal_complemento; 
												}
												$aux++;
											echo "</li>";
											if ($k == $Cigual){ $Cigual = 1; }
										}
									}
								?>
							</ul>
						</td>
					</tr>
				</table></li> </ul>				
				<?php	
				}else{
					$Cigual++;
				}
			}
		}
		?>  
	</div>
</div><!-- fim coluna_C2 -->  