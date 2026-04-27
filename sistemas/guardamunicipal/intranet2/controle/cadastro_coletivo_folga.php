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
   
    //Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   
   $sql = "SELECT * FROM guarda_gmf where id=$idsession";
   $result = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($result);
	if( $linha )
	{
		$login = $linha["login"];
	}
   
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<meta http-equiv="Content-Type" content="text/xhtml; charset=UTF-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
      <?php include("head/incHead.php");?>
<!-- fim inc head -->
</head>

<body>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!-- inicio do adm -->
	<fieldset>
	<legend class="cabecalho">CADASTRO COLETIVO DE FOLGAS</legend>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="38%">
<form name="form1" action="../classes/controleFolgaColetiva.php" method="post" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">
<br>
<table border="0" cellpadding="1" cellspacing="1">
 	<tr>
	    <td align="right" class="letra">Cadastrado por: </td>
	    <td><input name="cadastrado" readonly="readonly" value="<? echo $login;?>" type="text" size="15" class="negrito" onkeyup="converteUpper(this);"></td>
	</tr>
  <tr>
    <td width="161" align="right" class="letra">Descri&ccedil;&atilde;o da Folga:</td>
    <td width="292"><input name="xfolga" type="text" class="negrito" value="<?php echo $folga ?>" size="35" onkeyup="converteUpper(this);" onfocus="mudacor(this,'#8BC5F3')" onblur="mudacor(this,'white')"/></td>
  </tr>
</table>

<table width="100%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#0086a8"  >
  <tr>
     <td width="6%" align="center" class="branco"><input name="checktodos" type="checkbox"  class="negrito"/></td>
    <td width="67%" align="left" class="branco"><b>Guardas</b></td>
	<td width="27%" align="center" class="branco">Dias</td>
	</tr>
</table>

<?php 
   $queryE = "select * from guarda_gmf order by login";
   $resultE = $obj->executaQuery($queryE);
   
   while($linhaE = mysql_fetch_array($resultE)):
?>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="6%" align="center"><input name="conf[]" type="checkbox" value="<?php echo $linhaE['login']; ?>"/></td>
          <td width="67%"><input name="login" type="text" value="<?php echo $linhaE['login']; ?>" readonly="readonly" class="negrito" /></td>
		  <td width="27%" align="center"><input name="tdias[]" type="text" value="" size="4" class="negrito"/></td>
		 </tr>
</table>
<?php 
   endwhile
?>


<table width="100%"  border="0">

    <tr>   
    <td><input name="Submit" type="submit" class="letra" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />   </td>
  </tr>
  <tr>
    <td class="letra" align="center"><a href="javascript:history.back(1);">Voltar</a></td>
  </tr>
  
</table>
</form>
</td>
    <td width="62%" valign="top">&nbsp;</td>
    </tr>
</table>
	</fieldset>
	<!-- fim do adm -->
	</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="14%" align="right" bgcolor="#8BC5F3" ><img src="imagens/ico_atencao.gif" width="22" height="21"></td>
    <td width="86%" align="left" bgcolor="#8BC5F3" class="branco">Os campos que mudarem para cor azul, sao cosiderados obrigatorios.</td>
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