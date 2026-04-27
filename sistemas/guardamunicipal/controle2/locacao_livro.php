<?php
	include("incValidaSessão.php");
	
	require ("../classes/DB_mysql.php");
	$conexao = new DB_mysql ;
	
	$idsession = $_SESSION['idSESSION'];
	$sql = "SELECT * FROM usuario where id=$idsession";
	$result = $conexao->executaQuery($sql);
	$linhaS = mysql_fetch_array($result);
	if( $linhaS )
	{
		$login = $linhaS["login"];
		$matricula = $linhaS["matricula"];
	}
	
	$idLivro =  $_POST['idLivro'];
	if( $idLivro == 0 )
    {
       $idLivro = $_GET['idLivro'];
    }
	
	if( $idLivro > 0 )
	{		
		$conexao->conectarConf();
		$query = "SELECT * FROM livros where id=$idLivro";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		
		$id = 0;
		$codigo = 0;
		$titulo = "";
		
		if( $linha )
		{
			$id = $linha["id"];
			$codigo = $linha["codigo"];
			$titulo = $linha["titulo"];
			
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<fieldset>
	<legend class="letra"><img src="imagens/livros.png" width="64" height="64" /></legend>
<form name="form1" method="post" action="../classes/controleReservaLivro.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="19%" align="right" class="letra">Atendente:</td>
    <td width="81%"><input name="matricula1" type="text" id="matricula1" value="<?echo $matricula;?>" size="8" readonly/>
    <input name="login" type="text" id="login" value="<?echo $login;?>" size="30" readonly /></td>
 </tr>
 <tr>
   <td align="right" class="letra">Matricula:<font color="#FF0033">*</font></td>
   <td><input name="xmatricula" type="text" id="xmatricula" value="<?echo $matricula;?>" size="8" readonly"readonly"/></td>
 </tr>
 <tr>
   <td align="right" class="letra">Senha:<font color="#FF0033">*</font></td>
   <td><input name="xsenha" type="text" id="matricula22" value="<?echo $senha;?>" size="8" readonly"/></td>
 </tr>
 <tr>
   <td align="right" class="letra">&nbsp;</td>
   <td>&nbsp;</td>
 </tr>
 <tr>
    <td width="19%" align="right" class="letra">C&oacute;digo:</td>
    <td width="81%"><input name="codigo" type="text" id="codigo" value="<?echo $codigo;?>" size="20" maxlength="6" readonly/></td>
 </tr>
 <tr>
    <td width="19%" align="right" class="letra">T&iacute;tulo:</td>
    <td width="81%"><input name="titulo" type="text" id="titulo" value="<?echo $titulo;?>" size="70" readonly/></td>
 </tr>
 <tr height="2">
    <td align="left" class="letra" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>
</table>

</form>
</fieldset>


</body>
</html>