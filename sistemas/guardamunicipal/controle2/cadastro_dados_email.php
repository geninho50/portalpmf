<?php
    // Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past

	include("incValidaSessao.php");
	$idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	//$conexao = $obj->conectarConf();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

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
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Cadastro dados Adicionais</legend>
	<form name="form1" method="post" action="../classes/controleDadosEmail.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	  <table width="67%" border="0" cellspacing="1" cellpadding="1">
	    <tr>
	      <td width="20%" align="right" class="letra">GM:</td>
	      <td width="53%"><input name="login" type="text" id="login" size="15" readonly="readonly" value="<? echo $login; ?>" /></td>
	      <td width="27%" align="right">&nbsp;</td>
	      </tr>
          <tr>
	      <td align="right" class="letra">CPF:</td>
	      <td><input name="xcpf" type="text" id="xcpf" maxlength="11" onBlur="Verifica_campo_CPF(this)" value="<? echo $cpf;?>"/><FONT COLOR="#FF0033" size="1">(Nomeros sem o <B>Digito</B>)</FONT> </td>
	      <td>      
	      </tr>
	    <tr>
	      <td align="right" class="letra">Telefone Residencial:</td>
	      <td><input type="text" value="<? echo $telefone1;?>" maxlength="9" name="telefone1" class="stylo1" size="20" onkeypress="formatar(this, '####-####')"/><font color="#FF0000" size="1">NAO OBRIGATORIO - sem codigo de area</font></td>
	      <td>      
	      </tr>
        <tr>
	      <td align="right" class="letra">Celular 1:</td>
	      <td><input type="text" value="<? echo $telefone2;?>" maxlength="9" name="xtelefone2" class="stylo1" size="20" onkeypress="formatar(this, '####-####')"/><font color="#FF0000" size="1">sem codigo de area</font></td>
	      <td>      
	      </tr>
	    <tr>
	      <td align="right" class="letra">Celular 2:</td>
	      <td><input type="text" value="<? echo $telefone3;?>" maxlength="9" name="telefone3" class="stylo1" size="20" onkeypress="formatar(this, '####-####')"/><font color="#FF0000" size="1">NAO OBRIGATORIO - sem codigo de area</font></td>
	      <td>      
	      </tr>
	    <tr>
	      <td height="24" align="right" class="letra">Email:</td>
	      <td><input name="xemail" type="text" id="xemail" size="50" /></td>
	      <td>      
	      </tr>
	    <tr>
	      <td height="24" align="right" class="letra">Chave:</td>
	      <td><input name="xchave" type="text" id="xchave" maxlength="4" size="10" /><font color="#FF0000" size="1">numerico de 4 digitos</font></td>
	      <td>      
	      </tr>
  <td height="24" align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="botao" id="Confirmar" value="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" /></td>
    <td width="27%">  
  </tr>
	    </table>
	</form>
	</fieldset>
<!-- fim do adm -->
	
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($conexao);
	$obj->closeVar($tamanho);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>