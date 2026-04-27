<table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse: collapse">
          <tr>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J4</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J5</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J6</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">J8</th>
            <th width="20%" align="center" bgcolor="#CCCCCC" scope="col">Indisponível</th>
          </tr>
        <tr>
			<td align="left" valign="top">
 <?
		    	
				$sqlJ4 = "SELECT * FROM guarnicao where status=3 order by vtr";
				$resultadoJ4= $obj->executaQuery($sqlJ4);
				while( $linhaJ4 = mysql_fetch_array($resultadoJ4))
				{
					$id = $linhaJ4["id"];
					$vtr = $linhaJ4["vtr"];
					$guarda1 = $linhaJ4["guarda1"];
					$guarda2 = $linhaJ4["guarda2"];
					$guarda3 = $linhaJ4["guarda3"];
					$guarda4 = $linhaJ4["guarda4"];
					$guarda5 = $linhaJ4["guarda5"];
					$outros = $linhaJ4["outros"];
					
					$sql = "select * from j4 where idguarnicao=$id and status=0";
					$result= $obj->executaQuery($sql);
					if($linha = mysql_fetch_array($result)){
						$hora = $linha["hora_entrada"];
				echo $vtr.' - '.$diferencatempo = calcula_hora($hora,$hora_atual);?> 
				<A href="../classes/controleJ4.php?idGuarnicao=<? echo $id;?>&chave=2"><img src="imagens/x.png" width="20" height="20" border="0" title="<? 
								if($guarda1 != '' ){echo $vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
							?>"/>
				</A><br>
			<?
		    	
					}				
				}	
			 ?>  
			</td>
			<td align="left" valign="top">
			<?	    	
				$sqlJ5 = "SELECT * FROM guarnicao where status=4 order by vtr";
				$resultadoJ5= $obj->executaQuery($sqlJ5);
				while( $linhaJ5 = mysql_fetch_array($resultadoJ5))
				{
					$id = $linhaJ5["id"];
					$vtr = $linhaJ5["vtr"];
					$guarda1 = $linhaJ5["guarda1"];
					$guarda2 = $linhaJ5["guarda2"];
					$guarda3 = $linhaJ5["guarda3"];
					$guarda4 = $linhaJ5["guarda4"];
					$guarda5 = $linhaJ5["guarda5"];
					$outros = $linhaJ5["outros"];
					
					$sql = "select * from j5 where idguarnicao=$id and status=0";
					$result= $obj->executaQuery($sql);
					if($linha = mysql_fetch_array($result)){
						$hora = $linha["hora_entrada"];
				echo $vtr.' - '.$diferencatempo = calcula_hora($hora,$hora_atual);?> <A href="../classes/controleJ5.php?idGuarnicao=<? echo $id;?>&chave=2"><img src="imagens/x.png" width="20" height="20" border="0" title="<? 
								if($guarda1 != '' ){echo $vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
							?>"/></A><br>
				<?
		    	
					}				
				}	
			 ?>  
			</td>
			<td align="left" valign="top">
			<?			    	
				$sqlJ6 = "SELECT * FROM guarnicao where status=5 order by vtr";
				$resultadoJ6= $obj->executaQuery($sqlJ6);
				while( $linhaJ6 = mysql_fetch_array($resultadoJ6))
				{
					$id = $linhaJ6["id"];
					$vtr1 = $linhaJ6["vtr"];
					$guarda1 = $linhaJ6["guarda1"];
					$guarda2 = $linhaJ6["guarda2"];
					$guarda3 = $linhaJ6["guarda3"];
					$guarda4 = $linhaJ6["guarda4"];
					$guarda5 = $linhaJ6["guarda5"];
					$outros = $linhaJ6["outros"];
					
					$sql = "select * from j6 where idguarnicao=$id and status=0";
					$result= $obj->executaQuery($sql);
					if($linha = mysql_fetch_array($result)){
						$hora = $linha["hora_entrada"];
				echo $vtr1.' - '.$diferencatempo = calcula_hora($hora,$hora_atual);?> <A href="../classes/controleJ6.php?idGuarnicao=<? echo $id;?>&chave=2"><img src="imagens/x.png" width="20" height="20" border="0" title="<? 
								if($guarda1 != '' ){echo $vtr1.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
							?>"/></A><br>
			<?
		    	
					}				
				}	
			 ?>  
			</td>
			<td align="left" valign="top">
			<?
				$sqlJ8 = "SELECT * FROM guarnicao where status=6 order by vtr";
				$resultadoJ8= $obj->executaQuery($sqlJ8);
				while( $linhaJ8 = mysql_fetch_array($resultadoJ8))
				{
					$id = $linhaJ8["id"];
					$vtr = $linhaJ8["vtr"];
					$guarda1 = $linhaJ8["guarda1"];
					$guarda2 = $linhaJ8["guarda2"];
					$guarda3 = $linhaJ8["guarda3"];
					$guarda4 = $linhaJ8["guarda4"];
					$guarda5 = $linhaJ8["guarda5"];
					$outros = $linhaJ8["outros"];
					
					$sql = "select * from j8 where idguarnicao=$id and status=0";
					$result= $obj->executaQuery($sql);
					if($linha = mysql_fetch_array($result)){
						$hora = $linha["hora_entrada"];
				echo $vtr.' - '.$diferencatempo = calcula_hora($hora,$hora_atual);?> <A href="../classes/controleJ8.php?idGuarnicao=<? echo $id;?>&chave=2"><img src="imagens/x.png" width="20" height="20" border="0" title="<? 
								if($guarda1 != '' ){echo $vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($outros != '' ){echo ' - '.$outros;}
							?>"/></A><br>
			<?
		    	
					}				
				}	
			 ?>  
			</td>
			<td align="left" valign="top">
			<?
				$sqlJ9 = "SELECT * FROM guarnicao where status=7 order by vtr";
				$resultadoJ9= $obj->executaQuery($sqlJ9);
				while( $linhaJ9 = mysql_fetch_array($resultadoJ9))
				{
					$id = $linhaJ9["id"];
					$vtr = $linhaJ9["vtr"];
					$guarda1 = $linhaJ9["guarda1"];
					$guarda2 = $linhaJ9["guarda2"];
					$guarda3 = $linhaJ9["guarda3"];
					$guarda4 = $linhaJ9["guarda4"];
					$guarda5 = $linhaJ9["guarda5"];
					$outros = $linhaJ9["outros"];
						
					$sql = "select * from indisponivel where idguarnicao=$id and status=0";
					$result= $obj->executaQuery($sql);
					if($linha = mysql_fetch_array($result)){
						$hora = $linha["hora_entrada"];
						$motivo = $linha["motivo"];
						
				echo $vtr.' - '.$diferencatempo = calcula_hora($hora,$hora_atual);?> <a onClick="EXLUIRGUARNICAO('../classes/controleIndisponivel.php?idGuarnicao=<? echo $id;?>&chave=2')" href="#"><img src="imagens/x.png" width="20" height="20" border="0" title="<? 
								if($guarda1 != '' ){echo $vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
								if($motivo != '' ){echo ' - '.$motivo;}
							?>"/></A><br>
			<?
		    	
					}				
				}	
			 ?>  
			</td>
			</tr>
        </table>
