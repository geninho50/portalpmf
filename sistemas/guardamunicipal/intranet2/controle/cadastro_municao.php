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
    <td width="58%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="cabecalho">CADASTRO DE MUNIÇÃO</legend>

    <form name="form" action="../classes/controleMunicao.php" method="post" enctype="multipart/form-data"  onSubmit="return validaFormAll(this,'Continuar','Continuar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">
 <tr>
   <td align="right" class="letra">Descricao Curta:</td>
   <td>
     <input name="xdescricaocurta" type="text" id="xdescricaocurta" value="<? echo $descricaocurta;?>" size="30" class="negrito" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/>
   </td>
 </tr>
 <tr>
    <td align="right" class="letra">Calibre:</td>
    <td><input name="xcalibre" type="text" id="xcalibre" value="<? echo $calibre;?>" size="10" class="negrito" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
 </tr>
 <tr>
    <td width="19%" align="right" class="letra">Qtd:</td>
    <td><input name="xqtd" type="text" id="xqtd" value="<? echo $qtd;?>" size="10" class="negrito" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
 </tr> 
 <tr>
    <td width="19%" align="right" class="letra">Numero do Estojo:</td>
    <td><input name="xnumeroestojo" type="text" id="xnumeroestojo" value="<? echo $numeroestojo;?>" size="10" class="negrito" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
   </tr> 
  <tr>
    <td width="19%" align="right" class="letra">Data de Fabricacao:</td>
    <td><input type="text" value="<? echo $datafabricacao;?>" readonly name="datafabricacao" class="negrito" size="12"/>
      <a onClick="displayCalendar(document.forms[0].datafabricacao,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' title='SELECIONAR DATA'></a>
    
    </td>
  </tr>
 <tr>
   <td align="right" class="letra">Vencimento em Armazenagem:</td>
   <td>
    <input type="text" value="<? echo $datavalidade;?>" readonly name="datavalidade" class="negrito" size="12"/>
      <a onClick="displayCalendar(document.forms[0].datavalidade,'yyyy-mm-dd',this)"> <img  src="imagens/calendario.gif" width='16' height='16' border='0' title='SELECIONAR DATA'></a>
    </td>
 </tr>
  <tr>
    <td align="right" class="letra">Tipo: </td>
    <td width="81%">
      <select name="ytipo" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
       <option value="0">Selecionar...</option>
       <option value="OGIVAL SIMPLES">Ogival Simples</option>
	   <option value="GOLD">Gold</option>
     </select>
      
      </td>
    </tr>
  <tr>
    <td align="right" class="letra">Emprego:</td>
    <td>
    <select name="yemprego" class="negrito" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')">
       <option value="0">Selecionar...</option>
       <option value="TREINA">Treina</option>
	   <option value="USO">Uso</option>
     </select>
    </td>
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

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="18%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="82%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
  </tr>
</table>

</body>
</html>