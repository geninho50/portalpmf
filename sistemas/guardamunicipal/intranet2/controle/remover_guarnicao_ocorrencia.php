<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $idOcorrencia = 0;
   $idOcorrencia = (int)$_POST['idOcorrencia'];
   if( $idOcorrencia == 0 )
   {
	 $idOcorrencia = (int)$_GET['idOcorrencia'];
   }
   
   $sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
    
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">OCUPANTES DA OCORRÊNCIA DE NÚMERO <? echo $idOcorrencia; ?></legend>
    <table bgcolor="#006699"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
	  <tr>
	  	<td width="12%" align="center" class="branco"><b>Ocorrência</b></td>
	  	<td width="12%" align="center" class="branco"><b>Guarniçãoo</b></td>
		<td width="15%" align="center" class="branco"><b>VTR/MT/BIKE</b></td>
		<td width="54%" align="left" class="branco"><b>Ocupantes</b></td>
		<td width="7%" align="center" class="branco"><b>Troca</b></td>
	  </tr>
	</table>
	<table width="100%"  border="0" cellpadding="1" cellspacing="1">
	  <?
	  	$chavee = true;
	  	$query = "SELECT * FROM ocorrencia where id=$idOcorrencia";
		$result = $obj->executaQuery($query);
		$dados = mysql_fetch_array($result);
		if( $dados )
		{
			$id = $dados["id"];
			
			$queryO = "SELECT ocorrencia_atendida.idguarnicao,guarnicao.id,guarnicao.vtr,guarnicao.guarda1,guarnicao.guarda2,guarnicao.guarda3,guarnicao.guarda4,guarnicao.guarda5,guarnicao.outros FROM ocorrencia_atendida inner join guarnicao where ocorrencia_atendida.idocorrencia=$id and guarnicao.id=ocorrencia_atendida.idguarnicao and ocorrencia_atendida.visivel=2 order by ocorrencia_atendida.id";
			$resultO = $obj->executaQuery($queryO);
			$cont = mysql_num_rows($resultO);
			
			if($cont == 1){
			
				while( $dadosO = mysql_fetch_array($resultO) )
					{
						$idGuarnicao = $dadosO["id"];
						$vtr = $dadosO["vtr"];
						$guarda1 = $dadosO["guarda1"];
						$guarda2 = $dadosO["guarda2"];
						$guarda3 = $dadosO["guarda3"];
						$guarda4 = $dadosO["guarda4"];
						$guarda5 = $dadosO["guarda5"];
						$outros = $dadosO["outros"];
			  ?>
			  <tr bgColor="<?PHP if($chavee)
								{
									echo '#cccccc';
								}
								else{ 
									echo '#ffffff';
								} 
								$chavee=!$chavee;
							?>">
				<td width="12%" align="center" class="negrito"><? echo $idOcorrencia; ?></td>
				<td width="12%" align="center" class="negrito"><? echo $idGuarnicao; ?></td>
				<td width="15%" align="center" class="negrito"><? echo $vtr; ?></td>
				<td width="54%" align="left" class="negrito">
					<? 
						if($guarda1 != '' ){echo $guarda1;}
						if($guarda2 != '' ){echo ' / '.$guarda2;}
						if($guarda3 != '' ){echo ' / '.$guarda3;}
						if($guarda4 != '' ){echo ' / '.$guarda4;}
						if($guarda5 != '' ){echo ' / '.$guarda5;}
						echo ' - '.$outros;
					?>
			    </td>
				<td width="7%" align="center" class="negrito">&nbsp;</td>
				
			  </tr>
			  <?
					}	
				
			}
			else{
					while( $dadosO = mysql_fetch_array($resultO) )
					{
						$idGuarnicao = $dadosO["id"];
						$vtr = $dadosO["vtr"];
						$guarda1 = $dadosO["guarda1"];
						$guarda2 = $dadosO["guarda2"];
						$guarda3 = $dadosO["guarda3"];
						$guarda4 = $dadosO["guarda4"];
						$guarda5 = $dadosO["guarda5"];
						$outros = $dadosO["outros"];
			  ?>
			  <tr bgColor="<?PHP if($chavee)
								{
									echo '#cccccc';
								}
								else{ 
									echo '#ffffff';
								} 
								$chavee=!$chavee;
							?>">
				<td width="12%" align="center" class="negrito"><? echo $idOcorrencia; ?></td>
				<td width="12%" align="center" class="negrito"><? echo $idGuarnicao; ?></td>
				<td width="15%" align="center" class="negrito"><? echo $vtr; ?></td>
				<td width="54%" align="left" class="negrito">
					<? 
						if($guarda1 != '' ){echo $guarda1;}
						if($guarda2 != '' ){echo ' / '.$guarda2;}
						if($guarda3 != '' ){echo ' / '.$guarda3;}
						if($guarda4 != '' ){echo ' / '.$guarda4;}
						if($guarda5 != '' ){echo ' / '.$guarda5;}
						echo ' - '.$outros;
					?>
				 </td>
				<td width="7%" align="center" class="negrito"><a onClick="EXLUIRGUARNICAO('../classes/controleRemoverGuarnicao.php?idOcorrencia=<? echo $idOcorrencia;?>&idGuarnicao=<? echo $idGuarnicao;?>&cont=1')"><img src="imagens/excluir.png" width="20" height="20" title="REMOVER GUARNIÇÃO DA OCORRÊNCIA" border="0"/></a></td>
				
			  </tr>
			  <?
					}
			}
	  	}
	  ?>
	</table>

</fieldset>

	<!--fim adm-->
	</td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="1" cellspacing="0" bordercolor="#cccccc" style="border-collapse:collapse">
  <tr>
    <td width="94%" align="center" class="negrito"><a onClick="EXLUIRGUARNICAO('../classes/controleRemoverGuarnicao.php?idOcorrencia=<? echo $idOcorrencia;?>&cont=2')" title="REMOVER TODAS AS GUARNICOES">Remover todas as guarnições da ocorrência.</a></td>
  </tr>
</table>



</body>
</html>
