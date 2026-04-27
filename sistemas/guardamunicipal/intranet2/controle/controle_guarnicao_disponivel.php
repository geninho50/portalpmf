<!-- ini inc head -->
					<?php 
					
	// Este primeiro header, corrigi o problema de acentuação dos caracteres.
	ini_set('default_charset','UTF-8');
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past		
					
			include("incValidaSessao.php");
					$idsession = $_SESSION['idSESSION'];
					require ("../classes/DB_mysql.php");
					require ("../classes/trataString.php");
					$obj = new DB_mysql ;
					$objS = new trataString;
					$conexao = $obj->conectarConf();
					include("head/incHeadCentral.php");
					//Pega a data atual
				   $data_atual = date("Y-m-d");
				   $hora_atual = date("H:i:s");
				   
	 function calcula_hora($inicio,$fim) {
		if (!is_array($inicio)) { $inicio = explode(":",$inicio); }
		if (!is_array($fim)) { $fim = explode(":",$fim); }
		$time_inicio    = (($inicio[0]*60)*60) + ($inicio[1]*60) + $inicio[2];
		$time_fim        = (($fim[0]*60)*60) + ($fim[1]*60) + $fim[2];
		$t[0] = floor(($time_fim - $time_inicio) / 60);
		$t[1] = floor((($time_fim - $time_inicio) / 60) / 60);
		$t[2] = $time_fim - $time_inicio;
		$h = $t[1];
		$m = $t[0] - ($t[1]*60);
		if ($m < 10) $m = "0$m";
		$s = $t[2] - (($h*60) + $m) * 60;
		if ($s < 10) $s = "0$s";
		$t[3] = "$h:$m:$s";
		// Array[0] = total em minutos ...
		// Array[1] = total em horas ...
		// Array[2] = total em segundos ...
		// Array[3] = retorna total h:m:s ...
		return $t[3];
		}

					?>
			<!-- fim inc head -->
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="3%" align="center"><img src="imagens/images.jpg" width="12" height="12"></td>			
			<tD width="61%" align="left" class="fieldset">GUARNI&Ccedil;&Otilde;ES A P&Eacute;
			  <hr></tD>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
		  </tr>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=4 order by setor";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$idGuarnicao = $linhaG["id"];
							$vtr = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$setor = $linhaG["setor"];
							$outros = $linhaG["outros"];
							$hora_entrada = $linhaG["hora_entrada"];
			?>
				<tr onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor=''">
					<th height="20" align="center" bgcolor="#CCCCCC">
					<?
						$sqlS = "SELECT id, vtr, sum(valor) as valortotal FROM ocorrencia_atendida where vtr='$vtr' and gerado=1 and data_cadastro='$data_atual' AND hora_cadastro>'$hora_entrada' GROUP BY vtr ORDER BY vtr ASC";
						$resultadoS = $obj->executaQuery($sqlS);
						while( $linhaS = mysql_fetch_array($resultadoS))
						{
							$id = $linhaS["id"];
							$valor = $linhaS["valortotal"];
							echo'<font class=negrito>'.$valor.'</font>';
						}
					?>
					</th>
					<th width="61%" height="23" align="left" class="negrito"><a href="javascript:POPUP('remover_ocupantes_guarnicao.php?idGuarnicao=<? echo $idGuarnicao;?>','800','300')">
					<? 
								if($guarda1 != '' ){echo '<font color="#FF0000"><I>setor '.$setor.' : </I></font>'.$vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
					?>
					</a></th>
					<th width="4%" align="center"><a onClick="J4('../classes/controleJ4.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j4.png" width="20" height="20" BORDER="0" title="REFEI&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J5('../classes/controleJ5.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j5.png" width="20" height="20" BORDER="0" title="ABASTECIMENTO"></A></th>
					<th width="4%" align="center"><a onClick="J6('../classes/controleJ6.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j6.png" width="20" height="20" BORDER="0" title="LAVA&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J8('../classes/controleJ8.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j8.png" width="20" height="20" BORDER="0" title="BANHEIRO"></A></th>
					<th width="4%" align="center"><a onClick="FINALIZAR('../classes/controleJ12.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr;?>')" href="#"><IMG SRC="imagens/j12.png" width="20" height="20" BORDER="0" title="FINALIZAR"></A></th>
					<th width="10%" align="center"><a href="javascript:POPUP('cadastro_p18.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr;?>','800','300')"><IMG SRC="imagens/p18.png" width="20" height="20" BORDER="0" title="P18"></a></th>
					<th width="6%" align="center" ><a href="javascript:POPUP('cadastro_indisponivel.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1','800','300')"><IMG SRC="imagens/in.png" width="20" height="20" BORDER="0" title="INDISPON&Iacute;VEL"></a></th>
				</tr>
			<?
						}
			?>

			<tr>
			<td width="3%">&nbsp;</td>			
			<tD width="61%" align="left" class="fieldset">GUARNI&Ccedil;&Otilde;ES BIKE
			  <hr></tD>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
		  </tr>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=3 order by setor";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$idGuarnicao = $linhaG["id"];
							$vtr2 = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$setor = $linhaG["setor"];
							$outros = $linhaG["outros"];
							$hora_entrada = $linhaG["hora_entrada"];
			?>
				<tr onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor=''">
					<th height="20" align="center" bgcolor="#CCCCCC">
					<?
						$sqlS = "SELECT id, vtr, sum(valor) as valortotal FROM ocorrencia_atendida where vtr='$vtr2' and gerado=1 and data_cadastro='$data_atual' AND hora_cadastro>'$hora_entrada' GROUP BY vtr ORDER BY vtr ASC";
						$resultadoS = $obj->executaQuery($sqlS);
						while( $linhaS = mysql_fetch_array($resultadoS))
						{
							$id = $linhaS["id"];
							$valor = $linhaS["valortotal"];
							echo'<font class=negrito>'.$valor.'</font>';
						}
					?>
					</th>
					<th width="61%" height="23" align="left" class="negrito"><a href="javascript:POPUP('remover_ocupantes_guarnicao.php?idGuarnicao=<? echo $idGuarnicao;?>','800','300')">
					<? 
								if($guarda1 != '' ){echo '<font color="#FF0000"><I>setor '.$setor.' : </I></font>'.$vtr2.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
					?>
					</a></th>
					<th width="4%" align="center"><a onClick="J4('../classes/controleJ4.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j4.png" width="20" height="20" BORDER="0" title="REFEI&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J5('../classes/controleJ5.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j5.png" width="20" height="20" BORDER="0" title="ABASTECIMENTO"></A></th>
					<th width="4%" align="center"><a onClick="J6('../classes/controleJ6.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j6.png" width="20" height="20" BORDER="0" title="LAVA&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J8('../classes/controleJ8.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j8.png" width="20" height="20" BORDER="0" title="BANHEIRO"></A></th>
					<th width="4%" align="center"><a onClick="FINALIZAR('../classes/controleJ12.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr2;?>')" href="#"><IMG SRC="imagens/j12.png" width="20" height="20" BORDER="0" title="FINALIZAR"></A></th>
					<th width="10%" align="center"><a href="javascript:POPUP('cadastro_p18.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr2;?>','800','300')"><IMG SRC="imagens/p18.png" width="20" height="20" BORDER="0" title="P18"></a></th>
					<th width="6%" align="center" ><a href="javascript:POPUP('cadastro_indisponivel.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1','800','300')"><IMG SRC="imagens/in.png" width="20" height="20" BORDER="0" title="INDISPON&Iacute;VEL"></a></th>
				</tr>
			<?
						}
			?>

			<tr>
			<td width="3%">&nbsp;</td>			
			<tD width="61%" align="left" class="fieldset">GUARNI&Ccedil;&Otilde;ES MOTO
			  <hr></tD>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
		  </tr>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=2 order by setor";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$idGuarnicao = $linhaG["id"];
							$vtr3 = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$setor = $linhaG["setor"];
							$outros = $linhaG["outros"];
							$hora_entrada = $linhaG["hora_entrada"];
			?>
				<tr onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor=''">
					<th height="20" align="center" bgcolor="#CCCCCC">
					<?
						$sqlS = "SELECT id, vtr, sum(valor) as valortotal FROM ocorrencia_atendida where vtr='$vtr3' and gerado=1 and data_cadastro='$data_atual' AND hora_cadastro>'$hora_entrada' GROUP BY vtr ORDER BY vtr ASC";
						$resultadoS = $obj->executaQuery($sqlS);
						while( $linhaS = mysql_fetch_array($resultadoS))
						{
							$id = $linhaS["id"];
							$valor = $linhaS["valortotal"];
							echo'<font class=negrito>'.$valor.'</font>';
						}
					?>
					</th>
					<th width="61%" height="23" align="left" class="negrito"><a href="javascript:POPUP('remover_ocupantes_guarnicao.php?idGuarnicao=<? echo $idGuarnicao;?>','800','300')">
					<? 
								if($guarda1 != '' ){echo '<font color="#FF0000"><I>setor '.$setor.' : </I></font>'.$vtr3.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
					?>
					</a></th>
					<th width="4%" align="center"><a onClick="J4('../classes/controleJ4.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j4.png" width="20" height="20" BORDER="0" title="REFEI&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J5('../classes/controleJ5.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j5.png" width="20" height="20" BORDER="0" title="ABASTECIMENTO"></A></th>
					<th width="4%" align="center"><a onClick="J6('../classes/controleJ6.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j6.png" width="20" height="20" BORDER="0" title="LAVA&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J8('../classes/controleJ8.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j8.png" width="20" height="20" BORDER="0" title="BANHEIRO"></A></th>
					<th width="4%" align="center"><a onClick="FINALIZAR('../classes/controleJ12.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr3;?>')" href="#"><IMG SRC="imagens/j12.png" width="20" height="20" BORDER="0" title="FINALIZAR"></A></th>
					<th width="10%" align="center"><a href="javascript:POPUP('cadastro_p18.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr3;?>','800','300')"><IMG SRC="imagens/p18.png" width="20" height="20" BORDER="0" title="P18"></a></th>
					<th width="6%" align="center" ><a href="javascript:POPUP('cadastro_indisponivel.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1','800','300')"><IMG SRC="imagens/in.png" width="20" height="20" BORDER="0" title="INDISPON&Iacute;VEL"></a></th>
				</tr>
			<?
						}
			?>
			
			<tr>
			<td width="3%">&nbsp;</td>			
			<tD width="61%" align="left" class="fieldset">GUARNI&Ccedil;&Otilde;ES P18
			  <hr></tD>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
		  </tr>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=8 order by setor";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$idGuarnicao = $linhaG["id"];
							$vtr4 = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$setor = $linhaG["setor"];
							$hora_entrada = $linhaG["hora_entrada"];
							$sqlP = "SELECT id,motivo,hora_entrada FROM p18 where idguarnicao=$idGuarnicao and status=0";
							$resultadoP = $obj->executaQuery($sqlP);
							if( $linhaP = mysql_fetch_array($resultadoP))
							{
								$idp18 = $linhaP["id"];
								$motivo = $linhaP["motivo"];
								$hora_entrada = $linhaP["hora_entrada"];
								$diferencatempo = calcula_hora($hora_entrada,$hora_atual);
			?>
							<tr onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor=''">
								<th height="20" align="center" bgcolor="#CCCCCC">
									<?
										$sqlS = "SELECT id, vtr, sum(valor) as valortotal FROM ocorrencia_atendida where vtr='$vtr4' and gerado=1 and data_cadastro='$data_atual' AND hora_cadastro>'$hora_entrada' GROUP BY vtr ORDER BY vtr ASC";
										$resultadoS = $obj->executaQuery($sqlS);
										while( $linhaS = mysql_fetch_array($resultadoS))
										{
											$id = $linhaS["id"];
											$valor = $linhaS["valortotal"];
											echo'<font class=negrito>'.$valor.'</font>';
										}
									?>
								</th>
								<th width="61%" height="23" align="left" class="negrito"><a href="javascript:POPUP('remover_ocupantes_guarnicao.php?idGuarnicao=<? echo $idGuarnicao;?>','800','300')">
								<? 
											if($guarda1 != '' ){echo '<font color="#FF0000"><I>setor '.$setor.' : </I></font>'.$vtr4.' = '.$guarda1;}
											if($guarda2 != '' ){echo ' / '.$guarda2;}
											if($guarda3 != '' ){echo ' / '.$guarda3;}
											if($guarda4 != '' ){echo ' / '.$guarda4;}
											if($guarda5 != '' ){echo ' / '.$guarda5;}
											if($motivo != '' ){echo ' - '.$motivo;}
								?>
								</a></th>
								<th width="4%" align="center" class="negrito"><? echo $diferencatempo; ?></th>
								<th width="4%" align="left" >&nbsp;</th>
								<th width="4%" align="left"><a onClick="EXLUIRGUARNICAO('../classes/controleP18.php?idp18=<? echo $idp18;?>&idGuarnicao=<? echo $idGuarnicao;?>&chave=2')" href="#"><IMG SRC="imagens/x.png" width="20" height="20" BORDER="0" title="REMOÇÃO DO P18"></A></th>
								<th width="4%" align="left" >&nbsp;</th>
								<th width="4%" align="left">&nbsp;</th>
								<th width="4%" align="left">&nbsp;</th>
								<th width="6%" align="left" >&nbsp;</th>
							</tr>
			<?
							}
						}
			?>
		<tr>
			<td width="3%">&nbsp;</td>			
			<tD width="61%" align="left" class="fieldset">GUARNI&Ccedil;&Otilde;ES VTR
		      <hr></tD>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
			<td width="6%">&nbsp;</td>
		  </tr>
			<?
						$sqlG = "SELECT * FROM guarnicao where status=1 AND idclassevtr=1 order by setor";
						$resultadoG = $obj->executaQuery($sqlG);
						while( $linhaG = mysql_fetch_array($resultadoG))
						{
							$idGuarnicao = $linhaG["id"];
							$vtr5 = $linhaG["vtr"];
							$guarda1 = $linhaG["guarda1"];
							$guarda2 = $linhaG["guarda2"];
							$guarda3 = $linhaG["guarda3"];
							$guarda4 = $linhaG["guarda4"];
							$guarda5 = $linhaG["guarda5"];
							$setor = $linhaG["setor"];
							$outros = $linhaG["outros"];
							$hora_entrada = $linhaG["hora_entrada"];
			?>
				<tr <? if($outros=='RONDA ESCOLAR NORTE' || $outros=='RONDA ESCOLAR SUL' || $outros=='RONDA ESCOLAR CENTRO'){?> bgcolor="#C9DDFC"<? }else{?>onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor=''"<? }?>>
					<th height="20" align="center" bgcolor="#CCCCCC">
					<?
						$sqlS = "SELECT id, vtr, sum(valor) as valortotal FROM ocorrencia_atendida where vtr='$vtr5' and gerado=1 and data_cadastro='$data_atual' AND hora_cadastro>'$hora_entrada' GROUP BY vtr ORDER BY vtr ASC";
						$resultadoS = $obj->executaQuery($sqlS);
						while( $linhaS = mysql_fetch_array($resultadoS))
						{
							$id = $linhaS["id"];
							$valor = $linhaS["valortotal"];
							echo'<font class=negrito>'.$valor.'</font>';
						}
					?>
					</th>
					<th width="61%" height="23" align="left" class="negrito"><a href="javascript:POPUP('remover_ocupantes_guarnicao.php?idGuarnicao=<? echo $idGuarnicao;?>','800','300')">
					<? 
								if($guarda1 != '' ){echo '<font color="#FF0000"><I>setor '.$setor.' : </I></font>'.$vtr5.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
					?></a>
					</th>
					<th width="4%" align="center"><a onClick="J4('../classes/controleJ4.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j4.png" width="20" height="20" BORDER="0" title="REFEI&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J5('../classes/controleJ5.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j5.png" width="20" height="20" BORDER="0" title="ABASTECIMENTO"></A></th>
					<th width="4%" align="center"><a onClick="J6('../classes/controleJ6.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j6.png" width="20" height="20" BORDER="0" title="LAVA&Ccedil;&Atilde;O"></A></th>
					<th width="4%" align="center"><a onClick="J8('../classes/controleJ8.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1')" href="#"><IMG SRC="imagens/j8.png" width="20" height="20" BORDER="0" title="BANHEIRO"></A></th>
					<th width="4%" align="center"><a onClick="FINALIZAR('../classes/controleJ12.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr5;?>')" href="#"><IMG SRC="imagens/j12.png" width="20" height="20" BORDER="0" title="FINALIZAR"></A></th>
					<th width="10%" align="center"><a href="javascript:POPUP('cadastro_p18.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1&vtr=<? echo $vtr5;?>','800','300')"><IMG SRC="imagens/p18.png" width="20" height="20" BORDER="0" title="P18"></a></th>
					<th width="6%" align="center" ><a href="javascript:POPUP('cadastro_indisponivel.php?idGuarnicao=<? echo $idGuarnicao;?>&chave=1','800','300')"><IMG SRC="imagens/in.png" width="20" height="20" BORDER="0" title="INDISPON&Iacute;VEL"></a></th>
				</tr>
			<?
						}
			?>
		</table>
