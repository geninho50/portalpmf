<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	$matricula = $_GET['matricula'];
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
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
  <tr align="center" bgcolor="#666666">
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
<fieldset>
	<legend class="cabecalho">RESULTADO</legend>
	<?
			$chavet = true;
			$query = "SELECT * FROM tiposang where matricula=$matricula";
			$resultado = $conexao->executaQuery($query);
			if( $linha = mysql_fetch_array($resultado) )
			{
				$id = $linha["id"];
				$tiposang = $linha["tiposang"];
				$chavedoador = $linha["chavedoador"];
			?>
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF">
  <tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
    <td width="21%" align="right" bgcolor="#006699" class="branco">Tipo Sang./Fator RH:</td>
    <td width="79%" align="left" class="letra"><? echo $tiposang; ?></td>
 </tr>
  <tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
    <td align="right" bgcolor="#006699" class="branco">Doador:</td>
    <td align="left" class="letra"><? if($chavedoador == 1){echo 'Sou Doador';}else{ echo'Não Doador';}?></td>
  </tr>
</table>
	<? 
			}
	?>
<form name="form" action="../classes/controleUsuarioSaude.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">
<table width="100%"  border="0">
  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td align="left" class="negrito">&nbsp;</td>
  </tr>
  <tr>
    <td width="18%" align="right" class="letra">Tipo Sang./Fator RH:</td>
    <td width="82%" align="left" class="letra"><input name="tiposang" type="text" class="letra" size="10" onkeyup="converteUpper(this);"</td>
  </tr>
  <tr>
    <td align="right"  class="letra">Doador?:</td>
    <td align="left"  class="letra"><input name="doador" type="radio" value="1" />Sim 
      								<input name="doador" type="radio" value="2" />N&atilde;o
	</td>
  </tr>
  <tr>
	<td align="left"  class="negrito">&nbsp;			</td>
    <td align="left"  class="negrito"><input name="matricula" type="text" size="7" readonly="readonly" value="<? echo $matricula; ?>" />
      <input name="tipo" type="text" size="6" readonly="readonly" value="fator" /></td>
  </tr>
  <tr>
     <td>&nbsp;</td>
     <td><input name="Submit" type="submit" class="letra" id="Submit" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Continuar" /></td>
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
	// Fechando as variáveis de conexão
	$obj->closeVar($conexao);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>