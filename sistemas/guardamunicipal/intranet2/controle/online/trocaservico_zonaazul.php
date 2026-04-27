<?php 
	$query = "SELECT id, DAY(datatroca) as dia,MONTH(datatroca) as mes,YEAR(datatroca) as ano,gmsolicitante,gmsolicitado,formareposicao,motivotroca,status,data,turno FROM trocaservico where status=0 and grupo='Zona Azul' order by id desc";
	
	$nvaloresencontrados = $obj->numregistros($query);	
	if( $nvaloresencontrados > 0 )
	{
	
	?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
            <td width="96%" class="negrito"  bgcolor="#CCCCCC">ZONA AZUL</td>
          </tr>
        </table>
        <table width="100%" border="1" cellspacing="1" cellpadding="1" bordercolor="#CCCCCC" style="border-collapse:collapse">
	<?	
	
		$resultD = $obj->executaQuery($query);
		while( $linhaD = mysql_fetch_array($resultD) )
			{
				$status = $linhaD['status'];
				$id = $linhaD['id'];
				$dia = $linhaD['dia'];
				$mes = $linhaD['mes'];
				$ano = $linhaD['ano'];
				$data = $linhaD['data'];
	?>
            <tr>
                <td width="4%" align="center" class="negrito"><? echo $linhaD['id']; ?></td>
                <td width="7%" align="center" class="negrito"><? echo $linhaD['data']; ?></td>
                <td width="10%" align="center" class="negrito"><? echo $linhaD['gmsolicitante']; ?></td>
                <td width="11%" align="center" class="negrito"><? echo $linhaD['gmsolicitado']; ?></td>
                <td width="8%" align="center" class="negrito"><?PHP echo $dia.' / '.$mes.' / '.$ano; ?></td>
                <td width="15%" align="center" class="negrito"><? echo $linhaD['formareposicao']; ?></td>		
                <td width="38%" align="left" class="negrito"><? echo $linhaD['motivotroca']; ?></td>
                <td width="7%" class="negrito" align="center">
                <a href="../classes/controleTrocaServico.php?id=<?PHP echo $id; ?>&status=1&xdatatroca=<? echo $linhaD['datatroca'];?>&ygmsolicitado=<? echo $linhaD['gmsolicitado'];?>&gmsolicitante=<? echo $linhaD['gmsolicitante'];?>&yturno=<? echo $linhaD['turno'];?>" border="0"><IMG SRC="imagens/true.png" ALT="Mais detalhes" width="20" height="20" BORDER="0"></A>
                <a href="cadastro_motivo_negado_troca_servico.php?id=<?PHP echo $id; ?>&status=2" border="0"><IMG SRC="imagens/negado.png" ALT="Mais detalhes" width="20" height="20" BORDER="0"></A>
                </td>
            </tr>
	<?php
			}
		}?></table><?
?>