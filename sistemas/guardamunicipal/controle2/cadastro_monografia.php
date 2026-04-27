<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	$id = (int)$_GET['id'];
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
		$query = "SELECT * FROM monografia where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$t_trabalho = $linha["t_trabalho"];
			$ano = $linha["ano"];
			$titulo = $linha["titulo"];
			$t_especializacao = $linha["t_especializacao"];
			$tamanho = strlen($nome);

			// Path onde os arquivos s�o cadastradas
			$path = $objT->getPath(2).$id."/";
			$nomearquivo = $objT->retornaArquivo($path);
			$tamanhonomearquivo = strlen($nomearquivo);
		}		
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<head>
<!-- ini inc head -->
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
			
			include("menu.php");
		}
	?>
	</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Cadastro Monografia</legend>

	<form name="form1" method="post" action="../classes/controleMonografia.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="74%" border="0" cellspacing="1" cellpadding="1">
	
	 <tr>
		<td width="26%" align="right" class="letra">Nome do Autor<font color="#FF3300"><b>*</b></font>:</td>
		<td width="74%"><input name="xnome" id="xnome" type="text" onKeyUp="counterUpdate('xnome','countNome','195');" size="52" value="<?echo $nome;?>"/></td>
	 </tr>
	
	  <tr>
		<td width="26%">&nbsp;</td>
		<td align="left" class="letra">
		Voc&ecirc; digitou <B><span id="countNome"><?php echo $tamanho;?></span></B> caracteres � Limite: <B>195</B> caracteres</p>
		</td>
	  </tr>
	  <tr>
		<td width="26%" align="right" class="letra">T�tulo do Trabalho<font color="#FF3300"><b>*</b></font>:</td>
		<td width="74%"><input name="xtitulo_trabalho" id="xtitulo_trabalho" type="text" size="52" value="<?echo $t_trabalho;?>"/></td>
	 </tr>
	  <tr>
		<td width="26%" align="right" class="letra">Ano<font color="#FF3300"><b>*</b></font>:</td>
		<td width="74%"><input name="xano" id="xano" type="text" size="52" value="<?echo $ano;?>"/></td>
	 </tr>
	 <tr>
		<td width="26%" align="right" class="letra">T�tulo<font color="#FF3300"><b>*</b></font>:</td>
		<td width="74%"><select name="ytitulo">
		 <option value="0">Selecione o T�tulo...</option>
		  <option value="Bacharel">Bacharel</option>
		  <option value="Licenciatura">Licenciatura</option>
		  <option value="BacharelLicenciatura">Bacharel / Licenciatura</option>
		  <option value="PosGraduacao">P&oacute;s-Graduacao</option>
		  <option value="Mestrado">Mestrado</option>
		  <option value="Doutorado">Doutorado</option>
		</select></td>
	 </tr>
	<tr>
		<td width="26%" align="right" class="letra">Curso<font color="#FF3300"><b>*</b></font>:</td>
		<td width="74%"><input name="xtitulo_especializacao" id="xtitulo_especializacao" type="text" size="52" value="<?echo $t_especializacao;?>"/></td>
	 </tr>
	 <tr>
		<td align="right" class="letra">Enviar Arquivo<font color="#FF3300"><b>*</b></font>:</td>
		<td>		
		<input name="arquivo" size="52" type="file" />
		</td>
	  </tr>
	
	 <INPUT TYPE="hidden" NAME="id" id="idhidden" value="<?echo $id;?>"> 
	
	 <tr>
			<td align="right" class="letra"><IMG SRC="images/dicas.gif" ALT="Dicas" width="11" height="17" BORDER="0"></td>
			<td class="letra"><strong><font color="#FF3300" size="1">Campos Obrigat&oacute;rios!</font></strong></td>
		</tr>
	
	  <tr height="2">
		<td align="left" class="letra" colspan="2">&nbsp;</td>
	  </tr>
	
	  <tr>	
		<td align="right">
		<td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
		</td>
	  </tr>
	
	</table>
	</form>
	</fieldset>
	<!--fim adm-->
	</td>
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
