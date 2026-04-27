<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	$idRecado = (int)$_GET['idRecado'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql ;
	$conexao = $obj->conectarConf();
	$objS = new trataString;
	if( $idRecado > 0 )
	{		
		$query = "SELECT * FROM recado_agente where id=$idRecado";
		$resultado = mysql_query($query) or die ("N�o foi poss�vel realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nome = "";
		$texto = "";
		if( $linha )
		{
			$id = $linha["id"];
			$nome = $linha["nome"];
			$texto = $linha["texto"];
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
	<legend class="negrito">Cadastro de Recado ao Agente</legend>
	
	<form name="form1" method="post" action="../classes/controleRecadoAgente.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="80%" border="0" cellspacing="1" cellpadding="1">
	 <tr>
		<td width="25%" align="right" class="letra">Nome:<FONT COLOR="#FF0033">*</FONT></td>
		<td width="75%"><input name="xnome" id="xnome" type="text" onKeyUp="counterUpdate('xnome', 'countNome','150');" size="52" value="<?echo $nome;?>"/></td>
	 </tr>
	
	 <tr>
		<td align="left" class="letra">&nbsp;
		</td>
	    <td align="left" class="letra">Voc&ecirc; digitou <B><span id="countNome">0</span></B> caracteres &raquo; Limite: <B>150</B> caracteres -
</td>
	 </tr>
	
	  <tr>
		<td align="right" class="letra">&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	
	 <tr>
		<td align="left" class="letra">&nbsp;</td>
	    <td align="left" class="letra">Texto Completo:<FONT COLOR="#FF0033">*</FONT></td>
	 </tr>
	<tr>
		<td>&nbsp;</td>
	    <td>
			<?php
			$texto = $objS->filtra_caracteres($texto," ");
			?>
			<script type="text/javascript">
			<!--
			// Automatically calculates the editor base path based on the _samples directory.
			// This is usefull only for these samples. A real application should use something like this:
			// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
			var sBasePath = 'fckeditor/';
			var oFCKeditor = new FCKeditor( 'xtexto' ) ;
			oFCKeditor.BasePath	= sBasePath ;
			oFCKeditor.Width	= 700 ;
			oFCKeditor.Height	= 500 ;
			oFCKeditor.Value	= "<?php echo $texto;?>";
			oFCKeditor.Create() ;
			//-->
			</script>
		</td>
	</tr>
	 <INPUT TYPE="hidden" NAME="idRecado" value="<?echo $idRecado;?>">	
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
