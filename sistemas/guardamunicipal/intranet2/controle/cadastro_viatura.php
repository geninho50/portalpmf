<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	//$idFuncionario = $_GET['idFuncionario'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataArquivo.php");
	require ("../classes/trataString.php");
	$conexao = new DB_mysql ;
	$objT = new trataArquivo;
	$objS = new trataString;
	$idViatura = 0;
	$idViatura = $_GET['idViatura'];
	if( $idViatura == 0 )
	{
		$idViatura = $_POST['idViatura'];
	}
	
	if( $idViatura > 0 )
	{		
		$conexao->conectarConf();
		$query = "SELECT * FROM viatura where id=$idViatura";
		$resultado = $conexao->executaQuery($query);
		$linha = mysql_fetch_array($resultado);
		if( $linha )
		{
			$id = $linha["id"];
			$codmaterial = $linha["codviatura"];
			$grupo = $linha["grupo"];
			$classe = $linha["classe"];
			$modelo = $linhaG["modelo"];
			$descricaolonga = $linhaG["descricaolonga"];
			$tracao = $linhaG["tracao"];
			$placa = $linhaG["placa"];
			$chassi = $linhaG["chassi"];
			$anofabricacao = $linhaG["anofabricacao"];
			$anomodelo = $linhaG["anomodelo"];
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
    <td width="42%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO DE VIATURAS</legend>

    <form name="form" action="../classes/controleViatura.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
    <td align="right" class="letra">Classe da Viatura:</td>
    <td>
        <select name="yclasse" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
          <option value="0">Selecionar...</option>
          <option value="1">VTR</option>
          <option value="2">MOTO</option>
          <option value="3">BIKE</option>
        </select>
    </td>
    </tr>
 <tr>
    <td align="right" class="letra">Código de Viatura:</td>
    <td><input name="xcodviatura" type="text" class="negrito" maxlength="6" id="xcodviatura" value="<? echo $codigo;?>"  onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/><FONT COLOR="#FF0033" size="1"><B>EX: VTR+número. (VTR001, MT001, BK001)</B></FONT></td>
    </tr>
 <tr>
    <td width="14%" align="right" class="letra">Marca/Modelo:</td>
    <td width="86%"><input name="xmodelo" type="text" class="negrito" id="xmodelo" value="<? echo $modelo;?>"  onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr> 
  <tr>
    <td align="right" class="letra">Espécie:</td>
    <td>
    	<select name="yespecie" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
       <option value="0">Escolha a Especie</option>
        <?php
        // mysql_connect("187.45.196.207", "gmf", "mkstec8045");
        // mysql_select_db("gmf");
         
		 mysql_connect("192.168.1.20", "gmf", "6f532!@AT");
		 mysql_select_db("siga");
		 
         $sql = "SELECT * FROM especie ORDER BY especie asc";
         $qr = mysql_query($sql) or die(mysql_error());
         while($ln = mysql_fetch_assoc($qr)){
            echo '<option value="'.$ln['id'].'">'.$ln['especie'].'</option>';
         }
      ?>
        
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" class="letra">Tipo:</td>
    <td>
      <select name="tipo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
        <option value="0" disabled="disabled">Escolha uma Especie Primeiro</option>
        </select>
      </td>
  </tr>
  <tr>
    <td align="right" valign="top" class="letra">Descrição Longa:</td>
    <td>
      <textarea name="descricaolonga" id="descricaolonga" class="negrito" cols="50" rows="7" onkeyup="converteUpper(this);"><? echo $descricaolonga;?></textarea>
    </tr>
 <tr>
   <td align="right" class="letra">Placa: </td>
   <td><input name="xplaca" type="text" id="xplaca" class="negrito" onkeyup="converteUpper(this);" value="<? echo $placa;?>" size="10" maxlength="7" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
 </tr>
  <tr>
    <td align="right" class="letra">Ano Fabricação: </td>
    <td><input name="xanofabricacao" type="text" id="xanofabricacao" class="negrito" value="<? echo $anofabricacao;?>" size="5" maxlength="4" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>

 <!--dados do numero--> 
  <!--dados do sangue-->
  <tr>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Cadastrar" /></td>
    </tr>

</table>
</form>
</fieldset>

<!--fim adm-->	</td>
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