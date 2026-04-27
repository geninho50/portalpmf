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
<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
  <tr>
    <td width="256" align="right" bgcolor="#0086a8" class="branco">Histórico de Medicamento:</td>
    <td width="976" align="left">
	
	
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
    		<? 
			$chavet = true;
			$query = "SELECT * FROM medicamento where matricula=$matricula";
			$resultado = $conexao->executaQuery($query);
			while( $linha = mysql_fetch_array($resultado) )
			{
				$id = $linha["id"];
				$respostamedicamento = $linha["medicamento"];
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
        <td width="96%"><? echo'<font class=negrito>'.$respostamedicamento.'</font><br>';?></td>
        </tr>
	  		<? 
			}
			?>
    </table>

	
	</td>
  </tr>
</table>

<form name="form" action="../classes/controleUsuarioSaude.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">
<table width="100%"  border="0">
  <tr>
    <td class="negrito" align="left">Informe abaixo caso haja mais algum relato de alergia a medicamento, alimento ou outros. </td>
  </tr>
  <tr>
    <td class="negrito" align="left">
	  <textarea name="xrespostamedicamento" cols="100" rows="20" id="xrespostamedicamento" onkeyup="converteUpper(this);"></textarea>	</td>
  </tr>
  <tr>
	<td align="left"  class="negrito">
			<input name="matricula" type="text" size="7" readonly="readonly" value="<? echo $matricula; ?>" />
			<input name="tipo" type="text" size="6" readonly="readonly" value="medicamento" /></td>
  </tr>
  <tr>
     <td><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Continuar" /></td>
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