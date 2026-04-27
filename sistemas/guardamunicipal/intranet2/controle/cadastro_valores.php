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
		$query = "SELECT * FROM institucional where matricula=$matricula";
		$resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$matricula = $linha["matricula"];
			$trienio = $linha["trienio"];
			$incentivo = $linha["incentivo"];
			$gratificacao = $linha["gratificacao"];
			$notacurso = $linha["notacurso"];
			$posicaocurso = $linha["posicaocurso"];
			$notaconcurso = $linha["notaconcurso"];
			$posicaoconcurso = $linha["posicaoconcurso"];
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
	<legend class="cabecalho">CADASTRO DE VALORES</legend>

<form name="form1" method="post" action="cadastro_valores.php" onSubmit="return validaFormAll(this,'Buscar','Buscar')" enctype="multipart/form-data">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
   <td width="16%" align="right" class="letra">Matricula:</td>
   <td width="84%"><input name="xmatricula" maxlength="6" type="text" size="20" value="<? echo $matricula;?>" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeypress="return SomenteNumero(event);"/> <input name="Submit" type="submit" id="Buscar" class="letra" onClick="onClickButton(null,'Aguarde...','','Buscar')" value="Buscar" /></td>
 </tr>
</table>
</form>
<form name="form1" method="post" action="../classes/controleValores.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')" enctype="multipart/form-data">

<table width="80%" border="0" cellspacing="1" cellpadding="1">
 <tr>
   <td width="16%" align="right" class="letra">Matricula:</td>
   <td width="84%"><input name="xmatricula" maxlength="6" type="text" size="10" value="<? echo $matricula;?>" class="negrito" readonly="readonly"/> </td>
 </tr>
 <tr>
   <td width="16%" align="right" class="letra">Grat. Chefia:</td>
   <td width="84%"><input name="xgratificacao" type="text" size="10" value="<? echo $gratificacao;?>" class="negrito"/><font class="letra">0 para NÃO POSSUE, 1 para FG1 e 2 para FG2</font></td>
 </tr>
 <tr>
    <td width="16%" align="right" class="letra">Grat. Insentivo:</td>
    <td class="letra" width="84%"><input name="xinsentivo" type="text" size="10" value="<? echo $incentivo;?>" class="negrito"/><font class="letra"> 1 para POSSUE e 2 para NÃO POSSUE</font></td>
 </tr>
 <tr>
    <td width="16%" align="right" class="letra">Triênio:</td>
    <td class="letra" width="84%"><input name="xtrienio" type="text" size="10" value="<? echo $trienio;?>" class="negrito"/></td>
 </tr>
<tr>
    <td width="16%" align="right" class="letra">Posição Concurso:</td>
    <td class="letra" width="84%"><input name="xposicaoconcurso" type="text" size="10" value="<? echo $posicaoconcurso;?>" class="negrito"/></td>
 </tr>
 <tr>
    <td width="16%" align="right" class="letra">Nota Concurso:</td>
    <td class="letra" width="84%"><input name="xnotaconcurso" type="text" size="10" value="<? echo $notaconcurso;?>" class="negrito"/></td>
 </tr>
 <tr>
    <td width="16%" align="right" class="letra">Posição Curso:</td>
    <td class="letra" width="84%"><input name="xposicaocurso" type="text" size="10" value="<? echo $posicaocurso;?>" class="negrito"/></td>
 </tr>
 <tr>
    <td width="16%" align="right" class="letra">Nota Curso:</td>
    <td class="letra" width="84%"><input name="xnotacurso" type="text" size="10" value="<? echo $notacurso;?>" class="negrito"/></td>
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
</body>
</html>