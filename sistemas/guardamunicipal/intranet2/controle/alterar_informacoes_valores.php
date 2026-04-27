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
	
	$matricula =  (int)$_POST['matricula'];
   
   if( $matricula == 0 )
   {
     $matricula = (int)$_GET['matricula'];
   }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">ALTERAR RESULTADO DE VALORES</legend>

	<table  width="50%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
		<tr>
			<td width="23%" align="center" class="branco"><B>Matricula</B></td>
			<td width="25%" align="center" class="branco">Grat. Chefia</td>	
			<td width="32%" align="center" class="branco">Grat. Incentivo</td>		
			<td width="20%" align="center" class="branco">Trienio</td>
		  </tr> 
	</table>
	<form name="form1" method="post" action="../classes/controleValores.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	<table width="50%" border="0" cellspacing="1" cellpadding="1">
	<?php
		$query = "SELECT gratificacao,incentivo,trienio,matricula FROM institucional where matricula=$matricula order by matricula";
		$chavet = true;
		$resultado = $obj->executaQuery($query);
		if ( $linha = mysql_fetch_array($resultado) )
		{		
			$gratificacao =  $linha['gratificacao'];
			$incentivo =  $linha['incentivo'];
			$trienio =  $linha['trienio'];
			$matricula =  $linha['matricula'];
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
			<td width="23%" align="center" class="letra"><input name="matricula" id="matricula" type="text" value="<? echo $matricula?>" size="8"></td>
			<td width="25%" align="center" class="letra"><input name="gratificacao" id="gratificacao" type="text" value="<? echo $gratificacao?>" size="10"></td>		
			<td width="32%" align="center" class="letra"><font class="negrito">Sim(1) Nao(0)&nbsp;&nbsp;</font><input name="incentivo" id="incentivo" type="text" value="<? echo $incentivo?>" size="5"></td>
			<td width="20%" align="center" class="letra"><input name="trienio" id="trienio" type="text" value="<? echo $trienio?>" size="3"></td>
			</tr>
		
	<?php
		}
	?>
		
	</table>
	<table width="393">
		<tr>	
			<td width="97" align="right">
			<td width="284"><input name="Confirmar" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
			</td>
	  </tr>
	</table>
	</form>
	
	</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($conexao);
	$obj->closeVar($xBusca);
	$obj->closeVar($tamanho);
	$obj->closeVar($nvaloresencontrados);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>