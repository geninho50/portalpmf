<?php 
	$query = "SELECT id,DAY(data) as diaD,MONTH(data) as mesD,YEAR(data) as anoD, DAY(datainicio) as diainicio,MONTH(datainicio) as mesinicio,YEAR(datainicio) as anoinicio,DAY(datafim) as diafim,MONTH(datafim) as mesfim,YEAR(datafim) as anofim,idfolga,gmsolicitante,datainicio,datafim, motivofolga, motivostatus, status FROM pedidofolga where status=0 and grupo='Logistica' order by id desc";
	
	$nvaloresencontrados = $obj->numregistros($query);	
	if( $nvaloresencontrados > 0 )
	{
	
	?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%" bgcolor="#CCCCCC">&nbsp;</td>
            <td width="96%" class="negrito"  bgcolor="#CCCCCC">LOGÍSTICA</td>
          </tr>
        </table>
        <table width="100%" border="1" cellspacing="1" cellpadding="1" bordercolor="#CCCCCC" style="border-collapse:collapse">
	<?	
	
		$result = $obj->executaQuery($query);
		while( $linhaF = mysql_fetch_array($result) )
		{
			$idtemp = $linhaF['id'];
			$status = $linhaF['status'];
			$idfolga = $linhaF['idfolga'];
			$gmsolicitante = $linhaF['gmsolicitante'];
			$diainicio = $linhaF['diainicio'];
			$mesinicio = $linhaF['mesinicio'];
			$anoinicio = $linhaF['anoinicio'];
			$diafim = $linhaF['diafim'];
			$mesfim = $linhaF['mesfim'];
			$anofim = $linhaF['anofim'];
			$datafim = $linhaF['datafim'];
			$dataincio = $linhaF['datainicio'];		
			$diaD = $linhaF['diaD'];
			$mesD = $linhaF['mesD'];
			$anoD = $linhaF['anoD'];
	
			$data1=''; // coloque a data vinda do banco de dados
			$data1= explode("-",$dataincio); 
			$data2=''; // coloque a data vinda do banco de dados
			$data2= explode("-",$datafim); 
			
			$datatemp1 = mktime(0,0,0,$data1[1],$data1[2],$data1[0]);
			$datatemp2 = mktime(0,0,0,$data2[1],$data2[2],$data2[0]);
			$dias = ($datatemp2 - $datatemp1)/86400;
			$dias = ceil($dias)+1;
			
			$queryT = "SELECT * FROM folga where id='$idfolga' order by id desc";
			$resultT = $obj->executaQuery($queryT);
			
			while( $linhaT = mysql_fetch_array($resultT) )
			{
				$descricao = $linhaT['descricao'];
				$idfolga = $linhaT['id'];
				$qtade = $linhaT['qtade'];
				$qtadeatual = $linhaT['qtadeatual'];
				
				$resultado = $qtade - $qtadeatual;
				
	?>
                    <tr>
                        <td width="4%" align="center" class="negrito"><? echo $linhaF['id']; ?></td>
                        <td width="7%" align="center" class="negrito"><? echo $diaD.' / '.$mesD.' / '.$anoD; ?></td>
                        <td width="9%" align="center" class="negrito"><? echo $gmsolicitante; ?></td>
                        <td width="18%" align="center" class="negrito"><?PHP echo $diainicio.' / '.$mesinicio.' / '.$anoinicio.' -- '.$diafim.' / '.$mesfim.' / '.$anofim.' -> '.$dias.' dias'; ?></td>
                        <td width="18%" align="left" class="negrito"><? echo $descricao; ?></td>
                        <td width="32%" align="left" class="negrito"><? echo $linhaF['motivofolga']; ?></td>
                        <td width="7%" align="center" class="negrito"><?PHP echo $resultado; ?></td>
                        <td width="5%" class="negrito" align="center">
                        <? 
						if($linhaL['logistica']=='S'){?>
                        
                            <a href="cadastro_autorizado_pedido_folga.php?idtemp=<?PHP echo $idtemp; ?>&status=1&idfolga=<? echo $idfolga;?>&gmsolicitante=<? echo $gmsolicitante;?>" border="0"><IMG SRC="imagens/true.png" width="20" height="20" BORDER="0" title="AUTORIZAR FOLGA"></A>
                            <a href="cadastro_motivo_negado_pedido_folga.php?idtemp=<?PHP echo $idtemp; ?>&status=2&idfolga=<? echo $idfolga;?>&gmsolicitante=<? echo $gmsolicitante;?>" border="0"><IMG SRC="imagens/negado.png" title="NEGAR FOLGA" width="20" height="20" BORDER="0"></A>
                        <? }?>
                        </td>
                    </tr>
	<?php
			}
		}?></table><?
	}
?>