<?
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
						HORP.data_i >='$dataAtual'				
						";

				
				$resultado = $driveOnibus->pedido($sql);
				
				while($obj = pg_fetch_object($resultado)){
					
					$origem = $obj->origem_destino;
					$idPer = $obj->id_per;
					$tipoDia = $obj->tipo_dia;
					
					$sql2 = "SELECT * FROM horarios_per_det WHERE id_per = $idPer ORDER BY hor" ;
					
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
                    <input type="hidden" name="tipoHorario" value="2" />
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
					<img src="../layout/imagens/serv_marcador.png" width="15" height="16" align="absmiddle" /> 
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
						  <td colspan="3">
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
						HORP.data_i >='$dataAtual'
									
						";

				
				$resultado = $driveOnibus->pedido($sql);
				
				while($obj = pg_fetch_object($resultado)){
					
					$origem = $obj->origem_destino;
					$idPer = $obj->id_per;
					$tipoDia = $obj->tipo_dia;
					require_once("../scripts/php/funcoes.php");					
					$sql2 = "SELECT * FROM horarios_per_det WHERE id_per = $idPer ORDER BY hor" ;
					
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
                        <input type="hidden" name="tipoHorario" value="2" />
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
					<b><img src="../layout/imagens/serv_marcador.png" width="15" height="16" align="absmiddle" /> 
					<?=$caminhoLinha?>
					</b>
					<br><br>
					
				  <table border="0" cellspacing="0" cellpadding="0" >
				    <?php 
						if(!empty($observacao)){
						
					?>
					  <th scope="col" align="center" colspan="3">Legendas</th>
					  <tr>
						  <td colspan="3">
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
				
				$sql = "SELECT * FROM itinerarios WHERE linha = '$idLinha' ORDER BY ordem";
				
				$resultado =	 $driveOnibus->pedido($sql);
				
				while($obj = pg_fetch_object($resultado)){
				
					$itinerario.=
								"							
							  <li>
								&raquo; $obj->rua
							  </li>
							  ";
				
				}
			
			?>
				<div class="painel_abas">
					<form method="post" id="formPrincipal">
						<input type="hidden" name="passoGeral" />
                        <input type="hidden" name="tipoHorario" value="2" />
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
		