<?php
	include("incValidaSessao.php");
	$idFuncionario = (int)$_GET['idFuncionario'];
	require ("../classes/DB_mysql.php");
	$conexao = new DB_mysql;
	
	if( $idFuncionario > 0 )
	{		
		$conexao->conectarConf();
		$query = "SELECT * FROM guarda_gmf where id=$idFuncionario";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		
		$id = 0;
		$matricula = 0;
		$nomeFuncionario = "";
		$login = "";
		$senha = "";

		if( $linha )
		{
			$id = $linha["id"];
			$matricula = $linha["matricula"];
			$nomeFuncionario = $linha["nome"];
			$login = $linha["login"];
			$senha = $linha["senha"];
		}
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<fieldset>
	<legend class="letra"><img src="imagens/21.jpg" width="64" height="64" /></legend>

<form name="form1" method="post" action="../classes/controleFuncionario.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')" enctype="multipart/form-data">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="12%" align="right" class="letra">Matricula:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="88%"><input name="xmatricula" maxlength="6" type="text" size="20" value="<?echo $matricula;?>"/></td>
 </tr>
 <tr>
    <td width="12%" align="right" class="letra">Nome:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="88%"><input name="xnome" type="text" size="52" value="<?echo $nomeFuncionario;?>"/></td>
 </tr>

 <tr>
    <td width="12%" align="right" class="letra">Login<FONT COLOR="#FF0033">*</FONT>:</td>
    <td width="88%"><input name="xlogin" type="text" size="52" value="<?echo $login;?>"/></td>
 </tr>

   <tr>
    <td width="12%" align="right" class="letra">Senha:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="88%"><input name="xsenha" type="password" size="52" value="<?echo $senha;?>"/></td>
 </tr>

 <INPUT TYPE="hidden" NAME="idFuncionario" value="<?echo $idFuncionario;?>">	

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" id="Confirmar" class="botao" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>
</table>

</form>
</fieldset>
</body>
</html>