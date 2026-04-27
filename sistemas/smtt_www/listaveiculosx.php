<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="estilos.css">
<?php
function listaveicserv($servico)
{
//$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca FROM vencimentos WHERE nomeservico = '$servico'";
$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca ";
$sql = $sql." FROM vencimentos WHERE nomeservico = '$servico' order by noordem";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	echo "<p align='center'><font face='Verdana' size='2'><a href='seleciona.php'>Voltar</a></font></p>";
	echo "<table align='center' border=4 bordercolor='#9ACD32'>";
	if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
	echo "<td align='center'><font face='verdana' size='1'><b>Servi&ccedilo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>N&ordm Ordem </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Placa </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Selo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Licen&ccedila </b></font></td>";
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$nomeservico=pg_result($resultado,$i,"nomeservico");
		$placa=pg_result($resultado,$i,"placa");
		$noordem=pg_result($resultado,$i,"noordem");
		$vencimentoselo=pg_result($resultado,$i,"vencimentoselo");
		$vencselo=substr($vencimentoselo,8,2).'/'.substr($vencimentoselo,5,2).'/'.substr($vencimentoselo,0,4);
		$vencimentolicenca=pg_result($resultado,$i,"vencimentolicenca");
		$venclicenca=substr($vencimentolicenca,8,2).'/'.substr($vencimentolicenca,5,2).'/'.substr($vencimentolicenca,0,4);
		
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
		echo "<td align='center'><font face='verdana' size='1'>$nomeservico </td>";
		echo "<td align='center'><font face='verdana' size='1'>$noordem </td>";
		echo "<td align='center'><font face='verdana' size='1'>$placa </td>";
		echo "<td align='center'><font face='verdana' size='1'>$vencselo </td>";
		echo "<td align='center'><font face='verdana' size='1'>$venclicenca </td>";
		echo "<td align='center'><font face='verdana' size='1'><a href='vistoria.php?placa=".$placa."'>Dados do Ve&iacuteculo </a></td>";
//		echo "<td align='center'><font face='verdana' size='1'><a href='javascript:window.history.go(-1)'>Voltar </a></td>";
		echo "<td align='center'><font face='verdana' size='1'><font face='verdana'><a href='seleciona.php'>Nova Pesquisa </a></font></td>";
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo pg_error();
}
}
function listaveicordem($noordem)
{
//echo "<html>";
//echo "<head>";
//echo "<meta http-equiv="Content-Type" content='text/html; charset=UTF-8' />";
//echo "</head>";
//echo "</html>";
//$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca FROM vencimentos WHERE nomeservico = '$servico'";
$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca ";
$sql = $sql." FROM vencimentos WHERE noordem like '%$noordem%'";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	echo "<table align='center' border='3' bordercolor='#9ACD32'>";
	
	if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
	echo "<tr bgcolor=$corfundo>";
	echo "<td align='center'><font face='verdana' size='1'><b>Servi&ccedilo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>N&ordm Ordem </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Placa </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Selo </b></font></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Licen&ccedila </b></font></td>";
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$nomeservico=pg_result($resultado,$i,"nomeservico");
		$placa=pg_result($resultado,$i,"placa");
		$noordem=pg_result($resultado,$i,"noordem");
		$vencimentoselo=pg_result($resultado,$i,"vencimentoselo");
		$vencselo=substr($vencimentoselo,8,2).'/'.substr($vencimentoselo,5,2).'/'.substr($vencimentoselo,0,4);
		$vencimentolicenca=pg_result($resultado,$i,"vencimentolicenca");
		$venclicenca=substr($vencimentolicenca,8,2).'/'.substr($vencimentolicenca,5,2).'/'.substr($vencimentolicenca,0,4);
		
		
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		echo "<tr bgcolor=$corfundo>";
		echo "<td align='center'><font face='verdana' size='1'>$nomeservico </td>";
		echo "<td align='center'><font face='verdana' size='1'>$noordem </td>";
		echo "<td align='center'><font face='verdana' size='1'>$placa </td>";
		echo "<td align='center'><font face='verdana' size='1'>$vencselo </td>";
		echo "<td align='center'><font face='verdana' size='1'>$venclicenca </td>";
		echo "<td align='center'><font face='verdana' size='1'><a href='vistoria.php?placa=".$placa."'>Dados do Ve&iacuteculo </a></td>";
//		echo "<td align='center'><font face='verdana' size='1'><a href='javascript:window.history.go(-1)'>Voltar </a></td>";
		echo "<td align='center'><font face='verdana' size='1'><a href='seleciona.php'>Nova Pesquisa </a></td>";
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo pg_error();
}
}
function listaveicplaca($placadig)
{
//echo $placadig;
$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca ";
$sql = $sql." FROM vencimentos WHERE placa like '%$placadig%'";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	echo "<table align='center' border=3 bordercolor='#9ACD32'>";
	if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
	echo "<tr bgcolor=$corfundo>";
	echo "<td align='center'><font face='verdana' size='1'><b>Servi&ccedilo</b></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>N&ordm Ordem </b></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Placa </b></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Selo </b></td>";
	echo "<td align='center'><font face='verdana' size='1'><b>Venc. Licen&ccedila </b></td>";
	echo "</tr>";
	for ($i=0; $i<$linhas; $i++)
	{
		$nomeservico=pg_result($resultado,$i,"nomeservico");
		$placa=pg_result($resultado,$i,"placa");
		$noordem=pg_result($resultado,$i,"noordem");
		$vencimentoselo=pg_result($resultado,$i,"vencimentoselo");
		$vencselo=substr($vencimentoselo,8,2).'/'.substr($vencimentoselo,5,2).'/'.substr($vencimentoselo,0,4);
		$vencimentolicenca=pg_result($resultado,$i,"vencimentolicenca");
		$venclicenca=substr($vencimentolicenca,8,2).'/'.substr($vencimentolicenca,5,2).'/'.substr($vencimentolicenca,0,4);
		if($corfundo == "#EAE9DB")
		{
			$corfundo="#FFFFFF";
		}
		else
		{
			$corfundo="#EAE9DB";
		}
		
		echo "<tr bgcolor=$corfundo align='center'>";
		echo "<td align='center'><font face='verdana' size='1'>$nomeservico</td>";
		echo "<td align='center'><font face='verdana' size='1'>$noordem</td>";
		echo "<td align='center'><font face='verdana' size='1'>$placa</td>";
		echo "<td align='center'><font face='verdana' size='1'>$vencselo</td>";
		echo "<td align='center'><font face='verdana' size='1'>$venclicenca</td>";
		echo "<td align='center'><font face='verdana' size='1'><a href='vistoria.php?placa=".$placa."'>Dados do Ve&iacuteculo </a></td>";
//		echo "<td align='center'><font face='verdana' size='1'><a href='javascript:window.history.go(-1)'>Voltar </a></td>";
		echo "<td align='center'><font face='verdana' size='1'><font face='verdana'><a href='seleciona.php'>Nova Pesquisa </a></font></td>";
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo pg_error();
}
}
function dadosveiculo($placa)
{
echo "<meta http-equiv='Content-Type' content='text/html; charset=ISO-8859-1' />";
//$sql = "SELECT nomeservico, placa, noordem, vencimentoselo, vencimentolicenca ";
$sql = "SELECT * ";
$sql = $sql." FROM vencimentos WHERE placa = '$placa'";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	if ($linhas == 0)
	{
		echo "Veículo não Cadastrado";
	}
	else
	{
		$nomeservico=pg_result($resultado,0,"nomeservico");
		$placa=pg_result($resultado,0,"placa");
		$noordem=pg_result($resultado,0,"noordem");
		$lotacao=pg_result($resultado,0,"lotacao");
		if($nomeservico == 'COLETIVO')
		{
			if(substr($lotacao,2,1)=='/')
			{
				$lotacao=$lotacao.'  (sentados/em pé)';
			}	
		}
		$tipo=pg_result($resultado,0,"tipo");
		$categoria=pg_result($resultado,0,"categoria");		
		$marcamodelo=pg_result($resultado,0,"marcamodelo");
		$anofab=pg_result($resultado,0,"anofab");
		$anomod=pg_result($resultado,0,"anomod");
		$vencimentoselo=pg_result($resultado,0,"vencimentoselo");
		$vencselo=substr($vencimentoselo,8,2).'/'.substr($vencimentoselo,5,2).'/'.substr($vencimentoselo,0,4);
		$vencimentolicenca=pg_result($resultado,0,"vencimentolicenca");
		$venclicenca=substr($vencimentolicenca,8,2).'/'.substr($vencimentolicenca,5,2).'/'.substr($vencimentolicenca,0,4);
		$ult_atual=pg_result($resultado,0,"ult_atualizacao");
		if($ult_atual != "")
		{
		$ult_atualizacao=substr($ult_atual,8,2).'/'.substr($ult_atual,5,2).'/'.substr($ult_atual,0,4);
		}
		else
		{
		$ult_atualizacao="";
		}
		$renavam=pg_result($resultado,0,"renavam");
		if($renavam != ""){
			$renavam=substr($renavam,0,3).'.'.substr($renavam,3,3).'.'.substr($renavam,6,3);
		}
		else
		{
			$renavam="";
		}
		$permissionario=pg_result($resultado,0,"permissionario");
		$endereco=pg_result($resultado,0,"endereco");
		$bairro=pg_result($resultado,0,"bairro");
		$cidade=pg_result($resultado,0,"cidade");
		$cep=pg_result($resultado,0,"cep");
		$local=pg_result($resultado,0,"local");
		if (strstr($cep,"-") == ""){		
		$cep=substr($cep,0,5).'-'.substr($cep,5,3);
		}
		$cnpj=pg_result($resultado,0,"cnpj");		
		if($cnpj != ""){
			$cnpj=substr($cnpj,0,2).'.'.substr($cnpj,2,3).'.'.substr($cnpj,5,3).'/'.substr($cnpj,8,4).'-'.substr($cnpj,12,2);
		}
		else{
			$cnpj="";
		}
		$cpf=pg_result($resultado,0,"cpf");		
		if($cpf != ""){
			$cpf=substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
		}
		else
		{
			$cpf="";
		}
		
		
		echo "<table align='center' border='3' width='400' bordercolor='#9ACD32'>";
		echo "<tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Servi&ccedilo</td>";
		echo "<td align='left' width='300'><a class='smt'>$nomeservico </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>N&ordm Ordem </td>";
		echo "<td align='left' width='300'><a class='smt'>$noordem </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Placa </td>";
		echo "<td align='left' width='300'><a class='smt'>$placa </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Lota&ccedil&atildeo </td>";
		echo "<td align='left' width='300'><a class='smt'>$lotacao</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Tipo </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($tipo)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Categoria </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($categoria)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Marca/Mod. </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($marcamodelo)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Ano Fab./Mod. </td>";
		echo "<td align='left' width='300'><a class='smt'>$anofab/$anomod</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Vencimento Selo </td>";
		echo "<td align='left'  width='300'><a class='smt'>$vencselo </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Vencimento Licen&ccedila </td>";
		echo "<td align='left' width='300'><a class='smt'>$venclicenca </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Renavam </td>";
		echo "<td align='left'width='300'><a class='smt'>$renavam </a></td>";
		echo "</tr><tr>";
		echo "<td align='center'width='100'><font face='verdana' size='1'>Permission&aacuterio </td>";
//		echo "<td align='left'><a class='smt'>".utf8_decode($permissionario)."</a></td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($permissionario)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Endere&ccedilo </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($endereco)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Bairro </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($bairro)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Cidade</td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($cidade)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>CEP </td>";
		echo "<td align='left' width='300'><a class='smt'>$cep </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>CNPJ </td>";
		echo "<td align='left' width='300'><a class='smt'>$cnpj </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>CPF </td>";
		echo "<td align='left' width='300'><a class='smt'>$cpf </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Local </td>";
		if($nomeservico == "TURISMO")
		{
			echo "<td align='left' width='300'><a class='smt'></a></td>";
		}
		else
		{
			echo "<td align='left' width='300'><a class='smt'>".utf8_encode($local)."</a></td>";
		}
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>&Uacuteltima atualiza&ccedil&atildeo </td>";
		echo "<td align='left' width='300'><a class='smt'>$ult_atualizacao </a></td>";
		echo "</tr>";
		echo "</table>";
	}
}
else
{
	echo pg_error();
}
opcoes();
}
function dadosveiculoid($id)
{
$sql = "SELECT * ";
$sql = $sql." FROM vencimentos WHERE id = '$id'";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	if ($linhas == 0)
	{
		echo "Veículo não Cadastrado";
	}
	else
	{
		$nomeservico=pg_result($resultado,0,"nomeservico");
		$placa=pg_result($resultado,0,"placa");
		$noordem=pg_result($resultado,0,"noordem");
		$lotacao=pg_result($resultado,0,"lotacao");
		if($nomeservico == 'COLETIVO')
		{
			if(substr($lotacao,2,1)=='/')
			{
				$lotacao=$lotacao.'  (sentados/em pé)';
			}	
		}
		$tipo=pg_result($resultado,0,"tipo");
		$categoria=pg_result($resultado,0,"categoria");				
		$marcamodelo=pg_result($resultado,0,"marcamodelo");
		$anofab=pg_result($resultado,0,"anofab");
		$anomod=pg_result($resultado,0,"anomod");
		$vencimentoselo=pg_result($resultado,0,"vencimentoselo");
		$vencselo=substr($vencimentoselo,8,2).'/'.substr($vencimentoselo,5,2).'/'.substr($vencimentoselo,0,4);
		$vencimentolicenca=pg_result($resultado,0,"vencimentolicenca");
		$venclicenca=substr($vencimentolicenca,8,2).'/'.substr($vencimentolicenca,5,2).'/'.substr($vencimentolicenca,0,4);
		$ult_atual=pg_result($resultado,0,"ult_atualizacao");
		if($ult_atual != "")
		{
		$ult_atualizacao=substr($ult_atual,8,2).'/'.substr($ult_atual,5,2).'/'.substr($ult_atual,0,4);
		}
		else
		{
		$ult_atualizacao="";
		}
		$renavam=pg_result($resultado,0,"renavam");
		if($renavam != ""){
			//$renavam=substr($renavam,0,3).'.'.substr($renavam,3,3).'.'.substr($renavam,6,3);
		}
		else{
			$renavam="";
		}
		$permissionario=pg_result($resultado,0,"permissionario");
		$endereco=pg_result($resultado,0,"endereco");
		$bairro=pg_result($resultado,0,"bairro");
		$cidade=pg_result($resultado,0,"cidade");
		$cep=pg_result($resultado,0,"cep");
		$local=pg_result($resultado,0,"local");
		if (strstr($cep,"-") == ""){		
		$cep=substr($cep,0,5).'-'.substr($cep,5,3);
		}
		$cnpj=pg_result($resultado,0,"cnpj");		
		if($cnpj != ""){
			$cnpj=substr($cnpj,0,2).'.'.substr($cnpj,2,3).'.'.substr($cnpj,5,3).'/'.substr($cnpj,8,4).'-'.substr($cnpj,12,2);
		}
		else{
			$cnpj="";
		}
		$cpf=pg_result($resultado,0,"cpf");		
		if($cpf != ""){
			$cpf=substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
		}
		else{
			$cpf="";
		}
		echo "<table align='center' border=3 width='400' bordercolor='#9ACD32'>";
		echo "<tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Servi&ccedilo</td>";
		echo "<td align='left' width='300'><a class='smt'>$nomeservico </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>N&ordm Ordem </td>";
		echo "<td align='left' width='300'><a class='smt'>$noordem </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Placa </td>";
		echo "<td align='left' width='300'><a class='smt'>$placa </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Lota&ccedil&atildeo </td>";
		echo "<td align='left' width='300'><a class='smt'>$lotacao </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Tipo </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($tipo)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Categoria </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($categoria)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Marca/Mod. </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($marcamodelo)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Ano Fab./Mod. </td>";
		echo "<td align='left' width='300'><a class='smt'>$anofab/$anomod</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Vencimento Selo </td>";
		echo "<td align='left' width='300'><a class='smt'>$vencselo </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Vencimento Licen&ccedila </td>";
		echo "<td align='left' width='300'><a class='smt'>$venclicenca </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Renavam </td>";
		echo "<td align='left' width='300'><a class='smt'>$renavam </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Permission&aacuterio </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($permissionario)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center'width='100'><font face='verdana' size='1'>Endere&ccedilo </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($endereco)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Bairro </td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($bairro)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Cidade</td>";
		echo "<td align='left' width='300'><a class='smt'>".utf8_encode($cidade)."</a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>CEP </td>";
		echo "<td align='left' width='300'><a class='smt'>$cep </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>CNPJ </td>";
		echo "<td align='left' width='300'><a class='smt'>$cnpj </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>CPF </td>";
		echo "<td align='left' width='300'><a class='smt'>$cpf </a></td>";
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>Local </td>";
		if($nomeservico == "TURISMO")
		{
			echo "<td align='left' width='300'><a class='smt'></a></td>";
		}
		else
		{
			echo "<td align='left' width='300'><a class='smt'>".utf8_encode($local)."</a></td>";
		}
		echo "</tr><tr>";
		echo "<td align='center' width='100'><font face='verdana' size='1'>&Uacuteltima atualiza&ccedil&atildeo </td>";
		echo "<td align='left' width='300'><a class='smt'>$ult_atualizacao </a></td>";
		echo "</tr>";
		echo "</table>";
	}
}
else
{
	echo pg_error();
}
opcoes();
}
function idveicserv($servico)
{
$sql = "SELECT id";
$sql = $sql." FROM vencimentos WHERE nomeservico = '$servico'";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	if($linhas==1)
	{
		$varid=pg_result($resultado,$i,"id");
	}
	elseif($linhas==0)
	{
		$varid=-1;
	}
	else
	{
		$varid=0;
	}
}
else
{
	echo pg_error();
	$varid=-1;
}
return $varid;
}
function idveicnord($noordem)
{
$sql = "SELECT id";
$sql = $sql." FROM vencimentos WHERE noordem like '%$noordem%'";
$resultado=pg_query($sql);
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	if($linhas==1)
	{
		$varid=pg_result($resultado,0,"id");
	}
	elseif($linhas==0)
	{
		$varid=-1;
	}
	else
	{
		$varid=0;
	}
}
else
{
	echo pg_error();
	$varid=-1;
}
return $varid;
}
function idveicplaca($placa)
{
//echo "IDVEICPLACA";
$sql = "SELECT id";
$sql = $sql." FROM vencimentos WHERE placa like '%$placa%'";
$resultado=pg_query($sql);
//$varid=-1;
if($resultado != FALSE)
{
	$linhas=pg_num_rows($resultado);
	if($linhas==1)
	{
		$varid=pg_result($resultado,0,"id");
	}
	elseif($linhas==0)
	{
		$varid=-1;
	}
	else
	{
		$varid=0;
	}
}
else
{
	echo pg_error();
	$varid==-1;
}
//echo $varid;
return $varid;
}
function opcoes()
{
echo "<p></p>";
echo "<table align='center'>";
echo "<tr align='center'>";
echo "</tr>";
echo "</table>";
//echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";

//echo "<td align='center'><font face='verdana' size='1'><a href='javascript:window.history.go(-1);'>Voltar</a></td>";
echo "<p></p>";
echo "<p align='center'><font face='verdana' size='1'><font face='verdana'><a href='seleciona.php'>Nova Pesquisa </a></font></p>";
//echo "<p align='center'><font face='verdana' size='1'><a href='goBack()'>Voltar</a></font></p>";
//echo "<p align='center'><font face='verdana' size='1'><font face='verdana'><a href='vistoria.php'>Voltar </a></font></p>";
//echo "<p align='center'><font face='verdana' size='1'><font face='verdana'><a href='cadvencidos.php'>Voltar </a></font></p>";
echo "<p></p>";
}

?>
</html>