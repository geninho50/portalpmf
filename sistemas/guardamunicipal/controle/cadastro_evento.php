<?php
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $id =  (int)$_POST['idevento'];
   if( $id == 0 )
   {
      $id = (int)$_GET['idevento'];
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
			$nome = $linha["nome"];
			$dataini = $linha["data"];
			$responsavel = $linha["responsavel"];
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
		<?php include("incHead.php");?>
<!-- fim inc head -->
</head>
<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr align="center" bgcolor="#666666">
    <th bgcolor="#666666" scope="col">
	<?php 
		$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$result = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($result);
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
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Cadastro Eventos</legend>
	<form name="form1" method="post" action="../classes/controleEvento.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

		<table width="100%" border="0" cellspacing="1" cellpadding="1">
		
		 <tr>
			<td height="24" align="right" class="letra">Nome:<FONT COLOR="#FF0033">*</FONT></td>
			<td width="1064"><input name="xnome" id="xnome" type="text" onKeyUp="counterUpdate('xnome','countNome','300');" size="52" value="<? echo $nome;?>"/></td>
		 </tr>
		
		  
		  <tr>
			<td width="174">&nbsp;</td>
			<td align="left" class="letra">
			Voc&ecirc; digitou <B><span id="countNome"><?php echo $tamanho;?></span></B> caracteres Limite: <B>300</B> caracteres</p>
			</td>
		  </tr>
		  <tr>
			<td height="24" align="right">N&ordm; Documento:<FONT COLOR="#FF0033">*</FONT></td>
			<td align="left" class="letra"><input name="xnumdocumento" id="xnumdocumento" type="text" size="30" value="<? echo $numdocumento;?>"/></td>
		  </tr>
		  <tr>
			<td height="24" align="right">Data:<FONT COLOR="#FF0033">*</FONT></td>
			<td align="left" class="letra">
			<input type="text" value="<? echo $dataini;?>" readonly name="xdataini" class="stylo1" size="12"/>
			  <a onClick="displayCalendar(document.forms[0].xdataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
			</td>
		  </tr>
		  <tr>
			<td height="24" align="right" class="letra">Hora Inicial:<FONT COLOR="#FF0033">*</FONT></td>
			<td width="1064"><input name="xhorainicial" id="xhorainicial" type="text" size="12" value="<?echo $horainicial;?>" maxlength="8"  onkeypress="valida_horas(this)"/> 
			- - <span class="letra">Hora Final:<font color="#FF0033">*
			<input name="xhorafinal" id="xhorafinal" type="text" size="12" value="<?echo $horafinal;?>"  maxlength="8"  onkeypress="valida_horas(this)"/>
			</font></span></td>
		 </tr>
		  <tr>
			<td height="24" align="right"><span class="letra">Respons&aacute;vel:<font color="#FF0033">*</font></span></td>
			<td align="left" class="letra"><input name="xresponsavel" id="xresponsavel" type="text" size="30" value="<? echo $responsavel;?>"/> 
			  &raquo; Telefone:<font color="#FF0033">*</font><input name="xtelefone" id="xtelefone" type="text" size="30" value="<?echo $telefone;?>"/></td>
		  </tr>
		  <tr>
			<td height="24" align="right"><span class="letra">Rua:</td>
			<td align="left" class="letra"><input name="rua" id="rua" type="text" size="52" value="<? echo $rua;?>"/>
			  &raquo; Bairro:<font color="#FF0033">*
			  <input name="xbairro" id="xbairro" type="text" size="30" value="<? echo $bairro;?>"/>
			  </font></td>
		  </tr>
		  <tr>
			<td align="right" valign="top" class="letra">Descri��o:<font color="#FF0033">*</font></td>
			<td align="left" class="letra">
			<?php
		$descricao = $objS->filtra_caracteres($descricao," ");
		?>
		<script type="text/javascript">
		<!--
		// Automatically calculates the editor base path based on the _samples directory.
		// This is usefull only for these samples. A real application should use something like this:
		// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
		var sBasePath = 'fckeditor/';
		var oFCKeditor = new FCKeditor( 'xdescricao' ) ;
		oFCKeditor.BasePath	= sBasePath ;
		oFCKeditor.Width	= 700 ;
		oFCKeditor.Height	= 500 ;
		oFCKeditor.Value	= "<?php echo $descricao;?>";
		oFCKeditor.Create() ;
		//-->
		</script>
			</td>
		  </tr>
		
		
		 <SCRIPT LANGUAGE="JavaScript">
		 <!--
			function checarItem()
			{
				var ver = false;
				if( document.getElementById("politica").checked == true )
				{
					ver = true;
				}
				if( ver == true && document.getElementById("eventos").checked == true )
				{
					document.getElementById("eventos").checked = false;
				}
			}
		 //-->
		 </SCRIPT>
		
		 <INPUT TYPE="hidden" NAME="idEvento" value="<?echo $id;?>">	
			
		  <tr height="2">
			<td align="left" class="letra" colspan="2">&nbsp;</td>
		  </tr>
		
		  <tr>	
			<td align="right">
			<td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
			</td>
		  </tr>
		</table>
		
		</fieldset>
	<!-- fim do adm -->
	
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
