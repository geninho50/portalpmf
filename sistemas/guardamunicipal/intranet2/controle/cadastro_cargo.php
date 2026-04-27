<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;
	
	$matricula = $_POST['xmatricula'];

	if($matricula > 0){
		$conexao->conectarConf();
		$query = "SELECT * FROM guarda_gmf where matricula=$matricula";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$matricula = $linha["matricula"];
			$login = $linha["login"];
			$cargo = $linha["cargo"];
		}
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

<fieldset>
	<legend class="cabecalho">CADASTRO DE CARGOS</legend>

<form name="form1" method="post" action="cadastro_cargo.php" onSubmit="return validaFormAll(this,'Buscar','Buscar')" enctype="multipart/form-data">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
   <td width="16%" align="right" class="letra">Matricula:</td>
   <td width="84%"><input name="xmatricula" maxlength="6" type="text" size="20" value="<? echo $matricula;?>" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeypress="return SomenteNumero(event);"/> <input name="Submit" type="submit" id="Buscar" class="letra" onClick="onClickButton(null,'Aguarde...','','Buscar')" value="Buscar" /></td>
 </tr>
</table>
</form>
<form name="form1" method="post" action="../classes/controleCargo.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')" enctype="multipart/form-data">

<table width="80%" border="0" cellspacing="1" cellpadding="1">
 <tr>
   <td width="16%" align="right" class="letra">Matricula:</td>
   <td width="84%"><input name="xmatricula" maxlength="6" type="text" size="10" value="<? echo $matricula;?>" class="negrito" readonly="readonly"/> </td>
 </tr>
 <tr>
   <td width="16%" align="right" class="letra">Login:</td>
   <td width="84%"><input name="login" type="text" size="20" value="<? echo $login;?>" readonly="readonly" class="negrito"/></td>
 </tr>
 <tr>
    <td width="16%" align="right" class="letra">Cargo Anterior:</td>
    <td class="letra" width="84%"><input name="cargo" type="text" size="20" value="<? echo $cargo;?>" readonly="readonly" class="negrito"/></td>
 </tr>
 <tr>
    <td width="16%" align="right" class="letra">Novo Cargo:</td>
    <td class="letra" width="84%">
    <select name="ycargo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
          <option value="0">Selecionar...</option>
          <option value="DIRETOR">DIRETOR</option>
          <option value="SUBDIRETOR">SUBDIRETOR</option>
          <option value="CHEFE SETOR">CHEFE SETOR</option>
          <option value="GERENTE TRANSITO">GERENTE TRANSITO</option>
          <option value="CHEFE OPERACOES">CHEFE DE OPERACOES</option>
          <option value="GUARDA MUNICIPAL">GUARDA MUNICIPAL</option>
     </select>
    </td>
 </tr>
 <INPUT TYPE="hidden" NAME="id" value="<? echo $id;?>">	
	
 <tr height="2">
    <td align="left" class="letra" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" id="Confirmar" class="letra" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
  </tr>
</table>
</form>
</fieldset>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
</body>
</html>