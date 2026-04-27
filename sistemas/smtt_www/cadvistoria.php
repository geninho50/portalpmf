<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
require("conecta.php");
//$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca FROM vencimentos WHERE nomeservico = '$servico'";
$sql = "SELECT * FROM vencimentos";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	echo "<table align='center' border=4 bordercolor='#9ACD32'>";
	echo "<tr>";
	echo "<td align='center'><font face='verdana' size='2'><b>Servi&ccedilo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>N&ordm Ordem </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Placa </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Lota&ccedil&atildeo S/P </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Tipo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Categoria </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Marca/Modelo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Ano Fab. </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Ano Mod. </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Venc. Selo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Venc. Licen&ccedila </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Renavam </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Permission&aacuterio </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Endere&ccedilo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='2'><b>Bairro </b></font></td>";	
	echo "<td align='center'><font face='verdana' size='2'><b>Cidade </b></font></td>";	
	echo "<td align='center'><font face='verdana' size='2'><b>Cep </b></font></td>";	
	echo "<td align='center'><font face='verdana' size='2'><b>CNPJ </b></font></td>";		
	echo "<td align='center'><font face='verdana' size='2'><b>CPF </b></font></td>";			
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$nomeservico=pg_result($resultado,$i,"nomeservico");
		$placa=pg_result($resultado,$i,"placa");
		$lotacao=pg_result($resultado,$i,"lotacao");
		$tipo=pg_result($resultado,$i,"tipo");
		$categoria=pg_result($resultado,$i,"categoria");
		$marcamodelo=pg_result($resultado,$i,"marcamodelo");
		$anofab=pg_result($resultado,$i,"anofab");
		$anomod=pg_result($resultado,$i,"anomod");		
		$noordem=pg_result($resultado,$i,"noordem");
		$vencimentoselo=pg_result($resultado,$i,"vencimentoselo");
		$vencselo=substr($vencimentoselo,8,2).'/'.substr($vencimentoselo,5,2).'/'.substr($vencimentoselo,0,4);
		$vencimentolicenca=pg_result($resultado,$i,"vencimentolicenca");
		$venclicenca=substr($vencimentolicenca,8,2).'/'.substr($vencimentolicenca,5,2).'/'.substr($vencimentolicenca,0,4);
		if($ult_atual != "")
		{
		$ult_atualizacao=substr($ult_atual,8,2).'/'.substr($ult_atual,5,2).'/'.substr($ult_atual,0,4);
		}
		else
		{
		$ult_atualizacao="";
		}
		$renavam=pg_result($resultado,$i,"renavam");
//		if($renavam != ""){
//			$renavam=substr($renavam,0,3).'.'.substr($renavam,3,3).'.'.substr($renavam,6,3);
//		}
//		else{
//			$renavam="";
//		}
		$permissionario=pg_result($resultado,$i,"permissionario");
		$endereco=pg_result($resultado,$i,"endereco");
		$bairro=pg_result($resultado,$i,"bairro");
		$cidade=pg_result($resultado,$i,"cidade");
		$cep=pg_result($resultado,$i,"cep");
//		if (strstr($cep,"-") == ""){		
//		$cep=substr($cep,0,5).'-'.substr($cep,5,3);
//		}
		$cnpj=pg_result($resultado,$i,"cnpj");		
		if($cnpj != ""){
			$cnpj=substr($cnpj,0,2).'.'.substr($cnpj,2,3).'.'.substr($cnpj,5,3).'/'.substr($cnpj,8,4).'-'.substr($cnpj,12,2);
		}
		else{
			$cnpj="";
		}
		$cpf=pg_result($resultado,$i,"cpf");		
		if($cpf != ""){
			$cpf=substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
		}
		else{
			$cpf="";
		}
		echo "<tr>";
		echo "<td align='center'>$nomeservico </td>";
		echo "<td align='center'>$noordem </td>";
		echo "<td align='center'>$placa </td>";
		echo "<td align='center'>$lotacao </td>";
		echo "<td align='center'>".utf8_encode($tipo)."</td>";
		echo "<td align='center'>".utf8_encode($categoria)."</td>";
		echo "<td align='center'>".utf8_encode($marcamodelo)."</td>";
		echo "<td align='center'>$anofab </td>";
		echo "<td align='center'>$anomod </td>";
		echo "<td align='center'>$vencselo </td>";
		echo "<td align='center'>$venclicenca </td>";
		echo "<td align='center'>$renavam </td>";
		echo "<td align='center'>".utf8_encode($permissionario)."</td>";
		echo "<td align='center'>".utf8_encode($endereco)."</td>";
		echo "<td align='center'>".utf8_encode($bairro)."</td>";
		echo "<td align='center'>".utf8_encode($cidade)."</td>";
		echo "<td align='center'>$cep </td>";
		echo "<td align='center'>$cnpj </td>";		
		echo "<td align='center'>$cpf </td>";				
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo pg_error();
}
?>
</html>