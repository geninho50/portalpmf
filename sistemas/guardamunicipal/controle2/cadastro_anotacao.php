<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	$idAnotacao = (int)$_GET['idAnotacao'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	$objS = new trataString;
	if( $idAnotacao > 0 )
	{		
		$query = "SELECT id,texto, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM anotacao where id=$idAnotacao";
		$resultado = mysql_query($query) or die ("N�o foi poss�vel realizar a consulta ao banco de dados");	
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$texto = "";
		if( $linha )
		{
			$id = $linha["id"];
			$texto = $linha["texto"];
			$dia = $linha['dia'];
			$mes = $linha['mes'];
			$ano = $linha['ano'];
		}
	}
	$data_atual = date("Y-m-d");
	$mes_atual = substr($data_atual,5,2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<script type="text/javascript" src="js/jquery.min.js"></script> 
		<script type="text/javascript">
		jQuery(document).ready(function() {
		  jQuery(".content").hide();
		  //toggle the componenet with class msg_body
		  jQuery(".heading").click(function()
		  {
			jQuery(this).next(".content").slideToggle(500);
		  });
		});
</script>
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
	<legend class="negrito">Cadastro Anota��es</legend>
	
	<form name="form1" method="post" action="../classes/controleAnotacao.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
	
	<table width="80%" border="0" cellspacing="1" cellpadding="1">
	
	 <tr>
		<td align="left" class="letra">&nbsp;</td>
	    <td align="left" class="letra">Texto Completo:<FONT COLOR="#FF0033">*</FONT> </td>
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
	</script></td>
	</tr>
	
	 <INPUT TYPE="hidden" NAME="idAnotacao" value="<?echo $idAnotacao;?>">	
		
	  <tr>	
		<td width="21%" align="right">
		<td width="79%"><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
		</td>
	  </tr>
	</table>
	
	</form>
	</fieldset>
	
	<br>
	<table bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td width="14%" align="left" class="branco"><B>Data</B></td>
			<td width="80%" align="center" class="branco"><B>&nbsp;</B></td>
			<td width="6%" align="left" class="branco"><B>Atualizar</B></td>	
		</tr> 
	</table>
	
		<?
			$queryR = "SELECT id,texto, DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano FROM anotacao";
			$resultadoR = mysql_query($queryR) or die ("N�o foi poss�vel realizar a consulta ao banco de dados");	
			while($linhaR = mysql_fetch_array($resultadoR)){
				$id = $linhaR["id"];
				$texto = $linhaR["texto"];
				$dia = $linhaR['dia'];
				$mes = $linhaR['mes'];
				$ano = $linhaR['ano'];
		?>
	<div class="layer1">
	<table width="100%" border="0" cellpadding="1" cellspacing="1">
		<tr>
			<td width="14%" align="left" class="letra"><font class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></font></td>
			<td width="80%" align="left" class="negrito"><p class="heading">Mais Detalhes</p>
			
			<div class="content">
				<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
				  <tr>
					<td width="70" align="right" bgcolor="#0086a8" class="branco">Texto:</td>
					<td width="1162" align="left"  class="letra"><?php echo $texto; ?></td>
				  </tr>
				</table>
			</div>			</td>
			<td width="6%" align="center" class="negrito" colspan="8"><a href="cadastro_anotacao.php?idAnotacao=<? echo $id; ?>"><img src="images/atualizar.gif" width="20" height="20" border="0" /></a></td>
		</tr>
	</table>
	</div>
		<?
			}
		?>
	<!--fim adm-->
	</td>
  </tr>
</table>


</body>
</html>
