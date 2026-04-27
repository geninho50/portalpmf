<?
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$numpagamento = $_GET['numpagamento'];
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$resultado = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($resultado);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

</head>

<body>
<fieldset>
	<legend class="cabecalho">LISTA DE MATERIAL EM PROCESSO DE DEVOLUÇÃO</legend>
<form name="form1" action="../classes/controleConfirmarDevolucaoDiario.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Receber','Receber')">
    <table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#006699">
	<tr>
		<td width="3%" align="center" class="branco">&nbsp;</td>
        <td width="6%" align="center" class="branco">&nbsp;</td>
		<td width="10%" align="center" class="branco"><B>QTD</B></td>
		<td width="80%" align="left" class="branco"><B>Descric&atilde;o</B></td>
		</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$query = "select * from pagamentodiario where numpagamento=$numpagamento and status=1";
	$resultado = $obj->executaQuery($query);
	while($linha=mysql_fetch_array($resultado))
	{		
		// Tratando o tamanho do nome da notícia
		$material = $obj->retornaSringTamanho($linha['material'],150);
		$id = $linha['id'];		
		$matricularetirada = $linha['matricularetirada'];
		$matriculagm4retirada = $linha['matriculagm4retirada'];
		$qtdretirado = $linha['qtdretirado'];
		
		$queryL = "select * from guarda_gmf where matricula = $matriculagm4retirada";
		$resultadoL = $obj->executaQuery($queryL);
		while ( $dadosL = mysql_fetch_array($resultadoL) )
		{
			$login = $dadosL['login'];
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

		<td width="3%" align="center" class="negrito"><input name="id[]" checked type="checkbox" value="<?php echo $id; ?>" class="negrito"/></td>
		<td width="6%" align="center" class="negrito"><input name="numpagamento[]" type="text" value="<?php echo $numpagamento; ?>" size="2" class="negrito"/></td>
        <td width="10%" align="center" class="negrito"><input name="qtddevolucao[]" type="text" value="<?php echo $qtdretirado; ?>" size="2" class="negrito"/></td>
		<td width="80%" align="left" class="negrito"><?php echo $material; ?></td>
	  </tr>
<?php
		}
	}
?>
	
</table>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td width="32%" align="right">&nbsp;</td>
    <td width="68%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="negrito">Matricula Guarda:
      <input name="xmatriculadevolucao" maxlength="6" type="text" size="10" value="<? echo $matriculaguarda; ?>" class="negrito"/></td>
    <td align="left" class="negrito"><input name="xsenhaguarda" type="password" size="10" class="negrito" />Senha</td>
  </tr>
  <tr>
    <td align="right" class="negrito">GM4: <input name="matriculagm4devolucao" readonly='readonly' class="negrito" type="text" size="10" value="<? echo $matriculagm4retirada; ?>"/></td>
    <td align="left" class="negrito"><input name="xsenhagm4" type="password" size="10" class="negrito" />Senha</td>
  </tr>
  <tr>
    <td class="letra" align="right"><? echo $login;?>&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="Submit" type="submit" id="Receber" class="letra" onClick="onClickButton(null,'Aguarde...','','Receber')" value="Receber" /></td>
  </tr>
</table>
</form>

</fieldset>
</body>
</html>
