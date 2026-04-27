<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
  
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $id =  (int)$_POST['idEscola'];
   if( $id == 0 )
   {
      $id = (int)$_GET['idEscola'];
   }

	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataString.php");
	$objS = new trataString;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;

	if( $id > 0 )
	{		
		$query = "SELECT * FROM escolas where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$rua = $linha["rua"];
			$numero = $linha["numero"];
			$bairro = $linha["bairro"];
			$diretor = $linha["diretor"];
			$telefone = $linha["telefone"];
			$email = $linha["email"];
			$numalunos = $linha["numalunos"];
			$tamanho = strlen($nome);
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
    <th>&nbsp;</th>
  </tr>
  <tr>
    <td colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CADASTRO DE SOLICITAÇÃO ESCOLAR</legend>
	<form name="form1" method="post" action="../classes/controleEscola.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

		<table width="100%" border="0" cellspacing="1" cellpadding="1">
          <td width="12%" align="right" valign="top" class="letra">Escola:</td>
          <td width="88%"><input type="text" class="negrito" name="xnome" id="xnome" size="60" value="<? echo $nome;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
        </tr>
		  <tr>
		    <td height="24" align="right" class="letra">Rua:</td>
		    <td align="left" class="letra"><input name="xrua" class="negrito" id="xrua" onkeyup="converteUpper(this);"  type="text" size="50" value="<? echo $rua;?>"onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
		      Numero:
		      <input type="text" name="xnumero" id="xnumero" class="negrito" value="<? echo $numero?>" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
		      Bairro:
		      <input type="text" name="xbairro" id="xbairro" class="negrito" value="<? echo $bairro?>" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
		    </tr>
		  <tr>
		    <td height="24" align="right" class="letra">Diretor:</td>
		    <td align="left" class="letra"><input name="xdiretor" id="xdiretor" class="negrito" type="text" size="30" value="<? echo $diretor;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/> 
		      &raquo; Telefone:
		      <input name="xtelefone" id="xtelefone" type="text" size="30" class="negrito" value="<? echo $telefone;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
		    </tr>
		  <tr>
			<td height="24" align="right" class="letra">Email:</td>
			<td align="left" class="letra"><input name="xemail" class="negrito" id="xemail" type="text" size="52" value="<? echo $email;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
		  </tr>
		  <tr>
		    <td align="right" valign="top" class="letra">Numero Alunos</td>
		    <td align="left" class="letra"><input type="text" name="xnumalunos" id="xnumalunos" class="negrito" value="<? echo $numalunos?>" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
		    </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Necessidade da Visita:</td>
			<td align="left" class="letra"><input name="xnecessidade" class="negrito" id="xnecessidade" type="text" size="52" value="<? echo $necessidade;?>"  onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
		  </tr>
	
		 	<input name="idEscola" type="hidden" value="<? echo $id;?>"/>
			
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
