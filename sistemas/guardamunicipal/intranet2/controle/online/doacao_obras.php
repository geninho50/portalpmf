<?php 
	$query = "SELECT id, DAY(datadoacao) as dia,MONTH(datadoacao) as mes,YEAR(datadoacao) as ano,gmsolicitante,status,data,datadoacao,turno FROM doacaosangue where status=0 and grupo='Obras' order by id desc";
	
	$nvaloresencontrados = $obj->numregistros($query);	
	if( $nvaloresencontrados > 0 )
	{
	
	?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
            <td width="96%" class="negrito"  bgcolor="#CCCCCC">OBRAS</td>
          </tr>
        </table>
        <table width="100%" border="1" cellspacing="1" cellpadding="1" bordercolor="#CCCCCC" style="border-collapse:collapse">
	<?	
	
		$resultE = $obj->executaQuery($query);
		while( $linhaE = mysql_fetch_array($resultE) )
		{
			$status = $linhaE['status'];
			$id = $linhaE['id'];
			$dia = $linhaE['dia'];
			$mes = $linhaE['mes'];
			$ano = $linhaE['ano'];
				
	?>
	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
		<td width="5%" align="center" class="negrito"><? echo $linhaE['id']; ?></td>
		<td width="9%" align="center" class="negrito"><? echo $linhaE['data']; ?></td>
		<td width="10%" align="center" class="negrito"><? echo $linhaE['gmsolicitante']; ?></td>
		<td width="70%" align="left" class="negrito"><?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
		<td width="6%" class="negrito" align="center">
		<a href="../classes/controleDoacaoSangue.php?id=<?PHP echo $id; ?>&status=1&gmsolicitante=<? echo $linhaE['gmsolicitante'];?>&xdatadoacao=<? echo $linhaE['datadoacao'];?>&yturno=<? echo $linhaE['turno'];?>" border="0"><IMG SRC="imagens/true.png" ALT="Mais detalhes" width="20" height="20" BORDER="0"></A>
		<a href="cadastro_motivo_negado_doacao_sangue.php?id=<?PHP echo $id; ?>&status=2" border="0"><IMG SRC="imagens/negado.png" ALT="Mais detalhes" width="20" height="20" BORDER="0"></A>
		</td>
	</tr>
	<?php
			}
		}?></table><?
?>