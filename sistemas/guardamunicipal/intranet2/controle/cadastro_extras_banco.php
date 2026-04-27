<?php
	ini_set('default_charset','UTF-8');

// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
	$id = $_GET['id'];
	if( $id > 0 )
	{
		// Pegou o Id
	}
	else
	{
		$id = $_POST['id'];
	}
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	require ("../classes/trataString.php");
	$objS = new trataString;
	$tamanho = 0;
	$nome = "";
	$descricao = "";
	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM extra where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$descricao = $linha["descricao"];
			$tamanho = strlen($nome);

			// Path onde os arquivos são cadastradas
			$path = $objT->getPath(3).$id."/";
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
<script type="text/javascript" src="scripts/arquivo_ajax.js" language="javascript"></script>
</head>

<body>

<fieldset>
	<legend class="cabecalho">PUBLICAR ESCALA DE HORA EXTRA</legend>

<form name="form1" method="post" action="../classes/controleExtrasBanco.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">

 <tr>
    <td width="11%" align="right" class="letra">Nome:</td>
    <td width="89%"><input name="xnome" id="xnome" type="text" class="negrito" onkeyup="converteUpper(this);" size="52" value="<? echo $nome;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
 </tr>

  <tr>
	<td width="11%">&nbsp;</td>
    <td align="left" class="letra">&nbsp;</td>
  </tr>

  <tr>
    <td width="11%" align="right" valign="top" class="letra">Descrição:</td>
    <td width="89%">
	<textarea name="xdescricao" cols="100" rows="10" class="negrito" onkeyup="converteUpper(this);"><? echo $descricao;?></textarea>
</td>
 </tr>

 <tr>
    <td align="right" class="letra">Enviar Arquivo:</td>
    <td>		
	<input name="arquivo" size="52" type="file" class="negrito" />
	</td>
  </tr>

 <INPUT TYPE="hidden" NAME="id" id="idhidden" value="<?echo $id;?>"> 
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>
</body>
</html>

<?php
	// Fechando as variáveis de conexão
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
