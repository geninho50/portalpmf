<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $id =  (int)$_POST['idEvento'];
   if( $id == 0 )
   {
      $id = (int)$_GET['idEvento'];
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
		$query = "SELECT * FROM evento where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$data = $linha["data"];
		}		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>

<!-- ini inc head -->
		<?php include("head/incHead.php");?>
<!-- fim inc head -->

</head>

<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
<fieldset>
	<legend class="cabecalho">CADASTRO PEDIDO DO EVENTO</legend>	
<form name="form1" method="post" action="../classes/controlePublicarPedido.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="52%" border="0" cellspacing="1" cellpadding="1">
 <tr>
    <td width="25%" align="right" class="letra">Evento:</td>
    <td width="75%"><input name="id" id="id" type="text" size="3" readonly="readonly" value="<? echo $id;?>"/></td>
 </tr>
 <tr>
    <td align="right" class="letra">Enviar Arquivo:</td>
    <td>		
	<input name="arquivo" size="52" type="file"/>
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
	<!-- fim do adm -->
	</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
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
