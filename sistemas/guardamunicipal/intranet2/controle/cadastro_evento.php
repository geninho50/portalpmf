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
	  $dia = (int)$_GET['dia'];
	  $mes = (int)$_GET['mes'];
	  $ano = (int)$_GET['ano'];
   }

	$xdataini=$ano.'-'.$mes.'-'.$dia;
	
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	require ("../classes/trataString.php");
	$objS = new trataString;
	require ("../classes/trataArquivo.php");
	$objT = new trataArquivo;
	$tamanho = 0;
	$nome = "";
	$descricao = "";
	$politica = "";
	$eventos = "";	
	if( $id > 0 )
	{		
		$query = "SELECT * FROM evento where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$numdocumento = $linha["numdocumento"];
			$nome = $linha["nome"];
			$dataini = $linha["data"];
			$hora = $linha["hora"];
			$solicitante = $linha["solicitante"];
			$telefone = $linha["telefone"];
			$rua = $linha["rua"];
			$bairro = $linha["bairro"];
			$descricao = $linha["descricao"];
			$tamanho = strlen($nome);
			
			// Path
			$path = $objT->getPath(16).$id."/";
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
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="400%" colspan="2">
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CADASTRO DE EVENTOS</legend>
	<form name="form1" method="post" action="../classes/controleEvento.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		
		 <tr>
		   <td width="142" height="24" align="right" class="letra">Tipo:</td>
		   <td>
           <select name="tipo" class="negrito">
            <option value="1" selected="selected">EVENTO</option>
            <option value="2">FERIADO</option>
           </select>
           </td>
		   </tr>
		 <tr>
			<td height="24" align="right" class="letra">Nome:</td>
			<td width="1149"><input name="xnome" id="xnome" class="negrito" type="text" size="52" onkeyup="converteUpper(this);" value="<? echo $nome;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
		 </tr>
		  <tr>
			<td height="24" align="right" class="letra">N&ordm; Documento:</td>
			<td align="left" class="letra"><input name="numdocumento" id="numdocumento" class="negrito" onkeyup="converteUpper(this);"  type="text" size="30" value="<? echo $numdocumento;?>"/></td>
		  </tr>
		  <tr>
	   <td height="24" align="right" class="letra">Data:</td>
	   <td>
	   <input type="text" value="<? echo $dataini;?>" readonly name="xdataini" class="negrito" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" />
		  <a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' tille='SELECIONE A DATA'></a>   
	   </td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Hora:</td>
			<td width="1149"><input name="hora" id="hora" type="text" class="negrito" size="12" value="<? echo $hora;?>" maxlength="8"  onkeypress="valida_horas(this)"/></td>
		 </tr>
		  <tr>
			<td height="24" align="right" class="letra">Solicitante:</td>
			<td align="left" class="letra"><input name="xsolicitante" id="xsolicitante" class="negrito" type="text" size="30" value="<? echo $solicitante;?>" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/> 
			  &raquo; Telefone:
			  <input name="telefone" id="telefone" type="text" size="30" maxlength="9" class="negrito" value="<? echo $telefone;?>" onkeypress="formatar(this, '####-####')"/></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Rua:</td>
			<td align="left" class="letra"><input name="xrua" id="xrua" type="text" size="52" class="negrito" value="<? echo $rua;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
			  &raquo; Bairro:<font color="#FF0033">
			  <input name="xbairro" id="xbairro" type="text" size="30" class="negrito" value="<? echo $bairro;?>" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
			  </font></td>
		  </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Descrição:</td>
			<td align="left" class="letra"><textarea name="descricao" class="negrito" cols="80" rows="8" id="descricao"><? echo $descricao; ?></textarea></td>
		  </tr>
	
		 <INPUT TYPE="hidden" NAME="idEvento" value="<? echo $id;?>">	
			
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
