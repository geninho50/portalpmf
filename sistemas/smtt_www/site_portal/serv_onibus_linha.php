<script type="text/javascript">


function AlternarAbas(passo){

	document.getElementById('formPrincipal').passoGeral.value = passo;
	document.getElementById('formPrincipal').submit();
}



function MostraItinerario(){
    document.getElementById('itinerario').style.display = 'block';
}

function EscondeItinerario(){
    document.getElementById('itinerario').style.display = 'none';
}

</script>

<?php 
$idLinha = $_GET['idLinha'];

	$sql = "SELECT LIN.*, EMP.* FROM linhas AS LIN
			JOIN empresas AS EMP ON EMP.empresa = LIN.empresa
			WHERE LIN.linha = '$idLinha'";
	
	require_once("../scripts/php/funcoes_bd_onibus.php");
	$driveOnibus->conecta();
	
	$resultado = $driveOnibus->pedido($sql);
	
	$obj = pg_fetch_object($resultado);

	$observacao = utf8_encode($obj->observacao);


?>
<div class="centro">
<div id="cabecalho_onibus_linha">
    <div id="caminho_migalhas">
    	home &gt; serviços
    </div>
    
    <div id="titulo_pagina">
        <h1>
            <?= $obj->nome_linha?> (<?=$obj->linha?>)
        </h1>
    </div> 
    <h4>Empresa: <?=$obj->nome_empresa?></h4>  
        <br>
        
        <div class="box">
        <div id="descricao_linha">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <?=utf8_encode($obj->valortarifa1)?><br />
                        <?=utf8_encode($obj->valortarifa2)?><br />                        
                        <?=utf8_encode($obj->tempoperc1)?><br />
                        <?=utf8_encode($obj->tempoperc2)?><br />
                        <?=utf8_encode($obj->extensao1)?> <br />
                        <?=utf8_encode($obj->extensao2)?>  
                    </td>
 
      				<td align="center" valign="top"><br><br>
                    	<?
                        if($_POST['tipoHorario']==1 or empty($_POST['tipoHorario'])){
						?>
                        
                    	<form method="post">
                        <input type="hidden" name="tipoHorario" value="2"/>
                        <input type="image" src="../layout/imagens/serv_btn_onibus_futuros.png" align="absmiddle" /> 
                        </form>
                        <?
                        }else{
						?>
                        <form method="post">
                        <input type="hidden" name="tipoHorario" value="1"/>
                        <input type="image" src="../layout/imagens/serv_btn_onibus_atuais.png" align="absmiddle" /> 
                        </form>
						<?
						}
						?>
                        <br />
                  </td>
                </tr>
            </table>
    	</div> <!-- Fim da DIV descricao_linha -->
    	</div><!-- Fim da DIV box -->
        <br>
         
            
</div>
<div id="area_servicos_onibus_linha">
        
        <?php
		
		if(empty($_POST['tipoHorario']) or $_POST['tipoHorario']==1){
		
			if(empty($_POST['passoGeral']) or $_POST['passoGeral']==1){
			
				$idLinha = $_GET['idLinha'];

				$dataAtual = date("Y-m-d");
				
				require_once("../scripts/php/funcoes.php");
				
				$sql = "SELECT HOR.*,HORP.*FROM horarios AS HOR
						JOIN horarios_per AS HORP ON HOR.id = HORP.id						
						WHERE 
						HOR.linha = '$idLinha'
						AND 
						HOR.sentido = 'Ida'	
						AND 
						HORP.data_i <='$dataAtual'
						AND
						HORP.data_f >='$dataAtual'					
						";

				
				$resultado = $driveOnibus->pedido($sql);
				
				while($obj = pg_fetch_object($resultado)){
					
					$origem = $obj->origem_destino;
					$idPer = $obj->id_per;
					$tipoDia = $obj->tipo_dia;
					
					$sql2 = "
						SELECT * FROM horarios_per_det WHERE id_per = $idPer ORDER BY turno,hor ASC
					";
					
					$res = $driveOnibus->pedido($sql2);
					
					while($obj2 = pg_fetch_object($res)){
						$horario= substr($obj2->hor,0,2);
						$horario2= substr($obj2->hor,2,4);
						$complemento = $obj2->complementos;
						if($tipoDia==1){
							$vigenciaDiaSemana = "vigência<br/> ".transformaData($obj->data_i);
							if(!empty($complemento)){								
								$diaSemana.=$horario.":".$horario2." - ".$complemento."<br/>";
							}else
								$diaSemana.=$horario.":".$horario2."<br/>";
						}else
						if($tipoDia==2){
							$vigenciaSabado = "vigência<br/> ".transformaData($obj->data_i);
							if(!empty($complemento)){
							$sabado.=$horario.":".$horario2." - ".$complemento."<br/>";
							}else
							$sabado.=$horario.":".$horario2."<br/>";
						}else
						if($tipoDia==3){
							$vigenciaDomingo = "vigência<br/>  ".transformaData($obj->data_i);
							if(!empty($complemento)){
							$domingo.=$horario.":".$horario2." - ".$complemento."<br/>";
							}else
							$domingo.=$horario.":".$horario2."<br/>";
						}
					
					}
					
					
					
					
						
						
					
					
				}
			
			?>
            



           
			
			<div class="painel_abas">
				<form method="post" id="formPrincipal">
					<input type="hidden" name="passoGeral" />
					<div id="aba_horaida" class="aba_sel" onClick="AlternarAbas('1')">
						<span>
							horários ida
						</span>
					</div>
					<div id="aba_horavolta" class="aba_serv" onClick="AlternarAbas('2')">
						<span>
							horários volta
						</span>
					</div>
					<div id="aba_itinerario" class="aba_serv" onClick="AlternarAbas('3')">
						<span>
							itinerário
						</span>
					</div>
				</form>    
			</div><!-- fim painel_abas --> 
			
			
			<div class="conteudo_abas_ext">  
			
			  <div id="conteudo_horaida" style="display:inline">
					
					<b>
					<?=$origem?>
					</b>
					<br>
					<br>
					
				  <table border="0" cellspacing="0" cellpadding="0" >
					<?php 
						if(!empty($observacao)){
						
					?>
					  <th scope="col" align="center" colspan="3">Legendas</th>
					  <tr>
						  <td colspan="3" id="texto_legenda">
							  <?=$observacao?>						  </td>
					  </tr>
					<?
					}
					?>
					<tr>
					<th scope="col">
						<div align="center">2ª a 6ª
						  <br />
						  <?=$vigenciaDiaSemana?>
					    </div></th>
					<th scope="col">
						<div align="center">Sábados
						  <br/>
						  <?=$vigenciaSabado?>
					    </div></th>
					<th scope="col">
						<div align="center">Domingos
						  <br/>
						  <?=$vigenciaDomingo?>
					    </div></th>
					</tr>
					<tr>
					<td valign="top">
					<?=$diaSemana?>					</td>
					<td valign="top">
					<?=$sabado?>					</td>
					<td valign="top">
					<?=$domingo?>					</td>
					</tr>
				  </table>
			
			  </div><!-- fim conteudo_horaida -->
			<?php 
			}else
			if($_POST['passoGeral']==2){
				$idLinha = $_GET['idLinha'];

				$dataAtual = date("Y-m-d");
				
				$sql = "SELECT HOR.*,HORP.*FROM horarios AS HOR
						JOIN horarios_per AS HORP ON HOR.id = HORP.id						
						WHERE 
						HOR.linha = '$idLinha'
						AND 
						HOR.sentido = 'Volta'	
						AND 
						HORP.data_i <='$dataAtual'
						AND
						HORP.data_f >='$dataAtual'					
						";

				
				$resultado = $driveOnibus->pedido($sql);
				
				while($obj = pg_fetch_object($resultado)){
					
					$origem = $obj->origem_destino;
					$idPer = $obj->id_per;
					$tipoDia = $obj->tipo_dia;
					require_once("../scripts/php/funcoes.php");					
					$sql2 = "SELECT * FROM horarios_per_det WHERE id_per = $idPer ORDER BY turno,hor" ;
					
					$res = $driveOnibus->pedido($sql2);
					
					while($obj2 = pg_fetch_object($res)){
						$horario= substr($obj2->hor,0,2);
						$horario2= substr($obj2->hor,2,4);
						$complemento = $obj2->complementos;
						if($tipoDia==1){
							$vigenciaDiaSemana = "vigência<br/> ".transformaData($obj->data_i);
							if(!empty($complemento)){								
								$diaSemana.=$horario.":".$horario2." - ".$complemento."<br/>";
							}else
								$diaSemana.=$horario.":".$horario2."<br/>";
						}else
						if($tipoDia==2){
							$vigenciaSabado = "vigência<br/> ".transformaData($obj->data_i);
							if(!empty($complemento)){
							$sabado.=$horario.":".$horario2." - ".$complemento."<br/>";
							}else
							$sabado.=$horario.":".$horario2."<br/>";
						}else
						if($tipoDia==3){
							$vigenciaDomingo = "vigência<br/> ".transformaData($obj->data_i);
							if(!empty($complemento)){
							$domingo.=$horario.":".$horario2." - ".$complemento."<br/>";
							}else
							$domingo.=$horario.":".$horario2."<br/>";
						}
					
					}
					
					
					
					}
					
						
						
					
					
				
			?>
				<div class="painel_abas">
					<form method="post" id="formPrincipal">
						<input type="hidden" name="passoGeral" />
						<div id="aba_horaida" class="aba_serv" onClick="AlternarAbas('1')">
							<span>
								horários ida
							</span>
						</div>
						<div id="aba_horavolta" class="aba_sel" onClick="AlternarAbas('2')">
							<span>
								horários volta
							</span>
						</div>
						<div id="aba_itinerario" class="aba_serv" onClick="AlternarAbas('3')">
							<span>
								itinerário
							</span>
						</div>
					</form>    
				</div><!-- fim painel_abas --> 
			
			
			<div class="conteudo_abas_ext"> 
			  <div id="conteudo_horavolta" >
					<b>
					<?=utf8_encode($caminhoLinha)?>
					</b>
					<br><br>
					
				  <table border="0" cellspacing="0" cellpadding="0" >
				    <?php 
						if(!empty($observacao)){
						
					?>
					  <th scope="col" align="center" colspan="3">Legendas</th>
					  <tr>
						  <td colspan="3" id="texto_legenda">
							  <?=$observacao?>						  </td>
					  </tr>
					<?
					}
					?>
					<tr>
					<th scope="col">
						<div align="center">2ª a 6ª<br/>
						  <?=$vigenciaDiaSemana?>
					    </div></th>
					<th scope="col">
						<div align="center">Sábados
						  <br/>
						  <?=$vigenciaSabado?>
					    </div></th>
					<th scope="col">
						<div align="center">Domingos
						  <br/>
						  <?=$vigenciaDomingo?>
					    </div></th>
					</tr>
					<tr>
					<td valign="top"><?=$diaSemana?> <br />					</td>
					<td valign="top">
					<p>
					<?=$sabado?></p></td>
					<td valign="top"><?=$domingo?> <br />					</td>
					</tr>
				  </table>
				
			  </div><!-- fim conteudo_horavolta --> 
			<?php 
			}else
			if($_POST['passoGeral']==3){
				
				$idLinha = $_GET['idLinha'];
				
				require_once("../scripts/php/funcoes_bd_onibus.php");
				
				$sql = "SELECT * FROM itinerarios WHERE linha = '$idLinha'  ORDER BY sentido, ordem, id_itin";
				
				$resultado =	 $driveOnibus->pedido($sql);
				
				while($obj = pg_fetch_object($resultado)){
				
					$itinerario.=
								"							
							  <li>
								&raquo; ".utf8_encode($obj->rua)."
							  </li>
							  ";
				
				}
			
			?>
				<div class="painel_abas">
					<form method="post" id="formPrincipal">
						<input type="hidden" name="passoGeral" />
						<div id="aba_horaida" class="aba_serv" onClick="AlternarAbas('1')">
							<span>
								horários ida
							</span>
						</div>
						<div id="aba_horavolta" class="aba_serv" onClick="AlternarAbas('2')">
							<span>
								horários volta
							</span>
						</div>
						<div id="aba_itinerario" class="aba_sel" onClick="AlternarAbas('3')">
							<span>
								itinerário
							</span>
						</div>
					</form>    
				</div><!-- fim painel_abas --> 
			
			
			<div class="conteudo_abas_ext"> 
				<div id="conteudo_itinerario">
                <ul class="listagem">
				
					
					<?=$itinerario?>
					<BR><BR>
					
				</ul>
				</div><!-- fim conteudo_itinerario --> 
		<?php 
		}
		?>
		
			</div><!-- fim conteudo_abas_ext -->     
		
    
     <?php 
	}else
		require_once("serv_onibus_futuro.php");
	
		
	
	
	?>
    
    
       <div id="itinerario" style="display:none" class="div_flutuante_onibus">
           <a href="javascript:EscondeItinerario()" onclick="javascript: initialize()"><img src="../layout/imagens/atualiza_btn_fechar.png" border="0" align="absmiddle" /></a><br><br>
          <?php 
		  	
			$linhaId = $_GET['idLinha'];
		  
		  	$sqlIda= "SELECT ITIN.*, LOGRA.* FROM horario_onibus_itinerarios AS ITIN
					  JOIN horario_onibus_logradouros AS LOGRA ON ITIN.itin_logra_id = LOGRA.logra_id 
					  WHERE ITIN.itin_linha_id = $linhaId 
					  AND ITIN.itin_sentido = '1'";
			
			$resultado = $drive->pedido($sqlIda);
			$cont=0;
			while($obj = pg_fetch_object($resultado)){
				if(!empty($obj->logra_latitude) && ($cont==0)){
					$direcao.="from: $obj->logra_latitude,$obj->logra_longitude "; 
				}else
				if(!empty($obj->logra_latitude)){
					$direcao.="to: $obj->logra_latitude,$obj->logra_longitude ";	
				}
				$cont++;
			}		  
			
		  ?> 
          <input type="button" value="Gerar Rota!" onclick="tracarRotas('<?=$direcao?>'); return false" />
          <div  id="map_canvas" style="width: 490px; height: 430px;"></div>
        </div>
    
    
    
    </div><!-- Fim da DIV semn nome nenhum-->
</div><!-- fim coluna_C2 -->   
