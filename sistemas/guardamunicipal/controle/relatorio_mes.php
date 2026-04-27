<?php
	include("incValidaSessao.php");
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	$obj = new DB_mysql;
	$objT = new trataArquivo;
	$conexao = $obj->conectarConf();
	$idsession = $_SESSION['idSESSION'];
	// Realiza a consulta ao banco;
	$ultimoslivros = $_GET['ultimoslivros'];
	if( $ultimoslivros > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$ultimoslivros = $_POST['ultimoslivros'];
	}

	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$mes = trim($mes);
	$tamanho = strlen($mes);
	$nvaloresencontrados = 0;
	
	if( $ultimoslivros > 0 ){
		$query = "SELECT id,nome,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,telefone,rua,numero,bairro,referencia,justificativa,hora,motivonegado,informacao_adicional,estado_clinico,destino,cancelamento,motivo_aceito,status FROM transporte order by data desc";
	}else{
			$query = "SELECT id,nome,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,telefone,rua,numero,bairro,referencia,justificativa,hora,motivonegado,informacao_adicional,estado_clinico,destino,cancelamento,motivo_aceito,status FROM transporte where MONTH(data)=$mes and YEAR(data)=$ano order by data desc";
		}
	
	if( $tamanho > 0 || $ultimoslivros > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body ONLOAD="setaFocusForm(1)">

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><fieldset>
	<legend class="letra">Relatorio</legend>
    <form name="form1" method="post" action="relatorio_mes.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td align="right" class="letra">Mes: </td>
    <td class="letra"><select name="mes">
	  <option value="1">JANEIRO</option>
	  <option value="2">FEVEREIRO</option>
	  <option value="3">MARÇO</option>
	  <option value="4">ABRIL</option>
	  <option value="5">MAIO</option>
	  <option value="6">JUNHO</option>
	  <option value="7">JULHO</option>
	  <option value="8">AGOSTO</option>
	  <option value="9">SETEMBRO</option>
	  <option value="10">OUTUBRO</option>
	  <option value="11">NOVEMBRO</option>
	  <option value="12">DEZEMBRO</option>
    </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">Ano: </td>
    <td class="letra"><select name="ano">
      <option value="2013">2013</option>
	  <option value="2014">2014</option>
      <option value="2015">2015</option>
      </select></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td align="right" class="letra"><input name="Submit" type="submit" class="botao" id="Submit" value="Pesquisar" onclick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
    <td>&nbsp;</td>
  </tr>

  <tr>
    <td width="40%" align="right" class="letra">&nbsp;</td>
    <td width="56%" class="letra"><A HREF="relatorio_mes.php?ultimoslivros=1"><font color="#000000" size="2">Listar Todos</font></A></td>
      <td width="29%">&nbsp;</td>
  </tr>
</table>



</form>
</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $livro;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="6%" align="center" class="branco"><B>N Protocolo </B></td>
		<td width="11%" align="center" class="branco"><B>Data</B></td>
		<td width="53%" align="left" class="branco"><strong>Solicitante</strong></td>
		<td width="10%" align="left" class="branco"><strong>Status</strong></td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	$path = $objT->getPath(17);
	while ($linha=mysql_fetch_array($resultado))
	{		
		$id = $linha["id"];
				$hora = $linha["hora"];
				$nome = $linha["nome"];
				$dataini = $linha["data"];
				$telefone = $linha["telefone"];
				$rua = $linha["rua"];
				$bairro = $linha["bairro"];
				$numero = $linha["numero"];
				$referencia = $linha["referencia"];
				$justificativa = $linha["justificativa"];
				$naoatentido = $linha['motivonegado'];
				$informacao = $linha['informacao_adicional'];
				$estado_clinico = $linha['estado_clinico'];
				$cancelamento = $linha['cancelamento'];
				$destino = $linha['destino'];
				$motivo_aceito = $linha['motivo_aceito'];
				$status = $linha['status'];
				$dia = $linha['dia'];
				$mes = $linha['mes'];
				$ano = $linha['ano'];
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

		<td width="6%" align="center" class="negrito"><? echo $id; ?></td>
		<td width="11%" align="center" class="negrito"><?php echo $dia."/".$mes."/".$ano; ?></td>
		<td width="53%" align="left" valign="top" class="negrito"><? echo $nome; ?></td>
		<td width="10%" align="left" valign="top" class="negrito">
		<? 
		if($status==1){echo'ATENDIDO';}
		if($status==2){echo'NEGADO ATENDIMENTO';}
		if($status==3){echo'CANCELADO';}
		?>
		</td>
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
	<legend class="letra">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $livro;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">

	<tr>
		<td width="100%" colspan="3" align="center" class="letra">Nenhuma ocorr&ecirc;ncia para <B><?echo $livro;?></B></td>
	</tr>
	
</table>
</fieldset>

<?php	
	}
?></td>
  </tr>
</table>








</body>
</html>