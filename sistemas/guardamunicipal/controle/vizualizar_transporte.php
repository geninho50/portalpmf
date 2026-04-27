<?php
// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   include("incValidaSessao.php");
   $idsession = $_SESSION['idSESSION'];
   $id =  (int)$_POST['idTransporte'];
   if( $id == 0 )
   {
      $id = (int)$_GET['idTransporte'];
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
		$query = "SELECT id,nome,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,telefone,rua,numero,bairro,referencia,justificativa,hora,motivonegado,informacao_adicional,estado_clinico,destino,cancelamento,motivo_aceito FROM transporte where id=$id";
		$resultado = $obj->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		$id = 0;
		$nomeCategoria = "";		
		if( $linha )
		{
				$id = $linha["id"];
				$hora = $linha["hora"];
				$nome = $linha["nome"];
				$dataini = $linha["data"];
				$telefone = $linha["telefone"];
				$rua = $linha["rua"];
				$bairro = $linha["bairro"];
				$numero = $linha["numero"];
				$referencia = $linha["referencia"];
				$justificativa = $linha["justificativa"];
				$naoatentido = $linha['motivonegado'];
				$informacao = $linha['informacao_adicional'];
				$estado_clinico = $linha['estado_clinico'];
				$cancelamento = $linha['cancelamento'];
				$destino = $linha['destino'];
				$motivo_aceito = $linha['motivo_aceito'];
				$dia = $linha['dia'];
				$mes = $linha['mes'];
				$ano = $linha['ano'];
			$tamanho = strlen($nome);
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
	<legend class="negrito">Dados da Solicitacao do Transporte</legend>
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
					  <? if($justificativa!=''){?>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Justificativa:</td>
						<td align="left" class="negrito"><?php echo $justificativa; ?></td>
					  </tr>
					  <? 
					  }
					  if($naoatentido!=''){
					  ?>
					   <tr>
						<td align="right" bgcolor="#006699" class="branco">Negado por:</td>
						<td align="left" class="negrito"><?php echo $naoatentido; ?></td>
					  </tr>
					  <? 
					  }
					  if($informacao!=''){
					  ?>
					  <tr>
						<td align="right" bgcolor="#006699" class="branco">Informacoes Adicionais:</td>
						<td align="left" class="negrito"><?php echo $informacao; ?></td>
					  </tr>
					   <? 
					  }
					  if($estado_clinico!=''){
					  ?>
					   <tr>
						<td align="right" bgcolor="#006699" class="branco">Estado Clinico:</td>
						<td align="left" class="negrito"><?php echo $estado_clinico; ?></td>
					  </tr>
					   <? 
					  }
					  if($destino!=''){
					  ?>
					   <tr>
						<td align="right" bgcolor="#006699" class="branco">Destino do Transporte:</td>
						<td align="left" class="negrito"><?php echo $destino; ?></td>
					  </tr>
					  <? 
					  }
					  if($motivo_aceito!=''){
					  ?>
					   <tr>
						<td align="right" bgcolor="#006699" class="branco">Justificativa para Remarcar:</td>
						<td align="left" class="negrito"><?php echo $motivo_aceito; ?></td>
					  </tr>
					  <? 
					  }
					  if($cancelamento!=''){
					  ?>
					   <tr>
						<td align="right" bgcolor="#006699" class="branco">Cancelamento:</td>
						<td align="left" class="negrito"><?php echo $cancelamento; ?></td>
					  </tr>
					  <?
					  }
					  ?>
					</table>
	<!-- fim do adm -->

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
