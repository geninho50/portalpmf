<?php
	require ("../classes/DB_mysql.php");
	$obj = new DB_mysql;
	$conexao = $obj->conectarConf();
	//Pega a data atual
   $data_atual = date("Y-m-d");
   $hora_atual = date("H:i:s");
   
   $query = "select MAX(id) as id from transporte";
   $resultado = mysql_query($query) or die ("Não foi possível realizar a consulta ao banco de dados");	
   while ($linha=mysql_fetch_array($resultado))
   {
	 $idTransporte = $linha['id'];
   }
   
	$sql = "SELECT id,nome,DAY(data) as dia,MONTH(data) as mes,YEAR(data) as ano,telefone,rua,numero,bairro,referencia,justificativa,hora FROM transporte where id=$idTransporte";
	$result = $obj->executaQuery($sql);
	$dados = mysql_fetch_array($result);
	if( $dados )
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
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- ini inc head -->
		<?php include("incCadastro2.php");?>
<!-- fim inc head -->
</head>
<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8%" align="center">&nbsp;</td>
        <td width="17%" align="center"><img src="images/brasao.png" width="103" height="128" /></td>
        <td width="66%" align="center"><font color="#000000" size="+1">Prefeitura Municipal de Florian&oacute;polis</font><br>
          <font color="#000000" size="+1">Secretaria Municipal de Seguran&ccedil;a e Defesa do Cidad&atilde;o</font><br>
          <font color="#000000" size="+1">Guarda Municipal de Florian&oacute;polis </font><br>          </td>
        <td width="9%" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><font color="#000000" size="+2">Confirma&ccedil;&atilde;o do Cadastro para agendamento do Transporte Solid&aacute;rio</font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="confirmar" align="center">Seu cadastro foi realizado com sucesso!!<br> 
    Protocolo de numero: <BR>
    <font color="#000000" size="+2"><? echo $id;?></font> <br>
	<br>	
	Data pre-agendada <font color="#FF0000" size="+1"><?php echo $dia."/".$mes."/".$ano; ?></font>.<br>
	Aguarde nosso contato!!<br>
	Em ate 48h pelo telefone <font color="#FF0000" size="+1"><?php echo $telefone; ?> </font>para confirmar o transporte.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<!--inicio adm-->
	<fieldset>
	<legend class="negrito">Confirmacao do Cadastro</legend>
  <table width="100%"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%"  border="0" cellpadding="0" cellspacing="1">
        <tr>
          <td width="17%" align="right">Nome:</td>
          <td width="83%"><? echo $nome; ?></td>
          </tr>
		<tr>
		  <td align="right">Telefone:</td>
		  <td><? echo $telefone;?></td>
		  </tr>
		<tr>
          <td align="right">Rua:</td>
          <td><? echo $rua.', '.$numero;?></td>
		  </tr>
        <tr>
          <td align="right">Bairro:</td>
          <td><? echo $bairro;?></td>
          </tr>
      	<tr>
      	  <td align="right" valign="top" >Ponto de Refer&ecirc;ncia :</td>
      	  <td><? echo $referencia;?></td>
    	  </tr>
	  </table>
	  </td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%" align="right" valign="top">Justifitica da necessidade: </td>
          <td width="83%"><? echo $justificativa;?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17%">&nbsp;</td>
          <td width="83%">
		  <script language="JavaScript1.2">
			<!--
			function DoPrinting(){
			if (!window.print){
			alert("Use o Netscape  ou Internet Explorer \n nas versões 4.0 ou superior!")
			return
			}
			window.print()
			}
			//-->
			</script>
			<form>
			  <input type="button" value="Clique para imprimir a pagina" OnClick="javascript:DoPrinting()">
			</form>
		  </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</fieldset>
	<!--fim adm-->
	</td>
  </tr>
</table>

</body>
</html>
