<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
		$resultado = $obj->executaQuery($sql);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$login = $linha["login"];
		}
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $idOcorrencia = 0;
   $idOcorrencia = (int)$_POST['idOcorrencia'];
   if( $idOcorrencia == 0 )
   {
	 $idOcorrencia = (int)$_GET['idOcorrencia'];
   }

    $sqlA = "SELECT * FROM ocorrencia where id=$idOcorrencia";
    $resultadoA = $obj->executaQuery($sqlA);
	if( $linhaA = mysql_fetch_array($resultadoA))
	{
		$id = $linhaA["id"];
		$telefone = $linhaA["telefone"];
		$comunicante = $linhaA["comunicante"];
		$rua = $linhaA["rua"];
		$numero = $linhaA["numero"];
		$bairro = $linhaA["bairro"];
		$descricao_ocorrrencia = $linhaA["descricao_ocorrencia"];
   }  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("head/incHeadCentral.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRAR GUARNIÇÃO</legend>
    <form name="form" action="../classes/controleGuarnicao.php" method="post" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
    <table width="100%"  border="0" cellpadding="1" cellspacing="1">
	<tr>
      <td width="12%" align="right">VTR:</td>
      <td width="88%">
        <select name="yvtr" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
          <option value="0">Selecionar...</option>
          <option value="A PE">A PE</option>
          <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
          <?php 
				$queryU = "SELECT * FROM vtr where status=0 order by vtr";
				$resultadoU = $obj->executaQuery($queryU);
				while($linhaU = mysql_fetch_array($resultadoU))
				{
					$vtr = $linhaU['vtr'];
			  ?>
          <option value="<?php echo $vtr; ?>"><?php echo $vtr; ?></option>
          <?php 
				} 
	  		  ?>
        </select>
</td>
    </tr>
    <tr>
      <td align="right" valign="top">Motorista:</td>
      <td>

		<input type="text" class="negrito" name="xGM1_1" id="xGM1_1" size="20" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/><br><br>
		<input type="text" class="negrito" name="GM1_2" id="GM1_2" size="20"/>
		<input type="text" class="negrito" name="GM1_3" id="GM1_3" size="20"/>
		<input type="text" class="negrito" name="GM1_4" id="GM1_4" size="20"/>
		<input type="text" class="negrito" name="GM1_5" id="GM1_5" size="20"/>
		</td>
    </tr>
    <tr>
      <td align="right">Setor:</td>
      <td><select name="setor" class="negrito">
        <option value="0" selected="selected">SETOR 0</option>
        <option value="1" >SETOR 1</option>
        <option value="2">SETOR 2</option>
        <option value="3">SETOR 3</option>
        <option value="4">SETOR 4</option>
        <option value="5">SETOR 5</option>
        <option value="6">SETOR 6</option>
        <option value="7">SETOR 7</option>
        <option value="8">SETOR 8</option>
        <option value="9">SETOR 9</option>
        <option value="10">SETOR 10</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">Tipo:</td>
      <td>
	  	<select name="ytipo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
          <option value="ATENDIMENTO 153" selected>ATENDIMENTO 153</option>
		  <option value="ZONA AZUL" >ZONA AZUL</option>
		  <option value="PRO CIDADAO" >PRO CIDADAO</option>
		  <option value="RONDA ESCOLAR NORTE" >RONDA ESCOLAR NORTE</option>
		  <option value="RONDA ESCOLAR SUL" >RONDA ESCOLAR SUL</option>
          <option value="RONDA ESCOLAR CENTRO" >RONDA ESCOLAR CENTRO</option>
		  <option value="APOIO" >APOIO</option>
		  <option value="APOIO SESP" >APOIO SESP</option>
		  <option value="HORA EXTRA" >HORA EXTRA</option>
		  <option value="ADMINISTRATIVO" >ADMINISTRATIVO</option>
        </select>
</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="Confirmar" type="submit" class="letra" id="Confirmar" onclick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" /></td>
    </tr>
  </table>
</form>
</fieldset>

	<!--fim adm-->
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
