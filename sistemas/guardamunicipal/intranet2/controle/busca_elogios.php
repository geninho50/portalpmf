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

	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	//Pega a data atual
    $data_atual = date("Y-m-d");
    $hora_atual = date("H:i:s");

	$ocorrencia = "";
	$ocorrencia = $_POST['xguarda'];
	$busca = $_POST['buscar'];
	$tamanho = strlen($ocorrencia);
	$nvaloresencontrados = 0;
	
    $query = "SELECT id,guarda,numero,titulo, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM elogio where UPPER($busca) like UPPER('%$ocorrencia%') order by numero desc";
		
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td width="42%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CONSULTAR ELOGIOS</legend>
		<form name="form" method="post" action="busca_elogios.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">
			<table width="67%" border="0" cellspacing="1" cellpadding="1">
				<tr>
				<td align="right" class="letra">Buscar por: </td>
				<td class="letra"><select name="buscar" class="negrito">
				  <option value="guarda">GUARDA</option>
				  <option value="titulo">TITULO</option>
				</select></td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td width="31%" align="right" class="letra">Digite o <B>Termo</B> para consulta:</td>
				<td width="56%"><input name="xguarda" id="xguarda" type="text" size="70" value="" class="codigo"/></td>
				  <td width="13%">&nbsp;</td>
			  </tr>
			  <tr>
				<td align="right">&nbsp;</td>
				<td align="right"><input name="Pesquisar" type="submit" class="botao" id="Submit" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
				<td>&nbsp;</td>
			  </tr>
			</table>
		</form>
	</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><? echo $nvaloresencontrados;?></B> PARA <? echo $ocorrencia;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="5%" align="center" class="branco"><B>N</B></td>
		<td width="10%" align="center" class="branco"><B>Data</B></td>
		<td width="13%" align="center" class="branco"><B>Guarda</B></td>
		<td width="66%" align="left" class="branco"><B>Titulo</B></td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultadoE = $obj->executaQuery($query);
	while ($linhaE=mysql_fetch_array($resultadoE))
	{		
		$id = $linhaE['id'];
		$guarda = $linhaE['guarda'];
		$numero = $linhaE['numero'];
		$titulo = $linhaE['titulo'];
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

		<td width="5%" align="center" class="negrito"><? echo $numero; ?></td>
		<td width="10%" align="center" class="negrito"><? echo $dia." / ".$mes." / ".$ano;?></td>
		<td width="13%" align="center" class="negrito"><? echo $guarda; ?></td>
		<td width="66%" align="left" valign="top" class="negrito"><? echo $titulo; ?></td>
	</tr>
<?php
	}
?>
	
</table>

</fieldset>


</td>
</tr>
</table>
<?php
	}

	if( $nvaloresencontrados == 0 && $tamanho > 0 )
	{
		
?>
<fieldset>
	<legend class="cabecalho">RESULTADO(s) <B><? echo $nvaloresencontrados;?></B> PARA <? echo $ocorrencia;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">

	<tr>
		<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para <B><? echo $ocorrencia;?></B></td>
	</tr>
	
</table>
</fieldset>

<?php	
	}
?>
	<!--fim adm-->
	</td>
  </tr>
</table>
 

</body>
</html>