<?php
	ini_set('default_charset','UTF-8');

	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
	$matricula = $_GET['matricula'];
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
		
		$id = 0;
		$matricula = 0;
		$login = "";
		$permissao = "";
		$administrador = '';
		$planejamento = '';
		$chefia = '';
		$guardaonline = '';
		$setorpessoal = '';
		$rondaescolar = '';
		$digitacao = '';
		$central = '';
		$digital = '';
		$logistica = '';

		if( $linha )
		{
			$id = $linha["id"];
			$matricula = $linha["matricula"];
			$login = $linha["login"];
			$permissao = $linha["permissao"];
			$administrador = $linha["administrador"];
			$planejamento = $linha["planejamento"];
			$chefia = $linha["chefia"];
			$guardaonline = $linha["guardaonline"];
			$setorpessoal = $linha["setorpessoal"];
			$rondaescolar = $linha["rondaescolar"];
			$digitacao = $linha["digitacao"];
			$central = $linha["central"];
			$digital = $linha["digital"];
			$logistica = $linha["logistica"];
					
			// Path
			$path = $objT->getPath(19).$id."/";
			$nomearquivo = $objT->retornaArquivo($path);
			$tamanhonomearquivo = strlen($nomearquivo);
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
	<legend class="cabecalho">CADASTRO DE PERMISSÕES</legend>

<form name="form1" method="post" action="cadastro_funcionario.php" onSubmit="return validaFormAll(this,'Buscar','Buscar')" enctype="multipart/form-data">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
   <td width="16%" align="right" class="letra">Matricula:</td>
   <td width="84%"><input name="xmatricula" maxlength="6" type="text" size="20" value="<? echo $matricula;?>" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" onkeypress="return SomenteNumero(event);"/> <input name="Submit" type="submit" id="Buscar" class="letra" onClick="onClickButton(null,'Aguarde...','','Buscar')" value="Buscar" /></td>
 </tr>
</table>
</form>

<form name="form1" method="post" action="../classes/controleFuncionario.php" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')" enctype="multipart/form-data">

<table width="80%" border="0" cellspacing="1" cellpadding="1">

 <tr>
   <td width="16%" align="right" class="letra">Matricula:</td>
   <td width="84%"><input name="xmatricula" maxlength="6" type="text" size="20" value="<? echo $matricula;?>" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
 </tr>
 <tr>
   <td width="16%" align="right" class="letra">Nome de Guerra:</td>
   <td width="84%"><input name="xlogin" type="text" size="52" value="<? echo $login;?>" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
 </tr>

   <?php
	$tamanhoadministrador = strlen($administrador);
	$tamanhoplanejamento = strlen($planejamento);
	$tamanhochefia = strlen($chefia);
	$tamanhoguardaonline = strlen($guardaonline);
	$tamanhosetorpessoal = strlen($setorpessoal);
	$tamanhorondaescolar = strlen($rondaescolar);
	$tamanhodigitacao = strlen($digitacao);
	$tamanhocentral = strlen($central);
	$tamanhodigital = strlen($digital);
	$tamanhologistica = strlen($logistica);
?>
 <tr>
    <td width="16%" align="right" valign="top" class="letra">Permissão:</td>
    <td class="letra" width="84%">
		<INPUT TYPE="checkbox" id="administrador" NAME="administrador" value="S" <?if($tamanhoadministrador>0){?>CHECKED<?}?> > <label for="administrador"><U><B>Administrador</B></U> [RESTRITO .: Pode cadastrar as Contas de Acesso ao ADM e definir suas permissões de acesso]</label><br>
        <INPUT TYPE="checkbox" id="planejamento" NAME="planejamento" value="S" <?if($tamanhoplanejamento>0){?>CHECKED<?}?> ><label for="planejamento">Planejamento</label><br>
        <INPUT TYPE="checkbox" id="chefia" NAME="chefia" value="S" <?if($tamanhochefia>0){?>CHECKED<?}?> ><label for="chefia">Chefia</label><br>
        <INPUT TYPE="checkbox" id="guardainline" NAME="guardaonline" value="S" <?if($tamanhoguardaonline>0){?>CHECKED<?}?> ><label for="guardaonline">Guarda Online</label><br>
		<INPUT TYPE="checkbox" id="setorpessoal" NAME="setorpessoal" value="S" <?if($tamanhosetorpessoal>0){?>CHECKED<?}?> > <label for="setorpessoal">Setor Pessoal</label><br>
        <INPUT TYPE="checkbox" id="rondaescolar" NAME="rondaescolar" value="S" <?if($tamanhorondaescolar>0){?>CHECKED<?}?> > <label for="rondaescolar">Ronda Escolar</label><br>
		<INPUT TYPE="checkbox" id="digitacao" NAME="digitacao" value="S" <?if($tamanhodigitacao>0){?>CHECKED<?}?> > <label for="digitacao">Digitação</label><br>
		<INPUT TYPE="checkbox" id="central" NAME="central" value="S" <?if($tamanhocentral>0){?>CHECKED<?}?> > <label for="central">Central</label><br>
        <INPUT TYPE="checkbox" id="digital" NAME="digital" value="S" <?if($tamanhodigital>0){?>CHECKED<?}?> > <label for="digital">Digital</label><br>
        <INPUT TYPE="checkbox" id="logistica" NAME="logistica" value="S" <?if($tamanhologistica>0){?>CHECKED<?}?> > <label for="logistica">Logística</label><br>
<br>
	</td>
 </tr>

 <INPUT TYPE="hidden" NAME="idFuncionario" value="<?echo $idFuncionario;?>">	
	
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