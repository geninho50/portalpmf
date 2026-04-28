<html>
<head>
<style type="text/css">
<!--
.texto_form {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 8.5pt;
	color: #333333;
	font-weight: normal;
}
-->
</style>
</head>
<body leftMargin="0" topMargin="0" >
	<table width="510" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
        	<td colspan="2">
            	<p>
				<font color="#000066" size="2" face="Verdana, Arial, Helvetica, sans-serif">
                  	<div style="float:left">
                      	<strong>
                        	<big>
								<?php 
								if($p_complemento && $enviarcompl){
									//echo "$sqlUp";
								}
								?>
                           	</big>
                     	</strong>
                 	</div>
				</font>
                </p>
                <br />
        	</td>
      	</tr>
        <?php
		if($msg){
		?>
		<tr>
        	<td colspan="2">
				<p>
				<font color="#000066" size="2" face="Verdana, Arial, Helvetica, sans-serif">
					<div style="text-align:center">
                    	<strong><?=$msg?></strong>
					</div>
				</font>
				</p>
			</td>
      	</tr>
		<?php
		}else{
			while ($row = pg_fetch_row($stres)) {
				$numeroatendimento  = $row[0];
				$anoatendimento     = $row[1];
				$nomesolicitante    = $row[2];
				$sexosolicitante    = $row[3];
				$idadesolicitante   = $row[4];
				$apelidosolicitante = $row[5];
				$datasolicitacao    = $row[6];
				$encaminhadopara    = $row[7];
				$dataprovidencia    = $row[9];
				if ($dataprovidencia != ""){
					$dataprovidencia = data_php($dataprovidencia);
				}			
				if ($datasolicitacao != ""){
					$datasolicitacao = data_php($datasolicitacao);
				}	
				if ($row[8]) {
					// $blob_data 	= pg_blob_info($row[7]);
					// $blob_hndl 	= pg_blob_open($row[7]);
					// $providencia = stripslashes(pg_blob_get($blob_hndl, $blob_data[0]));
					$providencia = stripslashes($row[8]);
					// $providencia = str_replace("\\\"", "\"", $providencia);
				}			
				$nomeorgaoencaminhado = " - ".$row[10];
				$descrreivindicacao   = stripslashes($row[11]);
				$cartacidadao 		  = stripslashes($row[13]);
				?>
			
            	<tr>
                	<td valign="Top" align="left" bgcolor="#F2F1E9" nowrap>
                    	<font class="texto_form">Número Atendimento:</font>
                  	</td>
                    <td width="200px" bgcolor="#F2F1E9">
                    	<font class="texto_form">
							<?=$numeroatendimento."/".$anoatendimento;?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Código de Consulta na Internet:&nbsp;<?=$p_codconsulta?>
                       	</font>
					</td>
              	</tr>
				<tr>
                	<td valign="Top" width="20%" align="left" bgcolor="#ffffff">
                    	<font class="texto_form">Nome Solicitante:</font>
                   	</td>
                    <td width="200px" bgcolor="#ffffff">
                    	<font class="texto_form"><?=$nomesolicitante;?></font>
                   	</td>
               	</tr>
				<tr>
                    <td valign="Top" align="left" bgcolor="#F2F1E9">
                        <font class="texto_form">Data solicitação:</font>
                    </td>
                    <td width="200px" bgcolor="#F2F1E9">
                        <font class="texto_form"><?=$datasolicitacao;?></font>
                    </td>
	            </tr>
				<tr>	
                	<td valign="Top" align="left" bgcolor="#ffffff">
                    	<font class="texto_form">Encaminhado para:</font>
                    </td>
                    <td width="200px" bgcolor="#ffffff">
                    	<font class="texto_form"><?=$encaminhadopara.$nomeorgaoencaminhado;?></font>
                    </td>
               	</tr>
				<tr>
                	<td valign="Top" align="left" bgcolor="#F2F1E9">
                    	<font class="texto_form">Reivindicação:</font>
                    </td>
                    <td width="200px" bgcolor="#F2F1E9">
                    	<font class="texto_form"><?=str_replace("\n","<br>", $descrreivindicacao);?></font>
                    </td>
                </tr>
				<tr>
                	<td valign="Top" align="left" bgcolor="#ffffff">
                    	<font class="texto_form">Data Providência:</font>
                    </td>
                 	<td width="200px" bgcolor="#ffffff">
                    	<font class="texto_form"><?=$dataprovidencia;?></font>
                    </td>
                </tr>
				<tr>
                	<td valign="Top" align="left" bgcolor="#F2F1E9">
                    	<font class="texto_form">Resposta do Orgão:</font>
                    </td>
                    <td width="200px" bgcolor="#F2F1E9">
                    	<font class="texto_form"><? echo("<pre>"); str_replace("\n","<br>",print_r($cartacidadao)); ?></font>
                    </td>
                </tr>
				<tr>
                	<td colspan="2" valign="Top" align="left" bgcolor="#F2F1E9">&nbsp;</td>
                </tr>
				<tr>
                	<td colspan="2" valign="Top" align="left" bgcolor="#ffffff">&nbsp;</td>
                </tr>
				<?php
			}
		}
		?>
                                <form name='frm_atendimento' action='complementa_solicitacao.php' method='POST'>

                                <input type=hidden name=p_num value=<?php echo $p_num?>>
                                <input type=hidden name=p_ano value=<?php echo $p_ano?>>                               
                                <input type=hidden name=p_codconsulta value=<?php echo $p_codconsulta?>>
          						
								<tr>
                                    <td align=right valign=middle height="15">&nbsp;</td>
                                    <td align=left valign=top height="15"><!-- <input  type="submit" value="Complementar Solicitaï¿½ï¿½o" border="0" name="enviar" align="center" width="57" height="21" >-->
                                     
                                    </td>
                               	</tr>
                               	</form> 
              </table>
</body>
</html>

