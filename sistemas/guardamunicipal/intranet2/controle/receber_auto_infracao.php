<?php
ini_set('default_charset','UTF-8');

// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   
    $matricula = $_GET['matricula'];
	$numblocoinicial = $_GET['numblocoinicial'];
	$numblocofinal = $_GET['numblocofinal'];

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataString.php");
	$objS = new trataString;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;

	if( $idcaixa > 0 )
	{		
		$query = "SELECT * FROM caixa where id=$idcaixa";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$caixa = $linha["caixa"];
		}	
	}
	
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
    <th width="100%" colspan="2">
		<!--topo--><!--topo-->
	</th>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">RECEBIMENTO DE AUTO DE INFRAÇÃO</legend>
    <form name="form1" method="post" action="../classes/controleReceberAuto.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

		<table width="100%" border="0" cellspacing="1" cellpadding="1">
              <tr>
                <td align="right" valign="top">&nbsp;</td>
                <td><input type="text" class="negrito" name="login" id="login" size="15" value="<? echo $login;?>" readonly="readonly"/></td>
              </tr>
              <td width="15%" align="right" class="letra">Matricula:</td>
          <td width="85%"><input type="text" class="negrito" name="xmatricula" id="xmatricula" maxlength="6" size="10" value="<? echo $matricula?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
          </td>
        </tr>
		    <tr height="2">
		      <td align="right" class="letra">Número do AIT Inicial:</td>
		      <td align="left" class="letra">
              <input type="text" class="negrito" name="xnumblocoinicial" id="xnumblocoinicial" size="15" value="<? echo $numblocoinicial;?>" onkeypress="return SomenteNumero(event);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
              <input type="text" class="negrito" name="xletrainicial" id="xletrainicial" size="3" value="D" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	        </tr>
            <tr height="2">
		      <td align="right" class="letra">Número do AIT Final:</td>
		      <td align="left" class="letra">
              <input type="text" class="negrito" name="xnumblocofinal" id="xnumblocofinal" size="15" value="<? echo $numblocofinal;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
              <input type="text" class="negrito" name="xletrafinal" id="xletrafinal" size="3" value="D" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	        </tr>
            <tr height="2">
		      <td align="right" class="letra">Senha Agente:</td>
		      <td align="left" class="negrito"><input type="password" class="negrito" name="xsenha" id="xsenha" size="10" value="<? echo $senha?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
	        </tr>
		    <tr height="2">
			<td align="left" class="letra" colspan="2">&nbsp;</td>
		  </tr>
		  <tr>	
			<td align="right">
			<td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
			</td>
		  </tr>
		</table>
		</form>
		</fieldset>
	<!-- fim do adm -->
	
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeVar($id);
	$obj->closeVar($nomeCategoria);
	if( $id > 0 )
	{
		$obj->closeQuery();
		$obj->closeConexaoGeral();
	}
?>
