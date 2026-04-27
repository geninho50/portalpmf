<table width="100%" border="0" cellpadding="0" cellspacing="0">
			
<?
				$sqlE = "SELECT ae.id, ae.idescola, ae.hora_chegada, g.vtr,g.guarda1,g.guarda2,g.guarda3,g.guarda4,g.guarda5 FROM atendimento_escola ae inner join guarnicao g where ae.status=1 and ae.idguarnicao=g.id";
				$resultadoE= $obj->executaQuery($sqlE);
				while( $linhaE = mysql_fetch_array($resultadoE))
				{
					$id = $linhaE["id"];
					$idescola = $linhaE["idescola"];
					$vtr = $linhaE["vtr"];
					$guarda1 = $linhaE["guarda1"];
					$guarda2 = $linhaE["guarda2"];
					$guarda3 = $linhaE["guarda3"];
					$guarda4 = $linhaE["guarda4"];
					$guarda5 = $linhaE["guarda5"];
					$hora_chegada = $linhaE["hora_chegada"];
					
					$sql = "select * from escolas where id=$idescola ";
					$result= $obj->executaQuery($sql);
					if($linha = mysql_fetch_array($result)){
						$nome = $linha["nome"];
?>
					<tr onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor=''">
					<td width="33%" class="negrito" title="<? 
								if($guarda1 != '' ){echo $vtr.' = '.$guarda1;}
								if($guarda2 != '' ){echo ' / '.$guarda2;}
								if($guarda3 != '' ){echo ' / '.$guarda3;}
								if($guarda4 != '' ){echo ' / '.$guarda4;}
								if($guarda5 != '' ){echo ' / '.$guarda5;}
							?>"><? echo $vtr.' - '.$nome;?></td>
     				<td width="67%"><a href="../classes/controleEscolaGuarnicao.php?id=<? echo $id; ?>&chave=1"><? if($hora_chegada == ''){?><img src="imagens/j10.png" width="20" height="20" border="0" title="J10"><? }?></a>
<a href="javascript:POPUP('finalizar_atendimento_escola.php?idAtendimento=<? echo $id;?>','720','500')"><img src="imagens/x.png" width="20" height="20" title="FINALIZAR ESCOLA" border="0"/></a>					
					</td>
					</tr>
<?							
		    	
					}				
				}	
			 ?>
		</table>
