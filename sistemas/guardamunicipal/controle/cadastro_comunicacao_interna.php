<?php
		header('Content-Type: text/html; charset=iso-8859-1');
// Os dois headers seguintes, evitam que a página seja armazenada em cache no navegador.
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
include("incValidaSessao.php");
    $idsession = $_SESSION['idSESSION'];
	require ("../classes/DB_mysql.php");
	require ("../classes/trataString.php");
	$objS = new trataString;
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();

	$login = "";
	$sql = "SELECT * FROM guarda_gmf where id=$idsession";
	$result = $obj->executaQuery($sql);
	$linha = mysql_fetch_array($result);
	if( $linha )
	{
		$login = $linha["login"];
	}
	
	//Pega a data atual
   $data_atual = date("Y-m-d");
   // Pega o ano da variavel $data_atual
   $ano_atual = substr($data_atual,0,4);
   // Pega o m�s da variavel $data_atual
   $mes_atual = substr($data_atual,5,2);
   // Pega o dia da variavel $data_atual
   $dia_atual = substr($data_atual,8,2);
   
   
   $query = "select MAX(id) as id from comunicacaointerna";
   $resultado = $obj->executaQuery($query);
   while ($linha=mysql_fetch_array($resultado))
   {
	 $idCi = $linha['id'];
	 $idCi = $idCi +1;
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
	<legend class="negrito">Cadastro Comunicacao Interna</legend>

<form name="form1" method="post" action="../classes/controleComunicacaoInterna.php" enctype="multipart/form-data" onSubmit="return validaFormAll(this,'Confirmar','Confirmar')">

<table width="100%" border="0" cellspacing="1" cellpadding="1">

 <tr>
   <td align="right" class="letra">Numero CI:</td>
   <td><font color="#000000" size="+2"><? echo $idCi.'/'.$ano_atual;?></font></td>
 </tr>
 <tr>
    <td width="13%" align="right" class="letra">De:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="87%"><input name="xlogin" id="xlogin" type="text" readonly="readonly" size="30" value="<?echo $login;?>"/></td>
 </tr>

  <tr>
    <td align="right" class="letra">Tratamento:<FONT COLOR="#FF0033">*</FONT></td>
    <td><select name="ytratamento">
      <option value="0">Selecionar...</option>
      <option value="DIRETOR">DIRETOR</option>
      <option value="SUBDIRETOR">SUBDIRETOR</option>
      <option value="CHEFE DE OPERACOES">CHEFE DE OPERACOES</option>
      <option value="GERENTE DE TRANSITO">GERENTE DE TRANSITO</option>
      <option value="GUARDA MUNICIPAL">GUARDA MUNICIPAL</option>
    </select></td>
  </tr>
  <tr>
    <td width="13%" align="right" class="letra">Para:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="87%"><select name="ypara">
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
		  </select></td>
 </tr>
  <tr>
    <td align="right" valign="top" class="letra">Assunto:<font color="#FF0033">*</font></td>
    <td><input name="xassunto" type="text" size="52" value="<?echo $assunto;?>"/></td>
  </tr>
  <tr>
    <td width="13%" align="right" valign="top" class="letra">Texto:<FONT COLOR="#FF0033">*</FONT></td>
    <td width="87%"><label for="xconteudo"></label>
      <textarea name="xconteudo" id="xconteudo" cols="100" rows="20"></textarea>      
	</td>
 </tr>

 <INPUT TYPE="hidden" NAME="idCi" value="<?echo $idCi;?>">	
	
  <tr height="2">
    <td align="left" class="quote" colspan="2">&nbsp;</td>
  </tr>

  <tr>	
    <td align="right">
    <td><input name="Submit" type="submit" class="botao" id="Confirmar" onClick="onClickButton(null,'Aguarde...','','Confirmar')" value="Confirmar" />
	</td>
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
