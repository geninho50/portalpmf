<?php
	include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	require ("../classes/trataString.php");
	$objS = new trataString;
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
		<?php include("incHead.php");?>
<!-- fim inc head -->
<script language="JavaScript" src="js/shortcut.js"></script>
<script type="text/javascript">
		function converteUpper(campo) {
        campo.value = campo.value.toUpperCase();
       }
	   
	   shortcut.add("F3",function() 
		{
			window.location.href = 'cadastro_guarnicao.php';
		});
		shortcut.add("F2",function() 
		{
			window.location.href = 'cadastro_ocorrencia.php';
		});
		shortcut.add("F4",function() 
		{
			window.location.href = 'administrar_ocorrencia.php';
		});
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
	<legend class="negrito">Cadastro de Ocorrências</legend>
<form name="form" action="../classes/controleOcorrencia.php" method="post" onSubmit="return validaFormAll(this,'Continuar','Continuar')">

  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td align="right"  class="letra">Atendente:</td>
          <td><input name="guarda" type="text" maxlength="10" id="guarda" readonly="readonly" value="<? echo $login;?>"/></td>
          <td align="right"  class="letra">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"  class="letra">&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"  class="letra">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="85" align="right"  class="letra">Telefone:</td>
          <td width="280"><input name="xtelefone" type="text" maxlength="10" id="xtelefone" value="<? echo $telefone;?>"/></td>
          <td width="83" align="right"  class="letra">Comunicante:</td>
          <td width="792"><input name="comunicante" type="text" size="40" id="comunicante" value="<? echo $comunicante; ?>" onkeyup="converteUpper(this);"/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="84" align="right"  class="letra">Rua:</td>
          <td><input name="rua" type="text" id="rua" value="<? echo $rua; ?>" size="40" onkeyup="converteUpper(this);"/></td>
		  <td width="77" align="right"  class="letra">N&uacute;mero:</td>
          <td width="798"><input name="numero" type="text" id="numero" value="<? echo $numero; ?>" size="8" maxlength="4" /></td>
        </tr>
        <tr>
          <td width="84" align="right"  class="letra">Bairro:</td>
          <td width="281"><input name="bairro" type="text" id="bairro" value="<? echo $bairro; ?>" size="30" onkeyup="converteUpper(this);"/></td>
          <td align="right"  class="letra">Refer&ecirc;ncia:</td>
          <td><input name="referencia" type="text" id="referencia" value="<? echo $referencia; ?>" size="30" onkeyup="converteUpper(this);"/></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="85" align="right" valign="top" class="letra" >Descri&ccedil;&atilde;o da Ocorr&ecirc;ncia:</td>
          <td width="1177">
		
			<?php
	$texto = $objS->filtra_caracteres($texto," ");
	?>
	<script type="text/javascript">
	<!--
	// Automatically calculates the editor base path based on the _samples directory.
	// This is usefull only for these samples. A real application should use something like this:
	// oFCKeditor.BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
	var sBasePath = 'fckeditor/';
	var oFCKeditor = new FCKeditor( 'xdescricao' ) ;
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.Width	= 700 ;
	oFCKeditor.Height	= 300 ;
	oFCKeditor.Value	= "<?php echo $descricao_ocorrrencia;?>";
	oFCKeditor.Create() ;
	//-->
	</script>
          </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
	  <table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="83" align="right" class="letra" >Tipifica&ccedil;&atilde;o:</td>
          <td width="169"><select name="tipificacao">
            <option value="Apoio">Apoio</option>
            <option value="Crime">Crime</option>
            <option value="Diversos">Diversos</option>
            <option value="Emergencias">Em&ecirc;rgencias</option>
            <option value="Operacoes">Opera&ccedil;&otilde;es</option>
            <option value="Transito" selected>Tr&acirc;nsito</option>
          </select></td>
          <td width="62" align="right" class="letra" >Data:</td>
          <td width="170"><input name="data_cadastro" type="text" size="20" value="<? echo $data_atual;?>" readonly="readonly" /></td>
		  <td width="62" align="right" class="letra" >Hora:</td>
          <td width="682"><input name="hora_cadastro" type="text" size="20" value="<? echo $hora_atual;?>" /></td>
        </tr>
      </table>
	  
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td width="7%" align="right">&nbsp;</td>
          <td width="37%"><input name="Submit" type="submit" class="botao" id="Submit" onclick="onClickButton(null,'Aguarde...','','Continuar')" value="Confirmar" /></td>
          <td width="7%">&nbsp;</td>
          <td width="49%">&nbsp;</td>
        </tr>
      </table></td>
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
