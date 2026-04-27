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
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">DADOS ANTERIORES AO EVENTO</legend>
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		
		  <tr>
		    <td width="180" height="24" align="right" class="letra">Evento:</td>
		    <td align="left"  class="negrito"><? echo $nome;?></td>
	    </tr>
		  <tr>
			<td height="24" align="right" class="letra">N&ordm; Documento:</td>
			<td align="left"  class="negrito"><? echo $numdocumento;?></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Data:</td>
			<td align="left" class="negrito"><? echo $dataini;?></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Hora:</td>
			<td width="1094" class="negrito"><? echo $hora;?></td>
		 </tr>
		  <tr>
			<td height="24" align="right" class="letra">Solicitante:</td>
			<td align="left" class="negrito"><? echo $solicitante;?></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Telefone:</td>
			<td align="left" class="negrito"><? echo $telefone;?></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Rua:</td>
			<td align="left" class="negrito"><? echo $rua;?></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Bairro:</td>
			<td align="left" class="negrito"><? echo $bairro;?></td>
		  </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Descrição:</td>
			<td align="left" class="negrito"><? echo $descricao; ?></td>
		  </tr>
		  <tr>	
			<td align="right"></td>
		  </tr>
		</table>
	</fieldset>
	<fieldset>
	<legend class="cabecalho">RELATÓRIO FINAL DO EVENTO</legend>
	<form name="form1" method="post" action="../classes/controleEvento.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
		 <tr>
		   <td height="24" align="right" class="letra">&nbsp;</td>
		   <td><input name="idEvento" id="idEvento" class="negrito" type="text" size="5" value="<? echo $id;?>"/></td>
	      </tr>
		 <tr>
			<td width="163" height="24" align="right" class="letra">Hora Inicial:</td>
			<td width="850"><input name="xhorainicial" id="xhorainicial" class="negrito" type="text" size="12" maxlength="8" onkeypress="valida_horas(this)" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		 </tr>
		  <tr>
			<td height="24" align="right" class="letra">Hora Final:</td>
			<td width="850"><input name="xhorafinal" id="xhorafinal" class="negrito" type="text" size="12" maxlength="8" onkeypress="valida_horas(this)" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		 </tr>
		  <tr>
			<td height="24" align="right" class="letra">Chefe de Operações:</td>
			<td align="left" class="letra">
			<input type="text" id="xchefe" name="xchefe" class="negrito" size="52" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">N&ordm; de Guardas:</td>
			<td width="850"><input name="xqtdguardas" id="xqtdguardas" class="negrito" type="text" size="12" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		 </tr>
		  <tr>
			<td height="24" align="right" class="letra">Tipo de Escala:</td>
			<td align="left" class="letra"><select name="ytipoescala" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" >
			 <option value="0">Selecionar...</option>
			  <option value="ORDINARIA">ORDINARIA</option>
			  <option value="EXTRAORDINARIA">EXTRAORDINARIA</option>
			</select></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Hora de 100:</td>
			<td align="left" class="letra"><input name="xhora100" id="xhora100" type="text" size="5" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Hora de 200:</td>
			<td align="left" class="letra"><input name="xhora200" id="xhora200" type="text" size="5" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" /></td>
		  </tr>
		 <tr>
			<td align="right" valign="top" class="letra">Equipamento/Material usado:</td>
			<td align="left" class="letra"><textarea name="material" cols="80" rows="8" id="material" class="negrito"></textarea></td>
		  </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Descrição:</td>
			<td align="left" class="letra"><textarea name="xdescricaofinal" cols="80" rows="8" id="xdescricaofinal" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')" ></textarea></td>
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
