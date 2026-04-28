<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");

if(!isset($_POST['entidade'])){
	$_POST['entidade']=$_SESSION['SuserEnt'];
}
?>
<div class="centro">
	<div id="caminho_migalhas">intranet &gt;</div>
	<div id="titulo_pagina">calend&aacute;rio</div>
	<div id="coluna_intranet_unica">
	<div>
     	<div class="box">
    	<form name="calendario" method="post">
        Escolha uma entidade para consulta:
        <?php
        combo_entidades($drive, "entidade", $_POST['entidade']);
		echo ("<br/>");
		?>
        Informe o mês:<br>
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
            for ($j = 1; $j < $i; $j++){
				$ano = 2009 + $j;
				$imprime  = "<option value=\"";
				$imprime .= $ano;
				$imprime .= "\"";
				if (date("Y") == $ano){
					$imprime .= " selected=\"selected\">";	
				}
				$imprime .= $ano;
				$impirme .= "</option>";
				echo $imprime;	
			}
			?>       
        </select>                           
        <input type="image" src="../layout/imagens/atualiza_btn_OK.png"  align="absmiddle"/>        
        </form> 
        </div>       
        <br />        
      	<?php	
		if (!isset($_POST['mes'])){			
			$data_inicial = date("Y/m")."/01";
			$data_final = date("Y")."/12/31";			
			if(!isset($_POST['entidade']) or ($_POST['entidade'] != "")){
				$compementaSql = "AND cal_entidade_id = ".$_SESSION['SuserEnt']."";	
			}
			$sql = "SELECT * FROM calendario WHERE cal_data >= '$data_inicial' AND cal_data <= '$data_final' $compementaSql ORDER BY cal_data ";
			
		}else{
			$consulta  = "SELECT * FROM calendario ";
			
			if($_POST['mes'] > 0){
				$data_inicial = $_POST['ano']."/".$_POST['mes']."/01";
				$data_final = $_POST['ano']."/".$_POST['mes']."/31";
				$consulta .= "WHERE cal_data >= '$data_inicial' AND cal_data <= '$data_final' ";		
			}else{
				$data_inicial = $_POST['ano']."/01/01";
				$data_final = $_POST['ano']."/12/31";
				$consulta .= "WHERE cal_data >= '$data_inicial' AND cal_data <= '$data_final' ";
			}
				
			if($_POST['entidade'] > 0){
				$consulta .= "AND cal_entidade_id = ".$_POST['entidade']." "; 				
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
					echo "<H1>".retornaMes($mes[1])." de ".$mes[0]."</H1><br />";					
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
											echo "<a href=\"".$vetorCalendario[$j]->cal_evento."\" target=\"blank\"><img src=\"../layout/imagens/marcador_azul3.png\" border=\"0\" /></a>"; 
										}
									echo "</li>";
									}else{
										$aux = ($j - $Cigual) + 1;
										for ($k=1; $k <= $Cigual; $k++){
											echo "<li>";
												echo "<strong>".$vetorCalendario[$aux]->cal_titulo."</strong>";
												echo "&nbsp;";
												if($vetorCalendario[$aux]->cal_evento != ""){ 
													echo "<a href=\"".$vetorCalendario[$aux]->cal_evento."\" target=\"blank\"><img src=\"../layout/imagens/marcador_azul3.png\" border=\"0\" /></a>"; 
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
				</table>
                </li></ul>				
				<?php	
				}else{
					$Cigual++;
				}
			}
		}
		?>  
        </div>
    </div>    
   
</div>