<?php
			// Este primeiro header, corrigi o problema de acentuação dos caracteres.
header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	// Realiza a consulta ao banco;
	$ygmsolicitante = "";
	$ygmsolicitante = mysql_escape_string($_POST['ygmsolicitante']);
	$solicitado = "";
	$solicitado = mysql_escape_string($_POST['solicitado']);
	$data = "";
	$data = $_POST['dataini'];
	
	$ygmsolicitante = trim($ygmsolicitante);
	$tamanho = strlen($ygmsolicitante);
	$tamanhoS = strlen($solicitado);
	$tamanhoD = strlen($data);

	$nvaloresencontrados = 0;
	
	if($tamanho > 0 && $tamanhoS > 0){
		$query = "SELECT * FROM trocaservico where UPPER(gmsolicitante) like UPPER('%$ygmsolicitante%') and UPPER(gmsolicitado) like UPPER('%$solicitado%') order by datatroca desc";
	}else{
		if($tamanho > 0 && $tamanhoD > 0){
			$query = "SELECT * FROM trocaservico where UPPER(gmsolicitante) like UPPER('%$ygmsolicitante%') and datatroca='".$data."' order by datatroca desc";
		}else{
			if($tamanho > 0 && $tamanhoS > 0 && $tamanhoD > 0){
				$query = "SELECT * FROM trocaservico where UPPER(gmsolicitante) like UPPER('%$ygmsolicitante%') and UPPER(solicitado) like UPPER('%$solicitado%') and datatroca='$data' order by datatroca desc";
			}else{
				$query = "SELECT * FROM trocaservico where UPPER(gmsolicitante) like UPPER('%$ygmsolicitante%') order by datatroca desc";
			}
		}
	}
	//echo ''.$query;
	if( $tamanho > 0 )
	{
		$nvaloresencontrados = $obj->numregistros($query);
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
	<legend class="negrito">Consultar Troca de Servico</legend>
<form name="form1" method="post" action="busca_troca_servico.php" onSubmit="return validaFormAll(this,'Pesquisar','Pesquisar')">

<INPUT TYPE="hidden" name="cadastro" value="true">

<table width="67%" border="0" cellspacing="1" cellpadding="1">

  <tr>
    <td width="22%" align="right" class="letra">Solicitante:</td>
    <td width="17%">
	<select name="ygmsolicitante">
			  <option value="0">Selecionar...</option>
			  <?php 
				$queryS = "SELECT * FROM guarda_gmf order by login";
				$resultadoS = $obj->executaQuery($queryS);
				while($linhaS = mysql_fetch_array($resultadoS))
				{
					$login = $linhaS['login'];
			  ?>
						 <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
			  <?php 
				} 
	  		  ?>
		  </select>
	</td>
    <td width="13%" align="right"><span class="letra">Troca com: </span></td>
    <td width="17%" align="left"><select name="solicitado">
      <option value="">Selecionar...</option>
      <?php 
				$queryE = "SELECT * FROM guarda_gmf order by login";
				$resultadoE = $obj->executaQuery($queryE);
				while($linhaE = mysql_fetch_array($resultadoE))
				{
					$login = $linhaE['login'];
			  ?>
      <option value="<?php echo $login; ?>"><?php echo $login; ?></option>
      <?php 
				} 
	  		  ?>
    </select></td>
    <td width="9%" align="right">Data: </td>
    <td width="22%" align="left">
		<input value="<? echo $dataini;?>" name="dataini" class="stylo1" size="12" />
			<a onClick="displayCalendar(document.forms[0].dataini,'yyyy-mm-dd',this)"> <img  src="images/calendario.gif" width='16' height='16' border='0' alt='Selecione a data'></a>
	</td>
  </tr>

  <tr>
    <td align="right" class="letra">&nbsp;</td>
    <td>&nbsp;</td>
	<td width="13%">
    <td width="17%">    
    <td width="9%">    
    <td width="22%">    
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="botao" id="Submit3" value="Pesquisar" onClick="onClickButton(null,'Aguarde...','','Pesquisar')" /></td>
	<td width="13%">    <td width="17%">    
    <td width="9%">    
    <td width="22%">  </tr>

</table>

</form>
</fieldset>

<?php
	if( $nvaloresencontrados > 0 )
	{
?>
<fieldset>
	<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>

<table  width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8">
	<tr>
		<td width="11%" align="left" class="branco"><B>Nome</B></td>				
		<td width="12%" align="left" class="branco"><B>Trocou com...</B></td>		
		<td width="13%" align="left" class="branco"><B>Data da troca:</B></td>
		<td width="17%" align="left" class="branco"><B>Forma de Reposicao:</B></td>
		<td width="47%" align="left" class="branco"><B>Resposta:</B></td>
	</tr> 
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php
	$chavet = true;
	$resultado = $obj->executaQuery($query);
	while ( $linha = mysql_fetch_array($resultado) )
	{		
		$solicitante = $linha['gmsolicitante'];
		$solicitado = $linha['gmsolicitado'];
		$formareposicao = $linha['formareposicao'];
		$data = $linha['datatroca'];
		$motivostatus = $linha['motivostatus'];
?>
	<tr bgColor="<?PHP if($chavet)
						{
							echo '#cccccc';
						}
						else{ 
							echo '#ffffff';
						} 
						$chavet=!$chavet;
					?>" >
		<td width="11%" align="left" class="negrito"><? echo $solicitante; ?></td>		
	 	<td width="12%" align="left" class="negrito"><? echo $solicitado; ?></td>
	   	<td width="13%" align="left" class="negrito"><? echo $data; ?></td>
		<td width="17%" align="left" class="negrito"><? echo $formareposicao; ?></td>
		<td width="47%" align="left" class="negrito"><? echo $motivostatus; ?></td>
	</tr>

<?php
	}
?>
	
</table>

</fieldset>
	
	</td>
	</tr> 
	
</table>


<?php
	}

	if( $nvaloresencontrados == 0 && $tamanho > 0 )
	{
		
?>

<fieldset>
	<legend class="negrito">Resultado(s) <B><?echo $nvaloresencontrados;?></B> para <?echo $xBusca;?></legend>
<table width="100%" border="0" cellspacing="1" cellpadding="1">
	<tr>
		<td width="100%" colspan="3" align="center" class="negrito">Nenhuma ocorr&ecirc;ncia para <B><?echo $xBusca;?></B></td>
	</tr>	
</table>
</fieldset>

<?php	
	}
?>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>

<?php
	// Fechando as vari�veis de conex�o
	$obj->closeVar($conexao);
	$obj->closeVar($xBusca);
	$obj->closeVar($tamanho);
	$obj->closeVar($nvaloresencontrados);
	$obj->closeVar($query);
	$obj->closeVar($resultado);
	$obj->closeVar($linha);
	$obj->closeQuery();
	$obj->closeConexaoGeral();
?>