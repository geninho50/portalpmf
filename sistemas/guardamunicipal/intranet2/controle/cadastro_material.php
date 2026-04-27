<?php
	ini_set('default_charset','UTF-8');
	
	// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	//$idFuncionario = $_GET['idFuncionario'];
	require ("../classes/DB_mysql.php");
	$conexao = new DB_mysql ;
	$conexao->conectarConf();
	
	$idgrupo = 0;
	$idgrupo = $_GET['idgrupo'];
	if( $idgrupo == 0 )
	{
		$idgrupo = $_POST['idgrupo'];
	}
	
	if( $idgrupo > 0 )
	{		
		$conexao->conectarConf();
		$query = "SELECT * FROM material where id=$idgrupo";
		$resultado = $conexao->executaQuery($query);
		$linhaG = mysql_fetch_array($resultado);
		if( $linhaG )
		{
			$idgrupo = $linhaG["id"];
			$codmaterial = $linhaG["codmaterial"];
			$grupo = $linhaG["grupo"];
			$subgrupo = $linhaG["subgrupo"];
			$descricaocurta = $linhaG["descricaocurta"];
			$descricaolonga = $linhaG["descricaolonga"];
			$tamanho = $linhaG["tamanho"];
			$datafabricacao = $linhaG["datafabricacao"];
			$datavalidade = $linhaG["datavalidade"];
			$qtdmin = $linhaG["qtdmin"];
			$quantidade = $linhaG["quantidade"];
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
<?
/*if ($numbers = getRandomNumbers(1, 1, 99999, false, SORT_ASC)) {
    $codmaterial = implode(', ', $numbers);
} else {
    print 'A faixa de valores entre $min e $max deve ser igual ou superior à' .
        ' quantidade de números requisitados';
}*/

?>
<body> 
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="42%" align="left">&nbsp;</td>
    <td width="58%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO DE MATERIAL</legend>

    <form name="form" action="../classes/controleMaterial.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
    <td align="right" class="letra">Codigo do Material:</td>
    <td width="86%" colspan="5"><input name="xcodmaterial" type="text" class="codigomaterial" id="xcodmaterial" value="<? echo $codmaterial;?>" size="20" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
 </tr>
  <tr>
    <td width="14%" align="right" class="letra">Permanente:</td>
    <td colspan="5">
	  
	  <select name="ypemanente" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
       <option value="0">Selecionar...</option>
       <option value="1">SIM</option>
       <option value="2">NAO</option>
	  </select>
	  
	  </td>
    </tr> 
 <tr>
    <td width="14%" align="right" class="letra">Grupo:</td>
    <td colspan="5">
	  
	  <select name="ygrupo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
       <option value="0">Selecionar...</option>
        <?php
		 mysql_connect("192.168.1.20", "gmf", "6f532!@AT");
		 mysql_select_db("siga");
		 
         $sql = "SELECT * FROM grupo_material ORDER BY nome ASC";
         $qr = mysql_query($sql) or die(mysql_error());
         while($ln = mysql_fetch_assoc($qr)){
            echo '<option value="'.$ln['nome'].'">'.$ln['nome'].'</option>';
         }
      ?>
        
    </select>
	  
	  </td>
    </tr> 
	<tr>
    <td width="14%" align="right" class="letra">SubGrupo:</td>
    <td colspan="5">
    <select name="subgrupo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
       <option value="0" disabled="disabled">Escolha um Grupo Primeiro</option>
    </select>
	
		</td>
    </tr> 
  <tr>
    <td width="14%" align="right" class="letra">Descricao Curta:</td>
    <td colspan="5"><input name="xdescricaocurta" class="codigo" type="text" id="xdescricaocurta" value="<? echo $descricaocurta;?>" size="30" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
      </td>
    </tr>
 <tr>
   <td align="right" valign="top" class="letra">Descri&ccedil;&atilde;o Tecnica:</td>
   <td colspan="5"><textarea name="descricaolonga" cols="60" rows="4" onkeyup="converteUpper(this);"><? echo $descricaolonga;?></textarea></td>
   </tr>
 <tr>
   <td align="right" class="letra">Tamanho:</td>
   <td colspan="5"><input name="tamanho" type="text" class="codigo" id="tamanho" onkeyup="converteUpper(this);" value="<? echo $tamanho;?>" size="5" maxlength="4"/>    </td>
 </tr>
  <tr>
    <td align="right" class="letra">Data Validade:</td>
    <td colspan="5">
      <input type="text" value="<? echo $datavalidade;?>" readonly name="datavalidade" class="negrito" size="12"/>
      <a onClick="displayCalendar(document.forms[0].datavalidade,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' title='SELECIONAR DATA'></a> 
      </td>
  </tr>
  
 <!--dados do numero--> 
  <tr>
    <td align="right" class="letra">Estoque Minimo:</td>
    <td colspan="5"><input name="xminimo" type="text" class="codigo" id="xminimo" value="<? echo $qtdmin;?>" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  
 <!--dados do sangue-->
  <tr>
    <td align="right"><span class="letra">Estoque:</span></td>
    <td colspan="5"><input name="xquantidade" type="text" class="codigo" id="xquantidade" value="<? echo $quantidade;?>" size="5" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
    </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td colspan="5"><input name="Submit" type="submit" class="letra" id="Continuar" onClick="onClickButton(null,'Aguarde...','','Continuar')" value="Cadastrar" /></td>
    </tr>

</table>
</form>
</fieldset>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

</body>
</html>