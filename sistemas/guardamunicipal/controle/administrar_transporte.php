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
	
	$data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
	/*if( $id > 0 )
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
			$solicitante = $linha["solicitante"];
			$telefone = $linha["telefone"];
			$rua = $linha["rua"];
			$bairro = $linha["bairro"];
			$descricao = $linha["descricao"];
			$tamanho = strlen($nome);
			
	}		
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
		<fieldset>
		<legend class="negrito">Lista de Transporte </legend>
		<table width="100%" bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		  <tr>
			<td width="9%" align="center" class="branco"><b>N Protocolo</b></td>
			<td width="9%" align="center" class="branco"><b>Data</b></td>
			<td width="25%" align="left" class="branco"><b>Solitante</b></td>
			<td width="52%" align="left" class="branco">&nbsp;</td>
			<td width="5%">&nbsp;</td>
		  </tr>
	 	</table>
		<div class="layer1">
		<table width="100%"  border="0" cellspacing="1" cellpadding="1">
		  <? 
		  	$chavet = true;
			$query = "SELECT id,nome,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,telefone,rua,numero,bairro,referencia,justificativa,hora FROM transporte where status=0";
			$resultado = $obj->executaQuery($query);
			while( $dados = mysql_fetch_array($resultado) )
			{
				$id = $dados["id"];
				$hora = $dados["hora"];
				$nome = $dados["nome"];
				$dataini = $dados["data"];
				$telefone = $dados["telefone"];
				$rua = $dados["rua"];
				$bairro = $dados["bairro"];
				$numero = $dados["numero"];
				$referencia = $dados["referencia"];
				$justificativa = $dados["justificativa"];
				$dia = $dados['dia'];
				$mes = $dados['mes'];
				$ano = $dados['ano'];
			
		  ?>
		  
		  <tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
			<td width="9%" align="center"><? echo $id; ?></td>
			<td width="9%" align="center"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
			<td width="25%" align="left"><? echo $nome; ?></td>
			<td width="52%" align="left"><p class="heading">Mais Detalhes</p>
				<div class="content">
					<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
					  <tr>
						<td width="351" align="right" bgcolor="#006699" class="branco">Data:</td>
						<td width="881" align="left"  class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Solicitante: </td>
						<td align="left"  class="negrito"><?php echo $nome; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Telefone: </td>
						<td align="left"  class="negrito"><?php echo $telefone; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Rua:</td>
						<td align="left" class="negrito"><?php echo $rua.', '.$numero; ?></td>
					  </tr>
					  <tr>
						<td align="right" valign="top" bgcolor="#006699" class="branco">Bairro:</td>
						<td align="left"  class="negrito"><?php echo $bairro; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Referencia:</td>
						<td align="left" class="negrito"><?php echo $referencia; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Justificativa:</td>
						<td align="left" class="negrito"><?php echo $justificativa; ?></td>
					  </tr>
					</table>
			  </div>		  
			
			</td>
			<td width="5%" align="center">
			<a href="cadastro_positivo_transporte.php?idTransporte=<?PHP echo $id; ?>&status=1" border="0"><IMG SRC="images/true.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
			<a href="cadastro_negado_transporte.php?idTransporte=<?PHP echo $id; ?>&status=2" border="0"><IMG SRC="images/false.gif" ALT="Mais detalhes" width="14" height="13" BORDER="0"></A>
			</td>
		  </tr>
		  <?
		   }
		  ?>
		</table>
		</div>
		</fieldset>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="negrito">Administrar Transporte </legend>
    	<? include("calTransporte.php");?>
	  </fieldset>
	<!-- fim do adm -->
	
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<fieldset>
	<legend class="negrito">Lista de Transportes Negados</legend>
    	<table width="100%" bgcolor="#0086a8"  width="100%" bordercolor="#FFFFFF" border="1" cellspacing="1" cellpadding="1">
		  <tr>
			<td width="9%" align="center" class="branco"><b>N Protocolo</b></td>
			<td width="9%" align="center" class="branco"><b>Data</b></td>
			<td width="25%" align="left" class="branco"><b>Solitante</b></td>
			<td width="53%">&nbsp;</td>
			<td width="4%" align="left">&nbsp;</td>
		  </tr>
	 	</table>
			<div class="layer1">
		<table width="100%"  border="0" cellspacing="1" cellpadding="1">
		  <? 
		  	$chavet = true;
			$query = "SELECT id,nome,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,telefone,rua,numero,bairro,referencia,justificativa,hora,motivonegado FROM transporte where status=2 and data>='$data_atual'";
			$resultado = $obj->executaQuery($query);
			while( $dados = mysql_fetch_array($resultado) )
			{
				$id = $dados["id"];
				$hora = $dados["hora"];
				$nome = $dados["nome"];
				$dataini = $dados["data"];
				$telefone = $dados["telefone"];
				$rua = $dados["rua"];
				$bairro = $dados["bairro"];
				$numero = $dados["numero"];
				$referencia = $dados["referencia"];
				$justificativa = $dados["justificativa"];
				$naoatentido = $dados['motivonegado'];
				$dia = $dados['dia'];
				$mes = $dados['mes'];
				$ano = $dados['ano'];
			
		  ?>
		  
		  <tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>">
			<td width="9%" align="center"><? echo $id; ?></td>
			<td width="9%" align="center"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
			<td width="25%" align="left"><? echo $nome; ?></td>
			<td width="53%" align="left"><p class="heading">Mais Detalhes</p>
				<div class="content">
					<table width="100%"  border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
					  <tr>
						<td width="351" align="right" bgcolor="#006699" class="branco">Data:</td>
						<td width="881" align="left"  class="negrito"><?php echo $dia." / ".$mes." / ".$ano; ?></td>
					  </tr>
					  <tr>
					    <td align="right" bgcolor="#006699" class="branco">Hora:</td>
					    <td align="left"  class="negrito"><?php echo $hora; ?></td>
				      </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Solicitante: </td>
						<td align="left"  class="negrito"><?php echo $nome; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Telefone: </td>
						<td align="left"  class="negrito"><?php echo $telefone; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Rua:</td>
						<td align="left" class="negrito"><?php echo $rua.', '.$numero; ?></td>
					  </tr>
					  <tr>
						<td align="right" valign="top" bgcolor="#006699" class="branco">Bairro:</td>
						<td align="left"  class="negrito"><?php echo $bairro; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Referencia:</td>
						<td align="left" class="negrito"><?php echo $referencia; ?></td>
					  </tr>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Justificativa:</td>
						<td align="left" class="negrito"><?php echo $justificativa; ?></td>
					  </tr>
					   <tr>
						<td align="right" bgcolor="#006699" class="branco">Negado por:</td>
						<td align="left" class="negrito"><?php echo $naoatentido; ?></td>
					  </tr>
					</table>
			  </div>		  
			
			</td>

		  <td width="4%" align="center">
		  <a href="confirmar_transporte.php?idTransporte=<?PHP echo $id; ?>&status=1" border="0"><img src="images/reincidente.gif" width="16" height="16" border="0" /></A>
		  </td>
		  </tr>
		  <?
		   }
		  ?>
		</table>
		</div>
	</fieldset>
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
